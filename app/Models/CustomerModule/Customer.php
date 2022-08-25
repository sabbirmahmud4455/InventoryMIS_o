<?php

namespace App\Models\CustomerModule;

use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    public function CustomerPreviuosBalance($customer_id)
    {
        $balance = DB::select('SELECT (SUM(cash_in) - SUM(cash_out)) as previous_balance
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

        $old_customer = DB::select('SELECT COUNT(id) FROM customers WHERE created_at BETWEEN  ? AND  ?;',
                        [$date->now()->startOfMonth()->subMonth()->format('Y-m-d').'%', $date->now()->subMonth()->endOfMonth()->format('Y-m-d').'%']);

        $new_customer = DB::select('SELECT COUNT(id) FROM customers WHERE created_at BETWEEN ? AND ?;',
                        [$date->now()->startOfMonth()->format('Y-m-d').'%', $date->now()->endOfMonth()->format('Y-m-d').'%']);

        return[
            'old_customers' => $old_customer,
            'new_customers' => $new_customer
        ];
    }


}
