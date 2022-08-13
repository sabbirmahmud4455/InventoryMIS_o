<?php

namespace App\Http\Controllers\Backend\CustomerModule;

use App\Models\SettingsModule\CompanyInfo;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerModule\Customer;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use App\Models\StockModule\StockInOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if( can('all_customer') || can('all_customer_report') ){

            $append = [];


            $customers = Customer::with('transactions')->select('id', 'name', 'contact_no', 'is_active')->orderBy('id', 'desc');

            if ($request->customer_search != null) {
                $customers = $customers->where(function ($query) use($request) {
                                        $query->where('name', 'like', '%' . $request->customer_search . '%')
                                        ->orWhere('contact_no', 'like', '%' . $request->customer_search . '%');
                                    });
                $append['customer_search'] = $request->customer_search;
            }

            $customers = $customers->paginate(10)->appends($append);

            return view('backend.modules.customer_module.index', compact('customers'));

        } else {
            return view("errors.404");
        }
    }

    //customer add modal start
    public function add_modal(){
        if( can('add_customer') ){
            return view("backend.modules.customer_module.modals.add");

        } else{
            return view("errors.404");
        }
    }

    //add customer start
    public function add(Request $request){

        if( can('add_customer') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'nullable|max:2000',
                'remarks' => 'nullable|max:2000',
                'opening_balance' => 'required',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()] ,422);
            }else{
                try{
                    $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->contact_no  = $request->phone;
                    $customer->address = $request->address;
                    $customer->remarks = $request->remarks;
                    $customer->is_active = true;

                    if( $customer->save() ){

                        $today = Carbon::now();
                        if($request->opening_balance){
                            $transaction = new Transaction();
                            $transaction->date = $today->toDateString();
                            $transaction->transaction_code = $today.'OP#CUSTOMER';
                            $transaction->narration = 'OPENING BALANCE';
                            $transaction->customer_id = $customer->id;
                            $transaction->remarks = 'Opening Balance of '.$customer->name;
                            $transaction->cash_in = BnToEn($request->opening_balance);
                            $transaction->created_by = auth('web')->user()->id;
                            $transaction->save();
                        }

                        return response()->json(['customer_add' => __('Customer.CustomerAddSuccessMsg')], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }else{
            return view("errors.404");
        }
    }

    //customer show modal start
    public function show($id){
        if( can("view_customer") || can('all_customer_report')){
            $customer = Customer::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.customer_module.modals.show", compact("customer"));
        }
        else{
            return view("errors.404");
        }
    }

    //customer edit modal start
    public function edit($id){
        if( can("edit_customer") ){
            $customer = Customer::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.customer_module.modals.edit", compact("customer"));
        }
        else{
            return view("errors.404");
        }
    }

    //customer update modal start
    public function update(Request $request, $id){
        if( can('edit_customer')){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'nullable|max:2000',
                'remarks' => 'nullable|max:2000',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()] ,422);
            }else{
                try{
                    $customer = Customer::find($id);
                    $customer->name = $request->name;
                    $customer->contact_no  = $request->phone;
                    $customer->address = $request->address;
                    $customer->remarks = $request->remarks;
                    $customer->is_active = true;

                    if( $customer->update() ){
                        return response()->json(['customer_update' => __('Customer.CustomerUpdateMsg')], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }else{
            return view("errors.404");
        }
    }

    // customer transaction
    public function customer_transaction(Request $request)
    {
        if (can('customer_transaction')) {

            $customer = Customer::findOrFail($request->customer_id);
            $customer_transactions = Transaction::where('customer_id', $customer->id)->get();

            return view("backend.modules.customer_module.transaction.customer_transaction", compact('customer', "customer_transactions"));

        } else {
            return view('errors.404');
        }
    }
    // customer transaction
    public function customer_transaction_export_pdf($id)
    {
        if (can('customer_transaction')) {

            $customer = Customer::findOrFail(decrypt($id));
            $customer_transactions = Transaction::where('customer_id', $customer->id)->get();

            $company_info = CompanyInfo::first();
            $title = __('Customer.Transaction');

            $now = new \DateTime();
            $time = $now->format('F j, Y, g:i a');
            $auth_user = Auth::user()->name;

            $footer = "
                    <span style='margin: 29px;'>Page :
                    <span></span>{PAGENO} of {nbpg}</span>
                    &nbsp;
                    &nbsp;
                    &nbsp;

                    <span class='print_date'>Print Date : $time
                </span>

                &nbsp;
                &nbsp;
                &nbsp;
                <span class='print_by'>
                    Printed By : $auth_user
                </span>

                &nbsp;
                &nbsp;
                <span class='powered_by'> Powered By: RP AI Solutions </span>
                &nbsp;
                ";

            $mpdf = new \Mpdf\Mpdf(
                [
                    // 'default_font_size' => 12,
                    'default_font' => 'nikosh',
                    'mode' => 'utf-8',
                ]
            );

            $mpdf->SetTitle(__("Customer.Transaction"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.customer_module.transaction.export.pdf.customer_transaction_export_pdf', compact(
                'customer',
                'customer_transactions',
                'company_info',
                'title'
            )));
            $mpdf->Output("CustomerTransactions".'.pdf', "I");

        } else {
            return view('errors.404');
        }
    }

    // Customer Transaction function details
    public function customer_transaction_details($id) {
        if(can('customer_transaction')) {
            $customer_transaction_details = Transaction::with('customer', 'sale')->findOrFail(decrypt($id));
            return view('backend.modules.customer_module.transaction.customer_transaction_details', compact('customer_transaction_details', 'id'));
        } else {
            return view('errors.404');
        }

    }

    // Customer Transaction function details export pdf
    public function customer_transaction_details_export_pdf($id) {
        if(can('customer_transaction')) {
            $customer_transaction_details = Transaction::with('customer', 'sale')->findOrFail(decrypt($id));

            $company_info = CompanyInfo::first();
            $title = __('Customer.TransactionDetails');

            $now = new \DateTime();
            $time = $now->format('F j, Y, g:i a');
            $auth_user = Auth::user()->name;

            $footer = "
                    <span style='margin: 29px;'>Page :
                    <span></span>{PAGENO} of {nbpg}</span>
                    &nbsp;
                    &nbsp;
                    &nbsp;

                    <span class='print_date'>Print Date : $time
                </span>

                &nbsp;
                &nbsp;
                &nbsp;
                <span class='print_by'>
                    Printed By : $auth_user
                </span>

                &nbsp;
                &nbsp;
                <span class='powered_by'> Powered By: RP AI Solutions </span>
                &nbsp;
                ";

            $mpdf = new \Mpdf\Mpdf(
                [
                    // 'default_font_size' => 12,
                    'default_font' => 'nikosh',
                    'mode' => 'utf-8',
                ]
            );

            $mpdf->SetTitle(__("Customer.TransactionDetails"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.customer_module.transaction.export.pdf.customer_transaction_details_export_pdf', compact(
                'customer_transaction_details',
                'company_info',
                'title'
            )));
            $mpdf->Output("CustomerTransactionsDetails".'.pdf', "I");

        } else {
            return view('errors.404');
        }

    }



}
