<?php

use App\Http\Controllers\Backend\SystemDataModule\UnitController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'unit'], function (){

    //index route start
    Route::get('/',[UnitController::class,'index'])->name('unit.index');

    //data route start
    Route::get('/data',[UnitController::class,'data'])->name('unit.data');

    //add route start
    Route::get('/add',[UnitController::class,'add_modal'])->name('unit.add.modal');
    Route::post('/add',[UnitController::class,'add'])->name('unit.add');

    //edit route start
    Route::get('/edit/{id}',[UnitController::class,'edit_modal'])->name('unit.edit.modal');
    Route::post('/edit/{id}',[UnitController::class,'edit'])->name('unit.edit');

    //view route start
    Route::get('/view/{id}',[UnitController::class,'view'])->name('unit.view.modal');

});