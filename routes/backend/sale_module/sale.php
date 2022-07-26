<?php

use App\Http\Controllers\Backend\SaleModule\SaleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'sale', 'as' => 'sale.'], function(){
    Route::get('/', [SaleController::class, 'index'])->name('index');

    // Add New sale
    Route::get('/add', [SaleController::class, 'add_new_sale'])->name('add');

    Route::get('/item-variants', [SaleController::class, 'get_item_variants'])->name('item_variants');

    Route::get('/get-lot-items', [SaleController::class, 'get_lot_items'])->name('lot_items');
});

?>
