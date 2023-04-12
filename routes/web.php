<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\StripePaymentController;

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

Route::get('/', [HomeController::class, 'userHome'])->middleware('user_auth')->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth')->name('admin#dashboard');
Route::get('/warning', [HomeController::class, 'warning'])->name('warning');
Route::get('/404_not_found', [HomeController::class, 'page404'])->name('404page');

Route::middleware(['admin_auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        #admin info view and update
        Route::get('/info', [AdminController::class, 'viewInfo'])->name('admin#info');
        Route::post('/update/{id}', [AdminController::class, 'updateInfo'])->name('admin#update');
        Route::get('/list', [AdminController::class, 'list'])->name('admin#list');
        Route::delete('/account/delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
        Route::get('user/accounts', [AdminController::class, 'userAccount'])->name('admin#userAccList');
        Route::get('/role/change', [AdminController::class, 'roleChange'])->name('admin#roleChange');
        Route::get('/user/role/change', [UserController::class, 'userRoleChange'])->name('admin#userRoleChg');
        Route::get('/password/change', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('/password/change', [AdminController::class, 'changePassword'])->name('admin#changePassword');

        #category
        Route::get('/category/lists', [CategoryController::class, 'list'])->name('category#list');
        Route::get('/category/create-page', [CategoryController::class, 'createPage'])->name('category#createPage');
        Route::post('category/create', [CategoryController::class, 'create'])->name('category#create');
        Route::get('/category/edit-page/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
        Route::post('category/edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
        Route::delete('category/delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');

        #product
        Route::get('/product/lists', [ProductController::class, 'list'])->name('product#list');
        Route::get('/product/create', [ProductController::class, 'createPage'])->name('product#createPage');
        Route::post('/product/create', [ProductController::class, 'create'])->name('product#create');
        Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
        Route::get('/product/edit/{id}', [ProductController::class, 'editPage'])->name('product#editPage');
        Route::post('product/edit', [ProductController::class, 'edit'])->name('product#edit');
        Route::get('/product/reviews', [ProductController::class, 'userReviewLists'])->name('product#userReviews');

        //order
        Route::get('/order/lists', [OrderController::class, 'list'])->name('order#list');
        Route::get('/order/status/change', [OrderController::class, 'changeStatus']);
        Route::get('/order/billing/details/{id}', [OrderController::class, 'billingDetails'])->name('order#details');
        Route::get('/ajax/order/deliever', [OrderController::class, 'delieverStatus'])->name('order#deliever');

        //user
        Route::get('/user/review/delete', [ProductController::class, 'deleteReview']);
        Route::get('/user/contact', [ContactController::class, 'userContactPage'])->name('admin#userContact');
        Route::delete('user/contact/delete/{id}', [ContactController::class, 'delete'])->name('contact#delete');
        Route::get('user/contact/email_back/{id}', [ContactController::class, 'emailBackPage'])->name('contact#emailPage');
        Route::post('/user/contact/email-back/{id}', [ContactController::class, 'emailback'])->name('contact_email_send');

        //send email to client
        Route::get('/email/send/{id}', [AdminController::class, 'sendEmail'])->name('admin#email');
        Route::post('/send/user_email/{id}', [AdminController::class, 'sendUserEmail'])->name('userEmail#send');
    });

});

Route::middleware(['user_auth','unlogin_auth'])->group(function () {

    Route::prefix('user')->group(function () {

        //account information
        Route::get('/info/view/{id}', [UserController::class, 'infoPage'])->name('user#info');
        Route::post('/info/update', [UserController::class, 'update'])->name('user#update');
        Route::get('/wishlist/{id}', [WishlistController::class, 'wishlist'])->name('user#wishlist');
        Route::get('/order/list', [OrderController::class, 'orderListPage'])->name('user#orderList');
        Route::post('/account/password/change', [UserController::class, 'passwordChange'])->name('user#changePassword');

        //product shop
        Route::prefix('products')->group(function () {
            Route::get('/shop', [UserController::class, 'shopPage'])->name('user#shop');
            Route::get('/filter-by-category/{id}', [ProductController::class, 'filterByCategory'])->name('product#filterByCategory');
            Route::get('/filter-by-price/{p1}/{p2}', [ProductController::class, 'filterByPrice'])->name('product#filterByPrice');
            Route::get('/filter-by-size/{para}', [ProductController::class, 'filterBySize'])->name('product#filterBySize');
            Route::get('/sort/{para}', [ProductController::class, 'sortingByPrice'])->name('product#sort');
            Route::get('/details/{id}', [ProductController::class, 'details'])->name('product#details');
            Route::get('/review', [ProductController::class, 'review'])->name('product#review');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('/products/list', [AjaxController::class, 'productList'])->name('ajax#productList');
            Route::get('/product/cart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('/cart/product/delete', [AjaxController::class, 'removeFromCart'])->name('ajax#removeFromCart');
            Route::get('/wishlist/product/cart', [AjaxController::class, 'addToCartnRemove']);
            Route::get('/wishlist/delete', [AjaxController::class, 'deleteWishlist']);
            Route::get('/order/checkout/', [AjaxController::class, 'checkoutPage']);
            Route::post('/products/order', [OrderController::class, 'order']);
            Route::get('/order/cancel', [OrderController::class, 'orderCancel']);
            Route::get('/shop',[AjaxController::class, 'shopPage']);
            // Route::get('/payment',)
        });

        //wish list
        Route::prefix('wishlist')->group(function () {
            Route::get('all/add', [WishlistController::class, 'addAllToCart'])->name('wishlist#allCart');
        });

        //cartlist
        Route::get('cart/list', [CartController::class, 'cartList'])->name('cart#list');
        Route::get('cart/clear', [CartController::class, 'cartClear'])->name('cart#clear');

        Route::prefix('order')->group(function () {
            Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('order#checkout');
            Route::get('/details/{code}', [OrderController::class, 'orderDetailsPage'])->name('user#orderDetails');
            Route::get('/payment/{price}', [StripePaymentController::class, 'paymentPage'])->name('user#payment');
            Route::post('/payment/{price}', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
        });

        //contact
        Route::get('/contact/page', [ContactController::class, 'contactPage'])->name('user#contactPage');
        Route::post('/contact', [ContactController::class, 'contact'])->name('user#contact');

    });

});

Route::prefix('user')->group(function () {
    Route::prefix('ajax')->group(function () {
        Route::get('/product/wishlist/add', [WishlistController::class, 'addToWishlistAjax']);
        Route::get('/shop/product/cart', [AjaxController::class, 'addToCart']);
    });
});



