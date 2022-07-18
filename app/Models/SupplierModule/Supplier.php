<?php

namespace App\Models\SupplierModule;

use App\Models\TransactionModule\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;

    // Get Specific Supplier Transaction History
    public function GetSupplierTransactions($id)
    {
        $supplier_transactions = DB::select('SELECT id, date, transaction_code, narration, status, cash_in, cash_out
                                FROM transactions
                                WHERE supplier_id = ?
                                ORDER BY id ASC;', [$id]);

        return $supplier_transactions;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
