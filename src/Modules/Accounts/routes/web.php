<?php

use Illuminate\Support\Facades\Route;
use Modules\Accounts\Http\Controllers\ProfileVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::get('/verify/{id}/{hash}', [ProfileVerificationController::class, 'verify_email', 'as' => 'verify_email'])->name('verification.verify');
});
