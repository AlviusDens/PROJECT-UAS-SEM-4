<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ReadingMaterialController; 
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome'); 

Route::get('/home', [HomeController::class, 'index'])->name('home'); 


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate'); 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
Route::post('/register', [AuthController::class, 'register'])->name('register.store'); 


Route::get('/rilis-baru', [HomeController::class, 'rilisBaru'])->name('koleksi.rilis_baru');
Route::get('/download-terpopuler', [HomeController::class, 'downloadTerpopuler'])->name('koleksi.terpopuler');


Route::get('/pengarang', [HomeController::class, 'pengarang'])->name('koleksi.pengarang');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact_us');

Route::middleware([CheckLogin::class])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    Route::put('/dashboard/update', [DashboardController::class, 'updateProfile'])->name('dashboard.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::post('/library/download/{id}', [LibraryController::class, 'downloadBook'])->name('library.download');
    Route::post('/reading-materials/download/{id}', [ReadingMaterialController::class, 'downloadMaterial'])->name('materials.download');


    Route::post('/library/store', [LibraryController::class, 'store'])->name('library.store');
    Route::put('/library/update/{id}', [LibraryController::class, 'update'])->name('library.update');
    Route::delete('/library/delete/{id}', [LibraryController::class, 'destroy'])->name('library.destroy');


    Route::post('/reading-materials/store', [ReadingMaterialController::class, 'store'])->name('materials.store');
    Route::put('/reading-materials/update/{id}', [ReadingMaterialController::class, 'update'])->name('materials.update');
    Route::delete('/reading-materials/delete/{id}', [ReadingMaterialController::class, 'destroy'])->name('materials.destroy');



    Route::get('/daftar_pengguna', [UserController::class, 'daftarPengguna'])->name('pengguna.index'); 
    Route::post('/daftar_pengguna/store', [UserController::class, 'store'])->name('pengguna.store');
    Route::put('/daftar_pengguna/update/{id}', [UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/daftar_pengguna/delete/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');
});
