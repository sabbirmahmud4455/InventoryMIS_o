<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SupplierModule\Supplier;
use Illuminate\Http\Request;

class AllReportController extends Controller
{
    //index function
    public function index() {
        if(can('all_report')) {
            $suppliers = Supplier::where('is_active', true)->get();
            return view('backend.modules.reports_module.all_report.index', compact('suppliers'));
        } else {
            return view('errors.404');
        }
    }


}
