<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('vendors', 'api\Vendor\VendorController');

Route::post('login', 'api\auth\AuthController@login');
Route::post('register', 'api\auth\RegisterController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('details', 'api\auth\AuthController@details');
    Route::get('logout', 'api\auth\AuthController@logout');
});
//Category routes
Route::resource('categories', 'api\Category\CategoryController');

//Attribute routes
Route::resource('attributes', 'api\Attribute\AttributeController');
Route::get('/families', 'api\Attribute\AttributeController@families');
Route::get('/families/{id}', 'api\Attribute\AttributeController@group_mapping');

//Product routes
Route::resource('products', 'api\Product\ProductController');
Route::post('/products/stock', 'api\Product\ProductController@addStock');
Route::post('/products/category', 'api\Product\ProductController@addCategory');
Route::get('/product-configurable-config/{id}', 'api\Product\ProductController@configurableConfig');
