<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;

Route::middleware('auth')->prefix('admin/reports')->group(function () {

    Route::get('/', [ReportController::class, 'index'])->name('admin.reports');
    Route::post('/store', [ReportController::class, 'store'])->name('admin.reports.store');
    Route::get('/{report}/edit', [ReportController::class, 'edit'])->name('admin.reports.edit');
    Route::put('/{report}/update', [ReportController::class, 'update'])->name('admin.reports.update');
    Route::get('/{report}/destroy', [ReportController::class, 'destroy'])->name('admin.reports.destroy');
    Route::get('/{report}/status', [ReportController::class, 'changeStatus'])->name('admin.reports.changeStatus');

    //Ajax request
    Route::post('/{report}/storeImageGeneral', [ReportController::class, 'storeImageGeneral'])->name('admin.reports.storeImageGeneral');
    Route::get('/{report}/delete_image_general', [ReportController::class, 'deleteImageGeneral'])->name('admin.reports.delete_image_general');

});
