<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SaleModule\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleReportController extends Controller
{
    //index
    public function index(Request $request) {
        if(can('all_sale_report') || can('date_wise_sale_report') || can('customer_wise_sale_report')) {

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


    //index
    public function sale_report_details($id) {
        if(can('all_sale_report') || can('date_wise_sale_report') || can('customer_wise_sale_report')) {

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $sale = new Sale();

            $sale_details = $sale->SaleDetails(decrypt($id));

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB


            return view('backend.modules.reports_module.all_report.sale_report.sale_report_details', compact('sale_details'));
        }
    }

}
