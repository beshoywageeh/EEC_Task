<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PharmacyController;/*
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
    return view('welcome');
});
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('/datatable', [ProductController::class, 'datatable'])->name('products.datatable');
Route::get('{id}/product_edit', [ProductController::class, 'edit'])->name('product.edit');
Route::get('{id}/product_delete', [ProductController::class, 'destroy'])->name('product.delete');
Route::post('{id}/product_update', [ProductController::class, 'update'])->name('product.update');
Route::get('create_product',[ProductController::class, 'create'])->name('product.create');
Route::post('store_product',[ProductController::class, 'store'])->name('product.store');
Route::get('{id}/product_details',[ProductController::class, 'show'])->name('product.details');
Route::get('/pharm_search',[ProductController::class, 'pharmacy'])->name('pharm_search');

Route::get('pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
Route::get('/datatable_pharmacies', [PharmacyController::class, 'datatable'])->name('pharmacies.datatable');
Route::get('create_pharmacy',[PharmacyController::class,'create'])->name('pharmacy.create');
Route::post('store_pharmacy',[PharmacyController::class,'store'])->name('pharmacy.store');
Route::get('{id}/pharmacy_edit', [PharmacyController::class, 'edit'])->name('pharmacy.edit');
Route::get('{id}/pharmacy_delete', [PharmacyController::class, 'destroy'])->name('pharmacy.delete');
Route::post('{id}/pharmacy_update', [PharmacyController::class, 'update'])->name('pharmacy.update');
Route::get('{id}/pharmacy_detailes', [PharmacyController::class, 'show'])->name('pharmacy.detail');