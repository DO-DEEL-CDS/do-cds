<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
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
