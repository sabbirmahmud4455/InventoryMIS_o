<?php

namespace App\Models\StockModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInOut extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'item_id', 'unit_id', 'varient_id', 'lot_id', 'in_quantity', 'out_quantity'];
}
