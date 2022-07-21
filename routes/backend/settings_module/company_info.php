<?php

use App\Http\Controllers\Backend\SettingsModule\CompanyInfoController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'company_info'], function(){

    //index route
    Route::get("/",[CompanyInfoController::class,"index"])->name("company.info.all");

    //update route start
    Route::post("/update/{id}",[CompanyInfoController::class,"update"])->name("company.info.update");

});

?>