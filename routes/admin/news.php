<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;

Route::middleware('auth')->prefix('admin/news')->group(function () {

    Route::get('/', [NewsController::class , 'index'])->name('admin.news');
    Route::post('/store', [NewsController::class , 'store'])->name('admin.news.store');
    Route::get('/{news}/edit', [NewsController::class , 'edit'])->name('admin.news.edit');
    Route::put('/{news}/update', [NewsController::class , 'update'])->name('admin.news.update');
    Route::get('/{news}/destroy', [NewsController::class , 'destroy'])->name('admin.news.destroy');
    Route::get('/{news}/status', [NewsController::class , 'changeStatus'])->name('admin.news.change_status' );
    //Ajax request
    Route::post('/{news}/store_image_general', [NewsController::class , 'storeImageGeneral'])->name('admin.news.store_image_general');
    Route::get('/{news}/delete_image_general', [NewsController::class , 'deleteImageGeneral'])->name('admin.news.delete_image_general');
});
