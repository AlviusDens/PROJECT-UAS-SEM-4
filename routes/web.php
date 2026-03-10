<?php

use App\Http\Controllers\LoginController; 
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CipherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index']);

Route::get('dashboard', [DashboardController::class, 'index']);

Route::get('/cipher', [CipherController::class, 'index']);

Route::post('/cipher/process', [CipherController::class, 'process']);