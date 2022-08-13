<?php

use App\Http\Controllers\Backend\CustomerModule\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'customer'], function(){

    //index route
    Route::get("/",[CustomerController::class,"index"])->name("customer.all");
    Route::get("/add-modal",[CustomerController::class,'add_modal'])->name('customer.add.modal');
    Route::post("/add",[CustomerController::class,'add'])->name('customer.add');

    //customer edit
    Route::get("/edit-modal/{id}",[CustomerController::class,'edit'])->name('customer.edit.modal');
    Route::post("/edit/{id}",[CustomerController::class,'update'])->name('customer.update');

    //view customer
    Route::get("/show/{id}",[CustomerController::class,'show'])->name('customer.show');

    //customer transaction
    Route::get("/transaction/",[CustomerController::class,'customer_transaction'])->name('customer.transaction');

    //customer transaction export pdf
    Route::get("/transaction-export-pdf/{id}",[CustomerController::class,'customer_transaction_export_pdf'])->name('customer.transaction.export.pdf');

    //customer transaction details
    Route::get("/transaction-details/{id}",[CustomerController::class,'customer_transaction_details'])->name('customer.transaction.details');

    //customer transaction details export pdf
    Route::get("/transaction-details-export-pdf/{id}",[CustomerController::class,'customer_transaction_details_export_pdf'])->name('customer.transaction.details.export.pdf');

});

?>
