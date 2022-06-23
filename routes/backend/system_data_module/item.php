<?php

use App\Http\Controllers\Backend\SystemDataModule\ItemController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item'], function (){

    //index route start
    Route::get('/',[ItemController::class,'index'])->name('item.index');

    //data route start
    Route::get('/data',[ItemController::class,'data'])->name('item.data');

    //add route start
    Route::get('/add',[ItemController::class,'add_modal'])->name('item.add.modal');
    Route::post('/add',[ItemController::class,'add'])->name('item.add');

    //edit route start
    Route::get('/edit/{id}',[ItemController::class,'edit_modal'])->name('item.edit.modal');
    Route::post('/edit/{id}',[ItemController::class,'edit'])->name('item.edit');

    //view route start
    Route::get('/view/{id}',[ItemController::class,'view'])->name('item.view.modal');

});