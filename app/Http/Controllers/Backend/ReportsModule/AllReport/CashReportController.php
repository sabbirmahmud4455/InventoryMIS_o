<?php

namespace App\Http\Controllers\Backend\ReportsModule\AllReport;

use App\Http\Controllers\Controller;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;

class CashReportController extends Controller
{
    //Index
    public function index()
    {
        if(can('all_bank_report')) {
            $today = Carbon::now()->toDateString();

            $transaction = new Transaction();
            $cash_transactions = $transaction->AllCashTransactions();
            $total_cash_transaction = $transaction->TotalCashTransactionCount();
            $today_cash_in_amount = $transaction->TodayCashInTransactions($today);
            $today_cash_out_amount = $transaction->TodayCashOutTransactions($today);
            $current_cash_balance = $transaction->CurrentCashBalance();

            return view('backend.modules.reports_module.all_report.cash_report.index', compact('cash_transactions', 'today_cash_in_amount',
                        'today_cash_out_amount', 'total_cash_transaction', 'current_cash_balance'));
        } else {
            return view('errors.404');
        }
    }
}
