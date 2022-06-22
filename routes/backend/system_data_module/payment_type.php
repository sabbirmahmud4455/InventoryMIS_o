<?php

use App\Http\Controllers\Backend\SystemDataModule\PaymentTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'payment_type'], function (){

    //index route start
    Route::get('/',[PaymentTypeController::class,'index'])->name('payment.type.index');

    //data route start
    Route::get('/data',[PaymentTypeController::class,'data'])->name('payment.type.data');

    //add route start
    Route::get('/add',[PaymentTypeController::class,'add_modal'])->name('payment.type.add.modal');
    Route::post('/add',[PaymentTypeController::class,'add'])->name('payment.type.add');

    //edit route start
    Route::get('/edit/{id}',[PaymentTypeController::class,'edit_modal'])->name('payment.type.edit.modal');
    Route::post('/edit/{id}',[PaymentTypeController::class,'edit'])->name('payment.type.edit');

    //view route start
    Route::get('/view/{id}',[PaymentTypeController::class,'view'])->name('payment.type.view.modal');

});