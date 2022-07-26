<?php

namespace App\Http\Controllers\Backend\StockModule;

use App\Http\Controllers\Controller;
use App\Models\PurchaseModule\Purchase;
use App\Models\PurchaseModule\PurchaseDetails;
use App\Models\StockModule\StockInOut;
use App\Models\SystemDataModule\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stock_add()
    {
        if(can('stock_add')) {
            $purchases = Purchase::with('supplier')
                            ->where('status', 'PENDING')
                            ->orderBy('date', 'desc')
                            ->get();

            return view('backend.modules.stock_module.add_to_stock', compact('purchases'));
        }
    }

    public function add_to_stock($id)
    {
        if(can('stock_add')) {
            $warehouses = Warehouse::select('id', 'name')->where('is_active', true)->where('is_delete',false)->get();
            $purchase = Purchase::with('supplier')->find(decrypt($id));
            $purchase_details = PurchaseDetails::with('lot', 'item', 'unit', 'variant')->where('purchase_id', decrypt($id))->get();

            return view('backend.modules.stock_module.stock_entry', compact('purchase', 'purchase_details', 'warehouses'));
        } else {
            return view('errors.404');
        }
    }

    // Store to Stock
    public function store_to_stock(Request $request)
    {
        if(can('stock_add')) {

            foreach($request->item_id as $key => $item){
                $stock_in = new StockInOut();
                $stock_in->purchase_id = $request->purchase_id;
                $stock_in->item_id = $item;
                $stock_in->variant_id = $request->variant_id[$key];
                $stock_in->unit_id = $request->unit_id[$key];
                $stock_in->lot_id = $request->lot_id[$key];
                $stock_in->in_quantity = $request->in_quantity[$key];
                if($request->one_wearhouse){
                    $stock_in->warehouse_id = $request->one_warehouse_id;
                } else {
                    $stock_in->warehouse_id = $request->warehouse_id[$key];
                }
                $stock_in->save();
            }

            Purchase::where('id', $request->purchase_id)->update(['status' => 'STOCK_IN']);
            return redirect()->route('stock.add');

            // return $request->all();
        } else {
            return view('errors.404');
        }
    }

    //Stock Report
    public function stock_list()
    {
        if(can('stock_list')){


            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $stock = new StockInOut();
            $stock_lists = $stock->StockList();

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            return view('backend.modules.stock_module.stock_list', compact('stock_lists'));
        }
    }
}
