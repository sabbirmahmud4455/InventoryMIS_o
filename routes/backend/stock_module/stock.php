<?php

use App\Http\Controllers\Backend\StockModule\StockController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'stock', 'as' => 'stock.'], function(){
    Route::get('/list', [StockController::class, 'stock_list'])->name('list');

    // stock list export pdf
    Route::get('/list-export-pdf/{warehouse}/{stock_date}', [StockController::class, 'stock_list_export_pdf'])->name('list.export.pdf');

    Route::get('/add', [StockController::class, 'stock_add'])->name('add');
    Route::get('/add-to-stock/{id}', [StockController::class, 'add_to_stock'])->name('add_to_stock');
    Route::post('/add-to-stock', [StockController::class, 'store_to_stock'])->name('store_to_stock');

});

?>
