<?php

namespace App\Http\Controllers\Backend\ReturnModule;

use App\Http\Controllers\Controller;
use App\Models\PurchaseModule\Purchase;
use App\Models\ReturnModule\ItemReturn;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    //index
    public function purchase_return_list()
    {
        if(can('purchase_return')) {
            $item_return = new ItemReturn();
            $purchase_return_list = $item_return->GetAllItemReturnList($prefix = 'PurchaseReturn');

            return view('backend.modules.return_module.purchase_return.purchase_return_list', compact('purchase_return_list'));

        } else {
            return view('errors.404');
        }
    }
}
