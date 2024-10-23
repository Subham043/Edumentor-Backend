<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserCreateController;
use Modules\Users\Http\Controllers\UserDeleteController;
use Modules\Users\Http\Controllers\UserListController;
use Modules\Users\Http\Controllers\UserUpdateController;
use Modules\Users\Http\Controllers\UserViewController;

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
    Route::prefix('users')->group(function () {
        Route::get('/', UserListController::class);
        Route::post('/', UserCreateController::class);
        Route::post('/{id}', UserUpdateController::class);
        Route::get('/{id}', UserViewController::class);
        Route::delete('/{id}', UserDeleteController::class);
    });
});
