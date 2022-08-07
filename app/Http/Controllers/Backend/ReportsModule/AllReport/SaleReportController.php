<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\CustomerModule\Customer;
use App\Models\SaleModule\Sale;
use App\Models\SettingsModule\CompanyInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            $customers = Customer::where('is_active', true)->orderBy('id', 'desc')->get();

            return view('backend.modules.reports_module.all_report.sale_report.index', compact('sales', 'customers'));
        } else {
            return view('errors.404');
        }
    }


    // sale report details
    public function sale_report_details($id) {
        if(can('all_sale_report') || can('date_wise_sale_report') || can('customer_wise_sale_report')) {

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $sale = new Sale();

            $sale_details = $sale->SaleDetails(decrypt($id));

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB


            return view('backend.modules.reports_module.all_report.sale_report.sale_report_details', compact('sale_details'));
        } else {
            return view('errors.404');
        }
    }


    //sale report details export pdf
    public function sale_report_details_export_pdf($id) {
        if(can('all_sale_report') || can('date_wise_sale_report') || can('customer_wise_sale_report')) {

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $sale = new Sale();

            $sale_details = $sale->SaleDetails(decrypt($id));

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            $company_info = CompanyInfo::first();
            $title = __('Report.SaleReport');

            $now = new \DateTime();
            $time = $now->format('F j, Y, g:i a');
            $auth_user = Auth::user()->name;

            $footer = "
                    <span style='margin: 29px;'>Page :
                    <span></span>{PAGENO} of {nbpg}</span>
                    &nbsp;
                    &nbsp;
                    &nbsp;

                    <span class='print_date'>Print Date : $time
                </span>

                &nbsp;
                &nbsp;
                &nbsp;
                <span class='print_by'>
                    Printed By : $auth_user
                </span>

                &nbsp;
                &nbsp;
                <span class='powered_by'> Powered By: RP AI Solutions </span>
                &nbsp;
                ";

            $mpdf = new \Mpdf\Mpdf(
                [
                    // 'default_font_size' => 12,
                    'default_font' => 'nikosh',
                    'mode' => 'utf-8',
                ]
            );

            $mpdf->SetTitle(__("Report.SaleReport"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.reports_module.all_report.sale_report.export.pdf.sale_report_details_export_pdf', compact(
                'sale_details',
                'company_info',
                'title'
            )));
            $mpdf->Output("SaleReport".'.pdf', "I");

        } else {
            return view('errors.404');
        }
    }



}
