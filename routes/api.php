<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource(
    'crimenes',
    \App\Http\Controllers\API\CrimenController::class
)->only(['index']);

Route::apiResource(
    'crimenes-heatmap',
    \App\Http\Controllers\API\CrimenHeatMapController::class
)->only(['index']);

Route::apiResource(
    'filtros',
    \App\Http\Controllers\API\Filtros::class
)->only(['index']);
