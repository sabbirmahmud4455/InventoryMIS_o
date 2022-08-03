<?php

namespace App\Models\StockModule;

use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\Unit;
use App\Models\SystemDataModule\Variant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockInOut extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'item_id', 'unit_id', 'varient_id', 'lot_id', 'in_quantity', 'out_quantity'];


    public function StockList()
    {
        $stock_lists = DB::select('SELECT items.name as item_name, variants.name as variant_name,
        units.name as unit_name,
        lots.name as lot_name,
        (SUM(in_quantity) - SUM(out_quantity)) as available_stock,
        item_id, variant_id, unit_id
        FROM stock_in_outs
        LEFT JOIN items ON items.id = stock_in_outs.item_id
        LEFT JOIN units ON units.id = stock_in_outs.unit_id
        LEFT JOIN variants on variants.id = stock_in_outs.variant_id
        LEFT JOIN lots on lots.id = stock_in_outs.lot_id
        GROUP BY item_id, variant_id, unit_id;');

        return $stock_lists;
    }

    public function StockItemVariants($item_id)
    {
        $stock_item_variants = DB::select('SELECT variant_id, unit_id, variants.name as variant_name, units.name as unit_name
        FROM stock_in_outs
        LEFT JOIN variants ON variants.id = stock_in_outs.variant_id
        LEFT JOIN units ON units.id = stock_in_outs.unit_id
        WHERE item_id = ?
        GROUP BY variant_id, unit_id;', [$item_id]);

        return $stock_item_variants;
    }

    public function StockLots($item_id, $variant_id, $unit_id)
    {
        $stock_lots = DB::select('SELECT lot_id, lots.name as lot_name, lots.lot_code as lot_code
        FROM stock_in_outs
        LEFT JOIN lots ON lots.id = stock_in_outs.lot_id
        WHERE item_id = ? AND variant_id = ? AND unit_id = ?;', [$item_id, $variant_id, $unit_id]);

        return $stock_lots;
    }

    public function GetWarehouseWithStock($item_id, $variant_id, $unit_id, $lot_id)
    {
        $warehouse_with_stock = DB::select('SELECT warehouse_id, warehouses.name as warehouse_name, (SUM(in_quantity) - SUM(out_quantity)) as available_stock
        FROM stock_in_outs
        LEFT JOIN warehouses ON warehouses.id = stock_in_outs.warehouse_id
        WHERE item_id = ? AND variant_id = ? AND unit_id = ? AND  lot_id = ?
        GROUP BY warehouse_id;', [$item_id, $variant_id, $unit_id, $lot_id]);

        return $warehouse_with_stock;
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function variant() {
        return $this->belongsTo(Variant::class);
    }

}
