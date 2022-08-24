<?php

use App\Http\Controllers\Backend\SupplierModule\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'supplier'], function(){

    //index route
    Route::get("/",[SupplierController::class,"index"])->name("supplier.all");
    Route::get("/add-modal",[SupplierController::class,'add_modal'])->name('supplier.add.modal');
    Route::post("/add",[SupplierController::class,'add'])->name('supplier.add');

    //supplier edit
    Route::get("/edit-modal/{id}",[SupplierController::class,'edit'])->name('supplier.edit.modal');
    Route::post("/edit/{id}",[SupplierController::class,'update'])->name('supplier.update');

    //view supplier
    Route::get("/show/{id}",[SupplierController::class,'show'])->name('supplier.show');

    Route::get("/show-details",[SupplierController::class,'show_details'])->name('supplier.show-details');

    // Suppllier Transaction
    Route::get('/transactions/', [SupplierController::class, 'supplier_transactions'])->name('supplier.transactions');
    Route::get('transaction-details/{id}', [SupplierController::class, 'supplier_transaction_details'])->name('supplier.transaction_details');

    // supplier transaction export pdf
    Route::get('/transactions/export/pdf/{id}', [SupplierController::class, 'supplier_transactions_export_pdf'])->name('supplier.transactions.export.pdf');

    // supplier transaction export pdf
    Route::get('transaction-details/export/pdf/{id}', [SupplierController::class, 'supplier_transaction_details_export_pdf'])->name('supplier.transaction.details.export.pdf');

});

?>
