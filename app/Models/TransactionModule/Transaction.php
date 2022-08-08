<?php

namespace App\Models\TransactionModule;

use App\Models\BankModule\Bank;
use App\Models\PurchaseModule\Purchase;
use App\Models\SupplierModule\Supplier;
use App\Models\SystemDataModule\TransactionType;
use App\Models\UserModule\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class Transaction extends Model
{
    use HasFactory;

    public function SupplierTransactionDetails($id)
    {
        $transactions = DB::select('SELECT transactions.id as transaction_id,
            transactions.date as transaction_date,
            transaction_code, narration,
            transactions.remarks as transaction_remarks,
            transactions.purchase_id as transaction_purchase_id,
            suppliers.name as supplier_name,
            customers.name as customer_name,
            banks.name as bank_name,
            banks.account_name as bank_account_name,
            banks.account_no as bank_account_no,
            cheque_no, cash_in, cash_out,
            transactions.status as transaction_status,
            users.name as transaction_created_by,
            purchases.date as purchase_date,
            purchases.challan_no as purchase_challan,
            purchases.total_amount as purchase_total_amount

            FROM transactions
            LEFT JOIN suppliers ON suppliers.id = transactions.supplier_id
            LEFT JOIN customers ON customers.id = transactions.customer_id
            LEFT JOIN banks ON banks.id         = transactions.bank_id
            LEFT JOIN users ON users.id         = transactions.created_by
            LEFT JOIN purchases ON purchases.id = transactions.purchase_id
            WHERE transactions.id               = ?;',[$id]);

        if(count($transactions) > 0) {
            $purchase_details = DB::select('SELECT purchase_details.id as purchase_details_id,
            lots.name as lot_name,
            items.name as item_name,
            units.name as unit_name,
            variants.name as varient_name,
            unit_price, total_price

            FROM purchase_details
            LEFT JOIN lots on lots.id           = purchase_details.lot_id
            LEFT JOIN items on items.id         = purchase_details.item_id
            LEFT JOIN units on units.id         = purchase_details.unit_id
            LEFT JOIN variants on variants.id   = purchase_details.variant_id
            WHERE purchase_id                   = ?;', [$transactions[0]->transaction_purchase_id] );

            return [
                'transactions' =>$transactions[0],
                'purchase_details' => $purchase_details
            ];

            // if($purchase_details) {

            //     return [
            //         'transactions' =>$transactions[0],
            //         'purchase_details' => $purchase_details
            //     ];

            // } else {
            //     return ['transactions' => $transactions[0]];
            // }
        }
    }

    // Bank Transaction
    public function BankTransactions($id)
    {
        $bank_transactions = DB::select('SELECT transactions.id as transaction_id, transactions.date as transaction_date, transaction_code, narration, status, cash_in, cash_out
        FROM transactions
        WHERE bank_id IS NOT NULL AND bank_id = ?;', [$id]);

        return $bank_transactions;
    }

    // TOTAL CASH TRANSACTIONS COUNT
    public function TotalCashTransactionCount()
    {
        $total_cash_transaction = DB::select("SELECT COUNT(id) as total_cash_transactions
        FROM transactions
        WHERE payment_by = 'CASH';");

        return $total_cash_transaction;
    }
    // ALL CASH TRANSACTIONS
    public function AllCashTransactions()
    {
        $cash_transactions = DB::select("SELECT id, date, transaction_code, narration, status, cash_in, cash_out
        FROM transactions
        WHERE payment_by = 'CASH'
        ORDER BY id = 'DESC';");

        return $cash_transactions;
    }

    // TODAY CASH IN TRANSACTIONS
    public function TodayCashInTransactions($date)
    {
        $today_cash_in_amount = DB::select("SELECT SUM(cash_in) as today_cash_in
        FROM transactions
        WHERE payment_by = 'CASH' AND date = ? AND bank_id IS NULL;",[$date]);

        return $today_cash_in_amount;
    }

    // TODAY CASH OUT TRANSACTIONS
    public function TodayCashOutTransactions($date)
    {
        $today_cash_out_amount = DB::select("SELECT SUM(cash_out) as today_cash_out
        FROM transactions
        WHERE payment_by = 'CASH' AND date = ? AND bank_id IS NULL;",[$date]);

        return $today_cash_out_amount;
    }

    // CURRENT CASH BALANCE
    public function CurrentCashBalance()
    {
        $current_cash_balance = DB::select("SELECT (SUM(cash_in) - SUM(cash_out)) as cash_balance
        FROM transactions
        WHERE payment_by = 'CASH' AND bank_id IS NULL;");

        return $current_cash_balance;
    }

    // TOTAL CASH IN
    public function TotalCashIn()
    {
        $total_cash_in = DB::select("SELECT SUM(cash_in) as total_cash_in
        FROM transactions
        WHERE payment_by = 'CASH' AND bank_id IS NULL;");

        return $total_cash_in;
    }

    // TOTAL CASH OUT
    public function TotalCashOut()
    {
        $total_cash_out = DB::select("SELECT SUM(cash_out) as total_cash_out
        FROM transactions
        WHERE payment_by = 'CASH' AND bank_id IS NULL;");

        return $total_cash_out;
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }
    public function purchase() {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    public function transaction_type() {
        return $this->belongsTo(TransactionType::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function created_by_user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
