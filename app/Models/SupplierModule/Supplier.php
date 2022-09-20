<?php

namespace App\Models\SupplierModule;

use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;

    // get all supplier
    public function GetAllSupplier($search, $supplier_id, $start_date, $end_date) {
        $suppliers = DB::select('SELECT suppliers.id as supplier_id, suppliers.name, suppliers.contact_no,
                    suppliers.is_active, transactions.id as transaction_id, transactions.date, transactions.supplier_id as t_supplier_id,
                    (SUM(transactions.cash_in) - SUM(transactions.cash_out)) AS balance
                    FROM suppliers LEFT JOIN transactions
                    ON suppliers.id = transactions.supplier_id
                    WHERE (? IS NULL OR suppliers.name LIKE ? OR suppliers.contact_no LIKE ? OR (SELECT SUM(transactions.cash_in) - SUM(transactions.cash_out)) LIKE ?)
                    AND (? IS NULL OR supplier_id = ?)
                    AND  (? IS NULL OR transactions.date >= ?)
                    AND  (? IS NULL OR transactions.date <= ?)
                    GROUP BY transactions.supplier_id
                    ORDER BY suppliers.id DESC
                    ;', [$search, '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', $supplier_id, $supplier_id, $start_date, $start_date, $end_date, $end_date]);
        return $suppliers;
    }

    // Get Specific Supplier Transaction History
    public function GetSupplierTransactions($id)
    {
        $supplier = DB::select('SELECT id, name, contact_no, address, company
                                FROM suppliers
                                WHERE id = ?', [$id]);

        $supplier_transactions = DB::select('SELECT id, date, transaction_code, narration, status, cash_in, cash_out
                                FROM transactions
                                WHERE supplier_id = ?
                                ORDER BY id ASC;', [$id]);

        return ['supplier' => $supplier, 'supplier_transactions' => $supplier_transactions];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Get Supplier Staus
    public function SupplierStatus()
    {
        $date = new Carbon();

        $old_supplier = DB::select('SELECT COUNT(id) AS old_supplier FROM suppliers WHERE created_at NOT BETWEEN  ? AND  ?;',
                        [$date->now()->startOfMonth()->format('Y-m-d').'%', $date->now()->endOfMonth()->format('Y-m-d').'%']);

        $new_supplier = DB::select('SELECT COUNT(id) AS new_supplier FROM suppliers WHERE created_at BETWEEN ? AND ?;',
                        [$date->now()->startOfMonth()->format('Y-m-d').'%', $date->now()->endOfMonth()->format('Y-m-d').'%']);


        return[
            'old_supplier' => $old_supplier[0],
            'new_supplier' => $new_supplier[0],
        ];
    }
}
