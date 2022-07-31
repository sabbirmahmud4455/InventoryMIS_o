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
use Illuminate\Support\Facades\DB;

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

    // Get Item Stock Variant
    public function get_item_stock_variant(Request $request)
    {
        if(can('add_sale')) {
            $item_id = $request->item_id;

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $item_stock = new StockInOut();
            $item_stock_variants = $item_stock->StockItemVariants($item_id);

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            return response()->json($item_stock_variants);

        } else {
            return view('errors.404');
        }
    }

    // available_lots
    public function available_lots(Request $request)
    {
        if(can('add_sale')) {
            $ids = explode("_", $request->ids);
            $variant_id = $ids[0];
            $unit_id = $ids[1];
            $item_id = $request->item_id;

            $stock_lots = new StockInOut();
            $lots = $stock_lots->StockLots($item_id, $variant_id, $unit_id);

            return response()->json($lots);
        } else {
            return view('errors.404');
        }
    }

    public function get_warehouse_stock(Request $request)
    {
        if(can('add_sale')) {
            $ids = explode("_", $request->ids);
            $variant_id = $ids[0];
            $unit_id = $ids[1];
            $item_id = $request->item_id;
            $lot_id = $request->lot_id;

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $stock_warehouses = new StockInOut();
            $warehouse_with_stock = $stock_warehouses->GetWarehouseWithStock($item_id, $variant_id, $unit_id, $lot_id);

            config()->set('database.connections.mysql.strict', true); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            return response()->json($warehouse_with_stock);
        } else {
            return view('errors.404');
        }
    }

    // GET CUSTOMER TOTAL PREVIUOS BALANCE
    public function customer_previous_balance(Request $request)
    {
        if(can('add_sale')) {
            $customer_id = $request->customer_id;
            $customer = new Customer();
            $customer_previous_balance = $customer->CustomerPreviuosBalance($customer_id);

            return response()->json($customer_previous_balance);
        } else {
            return view('errors.404');
        }
    }
}
