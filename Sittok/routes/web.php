<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangkuController;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Customer;
use App\Models\Jual;
use App\Models\Beli;

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

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::controller(CustomAuthController::class)->group(function () {
    Route::get('loginn', 'loginn')->name('loginn');
    Route::post('loginn', 'loginPost');
});

    Route::resource('/home', AdminController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/barang', BarangController::class);
    Route::post('/customers/resetPassword/{id_customer}', [CustomerController::class, 'resetPassword'])->name('customers.resetPassword');
    Route::resource('/customers', CustomerController::class);
    Route::resource('/barangku', BarangkuController::class);

    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');