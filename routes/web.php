<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::post('/book', [HomeController::class, 'book']);
Route::get('/book/{id}', [HomeController::class, 'detail']);
Route::get('/cancelAll', [HomeController::class, 'cancelAll']);
Route::post('/book/cancel/{id}', [HomeController::class, 'cancel']);
