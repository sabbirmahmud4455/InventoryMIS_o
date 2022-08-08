<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\ItemType;
use App\Models\SystemDataModule\ItemVariant;
use App\Models\SystemDataModule\Variant;
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
                ->rawColumns(['action', 'is_active', 'item_type_id'])
                ->editColumn('is_active', function (Item $item) {
                    if ($item->is_active == true) {
                        return '<p class="badge badge-success">'.__('Application.Active').'</p>';
                    } else {
                        return '<p class="badge badge-danger">'.__('Application.Inactive').'</p>';
                    }
                })
                ->editColumn('item_type_id', function (Item $item) {
                    return $item_type_id = $item->item_type->name;
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
            $variants = Variant::where('is_active', true)->where('is_delete', false)->get();
            return view('backend.modules.system_data_module.item.modals.add', compact('item_types', 'variants'));
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
                'item_type_id' => 'required',
                'name' => 'required|unique:items,name',
                'item_code' => 'required|unique:items,item_code',
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
                    $AddSwal = __('Item.AddSwal');

                    if( $item->save() ){

                        if($request->has('item_variant_check')) {

                            foreach($request->variant_id as $key => $variant_id) {

                                $item_variant = new ItemVariant();
                                $item_variant->item_id = $item->id;
                                $item_variant->variant_id = $variant_id;

                                $check_duplicate_item_variant = ItemVariant::where('item_id', $item->id)->where('variant_id',$variant_id)->get();

                                $ItemVariantDuplicateSwal = __('Item.ItemVariantDuplicateSwal');
                                if (count($check_duplicate_item_variant) > 0) {
                                    return response()->json(['error' => $ItemVariantDuplicateSwal], 200);
                                }

                                $item_variant->save();

                            }

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
        if (can('edit_item'))
        {
            $item = Item::with('item_type','item_variants')->where('id',$id)->select("id", 'item_type_id', "name", 'item_code', "is_active", 'is_delete')->first();
            $item_types = ItemType::where('is_active', true)->get();
            $variants = Variant::where('is_active', true)->where('is_delete', false)->get();
            return view('backend.modules.system_data_module.item.modals.edit',compact('item', 'item_types', 'variants'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_item") ){
            $validator = Validator::make($request->all(), [
                "item_type_id" => "required",
                "name" => "required|unique:items,name,$id",
                "item_code" => "required|unique:items,name,$id",
                "is_active" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $item = Item::find($id);
                    $item->item_type_id = $request->item_type_id;
                    $item->name = $request->name;
                    $item->item_code = $request->item_code;
                    $item->is_active = $request->is_active;
                    $item->is_delete = false;
                    $EditSwal = __('Item.EditSwal');

                    if( $item->save() ){

                        ItemVariant::where('item_id',$id)->delete();

                        if($request->has('item_variant_check')) {

                            foreach($request->variant_id as $key => $variant_id) {


                                $item_variant = new ItemVariant();
                                $item_variant->item_id = $item->id;
                                $item_variant->variant_id = $variant_id;

                                $check_duplicate_item_variant = ItemVariant::where('item_id', $item->id)->where('variant_id',$variant_id)->get();

                                $ItemVariantDuplicateSwal = __('Item.ItemVariantDuplicateSwal');
                                if (count($check_duplicate_item_variant) > 0) {
                                    return response()->json(['error' => $ItemVariantDuplicateSwal], 200);
                                }

                                $item_variant->save();

                            }

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
        if (can('view_item'))
        {
            $item = Item::with('item_type','item_variants')->find($id);
            return view('backend.modules.system_data_module.item.modals.view',compact('item'));
        }
        else
        {
            return view('errors.404');
        }
    }
    //view modal function end



}
