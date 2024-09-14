<?php

use App\Http\Controllers\Admin\TranslatableController;
use Illuminate\Support\Facades\Route;

//Constante
Route::middleware('auth')->prefix('admin/config')->group(function () {

    Route::get('/translate', [TranslatableController::class, 'index'])->name('admin.translate');
    Route::get('/translate/search', [TranslatableController::class, 'index'])->name('admin.translate.search');
    Route::get('/translate/edit/{id}', [TranslatableController::class, 'edit'])->name('admin.translate.edit');
    Route::get('/translate/create', [TranslatableController::class, 'create'])->name('admin.translate.create');
    Route::put('/translate/insert', [TranslatableController::class, 'insert'])->name('admin.translate.insert');
    Route::post('/translate/update', [TranslatableController::class, 'update'])->name('admin.translate.update');
    Route::get('/translate/delete', [TranslatableController::class, 'delete'])->name('admin.translate.delete');
});
