<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VariantController extends Controller
{
    //index function start
    public function index()
    {
        if (can('variant'))
        {
            return view('backend.modules.system_data_module.variant.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('variant') ){

            $variant = Variant::select("id", "name", "is_active", 'is_delete')->get();

            return DataTables::of($variant)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (Variant $variant) {
                    if ($variant->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->addColumn('action', function (Variant $variant) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$variant->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$variant->id.'">

                        '.( can("view_variant") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('variant.view.modal',$variant->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('Variant.ViewVariant').'
                        </a>
                        ': '') .'

                        '.( can("edit_variant") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('variant.edit.modal',$variant->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('Variant.EditVariant').'
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
        if( can("add_variant") ){
            return view('backend.modules.system_data_module.variant.modals.add');
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_variant") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:variants,name',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $variant = new Variant();

                    $variant->name = $request->name;
                    $variant->is_active = true;
                    $variant->is_delete = false;
                    $AddSwal = __('Variant.AddSwal');
                    if( $variant->save() ){
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
        if (can('edit_variant'))
        {
            $variant = Variant::where('id',$id)->select('id','name', 'is_active')->first();
            return view('backend.modules.system_data_module.variant.modals.edit',compact('variant'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_variant") ){
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:variants,name,$id",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $variant = Variant::find($id);
                    $variant->name = $request->name;
                    $variant->is_active = $request->is_active;
                    $variant->is_delete = false;
                    $EditSwal = __('Variant.EditSwal');
                    if( $variant->save() ){
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
        if (can('view_variant'))
        {
            $variant = Variant::find($id);
            return view('backend.modules.system_data_module.variant.modals.view',compact('variant'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end
}
