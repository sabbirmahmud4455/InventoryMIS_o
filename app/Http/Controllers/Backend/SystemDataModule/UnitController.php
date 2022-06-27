<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    //index function start
    public function index()
    {
        if (can('unit'))
        {
            return view('backend.modules.system_data_module.unit.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('unit') ){

            $unit = Unit::select("id", "name", "is_active", 'is_delete')->get();

            return DataTables::of($unit)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (Unit $unit) {
                    if ($unit->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->addColumn('action', function (Unit $unit) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$unit->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$unit->id.'">

                        '.( can("view_unit") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('unit.view.modal',$unit->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('Unit.ViewUnit').'
                        </a>
                        ': '') .'

                        '.( can("edit_unit") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('unit.edit.modal',$unit->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('Unit.EditUnit').'
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
        if( can("add_unit") ){
            return view('backend.modules.system_data_module.unit.modals.add');
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_unit") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:units,name',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $unit = new Unit();

                    $unit->name = $request->name;
                    $unit->is_active = true;
                    $unit->is_delete = false;
                    $AddSwal = __('Unit.AddSwal');
                    if( $unit->save() ){
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
        if (can('edit_unit'))
        {
            $unit = Unit::where('id',$id)->select('id','name', 'is_active')->first();
            return view('backend.modules.system_data_module.unit.modals.edit',compact('unit'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_unit") ){
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:units,name,$id",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $unit = Unit::find($id);
                    $unit->name = $request->name;
                    $unit->is_active = $request->is_active;
                    $unit->is_delete = false;
                    $EditSwal = __('Unit.EditSwal');
                    if( $unit->save() ){
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
            $unit = Unit::find($id);
            return view('backend.modules.system_data_module.unit.modals.view',compact('unit'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end



}
