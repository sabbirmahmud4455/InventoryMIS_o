<?php

namespace App\Http\Controllers\Backend\TransactionModule;

use App\Http\Controllers\Controller;
use App\Models\BankModule\Bank;
use App\Models\SettingsModule\CompanyInfo;
use App\Models\SystemDataModule\TransactionType;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    // all transaction function
    public function all_transaction() {
        if(can('all_transaction') || can('all_transaction_report')) {
            $transactions = Transaction::orderBy('id', 'desc')->paginate(50);
            return view('backend.modules.transaction_module.transaction.index', compact('transactions'));
        } else {
            return view('errors.404');
        }
    }

    // transaction create page
    public function transaction_create_page() {
        if(can('new_transaction')) {
            $transaction_types = TransactionType::where('is_active', true)->where('is_delete', false)->get();
            $banks = Bank::where('is_active', true)->where('is_delete', false)->get();
            return view('backend.modules.transaction_module.transaction.create_transaction.index', compact('transaction_types', 'banks'));
        } else {
            return view('errors.404');
        }
    }

    // transaction create
    public function transaction_create(Request $request) {
        if(can('new_transaction')) {
            $validator = Validator::make($request->all(), [
                'date' => 'required',
                "transaction_type_id" => "required",
                "transaction_amount" => "required",
                "payment_type" => "required",
                "bank_id" => "required_if:payment_type,==,Bank",
                "cheque_no" => "required_if:payment_type,==,Bank",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    
                    $transaction_type = TransactionType::where('id', $request->transaction_type_id)->first();
                    $cash_type = $transaction_type->cash_type;
                    

                    $today = Carbon::now();
                    $transaction = new Transaction();
                    $transaction->date = $request->date;
                    $transaction->transaction_code = $today.'Tran#'.$transaction_type->name;
                    $transaction->transaction_type_id = $request->transaction_type_id;
                    $transaction->narration = $transaction_type->name.' Transaction';
                    
                    $transaction->remarks = 'Transaction of '.$transaction_type->name;
                    $transaction->created_by = auth('web')->user()->id;

                    if($cash_type === 'Cash In') {
                        $transaction->cash_in = BnToEn($request->transaction_amount);
                        $transaction->cash_out = 0;
                    } else if($cash_type === 'Cash Out') {
                        $transaction->cash_out = BnToEn($request->transaction_amount);
                        $transaction->cash_in = 0;
                    }

                    if($request->payment_type === 'Bank') {
                        $transaction->bank_id = $request->bank_id;
                        $transaction->cheque_no = $request->cheque_no;
                    } else if($request->payment_type === 'Cash') {
                        $transaction->bank_id = null;
                        $transaction->cheque_no = null;
                    }

                    $addSwal = __('Transaction.AddSwal');
                    if($transaction->save()) {
                        $transaction_details_route = route('transaction.details', ['id' => encrypt($transaction->id)]);
                        // return response()->json(['success' => __('Transaction.AddSwal')]);
                        return response()->json(['create_transaction' => $transaction_details_route, 'addSwal' => $addSwal], 200);
                    }

                } catch(Exception $e) {
                    return response()->json(['error' => $e->getMessage()]);
                }
            }
        } else {
            return view('errors.404');
        }
    }

    // transaction status change
    public function transaction_status_change($id) {
        if(can('transaction_status_change')) {
            $transaction = Transaction::findOrFail(decrypt($id));
            return view('backend.modules.transaction_module.transaction.transaction_status_change', compact('transaction'));
        } else {
            return view('errors.404');
        }
    }

    // transaction status update
    public function transaction_status_update(Request $request, $id) {
        if(can('transaction_status_change')) {
            $transaction = Transaction::findOrFail(decrypt($id));

            $validator = Validator::make($request->all(), [
                'status' => 'required',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $transaction->status = $request->status;
                    $ChangeStatusSwal = __('Transaction.ChangeStatusSwal');
                    if($transaction->save()) {
                        return response()->json(['success' => $ChangeStatusSwal], 200);
                    }
                    
                } catch(Exception $e) {
                    return response()->json(['error' => $e->getMessage()]);
                }
            }

        } else {
            return view('errors.404');
        }
    }

    // transaction details
    public function transaction_details($id) {
        if(can('transaction_details') || can('all_transaction_report')) {
            $transaction = Transaction::with('transaction_type', 'purchase', 'supplier', 'bank', 'created_by_user')->findOrFail(decrypt($id));
            return view('backend.modules.transaction_module.transaction.details.transaction_details', compact('transaction'));
        } else {
            return view('errors.404');
        }
    }

    // transaction details
    public function transaction_details_export_pdf($id) {
        if(can('transaction_details') || can('all_transaction_report')) {
            $transaction = Transaction::with('transaction_type', 'purchase', 'supplier', 'bank', 'created_by_user')->findOrFail(decrypt($id));

            $company_info = CompanyInfo::first();
            $title = __('Transaction.TransactionDetails');

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

            $mpdf->SetTitle(__("Transaction.TransactionDetails"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.transaction_module.transaction.details.export.pdf.transaction_details_export_pdf', compact(
                'transaction',
                'company_info',
                'title'
            )));
            $mpdf->Output("TransactionDetails".'.pdf', "I");

        } else {
            return view('errors.404');
        }
    }




}
