<?php

namespace App\Models\BankModule;

use App\Models\TransactionModule\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bank extends Model
{
    use HasFactory;

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function AllBanksWithBalance()
    {
        $all_banks = DB::select('SELECT banks.id as bank_id, banks.name as bank_name, banks.account_name as account_name, banks.account_no as account_no, banks.is_active as status, banks.branch_name as branch_name, (SUM(cash_in) - SUM(cash_out)) as balance
        FROM transactions
        LEFT JOIN banks ON banks.id = transactions.bank_id
        WHERE bank_id IS NOT NULL
        GROUP BY bank_id;');

        return $all_banks;
    }

}
