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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

/* This is product route */
Route::match(['get', 'post'],'/product/index', [ProductController::class, 'index'])->name('product.index');
Route::match(['get', 'post'],'/product/create', [ProductController::class, 'create'])->name('product.create');
// Route::match(['get', 'post'],'/product/buy{id}', [ProductController::class, 'buy'])->name('product.buy');
Route::match(['get', 'post'],'/product/update{id}', [ProductController::class, 'update'])->name('product.update');
Route::match(['get', 'post'],'/product/delete{id}', [ProductController::class, 'delete'])->name('product.delete');
