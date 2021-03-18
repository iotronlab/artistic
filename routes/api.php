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

Route::get('/countries', 'api\Locale\CountryController@index');
Route::get('/shipping', 'api\Shipping\ShippingController@index');
Route::get('/trending', 'api\DataChart\TrendingController@index');
Route::get(
    'address/{address}/shipping',
    'api\Customer\AddressShippingController@getShipping'
);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('vendor')->group(function () {
    Route::post('/upload-image', 'api\Vendor\VendorProfileController@uploadImage');
    Route::post('/profile-update', 'api\Vendor\VendorProfileController@updateProfile');
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


//vendor login
Route::post('vendor/login', 'api\auth\VendorAuthController@login');

Route::group(['middleware' => 'auth:vendor-api'], function () {
    Route::get('vendor/details', 'api\auth\VendorAuthController@details');
    Route::get('vendor/logout', 'api\auth\VendorAuthController@logout');
    //Vendor address
    Route::resource('vendor/address', 'api\Vendor\VendorAddressController');
});


Route::get('tax', 'api\Tax\TaxCategoryController@index');
//Category routes
Route::resource('categories', 'api\Category\CategoryController');

//Attribute routes
Route::apiResource('attributes', 'api\Attribute\AttributeController');
Route::get('/families', 'api\Attribute\AttributeController@families');
Route::get('/families/{id}', 'api\Attribute\AttributeController@group_mapping');

// Route::group(['middleware' => 'auth:api'], function () {

// });
//Product Routes

Route::resource('products', 'api\Product\ProductController');

//Product Stock Routes
//https://laravel.com/docs/8.x/controllers#shallow-nesting

Route::apiResource('products.stocks', 'api\Product\ProductStockController')->shallow();
Route::prefix('stock')->group(function () {

    Route::post('/{product}', 'api\Product\ProductStockController@addStock');
});


//Product add/remove category
Route::post('/products-category/add/{product}', 'api\Product\ProductController@addCategory');
Route::post('/products-category/del/{product}', 'api\Product\ProductController@removeCategory');

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
Route::resource('catalog-rules', 'api\CatalogRule\CatalogRuleController');

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
