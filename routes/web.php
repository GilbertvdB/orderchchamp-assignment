<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;

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

//cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

//checkout routes
Route::get('/checkout/details', [CheckoutController::class, 'step1'])->name('checkout.step1');
Route::post('/checkout/confirm', [CheckoutController::class, 'step3'])->name('checkout.step3');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/failed', [CheckoutController::class, 'failed'])->name('checkout.failed');

//costumer routes
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');
Route::get('/customer/profile/{id}', [CustomerController::class, 'profile'])->middleware('auth')->name('customer.profile');
Route::post('/customer/profile/{id}', [CustomerController::class, 'update'])->middleware('auth')->name('customer.update');
