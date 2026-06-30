<?php

use App\Http\Controllers\Api\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('properties', [PropertyController::class, 'index']);
Route::post('properties', [PropertyController::class, 'store']);
Route::get('properties/{property}', [PropertyController::class, 'show']);
Route::put('properties/{property}', [PropertyController::class, 'update']);
Route::delete('properties/{property}', [PropertyController::class, 'destroy']);
