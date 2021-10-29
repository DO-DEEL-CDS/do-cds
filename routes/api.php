<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmploymentsController;
use App\Http\Controllers\Misc\EnumsController;
use App\Http\Controllers\Misc\InfoController;
use App\Http\Controllers\Misc\LocationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\StateMemberController;
use App\Http\Controllers\TrainingAttendanceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
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

Route::get('ping', function () {
    return response()->json('pong');
});

Route::middleware('throttle:5')->post('apply', [ProspectController::class, 'store']);

Route::middleware('throttle:10')->prefix('auth')->group(function () {
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
    Route::middleware('throttle:5')->post('contact-us', [InfoController::class, 'contact']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/profile', [ProfileController::class, 'show']);
    Route::patch('auth/profile', [ProfileController::class, 'update']);

    Route::resource('users', UserController::class)->except('destroy');
    Route::post('users/{user}/trainings/{training}', [UserController::class, 'recordAttendance']);

    Route::get('news', [ArticlesController::class, 'index']);
    Route::post('news', [ArticlesController::class, 'store']);
    Route::get('news/{article}', [ArticlesController::class, 'show']);
    Route::patch('news/{article}', [ArticlesController::class, 'update']);
    Route::delete('news/{article}', [ArticlesController::class, 'destroy']);

    Route::get('jobs', [EmploymentsController::class, 'index']);
    Route::get('jobs/{job}', [EmploymentsController::class, 'show']);

    Route::post('trainings/{training}/attendance', [TrainingAttendanceController::class, 'store']);
    Route::resource('trainings', TrainingController::class);

    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/{project}', [ProjectController::class, 'show']);
    Route::patch('projects/{project}', [ProjectController::class, 'update']);
    Route::post('projects/{project}/business', [ProjectController::class, 'gmbSubmission']);
    Route::post('projects/{project}/members', [ProjectMemberController::class, 'store']);

    Route::patch('project-members/{member}', [ProjectMemberController::class, 'update']);
    Route::delete('project-members/{member}', [ProjectMemberController::class, 'destroy']);

    Route::get('states/{state}/members', [StateMemberController::class, 'index']);

    Route::get('prospects', [ProspectController::class, 'index']);
    Route::patch('prospects', [ProspectController::class, 'updateProspectsStatus']);
    Route::patch('prospects/{prospect}', [ProspectController::class, 'update']);

    Route::prefix('enums')->group(function () {
        Route::get('batches', [EnumsController::class, 'batches']);
        Route::get('project-statuses', [EnumsController::class, 'projectStatuses']);
        Route::get('project-types', [EnumsController::class, 'projectTypes']);
        Route::get('prospect-statuses', [EnumsController::class, 'prospectStatuses']);
        Route::get('training-statuses', [EnumsController::class, 'trainingStatuses']);
    });
});
