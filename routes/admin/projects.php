<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProjectController;

Route::middleware('auth')->prefix('admin/projects')->group(function () {

    Route::get('/', [ProjectController::class, 'index'])->name('admin.projects');
    Route::post('/store', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::match(['post', 'put'], '/{project}/update', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::get('/{project}/destroy', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
    Route::get('/{project}/status', [ProjectController::class, 'changeStatus'])->name('admin.projects.changeStatus');

    //Ajax request
    Route::post('/{project}/storeImageGeneral', [ProjectController::class, 'storeImageGeneral'])->name('admin.projects.storeImageGeneral');
    Route::get('/{project}/delete_image_general', [ProjectController::class, 'deleteImageGeneral'])->name('admin.projects.delete_image_general');

});
