<?php

use App\Http\Controllers\Backend\ReportsModule\AllReport\AllReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\CashReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\ItemReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\PurchaseReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\SaleReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\StockReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\SystemDataReportController;
use App\Http\Controllers\Backend\ReportsModule\BankReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'all-reports'], function (){

    //index route
    Route::get('/',[AllReportController::class,'index'])->name('report.index');


    // System Data Report Start
    Route::group(['prefix' => 'system-data-report'], function() {

        // Unit Report route start
        Route::group(['prefix' => 'unit-report'], function(){

            // index route
            Route::get('/', [SystemDataReportController::class, 'unit_report'])->name('unit.report.index');

            // Export pdf route
            Route::get('/export-pdf', [SystemDataReportController::class, 'unit_report_export_pdf'])->name('unit.report.export.pdf');

        });
        // Unit Report route end

        // Variant Report route start
        Route::group(['prefix' => 'variant-report'], function(){

            // index route
            Route::get('/', [SystemDataReportController::class, 'variant_report'])->name('variant.report.index');

            // Export pdf route
            Route::get('/export-pdf', [SystemDataReportController::class, 'variant_report_export_pdf'])->name('variant.report.export.pdf');

        });
        // Variant Report route end

        // Item Type Report route start
        Route::group(['prefix' => 'item-type-report'], function(){

            // index route
            Route::get('/', [SystemDataReportController::class, 'item_type_report'])->name('item.type.report.index');

            // Export pdf route
            Route::get('/export-pdf', [SystemDataReportController::class, 'item_type_report_export_pdf'])->name('item.type.report.export.pdf');

        });
        // Item Type Report route end

        // Warehouse Report route start
        Route::group(['prefix' => 'warehouse-report'], function(){

            // index route
            Route::get('/', [SystemDataReportController::class, 'warehouse_report'])->name('warehouse.report.index');

            // Export pdf route
            Route::get('/export-pdf', [SystemDataReportController::class, 'warehouse_report_export_pdf'])->name('warehouse.report.export.pdf');

        });
        // Warehouse Report route end

        // Transaction Type Report route start
        Route::group(['prefix' => 'transaction-type-report'], function(){

            // index route
            Route::get('/', [SystemDataReportController::class, 'transaction_type_report'])->name('transaction.type.report.index');

            // Export pdf route
            Route::get('/export-pdf', [SystemDataReportController::class, 'transaction_type_report_export_pdf'])->name('transaction.type.report.export.pdf');

        });
        // Transaction Type Report route end

        // Payment Type Report route start
        Route::group(['prefix' => 'payment-type-report'], function(){

            // index route
            Route::get('/', [SystemDataReportController::class, 'payment_type_report'])->name('payment.type.report.index');

            // Export pdf route
            Route::get('/export-pdf', [SystemDataReportController::class, 'payment_type_report_export_pdf'])->name('payment.type.report.export.pdf');

        });
        // Payment Type Report route end




    });
    // System Data Report End


    // Item Report Start
    Route::group(['prefix' => 'item-report'], function() {

        // all item report route
        Route::get('/all-item-report', [ItemReportController::class, 'all_item_report'])->name('all.item.report');

        // all item report export pdf route
        Route::get('/all-item-report-export-pdf', [ItemReportController::class, 'all_item_report_export_pdf'])->name('all.item.report.export.pdf');

        // unit wise item report route
        Route::get('/unit-wise-item-report', [ItemReportController::class, 'unit_wise_item_report'])->name('unit.wise.item.report');

        // unit wise item report export pdf route
        Route::get('/unit-wise-item-report-export-pdf', [ItemReportController::class, 'unit_wise_item_report_export_pdf'])->name('unit.wise.item.report.export.pdf');

        // variant wise item report route
        Route::get('/variant-wise-item-report', [ItemReportController::class, 'variant_wise_item_report'])->name('variant.wise.item.report');

        // variant wise item report export pdf route
        Route::get('/variant-wise-item-report-export-pdf', [ItemReportController::class, 'variant_wise_item_report_export_pdf'])->name('variant.wise.item.report.export.pdf');

    });
    // Item Report End

    // Sale Report Start
    Route::group(['prefix' => 'sale-report'], function() {
        // Index route
        Route::get('/', [SaleReportController::class, 'index'])->name('sale.report.index');

        // sale report details
        Route::get('/details/{id}', [SaleReportController::class, 'sale_report_details'])->name('sale.report.details');

        // sale report details export pdf
        Route::get('/details-export-pdf/{id}', [SaleReportController::class, 'sale_report_details_export_pdf'])->name('sale.report.details.export.pdf');

    });
    // Sale Report End


    // Bank Report Start
    Route::group(['prefix' => 'bank-report', 'as' => 'bank_report.'], function() {
        Route::get('/all-bank', [BankReportController::class, 'all_bank'])->name('all_bank');
        Route::get('/bank-details/{id}', [BankReportController::class, 'bank_details'])->name('bank_details');
        Route::get('/bank-details/latest-transactions/{id}', [BankReportController::class, 'latest_transactions'])->name('latest_transactions');
    });
    // Bank Report End

    // CashReport Start
    Route::group(['prefix' => 'cash-report', 'as' => 'cash_report.'], function() {
        Route::get('/', [CashReportController::class, 'index'])->name('index');
    });
    // CashReport End



});
