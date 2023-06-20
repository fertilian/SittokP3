<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------cd ----
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']); 
Route::post('get-data-barang', [AuthController::class, 'getDataBarang']);
Route::post('getDataKategori', [AuthController::class, 'getDataKategori']);
Route::post('addData', [AuthController::class, 'addData']);
Route::post('get-data-keranjang', [AuthController::class, 'getDataKeranjang']);
Route::put('/customer/{id}', [CustomerController::class, 'updateData']);
