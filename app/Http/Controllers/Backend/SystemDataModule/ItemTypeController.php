<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemTypeController extends Controller
{
    //Index
    public function index()
    {
        if(can('item_type')) {
            return "This is Item Type";
        } else {
            return view("errors.404");
        }
    }
}
