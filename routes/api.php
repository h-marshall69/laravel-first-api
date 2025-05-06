<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\GlobalStateController;

// Autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //Route::apiResource('/personas', [PersonaController::class, 'index']);
    Route::apiResource('personas', PersonaController::class)->middleware('auth:sanctum');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/state', [GlobalStateController::class, 'show']);
    Route::put('/state', [GlobalStateController::class, 'update']);
});
