<?php

use App\Http\Controllers\Backend\SystemDataModule\ItemTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-type', 'as' => 'item_type.'], function() {
    Route::get('/', [ItemTypeController::class, 'index'])->name('index');
});
