<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
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
    return redirect('/dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //kategori obat
    Route::get('/kategori', [CategoryController::class, 'index']);
    Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/data', [CategoryController::class, 'getCategoriesData'])->name('kategori.data');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori/{id}/edit', [CategoryController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [CategoryController::class, 'update'])->name('kategori.update');

    //supplier
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/data', [SupplierController::class, 'getSuppliersData'])->name('supplier.data');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
});
