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

//Route::get('/', 'PagesController@root')->name('root');
// 添加邮箱验证中间件：->middleware('verified')

Route::group(['middleware' => ['auth', 'verified']], function() {
    // 收货地址页面
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
    // 新增收货地址
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
    // 表单验证
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
    // 修改地址页面
    Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
    // 修改地址功能
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
    // 删除地址功能
    Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');
});

Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');
Route::get('products/{product}', 'ProductsController@show')->name('products.show');


Auth::routes(['verify' => true]);
