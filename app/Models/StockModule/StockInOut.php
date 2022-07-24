<?php

namespace App\Models\StockModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockInOut extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'item_id', 'unit_id', 'varient_id', 'lot_id', 'in_quantity', 'out_quantity'];

    public function StockList()
    {
        $stock_lists = DB::select('SELECT items.name as item_name, variants.name as varient_name,
        units.name as unit_name, 
        lots.name as lot_name, 
        (SUM(in_quantity) - SUM(out_quantity)) as available_stock,
        item_id, variant_id
        FROM stock_in_outs
        LEFT JOIN items ON items.id = stock_in_outs.item_id
        LEFT JOIN units ON units.id = stock_in_outs.unit_id
        LEFT JOIN variants on variants.id = stock_in_outs.variant_id
        LEFT JOIN lots on lots.id = stock_in_outs.lot_id
        GROUP BY item_id, variant_id;');

        return $stock_lists;
    }
}
