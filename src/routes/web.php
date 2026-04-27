<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//商品一覧ページ
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

//商品登録ページ
Route::get('/products/register', [ProductController::class, 'register'])->name('products.register');
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');

//商品詳細ページ
Route::get('/products/detail/{productId}', [ProductController::class, 'show'])->name('products.show');

//商品更新
Route::post('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

//商品検索
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

//削除
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
