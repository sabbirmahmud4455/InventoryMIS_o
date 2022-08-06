<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\CustomerModule\Customer;
use App\Models\SupplierModule\Supplier;
use App\Models\SystemDataModule\TransactionType;
use App\Models\SystemDataModule\Warehouse;
use Illuminate\Http\Request;

class AllReportController extends Controller
{
    //index function
    public function index() {
        if(can('all_report')) {
            $suppliers = Supplier::where('is_active', true)->orderBy('id', 'desc')->get();
            $warehouses = Warehouse::where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            $transaction_types = TransactionType::where('is_active', true)->where('is_delete', false)->orderBy('id', 'desc')->get();
            $customers = Customer::where('is_active', true)->orderBy('id', 'desc')->get();
            return view('backend.modules.reports_module.all_report.index', compact('suppliers', 'warehouses', 'transaction_types', 'customers'));
        } else {
            return view('errors.404');
        }
    }


}
