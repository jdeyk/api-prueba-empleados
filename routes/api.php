<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;


// correr con flutter  php artisan serve --host=0.0.0.0 --port=8000

Route::get('/', function () {
    return response()->json('API', 200);
});

Route::prefix('v1')->group(function () {
    Route::get('/empleados', [EmpleadoController::class, 'index']);
    Route::post('/empleados', [EmpleadoController::class, 'store']);
    Route::get('/empleados/{id}', [EmpleadoController::class, 'show']);
    Route::put('/empleados/{id}', [EmpleadoController::class, 'update']);
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy']);

    Route::get('/departamentos', [DepartamentoController::class, 'index']);
});
