<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\ProductController;

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
Route::get('/style/{id}', [StyleController::class, 'showproductid']);
Route::get('/product', [ProductController::class, 'index']); // ini buat yang nampilin semua product
Route::get('/style/product/{id}', [ProductController::class, 'showproductid']); // ini buat nampilin product dengan id style
Route::get('/products/{style_id}', [ProductController::class, 'showproductid']); // ini nampilin product berdasarkan idnya

