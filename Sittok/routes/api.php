<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('getDataBarang', [AuthController::class, 'getDataBarang']);
Route::post('getDataKategori', [AuthController::class, 'getDataKategori']);
Route::post('addDataKeranjang', [AuthController::class, 'addDataKeranjang']);
Route::post('getDataKeranjang', [AuthController::class, 'getDataKeranjang']);
Route::post('addDataFavorit', [AuthController::class, 'addDataFavorit']);
Route::post('deleteDataFavorit', [AuthController::class, 'deleteDataFavorit']);
Route::post('getDataBarangFav', [AuthController::class, 'getDataBarangFav']);
Route::post('updateDataKeranjang', [AuthController::class, 'updateDataKeranjang']);
Route::post('updateQty', [AuthController::class, 'updateQty']);
Route::post('getTotalKeranjang', [AuthController::class, 'getTotalKeranjang']);
Route::post('getAllPaymen', [AuthController::class, 'getAllPaymen']);
Route::post('store', [AuthController::class, 'store']);
Route::post('storeJual', [AuthController::class, 'storeJual']);
Route::post('storeDetil', [AuthController::class, 'storeDetil']);itt
Route::post('updateStatusKeranjang', [AuthController::class, 'updateStatusKeranjang']);
Route::post('getNota', [AuthController::class, 'getNota']);
Route::post('getDataJualByCustomer', [AuthController::class, 'getDataJualByCustomer']);
Route::post('getDetilJual', [AuthController::class, 'getDetilJual']);
Route::post('updateJual', [AuthController::class, 'updateJual']);
Route::post('getDetilBarang', [AuthController::class, 'getDetilBarang']);
Route::post('updateDataBarang', [AuthController::class, 'updateDataBarang']);
Route::post('updateProfile', [AuthController::class, 'updateProfile']);
Route::post('getUserById', [AuthController::class, 'getUserById']);
Route::post('kategori', [AuthController::class, 'kategori']);
Route::post('updateKlaim', [AuthController::class, 'updateKlaim']);
Route::put('/customer/{id}', [CustomerController::class, 'updateData']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});