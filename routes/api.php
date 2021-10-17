<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Misc\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('get-started', [RegistrationController::class, 'getStarted']);
    Route::post('verify-email', [RegistrationController::class, 'verifyEmail']);
    Route::post('account', [RegistrationController::class, 'createAccount']);
    Route::post('login', LoginController::class);
    Route::post('forgot-password', [PasswordController::class, 'sendPasswordResetCode']);
    Route::post('verify-password-code', [PasswordController::class, 'verifyPasswordResetCode']);
    Route::post('reset-password', [PasswordController::class, 'setNewPassword']);
});

Route::prefix('misc')->group(function () {
    Route::get('states', [LocationController::class, 'states']);
    Route::get('categories', [CategoryController::class, 'index']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('news', [ArticlesController::class, 'index']);
    Route::get('news/{article}', [ArticlesController::class, 'show']);
});
