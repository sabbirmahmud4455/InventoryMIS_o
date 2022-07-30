<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SettingsModule\CompanyInfo;
use App\Models\SystemDataModule\Unit;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitReportController extends Controller
{
    //index function
    public function index() {
        if(can('unit_report')) {
            $units = Unit::with('purchase_details')->where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            
            return view('backend.modules.reports_module.all_report.system_data_report.unit_report.index', compact('units'));
            
        } else {
            return view('errors.404');
        }
    }

    //export pdf function
    public function unit_report_export_pdf() {
        if(can('unit_report')) {
            $units = Unit::with('purchase_details')->where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            
            $company_info = CompanyInfo::first();
            $title = __('Report.UnitReport');

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

            $mpdf->SetTitle(__("Report.UnitReport"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.reports_module.all_report.system_data_report.unit_report.export.pdf.unit_report_export_pdf', compact(
                'units',
                'company_info',
                'title'
            )));
            $mpdf->Output("UnitReport".'.pdf', "I");

            
        } else {
            return view('errors.404');
        }
    }


}
