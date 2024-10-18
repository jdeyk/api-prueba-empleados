<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('El servicio se encuentra activo / JRMS 2024-10-17', 200);
});
