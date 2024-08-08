<?php

use Illuminate\Http\Request;
use App\Http\Controllers\api\Test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/testdbconnection', [Test::class, 'testConnection']);
Route::get('/testquery', [Test::class, 'testQuery']);
Route::post('/userregister', [UserController::class, 'register']);
Route::post('/changepassword', [UserController::class, 'changepassword']);
