<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'auth.user'], function () {
Route::get('/', [ProductController::class, 'showall']);
Route::get('/product/{id}', [ProductController::class, 'show']) ->middleware('log.request');
Route::get('/products/expensive/{amount}', [ProductController::class, 'expensiveProducts']);
Route::get('/products/all', [ProductController::class, 'showall']);
Route::get('/home',[ProductController::class, 'showall']);
Route::get('/products/edit/{id}',[ProductController::class, 'editForm']);
Route::put('/products/update/{id}', [ProductController::class, 'update']);
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy']);
Route::get('/products/add', [ProductController::class, 'add']);
Route::post('/products/create', [ProductController::class, 'store']);


});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard',[ProductController::class, 'showall'])->name('dashboard');
});


Route::post('/charge', [PaymentController::class, 'charge']);
Route::get('/payment', [PaymentController::class, 'chargeform']);
Route::post('/webhook/stripe', [PaymentController::class, 'handle']);
Route::get('/create-order', function () {
    return view('create_order');
});

Route::post('/create-order', [OrderController::class, 'createOrder'])->name('orders.create');
