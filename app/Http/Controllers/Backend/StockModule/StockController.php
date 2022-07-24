<?php

namespace App\Http\Controllers\Backend\StockModule;

use App\Http\Controllers\Controller;
use App\Models\PurchaseModule\Purchase;
use App\Models\PurchaseModule\PurchaseDetails;
use App\Models\StockModule\StockInOut;
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
            return $purchase_to_stock = PurchaseDetails::with('purchase_info')->where('purchase_id', decrypt($id))->get();

            return view('backend.modules.stock_module.stock_entry', compact('purchase_to_stock'));
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
