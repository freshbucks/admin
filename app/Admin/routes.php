<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/home/system', 'HomeController@system')->name('admin.home');

    // 营销中心
    $router->get('/marketing', 'MarketingController@index');
    $router->get('/marketing/sms', 'MarketingController@sms');

    // 阿里订单
    $router->resource('top-orders', 'TopOrderController');

    // 应用管理
    $router->resource('vendors', 'VendorController');
    $router->resource('vendors/{vendor_id}/configs', 'VendorConfigController');
    $router->resource('vendors/{vendor_id}/templates', 'MessageTemplateController');
    $router->resource('message-templates', 'MessageTemplateController');

});
