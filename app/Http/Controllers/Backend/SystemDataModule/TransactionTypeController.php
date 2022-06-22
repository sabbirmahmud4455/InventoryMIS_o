<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TransactionTypeController extends Controller
{
    //index function start
    public function index()
    {
        if (can('transaction_type'))
        {
            return view('backend.modules.system_data_module.transaction_type.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('transaction_type') ){

            $transaction_type = TransactionType::select("id", "name", 'cash_type', "is_active", 'is_delete')->get();

            return DataTables::of($transaction_type)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (TransactionType $transaction_type) {
                    if ($transaction_type->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->addColumn('action', function (TransactionType $transaction_type) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$transaction_type->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$transaction_type->id.'">

                        '.( can("view_payment_type") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('transaction.type.view.modal',$transaction_type->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('TransactionType.ViewTransactionType').'
                        </a>
                        ': '') .'

                        '.( can("edit_payment_type") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('transaction.type.edit.modal',$transaction_type->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('TransactionType.EditTransactionType').'
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
        if( can("add_payment_type") ){
            return view('backend.modules.system_data_module.transaction_type.modals.add');
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_transaction_type") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:payment_types,name',
                'cash_type' => 'required',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $transaction_type = new TransactionType();

                    $transaction_type->name = $request->name;
                    $transaction_type->cash_type = $request->cash_type;
                    $transaction_type->is_active = true;
                    $transaction_type->is_delete = false;
                    $AddSwal = __('TransactionType.AddSwal');
                    if( $transaction_type->save() ){
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
        if (can('edit_transaction_type'))
        {
            $transaction_type = TransactionType::where('id',$id)->select('id','name', 'is_active')->first();
            return view('backend.modules.system_data_module.transaction_type.modals.edit',compact('transaction_type'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_transaction_type") ){
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:transaction_types,name,$id",
                "cash_type" => "required",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $transaction_type = TransactionType::find($id);
                    $transaction_type->name = $request->name;
                    $transaction_type->cash_type = $request->cash_type;
                    $transaction_type->is_active = $request->is_active;
                    $transaction_type->is_delete = false;
                    $EditSwal = __('TransactionType.EditSwal');
                    if( $transaction_type->save() ){
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
        if (can('view_payment_type'))
        {
            $transaction_type = TransactionType::find($id);
            return view('backend.modules.system_data_module.transaction_type.modals.view',compact('transaction_type'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end



}
