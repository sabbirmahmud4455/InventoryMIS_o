<?php

namespace App\Models\CustomerModule;

use App\Models\SaleModule\Sale;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function CustomerPreviuosBalance($customer_id)
    {
        $balance = DB::select('SELECT ( SUM(cash_out) - SUM(cash_in) ) as previous_balance
        FROM transactions
        WHERE customer_id = ?;', [$customer_id]);

        return $balance[0];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    // Get Customer Staus
    public function CustomerStatus()
    {
        $date = new Carbon();

        $old_customer = DB::select('SELECT COUNT(id) AS old_customer FROM customers WHERE created_at NOT BETWEEN  ? AND  ?;',
                        [$date->now()->startOfMonth()->format('Y-m-d').'%', $date->now()->endOfMonth()->format('Y-m-d').'%']);

        $new_customer = DB::select('SELECT COUNT(id) AS new_customer FROM customers WHERE created_at BETWEEN ? AND ?;',
                        [$date->now()->startOfMonth()->format('Y-m-d').'%', $date->now()->endOfMonth()->format('Y-m-d').'%']);


        return[
            'old_customer' => $old_customer[0],
            'new_customer' => $new_customer[0],
        ];
    }


}
