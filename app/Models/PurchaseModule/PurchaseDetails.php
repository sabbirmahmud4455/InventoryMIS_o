<?php

namespace App\Models\PurchaseModule;

use App\Models\LotModule\Lot;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\Unit;
use App\Models\SystemDataModule\Variant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'lot_id', 'item_id', 'unit_id', 'varient_id', 'unit_price', 'total_price'];

    public function purchase_info()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}
