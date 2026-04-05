<?php

use App\Http\Controllers\Api\V1\Authentication\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:sanctum')->prefix('v1')->group(function(){
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});