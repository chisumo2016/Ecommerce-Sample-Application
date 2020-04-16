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

Route::resource('/product', 'ProductController');
Route::get('/cart/{id}', 'ProductController@AddCart')->name('Product.addToCart');
Route::get('/reduce/{id}', 'ProductController@getReduceByOne')->name('product.reducedByOne');
Route::get('/remove/{id}', 'ProductController@getRemoveItem')->name('product.remove');
Route::get('/cart', 'ProductController@ShopCart')->name('product.shoppingCart');
Route::get('/checkout', 'ProductController@checkout')->name('checkout')->middleware('auth');
Route::post('/checkout', 'ProductController@postCheckout')->name('checkout')->name('product.shoppingCart');

Route::get('profile' ,'UserController@getProfile')->name('user.profile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
