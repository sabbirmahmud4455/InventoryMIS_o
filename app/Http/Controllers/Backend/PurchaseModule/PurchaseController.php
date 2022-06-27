<?php

namespace App\Http\Controllers\Backend\PurchaseModule;

use App\Http\Controllers\Controller;
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
            return view('backend.modules.purchase_module.add_purchase');
        } else {
            return view('errors.404');
        }
    }
}
