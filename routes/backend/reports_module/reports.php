<?php

use App\Http\Controllers\Backend\ReportsModule\AllReport\AllReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\SystemDataReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'all-reports'], function (){

    //index route
    Route::get('/',[AllReportController::class,'index'])->name('report.index');


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



});