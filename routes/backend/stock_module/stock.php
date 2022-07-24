<?php

use App\Http\Controllers\Backend\StockModule\StockController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'stock', 'as' => 'stock.'], function(){
    Route::get('/list', [StockController::class, 'stock_list'])->name('list');

    Route::get('/add', [StockController::class, 'stock_add'])->name('add');
    Route::get('/add-to-stock/{id}', [StockController::class, 'add_to_stock'])->name('add_to_stock');
});

?>
