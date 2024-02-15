<?php

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



Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");

Route::get('/', function () {
    return redirect()->route('admin.home.index');
});


use App\Http\Controllers\GraficaController;

Route::get('/grafica1', [GraficaController::class, 'grafica1'])->name('grafica1');
Route::get('/grafica2', [GraficaController::class, 'grafica2'])->name('grafica2');
Route::get('/grafica3', [GraficaController::class, 'grafica3'])->name('grafica3');
Route::get('/grafica4', [GraficaController::class, 'grafica4'])->name('grafica4');
