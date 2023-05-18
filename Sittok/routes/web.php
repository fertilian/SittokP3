<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriController;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Kategori;

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
    return view('loginn');
});

Route::controller(CustomAuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerPost')->name('register');

    Route::get('loginn', 'loginn')->name('loginn');
    Route::post('loginn', 'loginPost')->name('loginn');
});


Route::get('/Admin/indexadmin', function () {
    return view('Admin.indexadmin');
});

Route::get('Admin/user/list', function () {
    return view('Admin.user.list');
});

Route::get('Admin/jual/list', function () {
    return view('Admin.jual.list');
});

Route::resource('Admin/user/list', UserController::class);
Route::resource('Admin/supplier/list', SupplierController::class);
Route::resource('Admin/kategori/list', KategoriController::class);

Route::controller(KategoriController::class)->group(function () {
    Route::get('kategori', 'create')->name('kategori');
    Route::post('kategori', 'store')->name('kategori');
    Route::get('kategori', 'index')->name('kategori');
});
Route::get('Admin/barang/list', function () {
    return view('Admin.barang.list');
});

Route::get('Admin/customers/list', function () {
    return view('Admin.customers.list');
});


Route::get('Admin/kategori/input', function () {
    return view('Admin.supplier.list');
});
