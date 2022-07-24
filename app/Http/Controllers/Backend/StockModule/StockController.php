<?php

namespace App\Http\Controllers\Backend\StockModule;

use App\Http\Controllers\Controller;
use App\Models\StockModule\StockInOut;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stock_add()
    {
        if(can('stock_add')) {
            
        }
    }

    //Stock Report
    public function stock_list()
    {
        if(can('stock_list')){
            $stock = new StockInOut();
            $stock_lists = $stock->StockList();
            return $stock_lists;
        }
    }
}
