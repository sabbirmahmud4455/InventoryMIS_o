<?php

use App\Http\Controllers\Backend\ReportsModule\AllReport\AllReportController;
use App\Http\Controllers\Backend\ReportsModule\AllReport\UnitReportController;
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



});