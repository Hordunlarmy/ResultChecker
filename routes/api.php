<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return response()->json(['message' => 'Hello, I\'m API!!!']);
});

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:sanctum', 'admin',
], function () {
    Route::get('users', [AdminController::class, 'getUsers']);
    Route::get('scratch-cards', [AdminController::class, 'index']);
    Route::post('generate', [AdminController::class, 'generate']);
    Route::get('account-types', [AdminController::class, 'getAccountTypes']);
    Route::post('results', [AdminController::class, 'createResult']);
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('check-result', [UserController::class, 'checkResult']);
});
