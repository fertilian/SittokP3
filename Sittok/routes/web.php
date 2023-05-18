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



Route::get('Admin/jual/list', function () {
    return view('Admin.jual.list');
});

Route::resource('/user', UserController::class);
Route::resource('/supplier', SupplierController::class);
Route::resource('/kategori', KategoriController::class);

Route::get('Admin/barang/list', function () {
    return view('Admin.barang.list');
});

Route::get('Admin/customers/list', function () {
    return view('Admin.customers.list');
});
