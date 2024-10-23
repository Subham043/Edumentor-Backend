<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentications\Http\Controllers\ForgotPasswordController;
use Modules\Authentications\Http\Controllers\LoginController;
use Modules\Authentications\Http\Controllers\RegisterController;
use Modules\Authentications\Http\Controllers\ResetPasswordController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', LoginController::class)->middleware(['throttle:3,1']);
        Route::post('/register', RegisterController::class)->middleware(['throttle:5,1']);
        Route::post('/forgot-password', ForgotPasswordController::class)->middleware(['throttle:3,1']);
        Route::post('/reset-password/{token}', ResetPasswordController::class)->name('user.reset_password')->middleware(['throttle:5,1']);
    });
});
