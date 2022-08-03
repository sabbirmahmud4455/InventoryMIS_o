<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\SupplierModule\Supplier;
use App\Models\SystemDataModule\Warehouse;
use Illuminate\Http\Request;

class AllReportController extends Controller
{
    //index function
    public function index() {
        if(can('all_report')) {
            $suppliers = Supplier::where('is_active', true)->get();
            $warehouses = Warehouse::where('is_active', true)->where('is_delete', false)->get();
            return view('backend.modules.reports_module.all_report.index', compact('suppliers', 'warehouses'));
        } else {
            return view('errors.404');
        }
    }


}
