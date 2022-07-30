<?php

namespace App\Models\SystemDataModule;

use App\Models\StockModule\StockInOut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public function stocks() {
        return $this->hasMany(StockInOut::class, 'warehouse_id', 'id');
    }
}
