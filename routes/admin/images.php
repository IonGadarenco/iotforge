<?php

use App\Http\Controllers\Admin\ImageController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/images/{parent_id}/{imageable_type}/gallery', [ImageController::class, 'gallery'])->name('images.gallery');
    Route::post('/images/{parent_id}/store_image', [ImageController::class, 'storeImage'])->name('images.store_image');
    Route::post('/images/{parent_id}/destroy_image', [ImageController::class, 'destroyImage'])->name('images.destroy_image');


});
