<?php

namespace App\Models\SystemDataModule;

use App\Models\StockModule\StockInOut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    public function item_type() {
        return $this->belongsTo(ItemType::class);
    }

    public function item_variants() {
        return $this->hasMany(ItemVariant::class);
    }

    public function stocks() {
        return $this->hasMany(StockInOut::class, 'item_id', 'id');
    }

    public function active_list()
    {
        return DB::select('SELECT id, name, item_code, is_active, is_delete FROM items WHERE is_active = 1 AND is_delete = 0');
    }

}
