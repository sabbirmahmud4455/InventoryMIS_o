<?php

use App\Http\Controllers\Backend\LotModule\LotController;
use App\Http\Controllers\Backend\PurchaseModule\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'lot', 'as' => 'lot.'], function(){
    // Add New Purchase
    Route::post('/store', [LotController::class, 'store_new_lot'])->name('store');
});

?>
