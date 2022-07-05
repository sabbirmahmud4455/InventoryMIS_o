<?php

namespace App\Models\PurchaseModule;

use App\Models\LotModule\Lot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id', 'id');
    }

    // public function
}
