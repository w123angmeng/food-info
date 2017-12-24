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

//Route::get('/', function () {
//    $users = DB::select('select * from food_info_users where 1',[1]);
//    $user = "hello";
//    $url = url('/');
//    return view('welcome',['users' => $user]);
//});
Route::get('/', [
    'as' => '/', 'uses' => 'IndexController@showIndex'
]);
//用户登录-路由配置
Route::group(['namespace' => 'User'], function()
{
    // Controllers Within The "App\Http\Controllers\User" Namespace
    Route::post('/login', [
        'as' => 'login', 'uses' => 'LoginController@showLogin'
    ]);
});

//后台用户-路由配置
Route::group(['namespace' => 'Web'], function()
{
    /*nav增删改查*/
    Route::get('/nav', [
        'as' => 'nav', 'uses' => 'NavController@showNav'
    ]);
    Route::match(['get','post'],'/nav/edit/{id}', [
        'as' => 'nav', 'uses' => 'NavController@editNav'
    ]);
    Route::get('/nav/del/{id}', [
        'as' => 'nav', 'uses' => 'NavController@delNav'
    ]);

    /*articlecate增删改查*/
    Route::get('/articlecate', [
        'as' => 'articlecate', 'uses' => 'ArticleCateController@showArticleCate'
    ]);
    Route::match(['get','post'],'/articlecate/edit/{id}', [
        'as' => 'articlecate', 'uses' => 'ArticleCateController@editArticleCate'
    ]);
    Route::get('/articlecate/del/{id}', [
        'as' => 'articlecate', 'uses' => 'ArticleCateController@delArticleCate'
    ]);

    /*article增删改查*/
    Route::get('/article', [
        'as' => 'article', 'uses' => 'ArticleController@showArticle'
    ]);
    Route::match(['get','post'],'/article/edit/{id}', [
        'as' => 'article', 'uses' => 'ArticleController@editArticle'
    ]);
    Route::get('/article/del/{id}', [
        'as' => 'article', 'uses' => 'ArticleController@delArticle'
    ]);

    //用户端
    //goods增删改查
    Route::get('/mobile/goods', [
        'as' => 'article', 'uses' => 'ArticleController@showArticle'
    ]);
});

//前端用户-路由配置
Route::group(['namespace' => 'Mobile'], function()
{
    //用户端
    //商品增删改查
    Route::get('/goods', [
        'as' => 'goods', 'uses' => 'GoodsController@showGoods'
    ]);
    
    //购物车增删改查
    Route::get('/cart', [
        'as' => 'cart', 'uses' => 'CartController@showCart'
    ]);
    Route::match(['get','post'],'/cart/add', [
        'as' => 'cart', 'uses' => 'CartController@addGoodsToCart'
    ]);
    Route::get('/cart/del/{id}', [
        'as' => 'cart', 'uses' => 'CartController@delGoodsFromCart'
    ]);
});