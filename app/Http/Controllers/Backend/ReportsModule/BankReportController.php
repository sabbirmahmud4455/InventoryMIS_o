<?php

namespace App\Http\Controllers\Backend\ReportsModule;

use App\Http\Controllers\Controller;
use App\Models\BankModule\Bank;
use Illuminate\Support\Facades\DB;

class BankReportController extends Controller
{
    //All Bank List with Current Balance
    public function all_bank()
    {
        if(can('all_bank_report')) {
            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $bank = new Bank();
            $all_banks = $bank->AllBanksWithBalance();

            config()->set('database.connections.mysql.strict', true); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            return view('backend.modules.reports_module.all_report.bank_report.all_bank', compact('all_banks'));
        } else {
            return view('errors.404');
        }
    }
}
