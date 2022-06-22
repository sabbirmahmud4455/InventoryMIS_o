<?php

use App\Http\Controllers\Backend\SystemDataModule\ItemTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-type', 'as' => 'item_type.'], function() {
    Route::get('/', [ItemTypeController::class, 'index'])->name('index');
    Route::get('/data', [ItemTypeController::class, 'data'])->name('data');

    Route::get('/add', [ItemTypeController::class, 'item_type_add'])->name('add');
    Route::post('/store', [ItemTypeController::class, 'item_type_store'])->name('store');

    Route::get('/edit/{id}', [ItemTypeController::class, 'item_type_edit'])->name('edit');
    Route::post('/update/{id}', [ItemTypeController::class, 'item_type_update'])->name('update');


});
