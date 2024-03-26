<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\StudentDocumentController;
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
    Route::get('students', [StudentController::class, 'index'])->middleware(['ability:get-students']);
    Route::post('students', [StudentController::class, 'store'])->middleware(['ability:create-students']);
    Route::get('workouts', [WorkoutController::class, 'index'])->middleware(['ability:get-workouts']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/api/students/{id}/documents', [StudentDocumentController::class, 'store'])->middleware(['ability:post-students']);
});


Route::post('login', [AuthController::class, 'store']);
