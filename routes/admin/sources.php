<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SourceController;

Route::middleware('auth')->prefix('admin/sources')->group(function () {

    Route::get('/', [SourceController::class, 'index'])->name('admin.sources');
    Route::post('/store', [SourceController::class, 'store'])->name('admin.sources.store');
    Route::get('/{source}/edit', [SourceController::class, 'edit'])->name('admin.sources.edit');
    Route::put('/{source}/update', [SourceController::class, 'update'])->name('admin.sources.update');
    Route::get('/{source}/destroy', [SourceController::class, 'destroy'])->name('admin.sources.destroy');
    Route::get('/{source}/status', [SourceController::class, 'changeStatus'])->name('admin.sources.changeStatus');

    //Ajax request
    Route::post('/{source}/storeImageGeneral', [SourceController::class, 'storeImageGeneral'])->name('admin.sources.storeImageGeneral');
    Route::get('/{source}/delete_image_general', [SourceController::class, 'deleteImageGeneral'])->name('admin.sources.delete_image_general');

});
