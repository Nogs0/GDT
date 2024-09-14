<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\TreinoController;
use Illuminate\Support\Facades\Route;

Route::post('/exercicios', [ExercicioController::class, 'create']);
Route::get('/exercicios/{id}', [ExercicioController::class, 'get']);
Route::put('/exercicios', [ExercicioController::class, 'update']);
Route::delete('/exercicios/{id}', [ExercicioController::class, 'delete']);

Route::post('/treinos', [TreinoController::class, 'create']);
Route::get('/treinos/{id}', [TreinoController::class, 'get']);
Route::put('/treinos', [TreinoController::class, 'update']);
Route::delete('/treinos/{id}', [TreinoController::class, 'delete']);

Route::post('/clientes', [ClienteController::class, 'create']);
Route::get('/clientes/{id}', [ClienteController::class, 'get']);
Route::get('/clienteTreinos/{id}', [ClienteController::class, 'getClienteWithTreinosId']);
Route::put('/clientes', [ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteController::class, 'delete']);
