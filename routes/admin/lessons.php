<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LessonController;

Route::middleware('auth')->prefix('admin/lessons')->group(function () {

    Route::get('/', [LessonController::class, 'index'])->name('admin.lessons');
    Route::post('/store', [LessonController::class, 'store'])->name('admin.lessons.store');
    Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('admin.lessons.edit');
    Route::put('/{lesson}/update', [LessonController::class, 'update'])->name('admin.lessons.update');
    Route::get('/{lesson}/destroy', [LessonController::class, 'destroy'])->name('admin.lessons.destroy');
    Route::get('/{lesson}/status', [LessonController::class, 'changeStatus'])->name('admin.lessons.changeStatus');

    //Ajax request
    Route::post('/{lesson}/storeImageGeneral', [LessonController::class, 'storeImageGeneral'])->name('admin.lessons.storeImageGeneral');
    Route::get('/{lesson}/delete_image_general', [LessonController::class, 'deleteImageGeneral'])->name('admin.lessons.delete_image_general');

});
