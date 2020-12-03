<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json(["token" => (string)App::make('App\Helpers\ShipRocket')->token], 200);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('vendors', 'api\Vendor\VendorController');
//Customer auth and social login
Route::post('login', 'api\auth\AuthController@login');
Route::post('register', 'api\auth\RegisterController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('details', 'api\auth\AuthController@details');
    Route::get('logout', 'api\auth\AuthController@logout');
});
Route::group(['middleware' => 'web'], function () {
    Route::get(
        'login/{service}',
        'api\auth\SocialLoginController@redirectToProvider'
    );
    Route::get(
        'login/{service}/callback',
        'api\auth\SocialLoginController@handleProviderCallback'
    );
});

//Customer account details
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('addresses', 'api\Customer\CustomerController@getAddresses');
    Route::get('wishlist', 'api\Customer\CustomerController@getWishlist');
    Route::get('orders', 'api\Customer\CustomerController@getOrders');
});
//Category routes
Route::resource('categories', 'api\Category\CategoryController');

//Attribute routes
Route::resource('attributes', 'api\Attribute\AttributeController');
Route::get('/families', 'api\Attribute\AttributeController@families');
Route::get('/families/{id}', 'api\Attribute\AttributeController@group_mapping');

// Route::group(['middleware' => 'auth:api'], function () {

// });
Route::resource('products', 'api\Product\ProductController');
//Product routes

Route::post('/products/stock', 'api\Product\ProductController@addStock');
Route::post('/products/category', 'api\Product\ProductController@addCategory');

//Cart
Route::resource('cart', 'api\Cart\CartController', [
    'parameters' => [
        'cart' => 'product'
    ]
]);

//images
Route::post('/products/upload-image/{product}', 'api\Product\ProductController@upload');

//catalog-rule
Route::resource('catalog-rules', 'api\CatalogRule\CatalogRuleController');
