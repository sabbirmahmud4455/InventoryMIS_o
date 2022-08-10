<?php

namespace App\Http\Controllers\Backend\ReturnModule;

use App\Http\Controllers\Controller;
use App\Models\PurchaseModule\Purchase;
use App\Models\SaleModule\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnAddController extends Controller
{
    //Add New Return
    public function add()
    {
        if(can('add_return')) {
            $sale = new Sale();
            $sale_challan_no = $sale->GetSaleChallanNo();

            $purchase = new Purchase();
            $purchase_challan_no = $purchase->GetPurchaseChallanNo();

            return view('backend.modules.return_module.add_return', compact('sale_challan_no', 'purchase_challan_no'));
        } else {
            return view('errors.404');
        }
    }

    // Customer Return View
    public function customer_return_view(Request $request)
    {
        if(can('customer_return')) {
            $sale_id = $request->customer_sale_id;

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $sale = new Sale();
            $sale_info = $sale->SaleDetails($sale_id);
            config()->set('database.connections.mysql.strict', true); // Enable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            return view('backend.modules.return_module.sale_return.sale_return_view', compact('sale_info'));
        } else {
            return view('errors.404');
        }
    }
}
