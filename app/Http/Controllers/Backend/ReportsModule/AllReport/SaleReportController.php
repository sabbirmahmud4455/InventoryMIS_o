<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SaleModule\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    //index
    public function index(Request $request) {
        if(can('all_sale_report')) {

            $sale = new Sale();
            $sales = $sale->AllSale();

            if($request->sale_date) {
                $date = explode('-', $request->sale_date);
                $start_date = Carbon::parse($date[0])->toDateString();
                $end_date = Carbon::parse($date[1])->toDateString();
                $sales = $sale->DateWiseSale($start_date, $end_date);
            }

            if($request->customer_id) {
                $sales = $sale->CustomerWiseSale($request->customer_id);
            }

            return view('backend.modules.reports_module.all_report.sale_report.index', compact('sales'));
        }
    }

}
