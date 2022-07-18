<?php

namespace App\Models\TransactionModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;

    public function TransactionDetails($id)
    {
        $transactions = DB::select('SELECT * FROM transactions WHERE id = ?;',[$id]);

        return $transactions;
    }
}
