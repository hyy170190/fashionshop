<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('Auth/Login');
});

Auth::routes();
Route::post('/admin/product', function () {
    return view('contents.product.list');
})->name('admin.list');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'filter'])->name('product');
Route::post('/product/order', [ProductController::class, 'order'])->name('product.order');

Route::post('/admin/invoicelist', [InvoiceController::class, 'listInvoice'])->name('admin.invoicelist');

require __DIR__.'/auth.php';
require __DIR__.'/product.php';
require __DIR__.'/invoice.php';
require __DIR__.'/inventory.php';
require __DIR__.'/account.php';
