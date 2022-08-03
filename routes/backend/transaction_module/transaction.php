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
    
    // transaction status change route
    Route::get('/status-change/{id}',[TransactionController::class,'transaction_status_change'])->name('transaction.status.change');
    
    // transaction status update route
    Route::post('/status-update/{id}',[TransactionController::class,'transaction_status_update'])->name('transaction.status.update');
    
    // transaction details route
    Route::get('/details/{id}',[TransactionController::class,'transaction_details'])->name('transaction.details');
    
    // transaction details export pdf route
    Route::get('/details/export/pdf/{id}',[TransactionController::class,'transaction_details_export_pdf'])->name('transaction.details.export.pdf');



});