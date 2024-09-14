<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;


Route::middleware('auth')->prefix('admin/pages')->group(function () {

    Route::get('/', [PageController::class , 'index'])->name('admin.pages');
    Route::post('/store', [PageController::class , 'store'])->name('admin.pages.store');
    Route::get('/{page}/edit', [PageController::class , 'edit'])->name('admin.pages.edit');
    Route::put('/{page}/update', [PageController::class , 'update'])->name('admin.pages.update');
    Route::get('/{page}/destroy', [PageController::class , 'destroy'])->name('admin.pages.destroy');

    Route::get('/{page}/first_menu/{feat}', [PageController::class , 'setFirstMenu'])->name('admin.pages.setFirstMenu');
    Route::get('/{page}/second_menu/{feat}', [PageController::class , 'setSecondMenu'])->name('admin.pages.setSecondMenu');

    //AjaxRequest
    Route::post('/order_pages/', [PageController::class , 'orderPages'])->name('admin.pages.orderPages');
    //Ajax requests images
    Route::get('/{page}/gallery', [PageController::class , 'gallery'])->name('admin.pages.gallery');
    Route::post('/{page}/store_image_general', [PageController::class , 'storeImageGeneral'])->name('admin.pages.store_image_general');
    Route::get('/{page}/delete_image_general', [PageController::class , 'deleteImageGeneral'])->name('admin.pages.delete_image_general');

});
