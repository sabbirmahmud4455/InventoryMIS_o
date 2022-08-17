<?php

use App\Http\Controllers\Backend\ReturnModule\ReturnAddController;
use App\Http\Controllers\Backend\ReturnModule\SalesReturnController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'return', 'as' => 'return.'], function(){

    Route::get('/add', [ReturnAddController::class, 'add'])->name('add');

    Route::post('/customer-return-view', [ReturnAddController::class, 'customer_return_view'])->name('customer_return_view');
    Route::post('/customer-return-store', [ReturnAddController::class, 'customer_return_store'])->name('customer_return_store');

    // Sales Return List
    Route::group(['prefix' => 'sales-return', 'as' => 'sales_return.'], function(){
        Route::get('/', [SalesReturnController::class, 'sales_return_list'])->name('index');
    });
});

?>
