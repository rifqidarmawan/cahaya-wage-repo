<?php


use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LamanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Gloudemans\Shoppingcart\Facades\Cart;
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

Route::get('/about', [LamanController::class, 'about']);
Route::get('/', [LamanController::class, 'home'])->name('home');
Route::get('/products', [LamanController::class, 'index']);
Route::get('/dashboard_pelanggan', [LamanController::class, 'dashboard_pelanggan'])->name('dashboard_pengguna');


// CART ROUTE
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

Route::get('/cart/add/{product_id}', [OrderController::class,'add'])->name('cart.add');
Route::post('/cart/remove', [OrderController::class,'remove'])->name('cart.remove');
Route::post('/cart/checkout', [OrderController::class,'checkout'])->name('checkout');


Route::patch('update-cart', [ProductController::class, 'updatecart'])->name('update_cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove_from_cart');


Route::post('cart', [ProductController::class,'store'])->name('cart.store');



// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout']);


// REGISTER
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


// ADMIN DASHBOARD
// SEMUA HALAMAN YANG CUMA BOLEH DIAKSES OLEH ADMIN HANYA ADA DI DALAM ROUTE INI
Route::middleware(['admin'])->group(function () {

    Route::get('/dashboard', [LamanController::class, 'dashboard'])->name('dashboard');

    Route::get('/dashboard/users', [UserController::class, 'users'])->name('users');

    // ORDERS
    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('index');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}/status/{status}', [OrderController::class, 'updateStatus'])->name('update.order.status');

    // USERS
    Route::get('/users/{user}/orders', [UserController::class, 'orders'])->name('users.orders');
    Route::get('/users', [UserController::class, 'users'])->name('users.index');

    // Products
    Route::get('/dashboard/products/checkSlug', [ProductController::class, 'checkSlug']);
    Route::resource('/dashboard/products', ProductController::class)->middleware('auth');


  });

