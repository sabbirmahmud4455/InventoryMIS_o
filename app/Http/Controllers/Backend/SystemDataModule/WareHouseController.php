<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WarehouseController extends Controller
{
    //index function start
    public function index()
    {
        if (can('warehouse'))
        {
            return view('backend.modules.system_data_module.warehouse.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('warehouse') ){

            $warehouse = Warehouse::select("id", "name", 'location', "is_active", 'is_delete')->get();

            return DataTables::of($warehouse)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (Warehouse $warehouse) {
                    if ($warehouse->is_active == true) {
                        return '<p class="badge badge-success">Active</p>';
                    } else {
                        return '<p class="badge badge-danger">Inactive</p>';
                    }
                })
                ->addColumn('action', function (Warehouse $warehouse) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$warehouse->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$warehouse->id.'">

                        '.( can("view_warehouse") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('warehouse.view.modal',$warehouse->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('Warehouse.ViewWarehouse').'
                        </a>
                        ': '') .'

                        '.( can("edit_warehouse") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('warehouse.edit.modal',$warehouse->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('Warehouse.EditWarehouse').'
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
        if( can("add_warehouse") ){
            return view('backend.modules.system_data_module.warehouse.modals.add');
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_warehouse") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:warehouses,name',
                'location' => 'required',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $warehouse = new Warehouse();

                    $warehouse->name = $request->name;
                    $warehouse->location = $request->location;
                    $warehouse->is_active = true;
                    $warehouse->is_delete = false;
                    if( $warehouse->save() ){
                        return response()->json(['success' => 'New Warehouse Created'], 200);
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
        if (can('edit_warehouse'))
        {
            $warehouse = Warehouse::where('id',$id)->select('id','name', 'location', 'is_active')->first();
            return view('backend.modules.system_data_module.warehouse.modals.edit',compact('warehouse'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_warehouse") ){
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:warehouses,name,$id",
                "location" => "required",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $warehouse = Warehouse::find($id);
                    $warehouse->name = $request->name;
                    $warehouse->location = $request->location;
                    $warehouse->is_active = $request->is_active;
                    $warehouse->is_delete = false;
                    if( $warehouse->save() ){
                        return response()->json(['success' => 'Warehouse Updated'], 200);
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
        if (can('view_warehouse'))
        {
            $warehouse = Warehouse::find($id);
            return view('backend.modules.system_data_module.warehouse.modals.view',compact('warehouse'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end


}
