<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User as ModelsUser;
use App\Http\Controllers\AgendamentoApiController;
use App\Http\Controllers\LocalApiController;


/*
|--------------------------------------------------------------------------
| Rotas de Autenticação (Sanctum)
|--------------------------------------------------------------------------
*/


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
