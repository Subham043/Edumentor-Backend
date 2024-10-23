<?php

use Illuminate\Support\Facades\Route;
use Modules\Accounts\Http\Controllers\LogoutController;
use Modules\Accounts\Http\Controllers\PasswordUpdateController;
use Modules\Accounts\Http\Controllers\ProfileController;
use Modules\Accounts\Http\Controllers\ProfileUpdateController;
use Modules\Accounts\Http\Controllers\ProfileVerificationController;

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

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('/', ProfileController::class);
        Route::get('/logout', LogoutController::class);
        Route::post('/update', ProfileUpdateController::class);
        Route::post('/update-password', PasswordUpdateController::class);
        Route::post('/resend-verification-link', [ProfileVerificationController::class, 'resend_notification'])->middleware(['throttle:6,1']);
    });
});
