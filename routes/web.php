<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Product;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Buyer\Userlist as Buyer;
use App\Http\Livewire\Buyer\Detail as BuyerDetail;
use App\Http\Livewire\Product\Create as addProduct;
use App\Http\Livewire\Product\Invoice as invoiceProduct;
use App\Http\Livewire\Product\Order as orderProduct;
use App\Http\Livewire\Product\Edit as editProduct;
use App\Http\Livewire\Product\Userproduct as Userproduct;
use App\Http\Livewire\ProductDetail;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::get('/', Product::class)->name('product');
Route::get('/product/detail/{id}', ProductDetail::class)->name('product.detail');
Route::group(['middleware'=>['auth']], function() {
    Route::get('/add/product', addProduct::class)->name('product.add');
    Route::get('/list/product', Userproduct::class)->name('product.list');
    Route::get('/invoice/product', invoiceProduct::class)->name('product.invoice');
    Route::get('/order/product', orderProduct::class)->name('product.order');
    Route::get('/edit/product/{id}', editProduct::class);
    Route::get('/buyer', Buyer::class)->name('buyer');
    Route::get('/buyer/{id}', BuyerDetail::class)->name('buyer.detail');
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/logout', Logout::class)->name('logout');
});

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
