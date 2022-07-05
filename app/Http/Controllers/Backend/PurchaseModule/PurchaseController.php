<?php

namespace App\Http\Controllers\Backend\PurchaseModule;

use App\Http\Controllers\Controller;
use App\Models\LotModule\Lot;
use App\Models\SupplierModule\Supplier;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\ItemVariant;
use App\Models\SystemDataModule\Unit;
use App\Models\SystemDataModule\Variant;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //Index
    public function index()
    {
        if(can('all_purchase')) {
            return view('backend.modules.purchase_module.index');
        } else {
            return view('errors.404');
        }
    }


    // Add New Purchase
    public function add_new_purchase()
    {
        if(can('add_purchase')) {

            $suppliers = Supplier::select('id', 'name')->where('is_active', true)->get();
            $items = Item::select('id', 'name')->where('is_active', true)->where('is_delete', false)->get();
            $lots = Lot::select('id', 'name')->get();
            $units = Unit::select('id', 'name')->get();
            $variants = Variant::select('id', 'name')->get();
            return view('backend.modules.purchase_module.add_purchase', compact('suppliers', 'items', 'lots', 'units', 'variants'));
        } else {
            return view('errors.404');
        }
    }

    // Get Item Varients
    public function get_item_varients(Request $request)
    {
        if(can('add_purchase')) {
            $id = $request->item_id;
             $item_variants = ItemVariant::with('variant')
                            ->where('item_id', $id)
                            ->get();

            return response()->json($item_variants);
        } else {
            return view('errors.404');
        }
    }

    public function store_new_purchase(Request $request)
    {
        return $request->data;
    }
}
