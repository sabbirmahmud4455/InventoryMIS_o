<?php

namespace App\Models\CustomerModule;

use App\Models\TransactionModule\Transaction;
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


}
