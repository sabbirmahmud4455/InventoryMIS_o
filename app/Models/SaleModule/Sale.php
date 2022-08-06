<?php

namespace App\Models\SaleModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    // all sale
    public function AllSale() {
        $all_sale = DB::select('SELECT sales.id, sales.date, sales.challan_no, sales.customer_id, sales.status,
                    customers.name AS customer_name
                    FROM sales
                    LEFT JOIN customers
                    ON sales.customer_id = customers.id
                    ORDER BY sales.id DESC');

        return $all_sale;
    }
}
