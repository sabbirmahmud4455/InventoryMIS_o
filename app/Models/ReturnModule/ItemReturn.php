<?php

namespace App\Models\ReturnModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemReturn extends Model
{
    use HasFactory;

    public function GetAllItemReturnList($prefix)
    {
        if($prefix == 'SalesReturn'){
            $column_name = 'sale_id';
            $relation_table_name = 'sales';
            $partner_id = 'customer_id';
            $partners_table = 'customers';
            $partners_name = 'customer_name';
        } else {
            $column_name = 'purchase_id';
            $relation_table_name = 'purchases';
            $partner_id = 'supplier_id';
            $partners_table = 'suppliers';
            $partners_name = 'supplier_name';
        }

        $item_retunrs = DB::select('SELECT item_returns.id as item_return_id, item_returns.date as return_date,'. $column_name .', invoice_no, return_amount,
        item_returns.status,'. $relation_table_name.'.'.$partner_id.' as '.$partner_id .', '.$partners_table.'.name as '.$partners_name.'
        FROM item_returns
        LEFT JOIN '.$relation_table_name .' ON '.$relation_table_name.'.id = item_returns.'.$column_name.'
        LEFT JOIN '.$partners_table.' ON '.$partners_table.'.id = '.$relation_table_name.'.'.$partner_id.'
        WHERE '.$column_name.' IS NOT null
        ORDER BY item_returns.id DESC;');

        return $item_retunrs;
    }

}
