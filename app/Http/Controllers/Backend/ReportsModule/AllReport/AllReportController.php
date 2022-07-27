<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllReportController extends Controller
{
    //index function
    public function index() {
        if(can('all_report')) {
            return view('backend.modules.reports_module.all_report.index');
        } else {
            return view('errors.404');
        }
    }


}
