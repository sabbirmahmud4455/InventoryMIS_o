<?php

use App\Http\Controllers\Backend\SystemDataModule\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'supplier'], function(){

    //index route
    Route::get("/",[SupplierController::class,"index"])->name("system.supplier.all");

});

?>
