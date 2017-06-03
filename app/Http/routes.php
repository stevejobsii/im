<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::auth();

// 控制台
Route::get('/', 'Admin\HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    // 公众号管理
    Route::group(['prefix' => 'wechat'], function () {
        Route::resource('info', 'WechatInfoController', ['except' => ['create', 'edit']]);
        Route::resource('menu', 'WechatMenuController');
        Route::post('pushMenu', 'WechatMenuController@pushMenu');
        Route::resource('follow', 'WechatFollowController', ['except' => ['create', 'edit', 'show', 'destroy','store']]);
        Route::put('refresh', 'WechatFollowController@refresh');
    });
    // 店铺管理
    Route::group(['prefix' => 'shop'], function () {
        Route::resource('config', 'ShopConfigController', ['except' => ['create', 'edit', 'show', 'destroy']]);
        Route::resource('banner', 'ShopBannerController');
    });

    /**
     * 后台商品／活动管理
     */
    // 商品
    Route::group(['prefix' => 'product'], function () {
        Route::resource('topic', 'ProductTopicController');
        Route::resource('plate', 'ProductPlateController');
        Route::resource('category', 'ProductCategoryController');
        Route::resource('commodity', 'ProductCommodityController');
        // Ajax Get Tree (category) & Table Data
        Route::get('getTreeData', 'ProductCategoryController@treeData');
        Route::get('getTableData', 'ProductCommodityController@tableData');
        // 富文本编辑器上传图片
        Route::post('editorUpload', 'ProductCommodityController@editorUpload');
    });
    // 活动
    Route::group(['prefix' => 'event'], function () {
        Route::resource('commodity', 'Event\EventCommodityController');
    });

    // 订单管理
    Route::resource('order', 'OrderController', ['except' => ['create']]);
    //确认已经发货
    Route::post('order-deliver-goods/{orderId}','OrderController@DeliverGoods');

});
// DEBUG
Route::get('/wechat/debug', 'WechatController@debug');

// Wechat http main route
Route::any('/wechat', 'WechatController@serve');

// 菜单->微信商城
Route::group(['prefix' => 'mall', 'middleware' => ['web', 'wechat.oauth'], 'namespace' => 'Mall'], function () {
    // Wechat OAuth2.0 (type=snsapi_userinfo)
    Route::get('/user', 'IndexController@oauth');
    // 首页
    Route::get('/', [
        'as'   => 'frontend.wechat.index',
        'uses' => 'IndexController@index',
    ]);
});

// 菜单->活动订单
Route::group(['prefix' => 'event', 'middleware' => ['web', 'wechat.oauth'], 'namespace' => 'Event'], function () {
    // Wechat OAuth2.0 (type=snsapi_userinfo)
    Route::get('/user', 'IndexController@oauth');
    // 活动首页
    Route::get('/', [
        'as'   => 'frontend.wechat.index',
        'uses' => 'IndexController@index',
    ]);
});

Route::group(['prefix' => 'api', 'middleware' => ['web', 'wechat.oauth'], 'namespace' => 'Api'], function () {
    // 获取用户信息
    Route::get('userinfo', 'UserController@userinfo');
    // 商铺配置
    Route::get('shopconfig', 'ShopController@shopconfig');
    // 获取首页轮播图、专题、板块数据
    Route::get('banners', 'ShopController@getBanners');
    Route::get('topics', 'ShopController@getTopics');
    Route::get('plates', 'ShopController@getPlates');
    // 数据分类数据
    Route::get('categories', 'ShopController@getCategories');
    // 根据不同条件获取商品数据集合
    Route::post('commodities/topic', 'ShopController@getCommodityByTopic');
    Route::post('commodities/plate', 'ShopController@getCommodityByPlate');
    Route::post('commodities/category', 'ShopController@getCommodityByCategory');

    /**
     * 根据不同条件获取活动数据集合,['报名中','已报满','已结束']
     */
    // ['报名中','已报满','已结束']活动
    Route::any('geteventcommodities/status', 'Event\ShopController@getCommodityByStatus');


    /**
     * 根据商品ID查询商品详情数据
     */
    // 商品:
    // 如https://goodgoto.com/api/eventcommodity/1 API获取第一个信息
    Route::get('commodity/{commodity}', 'ShopController@getCommodity');
    // 为了order settle，各种商品的信息
    Route::get('commodities/{commodity}', 'ShopController@getCommodities');
    // 活动:
    Route::get('eventcommodity/{commodity}', 'Event\ShopController@getCommodity');
    Route::get('eventcommodities/{commodity}', 'Event\ShopController@getCommodities');
    
    /**
     * 购物车
     */
    // 商品:
    Route::resource('cart', 'CartController', ['except' => ['create', 'edit', 'show']]);
    // 活动:
    Route::resource('eventcart', 'Event\CartController', ['except' => ['create', 'edit', 'show']]);
    
    /**
     * 获取购物车数据总条数及清空
     */
    // 商品:
    Route::get('cart/count', 'CartController@calculateTotal');
    Route::post('cart/empty', 'CartController@emptyCart');
    // 活动:
    Route::get('eventcart/count', 'Event\CartController@calculateTotal');
    Route::post('eventcart/empty', 'Event\CartController@emptyCart');

    /**
     * 订单：创建订单,获取订单数据,获取订单列表（all,unpay,unreceived),获取商品订单订单详情
     */
    // 商品
    Route::post('order', 'OrderController@store');
    Route::get('order/{order}', 'OrderController@show');
    Route::get('orderlist/{type}', 'OrderController@index');
    Route::get('orderdetail/{order}', 'OrderController@detail');
    // 活动
    Route::any('eventorder', 'Event\OrderController@store');
    Route::get('eventorder/{order}', 'Event\OrderController@show');
    Route::get('eventorderlist/{type}', 'Event\OrderController@index');
    Route::get('eventorderdetail/{order}', 'Event\OrderController@detail');

    // 意见建议
    Route::post('suggestion', 'UserController@suggestion');
    // 地址管理
    Route::get('address', 'UserController@indexAddress');
    Route::post('address', 'UserController@storeAddress');
    Route::get('address/{address}', 'UserController@showAddress');
    Route::put('address/{address}', 'UserController@updateAddress');
    Route::get('default/address', 'UserController@defaultAddress');
    Route::delete('address/{address}', 'UserController@deleteAddress');
    /**
     * 微信支付 设定订单内容SetAttributes
     */
    // 商品
    Route::get('SetAttributes/{id}', [
        'uses' => 'OrderController@SetAttributes',
    ]);
    // 活动
    Route::get('eventSetAttributes/{id}', [
        'uses' => 'Event\OrderController@eventSetAttributes',
    ]);

    /**
     * 微信支付
     */
    Route::get('pay/{id}', [
        'as'   => 'frontend.wechat.pay',
        'uses' => 'OrderController@pay',
    ]);
    // TODO活动订单API

});

/**
 * 微信支付回调--处理支付后,这是微信来发送信息给服务器
 */
Route::post('HandlePay',[
    'as'   => 'frontend.wechat.HandlePay',
    'uses' => 'Api\OrderController@HandlePay',
]);

/**
 * 第三方登录包括qq、weixin等
 */
Route::get('/oauth', 'Auth\AuthController@getOauth');

Route::get('/auth/oauth', 'Auth\AuthController@oauth')->name('auth.oauth');
Route::any('/auth/{provider}/callback', 'Auth\AuthController@callback')->name('auth.callback');
Route::get('/verification/{token}', 'Auth\AuthController@getVerification')->name('verification');

