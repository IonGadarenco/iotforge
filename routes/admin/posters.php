<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PosterController;

Route::middleware('auth')->prefix('admin/posters')->group(function () {

    Route::get('/', [PosterController::class, 'index'])->name('admin.posters');
    Route::post('/store', [PosterController::class, 'store'])->name('admin.posters.store');
    Route::get('/{poster}/edit', [PosterController::class, 'edit'])->name('admin.posters.edit');
    Route::put('/{poster}/update', [PosterController::class, 'update'])->name('admin.posters.update');
    Route::get('/{poster}/destroy', [PosterController::class, 'destroy'])->name('admin.posters.destroy');
    Route::get('/{poster}/status', [PosterController::class, 'changeStatus'])->name('admin.posters.changeStatus');

    //Ajax request
    Route::post('/{poster}/storeImageGeneral', [PosterController::class, 'storeImageGeneral'])->name('admin.posters.storeImageGeneral');
    Route::get('/{poster}/delete_image_general', [PosterController::class, 'deleteImageGeneral'])->name('admin.posters.delete_image_general');

});
