<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('/', function () {
    return view('home');
});
route::get('add/product', [ProductController::class, 'add'])->name('product.add');
route::post('product/inser', [ProductController::class, 'inser'])->name('product.inser');
route::get('product/index', [ProductController::class, 'index'])->name('product.index');
route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::name('app.')->group(function() {
    Route::match(['GET', 'POST'], '/', [HomeController::class, 'index'])->name('home');
    Route::match(['GET', 'POST'], '/tim-kiem',[SearchController::class ,'index'])->name('search.index');
    Route::name('sale.')->group(function(){
        Route::get('/gio-hang/{installment?}', 'SaleController@index')->name('index');
        Route::post('/thanh-toan', 'SaleController@payment')->name('payment');
        Route::get('/thanh-toan-tra-gop/{code}', 'SaleController@installment')->name('installment');
        Route::post('/thanh-toan-tra-gop/{code}', 'SaleController@installmentPost')->name('installmentPost');
        Route::get('/dat-hang-thanh-cong/{code}', 'SaleController@success')->name('success');
        Route::get('/thanh-toan-lai/{code}', 'SaleController@paymentBack')->name('paymentBack');
    });
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::match(['GET', 'POST'], 'login', [AuthController::class, 'login'])->name('login');
    Route::match(['GET', 'POST'], '/', [AdminController::class, 'index'])->name('home');
});
