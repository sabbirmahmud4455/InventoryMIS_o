<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    //index function start
    public function index()
    {
        if (can('warehouse'))
        {
            return view('backend.modules.system_data_module.warehouse.index');
        }
        else
        {
            return view('errors.404');
        }
    }
    //index function end
}
