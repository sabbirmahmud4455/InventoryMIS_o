<?php

namespace App\Models\PurchaseModule;

use App\Models\SupplierModule\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function purchase_details()
    {
        return $this->hasMany(PurchaseDetails::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
