<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SaleModule\Sale;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    //index
    public function index() {
        if (can('all_sale_report')) {
            $sales = new Sale();
            $sales = $sales->AllSale();
            return view('backend.modules.reports_module.all_report.sale_report.index', compact('sales'));
        }
    }

}
