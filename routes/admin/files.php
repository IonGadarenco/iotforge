<?php

use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


// Group routes under the same controller
Route::controller(FileController::class)->prefix('files')->name('files.')->group(function () {
    Route::get('{parent_id}/{fileable_type}/main', 'files')->name('main');
    Route::post('{parent_id}/store_file', 'storeFile')->name('store_file');
    Route::put('update_file/{file}', 'updateFile')->name('updateFile');
    Route::post('{parent_id}/destroy_file', 'destroyFile')->name('destroy_file');
});
