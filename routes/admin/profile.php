<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/import-products', [DashboardController::class, 'importProducts'])->name('admin.importProducts');
    Route::get('/import-catalogs', [DashboardController::class, 'importCatalogs'])->name('admin.importCatalogs');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/{user}/delete_image_general', [ProfileController::class , 'deleteImageGeneral'])->name('profile.delete_image_general');

});
