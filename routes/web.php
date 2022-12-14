<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\FrontProductListController;

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

Route::get('/',[WelcomeController::class,'index'])->name('welcome');
Route::get('/category/{slug}',[FrontProductListController::class,'productList'])->name('product.list');
Route::get('/product/{slug}',[FrontProductListController::class,'show'])->name('frontProduct.show');
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart',[CartController::class,'store'])->name('cart.store');
Route::patch('/cart/{product}',[CartController::class,'update'])->name('cart.update');
Route::delete('cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');
Route::post('cart/switchToSaveForLater/{product}',[CartController::class,'switchToSaveForLater'])->name('cart.switchToSaveForLater');
Route::delete('cart/moveToCartDelete/{product}',[CartController::class,'delete'])->name('cart.moveToCartDelete');
Route::post('cart/moveToCart/{product}',[CartController::class,'moveToCart'])->name('cart.moveToCart');
Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');



Route::prefix('admin')->middleware(['auth', 'user-access:admin'])->group(function(){

    Route::get('/home',[AdminController::class,'home'])->name('admin.home');
    Route::resource('category',CategoryController::class)->except('show');
    Route::resource('subcategory',SubcategoryController::class)->except('show');
    Route::resource('product',ProductController::class)->except('show');
    Route::get('/loadSubCategories/{id}',[AdminController::class,'loadSubCategories']);

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')->middleware(['auth', 'user-access:user']);
