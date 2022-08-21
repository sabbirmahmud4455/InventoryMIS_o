<?php

namespace App\Http\Controllers\Backend\ReturnModule;

use App\Http\Controllers\Controller;
use App\Models\ReturnModule\ItemReturn;
use Illuminate\Http\Request;

class SalesReturnController extends Controller
{
    //Index
    public function sales_return_list()
    {
        if(can('sales_return')) {
            $item_return = new ItemReturn();
            $sales_return = $item_return->GetAllItemReturnList();

            return view('backend.modules.return_module.sale_return.sale_return_list', compact('sales_return'));
        } else {
            return view('errors.404');
        }
    }
}
