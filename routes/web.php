<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\RegisterController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role == 'admin') {
            return redirect('/dashboard');
        }
    }
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('admin');
// cotroller kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/pagination/paginate-data-kategori', [KategoriController::class, 'pagination']);
Route::post('/Katgori-store', [KategoriController::class, 'store'])->name('kategori.store');
Route::delete('/kategori-delete/{id}', [KategoriController::class, 'destroy']);

//controller menu
Route::get('/menu', [MenusController::class, 'index']);
Route::post('/Menu-store', [MenusController::class, 'store'])->name('menu.store');
Route::post('/Menu-update', [MenusController::class, 'update'])->name('menu.update');
Route::delete('/menu-delete/{id}', [MenusController::class, 'destroy']);
Route::get('/pagination/paginate-data-menu', [MenusController::class, 'pagination']);

//Login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

//register
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
