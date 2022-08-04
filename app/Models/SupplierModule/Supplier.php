<?php

namespace App\Models\SupplierModule;

use App\Models\TransactionModule\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;

    // get all supplier
    public function GetAllSupplier() {
        $suppliers = DB::select('SELECT suppliers.id as supplier_id, suppliers.name, suppliers.contact_no,
                    suppliers.is_active, transactions.id as transaction_id, transactions.supplier_id as t_supplier_id,
                    (SUM(transactions.cash_in) - SUM(transactions.cash_out)) AS balance
                    FROM suppliers LEFT JOIN transactions
                    ON suppliers.id = transactions.supplier_id
                    GROUP BY transactions.supplier_id
                    ORDER BY suppliers.id DESC;');
        return $suppliers;
    }

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
