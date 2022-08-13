<?php

namespace App\Models\SaleModule;

use App\Models\LotModule\Lot;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\Unit;
use App\Models\SystemDataModule\Variant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

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
