<?php

use App\Http\Controllers\Backend\PurchaseModule\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function(){
    Route::get('/', [PurchaseController::class, 'index'])->name('index');

    // Add New Purchase
    Route::get('/add', [PurchaseController::class, 'add_new_purchase'])->name('add');

    Route::get('/item-varients', [PurchaseController::class, 'get_item_varients'])->name('item_varients');
});

?>
