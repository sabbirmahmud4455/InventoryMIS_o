<?php

use App\Http\Controllers\Backend\SystemDataModule\VariantController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'variant'], function (){

    //index route start
    Route::get('/',[VariantController::class,'index'])->name('variant.index');

    //data route start
    Route::get('/data',[VariantController::class,'data'])->name('variant.data');

    //add route start
    Route::get('/add',[VariantController::class,'add_modal'])->name('variant.add.modal');
    Route::post('/add',[VariantController::class,'add'])->name('variant.add');

    //edit route start
    Route::get('/edit/{id}',[VariantController::class,'edit_modal'])->name('variant.edit.modal');
    Route::post('/edit/{id}',[VariantController::class,'edit'])->name('variant.edit');

    //view route start
    Route::get('/view/{id}',[VariantController::class,'view'])->name('variant.view.modal');

});