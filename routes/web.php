<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StyleController;
use App\Http\Controllers\ProductController;

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

Route::get('/style',[StyleController::class, 'index'])->name('style.index');
Route::resource('/style', StyleController::class);
Route::get('/style/{id}/countcomponent', [ProductController::class, 'count'])->name('count.component');
Route::get('/style/{id}/createcomponent', [ProductController::class, 'send'])->name('create.component');
Route::get('/style/{id}/showcomponent', [ProductController::class, 'show'])->name('show.stylewithcomponent');
Route::post('/style/storedata', [ProductController::class, 'storetodata'])->name('storetodata.product');
Route::get('/auth/google', 'AuthController@redirectToGoogle');
Route::get('/auth/google/callback', 'AuthController@handleGoogleCallback');
