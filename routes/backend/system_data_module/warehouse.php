<?php

use App\Http\Controllers\Backend\SystemDataModule\WareHouseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'warehouse'], function (){

    //index route start
    Route::get('/',[WareHouseController::class,'index'])->name('warehouse.index');

    //data route start
    Route::get('/data',[WareHouseController::class,'data'])->name('warehouse.data');

    //add route start
    Route::get('/add',[WareHouseController::class,'add_modal'])->name('warehouse.add.modal');
    Route::post('/add',[WareHouseController::class,'add'])->name('warehouse.add');

    //edit route start
    Route::get('/edit/{id}',[WareHouseController::class,'edit_modal'])->name('warehouse.edit.modal');
    Route::post('/edit/{id}',[WareHouseController::class,'edit'])->name('warehouse.edit');

    //view route start
    Route::get('/view/{id}',[WareHouseController::class,'view'])->name('warehouse.view.modal');

});