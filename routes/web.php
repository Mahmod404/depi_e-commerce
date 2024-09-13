<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Login Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});

// Register Routes
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register');
});

// User Routes
Route::controller(Controller::class)->group(function () {
    Route::get('user/profile', 'showProfile')->name('profile');
    Route::get('user/profile/update_info', 'showEditForm')->name('user.edit');
    Route::put('/user/profile/update_info/store/', 'updateProfile')->name('user.update');
    Route::get('admin/dashboard', 'index')->name('dashboard')->middleware('isAdmin');
});

// Product Routes
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'getProducts')->name('products.index');
    Route::get('/product/details/{id}', 'show')->name('product.show');
    Route::get('/product/create/form', 'create')->name('product.create')->middleware(['auth', 'isAdmin']);
    Route::post('/product/create/store', 'store')->name('product.store')->middleware(['auth', 'isAdmin']);
    Route::get('/product/update/form/{id}', 'edit')->name('product.edit')->middleware(['auth', 'isAdmin']);
    Route::put('/product/update/store/{id}', 'update')->name('product.update')->middleware(['auth', 'isAdmin']);
    Route::delete('/product/destroy/{id}', 'destroy')->name('product.destroy')->middleware(['auth', 'isAdmin']);
});

// Address Routes
Route::controller(AddressController::class)->middleware('auth')->group(function () {
    Route::get('user/addresses/create', 'create')->name('address.create');
    Route::post('user/addresses/store', 'store')->name('address.store');
    Route::get('user/addresses/edit/{id}', 'edit')->name('address.edit');
    Route::put('user/addresses/edit/update/{id}', 'update')->name('address.update');
    Route::get('user/addresses/destroy/{id}', 'destroy')->name('address.destroy');
});

// Order Routes
Route::controller(OrderController::class)->middleware('auth')->group(function () {
    Route::get('user/orders', 'index')->name('orders.index');
    Route::get('user/orders/{id}', 'show')->name('order.show');
});

// Checkout Routes
Route::controller(CheckoutController::class)->middleware('auth')->group(function () {
    Route::get('orders/checkout', 'index')->name('checkout.index');
    Route::post('/checkout/process', 'process')->name('checkout.process');
});

// Cart Routes
Route::controller(CartController::class)->middleware('auth')->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add', 'add')->name('cart.add');
    Route::put('/cart/{id}', 'update')->name('cart.update');
    Route::delete('/cart/{id}', 'destroy')->name('cart.remove');
});

// Blog Routes
Route::controller(BlogController::class)->group(function () {
    Route::get('/blogs', 'getAllBlogs')->name('blogs.index');
    Route::get('/blogs/my_Blogs', 'myBlogs')->name('blogs.myBlogs')->middleware('auth');
    Route::get('/blogs/{id}', 'show')->name('blogs.show');
    Route::get('/blogs/create/new', 'create')->name('blog.create')->middleware('auth');
    Route::post('/blogs', 'store')->name('blogs.store')->middleware('auth');
    Route::get('/blogs/edit/{id}', 'edit')->name('blog.edit')->middleware('auth');
    Route::put('/blogs/{id}', 'update')->name('blog.update')->middleware('auth');
    Route::delete('/blogs/destroy/{id}', 'destroy')->name('blog.destroy')->middleware('auth');
});

// wishhlist Routes
Route::controller(WishlistController::class)->middleware('auth')->group(function () {
    Route::get('/wishlist', 'index')->name('wishlist');
    Route::post('/wishlist/add', 'store')->name('wishlist.store');
    Route::delete('/wishlist/{id}', 'destroy')->name('wishlist.remove');
});

// Route::get('/wishlist', [App\Http\Controllers\HomeController::class, 'wishlist'])->name('wishlist');