<?php

namespace App\Http\Controllers\Backend\ReportsModule;

use App\Http\Controllers\Controller;
use App\Models\BankModule\Bank;
use App\Models\TransactionModule\Transaction;
use Illuminate\Support\Facades\DB;

class BankReportController extends Controller
{
    //All Bank List with Current Balance
    public function all_bank()
    {
        if(can('all_bank_report')) {

            DisableDBStrictMode();

            $bank = new Bank();
            $all_banks = $bank->AllBanksWithBalance();

            EnableDBStrictMode();

            return view('backend.modules.reports_module.all_report.bank_report.all_bank', compact('all_banks'));
        } else {
            return view('errors.404');
        }
    }

    // Specific Bank Details
    public function bank_details($id)
    {
        if(can('all_bank_report')) {

            $bank = Bank::find(decrypt($id));

            $transaction = new Transaction();
            $bank_transactions = $transaction->BankTransactions(decrypt($id));

            return view('backend.modules.reports_module.all_report.bank_report.bank_details', compact('bank', 'bank_transactions'));
        } else {
            return view('errors.404');
        }
    }

    public function latest_transactions($id)
    {
        return view('backend.modules.reports_module.all_report.bank_report.latest_transaction');
    }
}
