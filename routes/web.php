<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CipherController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [HomeController::class, 'index']);

Route::get('login', [AuthController::class, 'index']);

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/daftar_pengguna', [AuthController::class, 'daftarPengguna']);

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/cipher', [CipherController::class, 'index']);

    Route::post('/cipher/process', [CipherController::class, 'process']);
    
});