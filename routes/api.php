<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InitiativeController;

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
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::get('/initiatives', [InitiativeController::class, 'index']);
Route::get('/initiatives/{id}', [InitiativeController::class, 'show']);
Route::post('/initiatives', [InitiativeController::class, 'store']);
Route::put('/initiatives/{id}/approve', [InitiativeController::class, 'approve']);
Route::put('/initiatives/{id}', [InitiativeController::class, 'update']);
Route::delete('/initiatives/{id}', [InitiativeController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
