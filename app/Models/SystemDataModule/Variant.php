<?php

namespace App\Models\SystemDataModule;

use App\Models\PurchaseModule\PurchaseDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Variant extends Model
{
    use HasFactory;

    public function purchase_details() {
        return $this->hasMany(PurchaseDetails::class);
    }

    public function VariantWithStock()
    {
        $variant_with_stock = DB::select('SELECT variants.id, variants.name, stock_in_outs.id AS stock_id,
                            stock_in_outs.variant_id, SUM(stock_in_outs.in_quantity) AS in_quantity, SUM(stock_in_outs.out_quantity) AS out_quantity,
                            (SUM(stock_in_outs.in_quantity) - SUM(stock_in_outs.out_quantity)) AS total_quantity
                            FROM variants
                            LEFT JOIN stock_in_outs ON variants.id = stock_in_outs.unit_id
                            WHERE variants.is_active = 1 AND variants.is_delete = 0
                            GROUP BY stock_in_outs.variant_id
                            ORDER BY variants.id DESC;');
        return $variant_with_stock;
    }

}
