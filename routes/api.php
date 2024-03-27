<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('users', [UserController::class, 'store'])->middleware(['ability:create-users']);
    Route::get('users', [UserController::class, 'index'])->middleware(['ability:get-users']);
    Route::put('users/{id}', [UserController::class, 'update'])->middleware(['ability:update-users']);
    Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware(['ability:delete-users']);

    Route::get('students', [StudentController::class, 'index'])->middleware(['ability:get-students']);
    //Route::get('workouts', [WorkoutController::class, 'index'])->middleware(['ability:get-workouts']);
    Route::get('students/{id}/workouts', [WorkoutController::class, 'workoutsByStudent'])->middleware(['ability:get-workout']);

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('students/{id}/workouts', [WorkoutController::class, 'workoutsByStudent'])->middleware(['ability:get-workout']);
});

Route::post('login', [AuthController::class, 'store']);
