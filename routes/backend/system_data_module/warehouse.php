<?php

use App\Http\Controllers\Backend\SystemDataModule\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'warehouse'], function (){

    //index route start
    Route::get('/',[WarehouseController::class,'index'])->name('warehouse.index');

    //data route start
    Route::get('/data',[WarehouseController::class,'data'])->name('warehouse.data');

    //add route start
    Route::get('/add',[WarehouseController::class,'add_modal'])->name('warehouse.add.modal');
    Route::post('/add',[WarehouseController::class,'add'])->name('warehouse.add');

    //edit route start
    Route::get('/edit/{id}',[WarehouseController::class,'edit_modal'])->name('warehouse.edit.modal');
    Route::post('/edit/{id}',[WarehouseController::class,'edit'])->name('warehouse.edit');

    //view route start
    Route::get('/view/{id}',[WarehouseController::class,'view'])->name('warehouse.view.modal');

});