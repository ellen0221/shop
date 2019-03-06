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

// 若把路由: Route::get('products/{product}', 'ProductsController@show')->name('products.show'); 放在收藏商品列表路由的前面则：
// Laravel 在匹配路由的时候会按定义的顺序依次查找，找到第一个匹配的路由就返回。
// 所以当我们访问这个 URL 的时候会先匹配到商品详情页这个路由，然后把 favorites 当成商品 ID 去数据库查找，查不到对应的商品就抛出了不存在的异常。

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

    // 商品收藏
    Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
    // 取消收藏
    Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');
    // 收藏商品列表
    Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');
    // 添加商品到购物车
    Route::post('cart', 'CartController@add')->name('cart.add');

});

Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');
Route::get('products/{product}', 'ProductsController@show')->name('products.show');


Auth::routes(['verify' => true]);
