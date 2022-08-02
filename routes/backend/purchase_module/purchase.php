<?php

use App\Http\Controllers\Backend\PurchaseModule\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function(){
    Route::get('/', [PurchaseController::class, 'index'])->name('index');

    // Add New Purchase
    Route::get('/add', [PurchaseController::class, 'add_new_purchase'])->name('add');
    Route::post('/add', [PurchaseController::class, 'store_new_purchase'])->name('store');
    Route::get('/item-varients', [PurchaseController::class, 'get_item_varients'])->name('item_varients');

    Route::get('/view/{id}', [PurchaseController::class, 'view_purchase'])->name('view');

    // export pdf route
    Route::get('/export-pdf/{id}', [PurchaseController::class, 'purchase_export_pdf'])->name('export.pdf');

});

?>
