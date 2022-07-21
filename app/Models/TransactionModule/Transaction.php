<?php

namespace App\Models\TransactionModule;

use App\Models\BankModule\Bank;
use App\Models\PurchaseModule\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function bank() {
        return $this->belongsTo(Bank::class);
    }
    public function purchase() {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }
}
