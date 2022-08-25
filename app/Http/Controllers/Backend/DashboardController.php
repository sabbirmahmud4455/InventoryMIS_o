<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerModule\Customer;
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

            $sale           = new Sale();
            $total_sale     = $sale->TotalSaleAmount($today, null);

            $purchase       = new Purchase();
            $total_purchase = $purchase->TotalPurchaseAmount($today, null);

            $customer           = new Customer();
            return $customer_status    = $customer->CustomerStatus();

            return view('backend.dashboard', compact('total_sale', 'total_purchase'));

        }else{
            return view("errors.404");
        }
    }


    // Current Stock List
    public function current_stock_list()
    {
        DisableDBStrictMode();
        $stock              = new StockInOut();
        $current_stock_list = $stock->StockList(null, null, null, null);
        EnableDBStrictMode();

        return response()->json(['stock_list' => $current_stock_list], 200);

    }

    public function get_dashboard_data()
    {
        $date = Carbon::now();

        $this_month_start_date  = $date->startOfMonth()->toDateString();
        $this_month_end_date    = $date->endOfMonth()->toDateString();

        DisableDBStrictMode();
        $stock              = new StockInOut();
        $current_stock_list = $stock->StockList(null, null, null, null);

        $sale               = new Sale();
        $this_mont_sales    = $sale->ThisMonthSalesGraph($this_month_start_date, $this_month_end_date);
        EnableDBStrictMode();

        return response()->json([
            'stock_list' => $current_stock_list,
            'this_month_sales' => $this_mont_sales
        ], 200);

    }



}
