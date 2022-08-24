<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PurchaseModule\Purchase;
use App\Models\SaleModule\Sale;
use App\Models\StockModule\StockInOut;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth('web')->check() ){
            $today = Carbon::now()->toDateString();

            $sale = new Sale();
            $total_sale = $sale->TotalSaleAmount($today, null);

            $purchase = new Purchase();
            $total_purchase = $purchase->TotalPurchaseAmount($today, null);



            return view('backend.dashboard', compact('total_sale', 'total_purchase'));
        }else{
            return view("errors.404");
        }
    }


    // Current Stock List
    public function current_stock_list()
    {
        DisableDBStrictMode();
        $stock = new StockInOut();
        $current_stock_list = $stock->StockList(null, null, null, null);
        EnableDBStrictMode();

        return response()->json(['stock_list' => $current_stock_list], 200);

    }



}
