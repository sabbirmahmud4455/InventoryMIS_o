<?php

use App\Http\Controllers\Backend\BankModule\BankController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'bank'], function (){

    //index route start
    Route::get('/',[BankController::class,'index'])->name('bank.index');

    //data route start
    Route::get('/data',[BankController::class,'data'])->name('bank.data');

    //add route start
    Route::get('/add',[BankController::class,'add_modal'])->name('bank.add.modal');
    Route::post('/add',[BankController::class,'add'])->name('bank.add');

    //edit route start
    Route::get('/edit/{id}',[BankController::class,'edit_modal'])->name('bank.edit.modal');
    Route::post('/edit/{id}',[BankController::class,'edit'])->name('bank.edit');

    //view route start
    Route::get('/view/{id}',[BankController::class,'view'])->name('bank.view.modal');

    // bank transaction route
    Route::get('/transaction/{id}', [BankController::class, 'bank_transaction'])->name('bank.transaction');

    // bank transaction route
    Route::get('/transaction/{id}', [BankController::class, 'bank_transaction'])->name('bank.transaction');
    
    // bank transaction export pdf route
    Route::get('/transaction/export/pdf/{id}', [BankController::class, 'bank_transaction_export_pdf'])->name('bank.transaction.export.pdf');

    // bank transaction details route
    Route::get('/transaction/details/{id}', [BankController::class, 'bank_transaction_details'])->name('bank.transaction.details');
    
    // bank transaction details export pdf route
    Route::get('/transaction/details/export/pdf/{id}', [BankController::class, 'bank_transaction_details_export_pdf'])->name('bank.transaction.details.export.pdf');

});