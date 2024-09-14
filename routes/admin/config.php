<?php


use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    // Define your routes
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.config.admins');
    Route::get('/admins/delete/{admin}', [AdminController::class, 'delete'])->name('admin.config.admins.delete');
    Route::get('/admins/edit/{admin}', [AdminController::class, 'edit'])->name('admin.config.admins.edit');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.config.admins.create');
    Route::put('/admins/updateOrCreate/{admin?}', [AdminController::class, 'updateOrCreate'])->name('admin.config.admins.updateOrCreate');
    Route::get('/admins/status/{status}/{admin}', [AdminController::class, 'status'])->name('admin.config.admins.status');
});

//Route::get('/notifications', 'NotificationsController@index')->name('user.notifications');
