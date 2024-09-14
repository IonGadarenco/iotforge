<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/{lang}/locale/', [HomeController::class, 'language'])->name('language');

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
Route::get('/device/{id}', [DeviceController::class,'show'])->name('device.show');
Route::get('/device/{id}/delete', [DeviceController::class,'delete'])->name('device.delete');


foreach (glob(__DIR__ . '/admin/*.php') as $filename) {
    require $filename;
}
