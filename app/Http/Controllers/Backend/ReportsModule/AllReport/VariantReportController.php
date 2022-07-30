<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SettingsModule\CompanyInfo;
use App\Models\SystemDataModule\Variant;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VariantReportController extends Controller
{
    //index function
    public function index() {
        if(can('variant_report')) {
            $variants = Variant::with('purchase_details')->where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            
            return view('backend.modules.reports_module.all_report.system_data_report.variant_report.index', compact('variants'));
            
        } else {
            return view('errors.404');
        }
    }

    //export pdf function
    public function variant_report_export_pdf() {
        if(can('variant_report')) {
            $variants = Variant::with('purchase_details')->where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            
            $company_info = CompanyInfo::first();
            $title = __('Report.VariantReport');

            $now = new DateTime();
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

            $mpdf->SetTitle(__("Report.VariantReport"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.reports_module.all_report.system_data_report.variant_report.export.pdf.variant_report_export_pdf', compact(
                'variants',
                'company_info',
                'title'
            )));
            $mpdf->Output("VariantReport".'.pdf', "I");

            
        } else {
            return view('errors.404');
        }
    }


}
