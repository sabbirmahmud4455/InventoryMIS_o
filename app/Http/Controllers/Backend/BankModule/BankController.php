<?php

namespace App\Http\Controllers\Backend\BankModule;

use App\Http\Controllers\Controller;
use App\Models\BankModule\Bank;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    //index function start
    public function index()
    {
        if (can('bank'))
        {
            return view('backend.modules.bank_module.bank.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('bank') ){

            $bank = Bank::select("id", "name", 'account_name', 'account_no', 'branch_name', "is_active", 'is_delete')->get();

            return DataTables::of($bank)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (Bank $bank) {
                    if ($bank->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->addColumn('action', function (Bank $bank) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$bank->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$bank->id.'">

                        '.( can("view_bank") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('bank.view.modal',$bank->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('Bank.ViewBank').'
                        </a>
                        ': '') .'

                        '.( can("edit_bank") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('bank.edit.modal',$bank->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('Bank.EditBank').'
                        </a>
                        ': '') .'
                        '.( can("bank_transaction") ? '
                        <a class="dropdown-item" href="'.route('bank.transaction', ['id' => encrypt($bank->id)]).'" class="btn btn-outline-dark">
                            <i class="fas fa-exchange-alt"></i>
                            '.__('Bank.Transaction').'
                        </a>
                        ': '') .'

                    </div>
                </div>
                ';
                })
                ->make(true);
        }else{
            return view("errors.404");
        }
    }
    //data function end

    //add modal function start
    public function add_modal(){
        if( can("add_bank") ){
            return view('backend.modules.bank_module.bank.modals.add');
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_bank") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                "account_name" => "required",
                "account_no" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $bank = new Bank();

                    $bank->name = $request->name;
                    $bank->account_name = $request->account_name;
                    $bank->account_no = $request->account_no;
                    $bank->branch_name = $request->branch_name;
                    $bank->is_active = true;
                    $bank->is_delete = false;
                    $AddSwal = __('Bank.AddSwal');
                    if( $bank->save() ){

                        $today = Carbon::now();
                        if($request->opening_balance){
                            $transaction = new Transaction();
                            $transaction->date = $today->toDateString();
                            $transaction->transaction_code = $today.'OP#Bank';
                            $transaction->narration = 'OPENING BALANCE';
                            $transaction->bank_id = $bank->id;
                            $transaction->remarks = 'Opening Balance of '.$bank->account_no;
                            $transaction->cash_in = BnToEn($request->opening_balance);
                            $transaction->created_by = auth('web')->user()->id;
                            $transaction->save();
                        }

                        return response()->json(['success' => $AddSwal], 200);
                    }

                }
                catch( \Exception $e ){
                    return response()->json(['error' => $e->getMessage()], 200);
                }
            }

        }
        else{
            return view('errors.404');
        }
    }
    //add function end

    //edit modal function start
    public function edit_modal($id)
    {
        if (can('edit_bank'))
        {
            $bank = Bank::where('id',$id)->with('transactions')->select("id", "name", 'account_name', 'account_no', 'branch_name', "is_active", 'is_delete')->first();
            return view('backend.modules.bank_module.bank.modals.edit',compact('bank'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_bank") ){
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "account_name" => "required",
                "account_no" => "required",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $bank = Bank::find($id);
                    $bank->name = $request->name;
                    $bank->account_name = $request->account_name;
                    $bank->account_no = $request->account_no;
                    $bank->branch_name = $request->branch_name;
                    $bank->is_active = $request->is_active;
                    $bank->is_delete = false;
                    $EditSwal = __('Bank.EditSwal');
                    if( $bank->save() ){
                        
                        $today = Carbon::now();
                        if($request->opening_balance){
                            $transaction = new Transaction();
                            $transaction->date = $today->toDateString();
                            $transaction->transaction_code = $today.'OP#Bank';
                            $transaction->narration = 'OPENING BALANCE';
                            $transaction->bank_id = $bank->id;
                            $transaction->remarks = 'Opening Balance of '.$bank->account_no;
                            $transaction->cash_in = BnToEn($request->opening_balance);
                            $transaction->created_by = auth('web')->user()->id;
                            $transaction->save();
                        }

                        return response()->json(['success' => $EditSwal], 200);
                    }

                }
                catch( \Exception $e ){
                    return response()->json(['error' => $e->getMessage()], 200);
                }
            }

        }
        else
        {
            return view('errors.404');
        }
    }
    //edit function end


    //view modal function start
    public function view($id)
    {
        if (can('view_unit'))
        {
            $bank = Bank::find($id);
            return view('backend.modules.bank_module.bank.modals.view',compact('bank'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end

    // Bank Transaction function start
    public function bank_transaction($id) {
        if(can('bank_transaction')) {
            $bank = Bank::with('transactions')->where('is_delete', false)->findOrFail(decrypt($id));
            $bank_transactions = Transaction::where('bank_id', $bank->id)->get();
            return view('backend.modules.bank_module.bank.transaction.bank_transaction', compact('bank', 'bank_transactions'));
        } else {
            return view('errors.404');
        }
        
    }
    // Bank Transaction function end

    // Bank Transaction function start
    public function bank_transaction_details($id) {
        if(can('bank_transaction')) {
            $bank_transaction_details = Transaction::with('bank', 'purchase')->findOrFail(decrypt($id));
            return view('backend.modules.bank_module.bank.transaction.bank_transaction_details', compact('bank_transaction_details'));
        } else {
            return view('errors.404');
        }
        
    }
    // Bank Transaction function end


}
