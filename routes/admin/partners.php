<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PartnerController;

Route::middleware('auth')->prefix('admin/partners')->group(function () {

    Route::get('/', [PartnerController::class, 'index'])->name('admin.partners');
    Route::post('/store', [PartnerController::class, 'store'])->name('admin.partners.store');
    Route::get('/{partner}/edit', [PartnerController::class, 'edit'])->name('admin.partners.edit');
    Route::put('/{partner}/update', [PartnerController::class, 'update'])->name('admin.partners.update');
    Route::get('/{partner}/destroy', [PartnerController::class, 'destroy'])->name('admin.partners.destroy');
    Route::get('/{partner}/status', [PartnerController::class, 'changeStatus'])->name('admin.partners.changeStatus');

    //Ajax request
    Route::post('/{partner}/storeImageGeneral', [PartnerController::class, 'storeImageGeneral'])->name('admin.partners.storeImageGeneral');
    Route::get('/{partner}/delete_image_general', [PartnerController::class, 'deleteImageGeneral'])->name('admin.partners.delete_image_general');

});
