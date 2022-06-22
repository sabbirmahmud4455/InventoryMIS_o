<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Varient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VarientController extends Controller
{
    //index function start
    public function index()
    {
        if (can('varient'))
        {
            return view('backend.modules.system_data_module.varient.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('varient') ){

            $varient = Varient::select("id", "name", "is_active", 'is_delete')->get();

            return DataTables::of($varient)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (Varient $varient) {
                    if ($varient->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->addColumn('action', function (Varient $varient) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$varient->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$varient->id.'">

                        '.( can("view_varient") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('varient.view.modal',$varient->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('Varient.ViewVarient').'
                        </a>
                        ': '') .'

                        '.( can("edit_varient") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('varient.edit.modal',$varient->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('Varient.EditVarient').'
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
        if( can("add_varient") ){
            return view('backend.modules.system_data_module.varient.modals.add');
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_varient") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:varients,name',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $varient = new Varient();

                    $varient->name = $request->name;
                    $varient->is_active = true;
                    $varient->is_delete = false;
                    $AddSwal = __('Varient.AddSwal');
                    if( $varient->save() ){
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
        if (can('edit_varient'))
        {
            $varient = Varient::where('id',$id)->select('id','name', 'is_active')->first();
            return view('backend.modules.system_data_module.varient.modals.edit',compact('varient'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_varient") ){
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:varients,name,$id",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $varient = Varient::find($id);
                    $varient->name = $request->name;
                    $varient->is_active = $request->is_active;
                    $varient->is_delete = false;
                    $EditSwal = __('Varient.EditSwal');
                    if( $varient->save() ){
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
        if (can('view_varient'))
        {
            $varient = Varient::find($id);
            return view('backend.modules.system_data_module.varient.modals.view',compact('varient'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end
}
