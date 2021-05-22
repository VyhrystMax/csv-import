<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Http\Controllers\IndexController::class)
    ->name('index');
Route::get('/result', [\App\Http\Controllers\ImportController::class, 'importResult'])
    ->name('import_result');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'showAll'])
    ->name('products');
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'showSingle'])
    ->name('product.show');

Route::post('/import', [\App\Http\Controllers\ImportController::class, 'import'])
    ->name('import');
