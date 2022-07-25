<?php

use App\Http\Controllers\Backend\TransactionModule\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'transaction'], function (){

    //all transaction route
    Route::get('/all',[TransactionController::class,'all_transaction'])->name('transaction.all');
    
    // transaction create page route
    Route::get('/',[TransactionController::class,'transaction_create_page'])->name('transaction.create.page');
    
    // transaction create route
    Route::post('/create',[TransactionController::class,'transaction_create'])->name('transaction.create');
    
    // transaction details route
    Route::get('/details/{id}',[TransactionController::class,'transaction_details'])->name('transaction.details');



});