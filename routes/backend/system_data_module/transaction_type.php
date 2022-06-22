<?php

use App\Http\Controllers\Backend\SystemDataModule\TransactionTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'transaction_type'], function (){

    //index route start
    Route::get('/',[TransactionTypeController::class,'index'])->name('transaction.type.index');

    //data route start
    Route::get('/data',[TransactionTypeController::class,'data'])->name('transaction.type.data');

    //add route start
    Route::get('/add',[TransactionTypeController::class,'add_modal'])->name('transaction.type.add.modal');
    Route::post('/add',[TransactionTypeController::class,'add'])->name('transaction.type.add');

    //edit route start
    Route::get('/edit/{id}',[TransactionTypeController::class,'edit_modal'])->name('transaction.type.edit.modal');
    Route::post('/edit/{id}',[TransactionTypeController::class,'edit'])->name('transaction.type.edit');

    //view route start
    Route::get('/view/{id}',[TransactionTypeController::class,'view'])->name('transaction.type.view.modal');

});