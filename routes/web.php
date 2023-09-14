<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockTransactionController;
use App\Models\Category;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'grocery','as' => 'grocery.'], function(){
        Route::get('/', [GroceryController::class,'index'])->name('index');
        Route::resource('item', ItemController::class);

        Route::prefix('ajax')->group(function() {
            Route::post('/items', [ItemController::class, 'getItems'])->name('ajax.items');
            Route::post('/stock_trans', [StockTransactionController::class, 'getStockTrans'])->name('ajax.stock.trans');
        });
        Route::resource('category', CategoryController::class);

        Route::resource('stock-transactions', StockTransactionController::class);
    });

    Route::group(['prefix' => 'shop','as' => 'shop.'], function(){
        Route::resource('shop', ShopController::class);
        Route::post('change_password', [ShopController::class, 'change_password'])->name('change_password');
    });

    Route::group(['prefix' => 'pos','as' => 'pos.'], function(){
        Route::get('/', [PosController::class, 'index'])->name('index');
    });
});
