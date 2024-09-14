<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ConsultationController;

Route::middleware('auth')->prefix('admin/consultations')->group(function () {

    Route::get('/', [ConsultationController::class, 'index'])->name('admin.consultations');
    Route::post('/store', [ConsultationController::class, 'store'])->name('admin.consultations.store');
    Route::get('/{consultation}/edit', [ConsultationController::class, 'edit'])->name('admin.consultations.edit');
    Route::put('/{consultation}/update', [ConsultationController::class, 'update'])->name('admin.consultations.update');
    Route::get('/{consultation}/destroy', [ConsultationController::class, 'destroy'])->name('admin.consultations.destroy');
    Route::get('/{consultation}/status', [ConsultationController::class, 'changeStatus'])->name('admin.consultations.changeStatus');

    //Ajax request
    Route::post('/{consultation}/storeImageGeneral', [ConsultationController::class, 'storeImageGeneral'])->name('admin.consultations.storeImageGeneral');
    Route::get('/{consultation}/delete_image_general', [ConsultationController::class, 'deleteImageGeneral'])->name('admin.consultations.delete_image_general');

});
