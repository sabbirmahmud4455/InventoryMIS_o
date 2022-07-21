<?php

namespace App\Models\BankModule;

use App\Models\TransactionModule\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

}
