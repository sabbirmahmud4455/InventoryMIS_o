<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\ItemType;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ItemTypeController extends Controller
{
    //Index
    public function index()
    {
        if(can('item_type')) {
            return view('backend.modules.system_data_module.item_type.index');
        } else {
            return view("errors.404");
        }
    }

    // Data
    public function data()
    {
        if(can('item_type')) {
            $item_types = ItemType::select('id', 'name', 'is_active')->get();
            return DataTables::of($item_types)
            ->rawColumns(['action', 'is_active'])
            ->editColumn('is_active', function (ItemType $item_types){
                if($item_types->is_active == true) {
                    return "<span class='badge badge-success'>  ".__('Application.Active')." </span>";
                } else {
                    return '<span class="badge badge-danger">'. __('Application.Inactive') .' </span>';
                }
            })
            ->addColumn('action', function(ItemType $item_types){
                return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$item_types->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '. __('Application.Action') .'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$item_types->id.'">

                        '.( can("edit_item_type") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('item_type.edit', encrypt($item_types->id)).'" data-target="#myModal" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '. __('Application.Edit') .'
                        </a>
                        ': '') .'

                        '.( can("view_item_type") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('user.edit',$item_types->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '. __('Application.View') .'
                        </a>
                        ': '') .'

                    </div>
                </div>
                ';
            })
            ->make(true);
        } else {
            return view('errors.404');
        }
    }

    // Add
    public function item_type_add()
    {
        if(can('add_item_type')) {
            return view('backend.modules.system_data_module.item_type.modals.add');
        } else {
            return view('errors.404');
        }
    }

    // Store
    public function item_type_store(Request $request)
    {
        if(can('add_item_type')) {
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:item_types,name',
            ]);

            if($validator->fails()){

                return response()->json(['errors' => $validator->errors()], 422);

            } else {

                try{

                    $item_type = new ItemType();
                    $item_type->name = $request->name;
                    $success_msg = __('ItemType.ItemTypeSuccessMsg');
                    $warning_msg = __('ItemType.ItemTypeWarningMsg');

                    if($item_type->save()){
                        return response()->json(['success' => $success_msg], 200);
                    } else {
                        return response()->json(['warning' => $warning_msg], 200);
                    }

                } catch(Exception $e) {

                    return response()->json(['error' => $e->getMessage()], 200);

                }
            }

        } else {
            return view('errors.404');
        }
    }


    // EDIT ITEM TYPE
    public function item_type_edit($id)
    {
        if(can('edit_item_type')) {
            $item_type = ItemType::find(decrypt($id));
            return view('backend.modules.system_data_module.item_type.modals.edit', compact('item_type'));
        } else {
            return view('errors.404');
        }
    }

    // UPDATE ITEM TYPE
    public function item_type_update(Request $request, $id)
    {
        if(can('edit_item_type')) {
            $item_type = ItemType::find(decrypt($id));

            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:item_types,name,'. decrypt($id),
            ]);

            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()],200);
            }
            else {
                try{

                    $item_type->name = $request->name;
                    $item_type->is_active = $request->is_active;
                    $update_msg = __('ItemType.ItemTypeUpdateMsg');
                    $warning_msg = __('ItemType.ItemTypeWarningMsg');
                    if($item_type->save()){
                        return response()->json(['success' => $update_msg],200);
                    } else {
                        return response()->json(['warning' => $warning_msg], 200);
                    }

                } catch(Exception $e) {
                    return response()->json(['errors' => $e->getMessage()], 200);
                }
            }
        } else {
            return view('errors.404');
        }
    }
}
