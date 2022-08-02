<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\StockModule\StockInOut;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    //stock report
    public function stock_report() {
        if(can('current_stock_report')) {
            $stocks = StockInOut::with('unit', 'item', 'variant')->get()->groupBy('item_id');
            return view('backend.modules.reports_module.all_report.stock_report.stock_report', compact('stocks'));
        } else {
            return view('errors.404');
        }
    }
}
