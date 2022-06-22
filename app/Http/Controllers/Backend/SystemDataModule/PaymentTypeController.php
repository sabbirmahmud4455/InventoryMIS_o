<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaymentTypeController extends Controller
{
    //index function start
    public function index()
    {
        if (can('payment_type'))
        {
            return view('backend.modules.system_data_module.payment_type.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('payment_type') ){

            $payment_type = PaymentType::select("id", "name", "is_active", 'is_delete')->get();

            return DataTables::of($payment_type)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (PaymentType $payment_type) {
                    if ($payment_type->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->addColumn('action', function (PaymentType $payment_type) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$payment_type->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$payment_type->id.'">

                        '.( can("view_payment_type") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('payment.type.view.modal',$payment_type->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('PaymentType.ViewPaymentType').'
                        </a>
                        ': '') .'

                        '.( can("edit_payment_type") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('payment.type.edit.modal',$payment_type->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('PaymentType.EditPaymentType').'
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
            return view('backend.modules.system_data_module.payment_type.modals.add');
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_payment_type") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:payment_types,name',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $payment_type = new PaymentType();

                    $payment_type->name = $request->name;
                    $payment_type->is_active = true;
                    $payment_type->is_delete = false;
                    $AddSwal = __('PaymentType.AddSwal');
                    if( $payment_type->save() ){
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
        if (can('edit_payment_type'))
        {
            $payment_type = PaymentType::where('id',$id)->select('id','name', 'is_active')->first();
            return view('backend.modules.system_data_module.payment_type.modals.edit',compact('payment_type'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_payment_type") ){
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:payment_types,name,$id",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $payment_type = PaymentType::find($id);
                    $payment_type->name = $request->name;
                    $payment_type->is_active = $request->is_active;
                    $payment_type->is_delete = false;
                    $EditSwal = __('PaymentType.EditSwal');
                    if( $payment_type->save() ){
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
            $payment_type = PaymentType::find($id);
            return view('backend.modules.system_data_module.payment_type.modals.view',compact('payment_type'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end



}
