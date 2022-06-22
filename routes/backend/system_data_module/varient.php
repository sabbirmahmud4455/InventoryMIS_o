<?php

use App\Http\Controllers\Backend\SystemDataModule\VarientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'varient'], function (){

    //index route start
    Route::get('/',[VarientController::class,'index'])->name('varient.index');

    //data route start
    Route::get('/data',[VarientController::class,'data'])->name('varient.data');

    //add route start
    Route::get('/add',[VarientController::class,'add_modal'])->name('varient.add.modal');
    Route::post('/add',[VarientController::class,'add'])->name('varient.add');

    //edit route start
    Route::get('/edit/{id}',[VarientController::class,'edit_modal'])->name('varient.edit.modal');
    Route::post('/edit/{id}',[VarientController::class,'edit'])->name('varient.edit');

    //view route start
    Route::get('/view/{id}',[VarientController::class,'view'])->name('varient.view.modal');

});