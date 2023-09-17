<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RetailController;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'grocery','as' => 'grocery.','middleware' => ['auth']], function(){
    Route::get('/', [GroceryController::class,'index'])->name('index');
    Route::resource('item', ItemController::class);
    Route::resource('category', CategoryController::class);
    

    Route::prefix('ajax')->group(function() {
        Route::post('/items', [ItemController::class, 'getItems'])->name('ajax.items');
        Route::post('/stock_trans', [RetailController::class, 'getStockTrans'])->name('ajax.stock.trans');
        Route::post('/inventory', [InventoryController::class, 'getInventories'])->name('ajax.inventories');

    });


    Route::group(['prefix' => 'retail', 'as' => 'retail.'], function(){
        Route::get('/', [RetailController::class,'index'])->name('index');
        Route::get('/create', [RetailController::class,'create'])->name('create');
        Route::post('/store', [RetailController::class,'retailing'])->name('store');
    });

    Route::group(['prefix' => 'inventory', 'as' => 'inventory.'], function(){
        Route::get('/', [InventoryController::class,'index'])->name('index');
        Route::get('/create', [InventoryController::class,'create'])->name('create');
        Route::post('/qty-update', [InventoryController::class,'qtyAdjust'])->name('qty_update');
        // Route::post('/store', [RetailController::class,'retailing'])->name('store');
    });

    


});

Route::group(['prefix' => 'shop','as' => 'shop.'], function(){
    Route::resource('shop', ShopController::class);
    Route::post('change_password', [ShopController::class, 'change_password'])->name('change_password');
});


Route::group(['middleware' => 'auth','prefix' => 'pos','as' => 'pos.'], function(){
    Route::get('/', [PosController::class, 'index'])->name('index');
    Route::post('/checkout', [PosController::class, 'checkout'])->name('checkout');
    Route::post('/search',[InventoryController::class,'barcodeSearch'])->name('barcode.search');
});


Route::group(['middleware' => 'auth','prefix' => 'report','as' => 'report.'], function(){
    Route::get('/income', [ReportController::class, 'incomeReports'])->name('sales');
    Route::get('/order/detail/{id}', [ReportController::class, 'orderDetail'])->name('order.detail');

    Route::get('/retails', [ReportController::class, 'restockTrans'])->name('retails');

    Route::prefix('ajax')->group(function() {
        Route::post('/order', [ReportController::class, 'getAjaxIncomes'])->name('ajax.order');
        Route::post('/retails', [ReportController::class, 'getAjaxRestockTrans'])->name('ajax.retails');
        Route::post('/order/detail/{id}', [ReportController::class, 'getAjaxIncomes'])->name('ajax.order.detail');
       

    });
   
});
