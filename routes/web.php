<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;

use App\Http\Controllers\UserController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\CipherController;

use App\Http\Controllers\LibraryController;

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [HomeController::class, 'index']);

Route::get('login', [AuthController::class, 'index']);

Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware([CheckLogin::class])->group(function () {

    Route::get('/daftar_pengguna', [UserController::class, 'daftarPengguna']);
    Route::get('/daftar_pengguna', [UserController::class, 'daftarPengguna']);
    Route::post('/daftar_pengguna/store', [UserController::class, 'store'])->name('pengguna.store');
    Route::put('/daftar_pengguna/update/{id}', [UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/daftar_pengguna/delete/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/cipher', [CipherController::class, 'index']);

    Route::post('/cipher/process', [CipherController::class, 'process']);

    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::post('/library/borrow/{id}', [LibraryController::class, 'borrow'])->name('library.borrow');
    Route::post('/library/store', [LibraryController::class, 'store'])->name('library.store');
    Route::put('/library/update/{id}', [LibraryController::class, 'update'])->name('library.update');
    Route::delete('/library/delete/{id}', [LibraryController::class, 'destroy'])->name('library.destroy');
});
