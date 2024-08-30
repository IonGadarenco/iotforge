<?php

use App\Http\Controllers\SensorController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/devices/{device}/sensors', [SensorController::class, 'store']);

Route::get('/tasks/pending', [TaskController::class, 'getPendingTasks']);

Route::patch('/tasks/{id}', [TaskController::class, 'updateTaskStatus']);
