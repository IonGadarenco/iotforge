<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/devices', [DeviceController::class,'index'])->name('device.index');
Route::get('/device/{id}/edit', [DeviceController::class,'edit'])->name('device.edit');
Route::get('/device/{id}/delete', [DeviceController::class,'delete'])->name('device.delete');
Route::get('/device/{id}', [DeviceController::class,'show'])->name('device.show');
