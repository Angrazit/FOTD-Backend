<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Models\style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;


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

Route::get('/style', [StyleController::class, 'view']);
Route::post('/style' ,[StyleController::class, 'store']);
Route::post('/product' ,[ProductController::class, 'storetodata']);
//Route::get('/product' ,[ProductController::class, 'index']);
Route::get('/product/{id}' ,[ProductController::class, 'showproduct']);
Route::put('/updateproduct/{id}', [ProductController::class, 'updatecomponent']);
Route::post('/perbarui/gambar/{id}', [ProductController::class, 'perbarui']);
Route::delete('/product/delete/{id}', [ProductController::class, 'delete']);
Route::get('/style/{id}' ,[StyleController::class, 'showing']);
Route::get('/style/{id}', [StyleController::class, 'showproductid']);
//Route::get('/product', [ProductController::class, 'index']); // ini buat yang nampilin semua product
Route::get('/style/product/{id}', [ProductController::class, 'showproductid']); // ini buat nampilin product dengan id style
Route::get('/products/{style_id}', [ProductController::class, 'showproductid']); // ini nampilin product berdasarkan idnya
Route::post('/signup', [UserController::class, 'signup']);
Route::get('/signup/google', [UserController::class, 'redirectToGoogle']);
Route::get('/signup/google/callback', [UserController::class,'handleGoogleCallback']);
Route::post('/login', [userController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/login/google', [UserController::class, 'redirectToGoogle']);



