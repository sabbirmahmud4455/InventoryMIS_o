<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reports\History;
use App\Models\Reports\SmsHistory;
use App\Models\Reports\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth('web')->check() ){
            return view('backend.dashboard');
        }else{
            return view("errors.404");
        }
    }



}
