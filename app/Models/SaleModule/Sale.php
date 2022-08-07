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
        $all_sale = DB::select('SELECT sales.id, sales.date, sales.challan_no, sales.customer_id, sales.status, sales.total_amount,
                    customers.name AS customer_name, customers.contact_no AS customer_phone
                    FROM sales
                    LEFT JOIN customers
                    ON sales.customer_id = customers.id
                    ORDER BY sales.id DESC');

        return $all_sale;
    }

    // date wise sale
    public function DateWiseSale($start_date, $end_date) {
        $date_wise_sale = DB::select('SELECT sales.id, sales.date, sales.challan_no, sales.customer_id, sales.status, sales.total_amount,
                    customers.name AS customer_name, customers.contact_no AS customer_phone
                    FROM sales
                    LEFT JOIN customers
                    ON sales.customer_id = customers.id
                    WHERE date BETWEEN ? AND ?
                    ORDER BY sales.id DESC;', [$start_date, $end_date]);

        return $date_wise_sale;
    }

    // customer wise sale
    public function CustomerWiseSale($customer_id) {
        $customer_wise_sale = DB::select('SELECT sales.id, sales.date, sales.challan_no, sales.customer_id, sales.status, sales.total_amount,
                    customers.name AS customer_name, customers.contact_no AS customer_phone
                    FROM sales
                    LEFT JOIN customers
                    ON sales.customer_id = customers.id
                    WHERE customer_id = ?
                    ORDER BY sales.id DESC;', [$customer_id]);

        return $customer_wise_sale;
    }

    // sale details
    public function SaleDetails($sale_id) {

        $sale = DB::select('SELECT sales.id, sales.date, sales.challan_no, sales.customer_id, sales.status, sales.total_amount,
                    customers.name AS customer_name, customers.contact_no AS customer_phone
                    FROM sales
                    LEFT JOIN customers
                    ON sales.customer_id = customers.id
                    WHERE sales.id = ? ;', [$sale_id]);

        $sale_details = DB::select('SELECT sale_details.id, sale_details.sale_id,
                        items.name AS item_name, units.name AS unit_name, variants.name AS variant_name,
                        lots.name AS lot_name, quantity, unit_price, total_price
                        FROM sale_details
                        LEFT JOIN items
                        ON sale_details.item_id = items.id
                        LEFT JOIN units
                        ON sale_details.unit_id = units.id
                        LEFT JOIN variants
                        ON sale_details.variant_id = variants.id
                        LEFT JOIN lots
                        ON sale_details.lot_id = lots.id
                        WHERE sale_id = ?
                        GROUP BY item_id, variant_id, unit_id;', [$sale_id]);

        return ['sale' => $sale, 'sale_details' => $sale_details];
    }


}
