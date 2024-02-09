<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::get('/', "App\Http\Controllers\HomeController@index")->name("home.index");
Route::get("/about", "App\Http\Controllers\HomeController@about")->name("home.about");

Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
Route::get('/admin/product', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");

Route::get('/admin/product/create', 'App\Http\Controllers\Admin\AdminProductController@create')->name("admin.product.create");
Route::post('/admin/product', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
Route::delete('/admin/product/{id}', 'App\Http\Controllers\Admin\AdminProductController@destroy')->name('admin.product.destroy');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


