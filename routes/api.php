<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\TreinoController;
use Illuminate\Support\Facades\Route;

Route::post('/exercicios', [ExercicioController::class, 'create'])->name('app.exercicios.create');
Route::get('/exercicios/{id}', [ExercicioController::class, 'get'])->name('app.exercicios.get');
Route::get('/exerciciosGetAll/{pagina}', [ExercicioController::class, 'getAll'])->name('app.exercicios.getAll');
Route::put('/exercicios', [ExercicioController::class, 'update'])->name('app.exercicios.update');
Route::delete('/exercicios/{id}', [ExercicioController::class, 'delete'])->name('app.exercicios.delete');

Route::post('/treinos', [TreinoController::class, 'create'])->name('app.treinos.create');
Route::get('/treinos/{id}', [TreinoController::class, 'get'])->name('app.treinos.get');
Route::get('/treinosGetAll/{pagina}', [TreinoController::class, 'getAll'])->name('app.treinos.getAll');
Route::put('/treinos', [TreinoController::class, 'update'])->name('app.treinos.update');
Route::delete('/treinos/{id}', [TreinoController::class, 'delete'])->name('app.treinos.delete');

Route::post('/clientes', [ClienteController::class, 'create'])->name('app.clientes.create');
Route::get('/clientes/{id}', [ClienteController::class, 'get'])->name('app.clientes.get');
Route::get('/clientesGetAll/{pagina}', [ClienteController::class, 'getAll'])->name('app.clientes.getAll');
Route::get('/clienteTreinos/{id}', [ClienteController::class, 'getClienteWithTreinosId'])->name('app.clientes.getTreinos');
Route::put('/clientes', [ClienteController::class, 'update'])->name('app.clientes.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'delete'])->name('app.clientes.delete');
