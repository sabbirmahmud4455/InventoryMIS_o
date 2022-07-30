<?php

namespace App\Models\SystemDataModule;

use App\Models\TransactionModule\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    public function transactions() {
        return $this->hasMany(Transaction::class, 'transaction_type_id', 'id');
    }

    
}
