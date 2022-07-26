<?php

namespace App\Http\Controllers\Backend\SaleModule;

use App\Http\Controllers\Controller;
use App\Models\CustomerModule\Customer;
use App\Models\LotModule\Lot;
use App\Models\StockModule\StockInOut;
use App\Models\SupplierModule\Supplier;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\ItemVariant;
use App\Models\SystemDataModule\Unit;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //Index
    public function index()
    {
        if(can('all_sale')) {
            return view('backend.modules.sale_module.index');
        } else {
            return view('errors.404');
        }
    }


    // Add New sale
    public function add_new_sale()
    {
        if(can('add_sale')) {

            $customers = Customer::select('id', 'name')->where('is_active', true)->get();
            $items = Item::select('id', 'name')->where('is_active', true)->where('is_delete', false)->get();
            $lots = Lot::select('id', 'name')->get();
            $units = Unit::select('id', 'name')->get();
            return view('backend.modules.sale_module.add_sale', compact('customers', 'items', 'lots', 'units'));
        } else {
            return view('errors.404');
        }
    }

    // Get Item Varients
    public function get_item_varients(Request $request)
    {
        if(can('add_sale')) {
            $id = $request->item_id;
             $item_variants = ItemVariant::with('variant')
                            ->where('item_id', $id)
                            ->get();

            return response()->json($item_variants);
        } else {
            return view('errors.404');
        }
    }

    // Get Lot Items List
    public function get_lot_items(Request $request)
    {
        if(can('add_sale')) {

            $lot_id = $request->lot_id;
            $lot_items = StockInOut::where('lot_id', $lot_id)->get();

            return response()->json($lot_items);

        } else {
            return view('errors.404');
        }
    }
}
