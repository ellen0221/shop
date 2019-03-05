<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('users', 'UsersController@index');
    $router->get('products', 'ProductsController@index');
    $router->get('products/create', 'ProductsController@create');
    // 表单验证
    /*
     * 在 ProductsController 中并没有 store 方法
     * 这是因为 Laravel-Admin 在创建控制器的时候默认引入了 HasResourceActions 这个 Trait
     * 打开 Encore\Admin\Controllers\HasResourceActions 这个类可以看到里面定义了 store 方法:
     *
     *  public function store()
        {
            return $this->form()->store();
        }
     *
     */
    $router->post('products', 'ProductsController@store');
    $router->get('products/{id}/edit', 'ProductsController@edit');
    /*
     * 控制器中的 update() 方法也是来自 HasResourceActions 这个 Trait
     */
    $router->put('products/{id}', 'ProductsController@update');


});
