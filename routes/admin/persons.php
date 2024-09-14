<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PersonController;

Route::middleware('auth')->prefix('admin/persons')->group(function () {

    Route::get('/', [PersonController::class, 'index'])->name('admin.persons');
    Route::post('/store', [PersonController::class, 'store'])->name('admin.persons.store');
    Route::get('/{person}/edit', [PersonController::class, 'edit'])->name('admin.persons.edit');
    Route::post('/{person}/update', [PersonController::class, 'update'])->name('admin.persons.update');
    Route::get('/{person}/destroy', [PersonController::class, 'destroy'])->name('admin.persons.destroy');
    Route::get('/{person}/status', [PersonController::class, 'changeStatus'])->name('admin.persons.changeStatus');

    //Ajax request
    Route::post('/{person}/storeImageGeneral', [PersonController::class, 'storeImageGeneral'])->name('admin.persons.storeImageGeneral');
    Route::get('/{person}/delete_image_general', [PersonController::class, 'deleteImageGeneral'])->name('admin.persons.delete_image_general');

});
