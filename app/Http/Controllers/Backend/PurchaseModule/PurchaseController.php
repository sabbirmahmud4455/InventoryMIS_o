<?php

namespace App\Http\Controllers\Backend\PurchaseModule;

use App\Http\Controllers\Controller;
use App\Models\SupplierModule\Supplier;
use App\Models\SystemDataModule\Item;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //Index
    public function index()
    {
        if(can('all_purchase')) {
            return view('backend.modules.purchase_module.index');
        } else {
            return view('errors.404');
        }
    }


    // Add New Purchase
    public function add_new_purchase()
    {
        if(can('add_purchase')) {
            $suppliers = Supplier::select('id', 'name')->where('is_active', true)->get();
            $items = Item::select('id', 'name')->where('is_active', true)->where('is_delete', false)->get();

            return view('backend.modules.purchase_module.add_purchase', compact('suppliers', 'items'));
        } else {
            return view('errors.404');
        }
    }
}
