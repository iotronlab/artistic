<?php

use App\Http\Controllers\api\Customer\CustomerController;
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
    return response()->json(["shipping_token" => (string)App::make('App\Helpers\ShipRocket')->token], 200);
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

//Customer address
Route::resource('address', 'api\Customer\AddressController');
//Vendor address
Route::resource('vendor-address', 'api\Vendor\VendorAddressController');

//vendor login
Route::post('vendor/login', 'api\auth\VendorAuthController@login');

Route::group(['middleware' => 'auth:vendor-api'], function () {
    Route::get('vendor/details', 'api\auth\VendorAuthController@details');
    Route::get('vendor/logout', 'api\auth\VendorAuthController@logout');
});
//Category routes
Route::resource('categories', 'api\Category\CategoryController');

//Attribute routes
Route::apiResource('attributes', 'api\Attribute\AttributeController');
Route::get('/families', 'api\Attribute\AttributeController@families');
Route::get('/families/{id}', 'api\Attribute\AttributeController@group_mapping');

// Route::group(['middleware' => 'auth:api'], function () {

// });
Route::resource('products', 'api\Product\ProductController');

//Product routes
Route::post('/products-stock/{product}', 'api\Product\ProductController@addStock');
Route::post('/products-category/{product}', 'api\Product\ProductController@addCategory');

//Cart
Route::resource('cart', 'api\Cart\CartController', [
    'parameters' => [
        'cart' => 'product'
    ]
]);

//images
Route::post('/products/upload-image/{product}', 'api\Product\ProductController@upload');
Route::post('/products/delete-image/{id}', 'api\Product\ProductController@delete_image');

//featured artist & products
Route::get('featured_artists', 'api\Vendor\VendorController@featured');
Route::get('featured_products', 'api\Product\ProductController@featured');

//catalog-rule
Route::resource('catalog-rules', 'api\CatalogRule\CatalogRuleController')->name('store', 'catalog-rules.store');

//cart-rule
Route::resource('cart-rules', 'api\Cart\CartRuleController');

//subscriptions
Route::post('/subscribe/{vendor}', [CustomerController::class, 'subscribeVendor']);
Route::post('/unsubscribe/{vendor}', [CustomerController::class, 'unsubscribeVendor']);

//product-comments
Route::apiResource('comments', 'api\Product\CommentController', [
    'parameters' => [
        'comments' => 'product'
    ]
]);

//Whishlists
Route::apiResource('wishlists', 'api\Customer\WishlistController', [
    'parameters' => [
        'wishlists' => 'product'
    ]
]);

Route::apiResource('orders', 'api\Order\OrderController');
