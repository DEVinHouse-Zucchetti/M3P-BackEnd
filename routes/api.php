<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvaliationController;
use App\Http\Controllers\StudentController;
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
    Route::get('students', [StudentController::class, 'index'])->middleware(['ability:get-students']);
    Route::get('workouts', [WorkoutController::class, 'index'])->middleware(['ability:get-workouts']);

    //rotas para cadastro de avaliações em 3 etapas
    Route::prefix('avaliations')->group(function () {
        Route::post('step1', [AvaliationController::class, 'step1']);
        Route::post('step2', [AvaliationController::class, 'step2']);
        Route::post('step3', [AvaliationController::class, 'step3']);
    })->middleware(['ability:create-avaliations']);


    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('login', [AuthController::class, 'store']);
