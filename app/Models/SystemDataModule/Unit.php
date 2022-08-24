<?php

namespace App\Models\SystemDataModule;

use App\Models\PurchaseModule\PurchaseDetails;
use App\Models\StockModule\StockInOut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    use HasFactory;

    public function purchase_details() {
        return $this->hasMany(PurchaseDetails::class);
    }

    public function stocks()
    {
        return $this->hasMany(StockInOut::class);
    }

    public function UnitWithStock()
    {
        $unit_with_stock = DB::select('SELECT units.id, units.name, stock_in_outs.id AS stock_id, stock_in_outs.unit_id,
                            SUM(stock_in_outs.in_quantity) AS in_quantity, SUM(stock_in_outs.out_quantity) AS out_quantity,
                            (SUM(stock_in_outs.in_quantity) - SUM(stock_in_outs.out_quantity)) AS total_quantity
                            FROM units
                            LEFT JOIN stock_in_outs ON units.id = stock_in_outs.unit_id
                            WHERE units.is_active = 1 AND units.is_delete = 0
                            GROUP BY stock_in_outs.unit_id
                            ORDER BY units.id DESC;');
        return $unit_with_stock;
    }


}
