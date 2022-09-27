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
    public function index(Request $request)
    {
        if( can('all_supplier') || can('all_supplier_report') || can('supplier_transaction_report') ){

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $search = $request->search;
            $supplier_id = $request->supplier_id;
            $purchase_date = $request->purchase_date;
            $date = explode('-', $purchase_date);
            $start_date = $purchase_date != null ? Carbon::parse($date[0])->format('Y-m-d') : null;
            $end_date = $purchase_date != null ?  Carbon::parse($date[1])->format('Y-m-d') : null;

            $supplier = new Supplier();
            $suppliers = $supplier->GetAllSupplier($search, $supplier_id, $start_date, $end_date);

            /*if ($request->search) {
                $search = $request->search;
//                return $request;
                $suppliers = $supplier->GetAllSupplier($search);
            }*/

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            $supplier_list = Supplier::where('is_active', true)->get();

            return view('backend.modules.supplier.index', compact('suppliers', 'supplier_list'));

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
    public function add(Request $request)
    {
        // return $request;
        if( can('add_supplier') ){

            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'nullable|max:2000',
                'company' => 'nullable|max:2000',
                'opening_balance' => 'nullable|numeric'
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()] ,422);
            }else{

                $today = Carbon::now();

                // DB::beginTransaction();

                // try{

                    $supplier = new Supplier();
                    $supplier->name = $request->name;
                    $supplier->contact_no  = $request->phone;
                    $supplier->address = $request->address;
                    $supplier->company = $request->company;
                    $supplier->is_active = true;

                    if($supplier->save() && $request->opening_balance){

                        $purchase = new Purchase();
                        $purchase->supplier_id = $supplier->id;
                        $purchase->date = $today;
                        $purchase->challan_no = $today.'_'.rand(1000, 9999).'_'.$supplier->id;
                        $purchase->total_amount =  $request->opening_balance;
                        $purchase->created_by =  Auth::user()->id;
                        $purchase->remarks = "Opening due purchase";
                        $purchase->save();

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
    public function supplier_transactions(Request $request)
    {

        if(can('supplier_transactions') || can('all_supplier_report') || can('supplier_transaction_report')) {
            $transaction = new Supplier();

            $supplier = Supplier::with([
                'purchases' => function($query){
                    $query->select('id', 'challan_no', 'supplier_id', 'total_amount', 'paid_amount');
                }
            ])->findOrFail($request->supplier_id);

            $supplier_transactions = $transaction->GetSupplierTransactions($request->supplier_id);


            return view('backend.modules.supplier.supplier_transactions', compact('supplier_transactions', 'supplier'));
        } else {
            return view('errors.404');
        }
    }

    public function supplier_pay_bill(Request $request, $id)
    {

        // return $request;

        $validator = Validator::make($request->all(),[
             'paid_amount' => 'required|numeric',
         ]);

         if( $validator->fails() ){
             return response()->json(['errors' => $validator->errors()] ,422);
         }

         $id = decrypt($id);
         $today = Carbon::now();
         $purchases = Purchase::with(['supplier' => function($query){ $query->select('id', 'name');}])->where('supplier_id', $id);

         if ($request->deduct_from_individual_challan && $request->paid_amount) {

             $purchase = $purchases->find($request->challan_sale_id);
             $purchase->paid_amount = $purchase->paid_amount + $request->paid_amount;

             if ($purchase->update()) {
                 $transaction = new Transaction();
                 $transaction->date = $today->toDateString();
                 $transaction->transaction_code = $today.'_'.rand(100, 999).'_'.'BC#supplier';
                 $transaction->narration = 'Pay Bill';
                 $transaction->supplier_id = $purchase->supplier->id;
                 $transaction->remarks = 'Pay Bill '.$purchase->supplier->name;
                 $transaction->cash_out = BnToEn($request->paid_amount);
                 $transaction->created_by = auth('web')->user()->id;
                 $transaction->save();
             }

         } elseif ($request->deduct_from_individual_challan != '1' && $request->paid_amount) {
             $purchases = $purchases->orderBy('date', 'desc')->get();
             $adjust_amount = $request->paid_amount;

             foreach ($purchases as $purchase_e) {

                if ($adjust_amount > 0) {

                $purchase_due = $purchase_e->total_amount - $purchase_e->paid_amount;
                $tran_amount = 0;

                if ($adjust_amount >= $purchase_due) {

                    $tran_amount = $purchase_due;
                    $purchase_e->paid_amount = $purchase_e->paid_amount + $tran_amount;
                    $adjust_amount -= $tran_amount;

                } else {

                    $tran_amount = $adjust_amount;
                    $purchase_e->paid_amount = $purchase_e->paid_amount + $adjust_amount;
                    $adjust_amount -= $adjust_amount;
                }

                if ($purchase_e->update()) {

                    $transaction = new Transaction();
                    $transaction->date = $today;
                    $transaction->transaction_code = $today.'_'.rand(100, 999).'_'.'BC#supplier';
                    $transaction->narration = 'Pay Bill';
                    $transaction->supplier_id = $purchase_e->supplier->id;
                    $transaction->remarks = 'Pay Bill '.$purchase_e->supplier->name;
                    $transaction->cash_out = BnToEn($tran_amount);
                    $transaction->created_by = auth('web')->user()->id;
                    $transaction->save();
                }
                }
             }
         }

         return response()->json(['success' => "success"], 200);

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
