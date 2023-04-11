<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BackendUserController;
use App\Http\Controllers\BackendProductController;
use App\Http\Controllers\BackendCategoryController;
use App\Http\Controllers\BackendAnnouncementController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
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

//Route::get('/', function () {
//    return view('index');
//});

//Route::get('/', function () {
//    return view('index');
//})->name('root');

Route::get('/',[ProductsController::class,'index'])->name('root');

Route::resource('articles',ArticlesController::class);
Route::resource('products',ProductsController::class);

Route::post('products/search',[ProductsController::class, 'search'])->name('products.search');

Route::post('orders/addToCart/{productId}',[OrdersController::class,'addToCart'])->name('orders.addToCart');
Route::get('cart', [OrdersController::class, 'cart'])->name('orders.cart');
Route::resource('orders',OrdersController::class);
Route::get('checkout', [OrdersController::class, 'checkout'])->name('orders.checkout');
Route::get('history', [OrdersController::class, 'history'])->name('orders.history');
Route::get('clearCart', [OrdersController::class, 'clearCart'])->name('orders.clearCart');

//綠界用的
Route::post('/callback',[OrdersController::class, 'callback']);
Route::get('/success',[OrdersController::class, 'redirectFromECpay']);

//練習api
Route::get('/GetArticles',[ArticlesController::class, 'GetArticles']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


//拿來做FB登入用的
Route::group(['prefix' => 'user'], function(){
    //使用者驗證
    Route::group(['prefix' => 'auth'], function(){
        //Facebook登入
        Route::get('/facebook-sign-in', [UserAuthController::class,'facebookSignInProcess'])->name('FbLogin');
        //Facebook登入重新導向授權資料處理
        Route::get('/facebook-sign-in-callback', [UserAuthController::class,'facebookSignInCallbackProcess']);
    });
});



//後台
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('backend-users', BackendUserController::class);
    Route::resource('backend-products',BackendProductController::class);
    Route::resource('backend-categories', BackendCategoryController::class);
    Route::resource('backend-announcements', BackendAnnouncementController::class);
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{order}', [TransactionController::class, 'show'])->name('transactions.show');
});


//Route::get('/redis-test', function () {
//    Redis::set('laravel-redis-test', 'Hello, Redis!');
//    $value = Redis::get('laravel-redis-test');
//
//    return "Redis test value: {$value}";
//});
