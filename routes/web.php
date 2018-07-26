<?php

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

Route::get('/', 'ShopController@index')->name('shop');
Route::get('/cat/show/{cat_id}', 'CatController@show')->name('cat.show');
Route::get('/product/show/{product_id}', 'ProductController@show')->name('product.show');
Route::post('/search', 'SearchController@index')->name('products.search');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/orders/show', 'OrderController@show')->name('orders.show');
    Route::get('/order/create/{product_id}', 'OrderController@create')->name('order.create');
    Route::post('/order/store/{product_id}', 'OrderController@store')->name('order.store');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'AdminOnly']], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::get('/cat/create', 'CatController@create')->name('cat.create');
    Route::post('/cat/store', 'CatController@store')->name('cat.store');
    Route::get('/cat/edit/{cat_id}', 'CatController@edit')->name('cat.edit');
    Route::put('/cat/update/{cat_id}', 'CatController@update')->name('cat.update');
    Route::get('/cat/delete/{cat_id}', 'CatController@delete')->name('cat.delete');
    Route::delete('/cat/destroy/{cat_id}', 'CatController@destroy')->name('cat.destroy');

    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/store', 'ProductController@store')->name('product.store');
    Route::get('/product/edit/{product_id}', 'ProductController@edit')->name('product.edit');
    Route::put('/product/update/{product_id}', 'ProductController@update')->name('product.update');
    Route::get('/product/delete/{product_id}', 'ProductController@delete')->name('product.delete');
    Route::delete('/product/destroy/{product_id}', 'ProductController@destroy')->name('product.destroy');
});
