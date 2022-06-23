<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    //index function start
    public function index()
    {
        if (can('item'))
        {
            return view('backend.modules.system_data_module.item.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('item') ){

            $item = Item::select("id", 'item_type_id', "name", 'item_code', "is_active", 'is_delete')->get();

            return DataTables::of($item)
                ->rawColumns(['action', 'is_active'])
                ->editColumn('is_active', function (Item $item) {
                    if ($item->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->addColumn('action', function (Item $item) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$item->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.__('Application.Action').'
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$item->id.'">

                        '.( can("view_item") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('item.view.modal',$item->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-eye"></i>
                            '.__('Item.ViewItem').'
                        </a>
                        ': '') .'

                        '.( can("edit_item") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('item.edit.modal',$item->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            '.__('Item.EditItem').'
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
        if( can("add_item") ){
            $item_types = ItemType::where('is_active', true)->get();
            return view('backend.modules.system_data_module.item.modals.add', compact('item_types'));
        }
        else{
            return view('errors.404');
        }
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        if( can("add_item") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:items,name',
                'item_code' => 'required|unique:items,item_code',
                'item_type_id' => 'required',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $item = new Item();

                    $item->item_type_id = $request->item_type_id;
                    $item->name = $request->name;
                    $item->item_code = $request->item_code;
                    $item->is_active = true;
                    $item->is_delete = false;
                    $AddSwal = __('Varient.AddSwal');
                    if( $item->save() ){
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



}
