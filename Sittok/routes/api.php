<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
<<<<<<< HEAD
Route::post('register', [AuthController::class, 'register']);
Route::post('getDataBarang', [AuthController::class, 'getDataBarang']);
Route::post('getDataKategori', [AuthController::class, 'getDataKategori']);
Route::post('addData', [AuthController::class, 'addData']);
Route::post('getDataKeranjang', [AuthController::class, 'getDataKeranjang']);
=======
>>>>>>> ffec979ad0a52cde8e5970c5d6d69f8999c75244
