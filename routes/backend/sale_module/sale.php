<?php

use App\Http\Controllers\Backend\SaleModule\SaleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'sale', 'as' => 'sale.'], function(){
    Route::get('/', [SaleController::class, 'index'])->name('index');

    // Add New sale
    Route::get('/add', [SaleController::class, 'add_new_sale'])->name('add');

    Route::get('/item-variants', [SaleController::class, 'get_item_variants'])->name('item_variants');

    Route::get('/get-lot-items', [SaleController::class, 'get_lot_items'])->name('lot_items');
    Route::get('/get-item-stock-variant', [SaleController::class, 'get_item_stock_variant'])->name('item_stock_variant');
    Route::get('/available-lots', [SaleController::class, 'available_lots'])->name('available_lots');
    Route::get('/get-warehouse-stock', [SaleController::class, 'get_warehouse_stock'])->name('get_warehouse_stock');
    Route::get('/customer_previous_balance', [SaleController::class, 'customer_previous_balance'])->name('customer_previuos_balance');


    Route::post('/add', [SaleController::class, 'store_new_sale'])->name('store');

});

?>
