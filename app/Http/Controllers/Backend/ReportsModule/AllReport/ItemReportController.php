<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SettingsModule\CompanyInfo;
use App\Models\SystemDataModule\Item;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemReportController extends Controller
{
    //all item report function
    public function all_item_report() {
        if(can('item_report')) {
            $items = Item::with('stocks')->where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            
            return view('backend.modules.reports_module.all_report.item_report.all_item_report', compact('items'));
            
        } else {
            return view('errors.404');
        }
    }

    //all item report export pdf function
    public function all_item_report_export_pdf() {
        if(can('item_report')) {
            $items = Item::with('stocks')->where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            
            $company_info = CompanyInfo::first();
            $title = __('Report.AllItemReport');

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

            $mpdf->SetTitle(__("Report.AllItemReport"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.reports_module.all_report.item_report.export.pdf.all_item_report_export_pdf', compact(
                'items',
                'company_info',
                'title'
            )));
            $mpdf->Output("AllItemReport".'.pdf', "I");

            
        } else {
            return view('errors.404');
        }
    }




}
