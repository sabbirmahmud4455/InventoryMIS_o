<?php

use App\Http\Controllers\Backend\ReturnModule\ReturnAddController;
use App\Http\Controllers\Backend\ReturnModule\SalesReturnController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'return', 'as' => 'return.'], function(){

    Route::get('/add', [ReturnAddController::class, 'add'])->name('add');

    Route::post('/sales-return-view', [ReturnAddController::class, 'sales_return_view'])->name('sales_return_view');
    Route::post('/sales-return-store', [ReturnAddController::class, 'sales_return_store'])->name('sales_return_store');

    Route::post('/purchase-return-view', [ReturnAddController::class, 'purchase_return_view'])->name('purchase_return_view');
    Route::post('/purchase-return-store', [ReturnAddController::class, 'purchase_return_store'])->name('purchase_return_store');

    // Sales Return List
    Route::group(['prefix' => 'sales-return', 'as' => 'sales_return.'], function(){
        Route::get('/', [SalesReturnController::class, 'sales_return_list'])->name('index');
    });
});

?>
