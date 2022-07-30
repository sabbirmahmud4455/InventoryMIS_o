<?php

namespace App\Models\SystemDataModule;

use App\Models\PurchaseModule\PurchaseDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public function purchase_details() {
        return $this->hasMany(PurchaseDetails::class);
    }


}
