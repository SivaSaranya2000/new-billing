<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SellController;
// Route::get('/', function () {
//     return view('welcome');
// });

// Additional web routes can be added here
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('post-login', [RegisterController::class, 'postLogin'])->name('login.post');
Route::get('/register', [RegisterController::class, 'adduser'])->name('register');
Route::post('/post-registration', [RegisterController::class, 'userCreate'])->name('user.add');
Route::get('dashboard', [RegisterController::class, 'dashboard'])->name('dashboard');
// User AJAX Data
Route::get('/data-all-user', [LoginController::class, 'data_all_user'])->name('data_all_user');
Route::get('user/{id}', [LoginController::class, 'destroy'])->name('user.delete');
// Customer Resource Route
Route::resource('customers', CustomerController::class);
// customer AJAX Data
Route::get('/data-all-customer', [CustomerController::class, 'data_all_customer'])->name('data_all_customer');
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
Route::get('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
// Supplier Resource Route
Route::resource('suppliers', SupplierController::class);
// Supplier AJAX Data
Route::get('/data-all-supplier', [SupplierController::class, 'data_all_supplier'])->name('data_all_supplier');
Route::get('/suppliers/{id}', [SupplierController::class, 'edit'])->name('suppliers.edit');
Route::post('/suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::get('/suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
// Unit Resource Route
Route::resource('units', UnitController::class);
// Unit AJAX Data
Route::get('/data-all-units', [UnitController::class, 'data_all_units'])->name('data_all_units');
Route::get('/units/{id}/edit', [UnitController::class, 'edit'])->name('units.edit');
Route::post('/units/{id}', [UnitController::class, 'update'])->name('units.update');
Route::get('/units/{id}', [UnitController::class, 'destroy'])->name('units.destroy');
// Variation Resource Route
Route::resource('variations', VariationController::class);
// Variation AJAX Data
Route::get('/data-all-variations', [VariationController::class, 'data_all_variations'])->name('data_all_variations');
Route::get('/variations/{id}/edit', [VariationController::class, 'edit'])->name('variations.edit');
Route::post('/variations/{id}', [VariationController::class, 'update'])->name('variations.update');
Route::get('/variations/{id}', [VariationController::class, 'destroy'])->name('variations.destroy');
// Product Resource Route
Route::resource('products', ProductController::class);
Route::get('/variation-values/{id}', [VariationController::class, 'getValues']);
Route::get('product-search', [ProductController::class, 'search'])->name('product.search');
// purchase Resource Route
Route::resource('purchases', PurchaseController::class);
// Brand Resource Route
Route::resource('brands', BrandController::class);
// Brand AJAX Data
Route::get('/data-all-brands', [BrandController::class, 'data_all_brands'])->name('data_all_brands');
Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::post('/brands/{id}', [BrandController::class, 'update'])->name('brands.update');
Route::get('/brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
// Business Settings Route
Route::resource('business-settings', BusinessController::class);
// Business AJAX Data
Route::get('/data-all-business', [BusinessController::class, 'data_all_business'])->name('data_all_business');
Route::get('/business-settings/{id}', [BusinessController::class, 'edit'])->name('business-settings.edit');
Route::post('/business-settings/{id}', [BusinessController::class, 'update'])->name('business-settings.update');
Route::get('/business-settings/{id}', [BusinessController::class, 'destroy'])->name('business-settings.destroy');
// Category Resource Route
Route::resource('categories', CategoryController::class);

//sellcontroller
Route::resource('sell', SellController::class);






