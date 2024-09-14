<?php


use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->prefix('admin')->group(function () {

    //Roluri users
    Route::get('/roles', [RoleController::class, 'roles'])->name('user.config.roles');
    Route::get('/roles/role_edit/{role?}', [RoleController::class, 'roleEdit'])->name('user.config.role_edit');
    Route::put('/roles/role_update/{role?}', [RoleController::class, 'roleUpdate'])->name('user.config.role_update');

});

