<?php

namespace App\Http\Controllers\Backend\SupplierModule;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseModule\Purchase;
use App\Models\SettingsModule\CompanyInfo;
use App\Models\SupplierModule\Supplier;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        if( can('all_supplier') || can('all_supplier_report') || can('supplier_transaction_report') ){

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $suppliers = new Supplier();
            $suppliers = $suppliers->GetAllSupplier();

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            return view('backend.modules.supplier.index', compact('suppliers'));

        } else {
            return view("errors.404");
        }
    }

    //supplier add modal start
    public function add_modal(){
        if( can('add_supplier') ){
            return view("backend.modules.supplier.modals.add");

        } else{
            return view("errors.404");
        }
    }

    //add supplier start
    public function add(Request $request){

        if( can('add_supplier') ){
            $today = Carbon::now();
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'nullable|max:2000',
                'company' => 'nullable|max:2000',
                'opening_balance' => 'required'
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()] ,422);
            }else{

                // DB::beginTransaction();

                // try{

                    $supplier = new Supplier();
                    $supplier->name = $request->name;
                    $supplier->contact_no  = $request->phone;
                    $supplier->address = $request->address;
                    $supplier->company = $request->company;
                    $supplier->is_active = true;
                    $supplier->save();

                    if($request->opening_balance){
                        $transaction = new Transaction();
                        $transaction->date = $today->toDateString();
                        $transaction->transaction_code = $today.'OP#Sup';
                        $transaction->narration = 'OPENING BALANCE';
                        $transaction->supplier_id = $supplier->id;
                        $transaction->remarks = 'Opening Balance of '.$supplier->name;
                        $transaction->cash_in = BnToEn($request->opening_balance);
                        $transaction->created_by = auth('web')->user()->id;
                        $transaction->save();
                    }

                    return response()->json(['supplier_add' => __("Supplier.SupplierAddSuccessMsg")], 200);

                // }catch( Exception $e ){
                //     DB::rollBack();
                //     return response()->json(['error' => $e->getMessage()],200);
                // }
            }
        }else{
            return view("errors.404");
        }
    }

    //supplier show modal start
    public function show($id){
        if( can("view_supplier") || can('all_supplier_report') || can('supplier_transaction_report')){
            $supplier = Supplier::where("id",$id)->select("id", "name", "contact_no", 'address', 'company', "is_active")->first();

            return view("backend.modules.supplier.modals.show", compact("supplier"));
        }
        else{
            return view("errors.404");
        }
    }

    //supplier edit modal start
    public function edit($id){
        if( can("edit_supplier") ){
            $supplier = Supplier::where("id",$id)->select("id", "name", "contact_no", 'address', 'company', "is_active")->first();

            return view("backend.modules.supplier.modals.edit", compact("supplier"));
        }
        else{
            return view("errors.404");
        }
    }

    //supplier update modal start
    public function update(Request $request, $id){
        if( can('edit_supplier')){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'nullable|max:2000',
                'company' => 'nullable|max:2000',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()] ,422);
            }else{
                try{
                    $supplier = Supplier::find($id);
                    $supplier->name = $request->name;
                    $supplier->contact_no  = $request->phone;
                    $supplier->address = $request->address;
                    $supplier->company = $request->company;
                    $supplier->is_active = true;

                    if( $supplier->update() ){
                        return response()->json(['supplier_update' => __('Supplier.SupplierUpdateMsg')], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }else{
            return view("errors.404");
        }
    }

    public function show_details(Request $request) {
        $supplier = Supplier::with('transactions')->find($request->id);

        return response()->json($supplier);
    }

    // Supplier Transaction
    public function suppllier_transactions($id)
    {
        if(can('supplier_transactions') || can('all_supplier_report') || can('supplier_transaction_report')) {
            $transaction = new Supplier();
            $supplier_transactions = $transaction->GetSupplierTransactions(decrypt($id));

            return view('backend.modules.supplier.supplier_transactions', compact('supplier_transactions', 'id'));
        } else {
            return view('errors.404');
        }
    }

    // Supplier Transaction Export Pdf
    public function supplier_transactions_export_pdf($id)
    {
        if(can('supplier_transactions') || can('all_supplier_report') || can('supplier_transaction_report')) {
            $transaction = new Supplier();
            $supplier_transactions = $transaction->GetSupplierTransactions(decrypt($id));

            $company_info = CompanyInfo::first();
            $title = __('Supplier.SupplierTransactions');

            $now = new DateTime();
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

            $mpdf->SetTitle(__("Supplier.SupplierTransactions"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.supplier.export.pdf.supplier_transactions_export_pdf', compact(
                'supplier_transactions',
                'company_info',
                'title'
            )));
            $mpdf->Output("SupplierTransactions".'.pdf', "I");

        } else {
            return view('errors.404');
        }
    }

    // Supplier Transaction Details
    public function supplier_transaction_details($id)
    {
        if(can('supplier_transactions' || can('all_supplier_report') || can('supplier_transaction_report'))) {
            $transaction = new Transaction();
            $transaction_details = $transaction->SupplierTransactionDetails(decrypt($id));

            return view('backend.modules.supplier.supplier_transaction_details', compact('transaction_details', 'id'));
        } else {
            return view('errors.404');
        }
    }

    // Supplier Transaction Details Export Pdf
    public function supplier_transaction_details_export_pdf($id)
    {
        if(can('supplier_transactions') || can('all_supplier_report') || can('supplier_transaction_report')) {
            $transaction = new Transaction();
            $transaction_details = $transaction->SupplierTransactionDetails(decrypt($id));

            $company_info = CompanyInfo::first();
            $title = __('Supplier.SupplierTransactionDetails');

            $now = new DateTime();
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

            $mpdf->SetTitle(__("Supplier.SupplierTransactionDetails"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.supplier.export.pdf.supplier_transaction_details_export_pdf', compact(
                'transaction_details',
                'company_info',
                'title'
            )));
            $mpdf->Output("SupplierTransactionDetails".'.pdf', "I");

        } else {
            return view('errors.404');
        }
    }




}
