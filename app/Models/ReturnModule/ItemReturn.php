<?php

namespace App\Models\ReturnModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemReturn extends Model
{
    use HasFactory;

    public function GetAllItemReturnList()
    {
        $item_retunrs = DB::select('SELECT item_returns.id as item_return_id, item_returns.date as return_date, sale_id, invoice_no, return_amount, item_returns.status, sales.customer_id as customer_id, customers.name as customer_name
        FROM item_returns
        LEFT JOIN sales ON sales.id = item_returns.sale_id
        LEFT JOIN customers ON customers.id = sales.customer_id
        ORDER BY item_returns.id;');

        return $item_retunrs;
    }
}
