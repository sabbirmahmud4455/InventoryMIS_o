<?php

use App\Http\Controllers\Backend\SystemDataModule\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'customer'], function(){

    //index route
    Route::get("/",[CustomerController::class,"index"])->name("customer.all");

});

?>
