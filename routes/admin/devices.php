<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DeviceController;

Route::middleware('auth')->prefix('admin/devices')->group(function () {

    Route::get('/', [DeviceController::class, 'index'])->name('admin.devices');
    Route::post('/store', [DeviceController::class, 'store'])->name('admin.devices.store');
    Route::get('/{device}/edit', [DeviceController::class, 'edit'])->name('admin.devices.edit');
    Route::match(['post', 'put'], '/{device}/update', [DeviceController::class, 'update'])->name('admin.devices.update');
    Route::get('/{device}/destroy', [DeviceController::class, 'destroy'])->name('admin.devices.destroy');
    Route::get('/{device}/status', [DeviceController::class, 'changeStatus'])->name('admin.devices.changeStatus');

    //Ajax request
    Route::post('/{device}/storeImageGeneral', [DeviceController::class, 'storeImageGeneral'])->name('admin.devices.storeImageGeneral');
    Route::get('/{device}/delete_image_general', [DeviceController::class, 'deleteImageGeneral'])->name('admin.devices.delete_image_general');

});
