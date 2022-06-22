<?php

use App\Http\Controllers\Backend\SystemDataModule\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'supplier'], function(){

    //index route
    Route::get("/",[SupplierController::class,"index"])->name("supplier.all");
    Route::get("/add",[SupplierController::class,'add_modal'])->name('supplier.add.modal');
    Route::get("/data",[SupplierController::class,'data'])->name('supplier.data');
    Route::post("/add",[SupplierController::class,'add'])->name('user.add');



});

?>
