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

    // date wise sale
    public function DateWiseSale($start_date, $end_date) {
        $date_wise_sale = DB::select('SELECT sales.id, sales.date, sales.challan_no, sales.customer_id, sales.status,
                    customers.name AS customer_name
                    FROM sales
                    LEFT JOIN customers
                    ON sales.customer_id = customers.id
                    WHERE date BETWEEN ? AND ?
                    ORDER BY sales.id DESC;', [$start_date, $end_date]);

        return $date_wise_sale;
    }

    // customer wise sale
    public function CustomerWiseSale($customer_id) {
        $customer_wise_sale = DB::select('SELECT sales.id, sales.date, sales.challan_no, sales.customer_id, sales.status,
                    customers.name AS customer_name
                    FROM sales
                    LEFT JOIN customers
                    ON sales.customer_id = customers.id
                    WHERE customer_id = ?
                    ORDER BY sales.id DESC;', [$customer_id]);

        return $customer_wise_sale;
    }


}
