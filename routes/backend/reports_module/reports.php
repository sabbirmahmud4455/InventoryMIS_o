<?php

use App\Http\Controllers\Backend\ReportsModule\AllReport\AllReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\UnitReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\VariantReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'all-reports'], function (){

    //index route
    Route::get('/',[AllReportController::class,'index'])->name('report.index');


    // Unit Report route start
    Route::group(['prefix' => 'unit-report'], function(){

        // index route
        Route::get('/', [UnitReportController::class, 'index'])->name('unit.report.index');
        
        // Export pdf route
        Route::get('/export-pdf', [UnitReportController::class, 'unit_report_export_pdf'])->name('unit.report.export.pdf');
        
    });
    // Unit Report route end

    // Variant Report route start
    Route::group(['prefix' => 'variant-report'], function(){

        // index route
        Route::get('/', [VariantReportController::class, 'index'])->name('variant.report.index');
        
        // Export pdf route
        Route::get('/export-pdf', [VariantReportController::class, 'variant_report_export_pdf'])->name('variant.report.export.pdf');

    });
    // Variant Report route end



});