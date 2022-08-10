<?php

use App\Http\Controllers\Backend\ReturnModule\ReturnAddController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'return', 'as' => 'return.'], function(){

    Route::get('/add', [ReturnAddController::class, 'add'])->name('add');

    Route::post('/customer-return-view', [ReturnAddController::class, 'customer_return_view'])->name('customer_return_view');
});

?>
