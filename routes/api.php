<?php

use App\Http\Controllers\API\DeliveryPersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\FrontController;
use App\Http\Controllers\API\DirectOrderController;
use App\Http\Controllers\API\AdvertisementController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AppleSocialiteController;
use App\Http\Controllers\AuthController;

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

    // Home
    Route::get('/home', [FrontController::class, 'getHome']);

   //Search
    Route::get('/search-product', [ProductController::class, 'search']);

   //Product Details
    Route::get('/product/{id}', [ProductController::class, 'productDetails']);

    //banner Details
    Route::get('/banner/click/{id}', [FrontController::class, 'bannerDetails']);

    //Advertisment Details
    Route::get('/advertisment/click/{id}', [FrontController::class, 'advertismentDetails']);

 //Advertisment1 Details
    Route::get('/advertisment1/click/{id}', [FrontController::class, 'advertisment1Details']);

 //Advertisment2 Details
    Route::get('/advertisment2/click/{id}', [FrontController::class, 'advertisment2Details']);

   //View All New Arrival Product
    Route::get('/new_arrivals/all', [ProductController::class, 'newAllproduct']);

   //View All New Arrival Product

   Route::get('/feature/all', [ProductController::class, 'allFeaturedProducts']);

   Route::get('/section1/all', [ProductController::class, 'allSection1Products']);

   Route::get('/section2/all', [ProductController::class, 'allSection2Products']);

   Route::get('/foryou/all', [ProductController::class, 'allForyouProducts']);

   Route::get('/brand/all/{id}', [ProductController::class, 'allBrandProducts']);

   Route::get('/category/all/{id}', [ProductController::class, 'allCategoryProducts']);

   Route::get('/subcategory/all/{id}', [ProductController::class, 'allSubCategoryProducts']);

    //Top sub categories
    Route::get('/topsubcategories', [SubCategoryController::class, 'getTopSubCategory']);

    //setting
    Route::get('/setting', [SettingController::class, 'getSetting']);

    //Delivery Charge
    Route::get('/delivery/charge', [SettingController::class, 'getDeliveryCharge']);


    //last order id
    Route::get('/lastOrderId', [SettingController::class, 'getlastOrderId']);

    // categories
    Route::get('/categories', [CategoryController::class, 'getCategory']);

    // brands
    Route::get('/brands', [BrandController::class, 'getBrand']);

    //sub categories
    Route::get('/subcategories', [SubCategoryController::class, 'getSubCategory']);

    //Top sub categories
    Route::get('/topsubcategories', [SubCategoryController::class, 'getTopSubCategory']);

    //sliders
    Route::get('/banners', [BannerController::class, 'getBanners']);

    //new Arrivals
    Route::get('/new_arrivals', [ProductController::class, 'getNewArrivals']);

    Route::get('/featured_products', [ProductController::class, 'getFeaturedProducts']);

    Route::get('/section1_products', [ProductController::class, 'getSection1Products']);

    Route::get('/section2_products', [ProductController::class, 'getSection2Products']);

    Route::get('/for_you_products', [ProductController::class, 'getForyouProducts']);

    //Direct Order
    Route::post('/direct-order', [DirectOrderController::class, 'directOrder']);

    //Query
    Route::post('/query', [DirectOrderController::class, 'Query']);

    //Sell Scrap
    Route::post('/sell-scrap', [DirectOrderController::class, 'sellScrap']);

    //sub categories
    Route::get('/scrap-categories', [CategoryController::class, 'getScrapCategory']);

    //Advertisement
    Route::get('/advertisements', [AdvertisementController::class, 'getAllAdvertisement']);

    Route::get('/advertisement1', [AdvertisementController::class, 'getAdvertisement1']);

    Route::get('/advertisement2', [AdvertisementController::class, 'getAdvertisement2']);

    Route::get('/popup', [AdvertisementController::class, 'getPopup']);

    //customer api route
    Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/forgot-password', [AuthController::class, 'forgot_password']);

        Route::post('/login/google/callback', [SocialiteController::class, 'googlehandleProviderCallback']);
        Route::post('/login/facebook/callback', [SocialiteController::class, 'facebookhandleProviderCallback']);
        Route::post('login/apple/callback', [AppleSocialiteController::class, 'callback']);

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::get('/calendar', [AuthController::class,'calendar']);

        Route::post('/deactive-account', [AuthController::class,'deactiveAccount']);
      
        //change password
        Route::post('change/password', [AuthController::class, 'changePassword']);

        //update Profile
        Route::post('update/profile/{id}', [AuthController::class, 'updateProfile']);

        //update Avatar
        Route::post('update/profileimage/{id}', [AuthController::class, 'updateProfileImage']);

        Route::get('/order-products', [OrderController::class, 'allOrderProductList']);

        Route::get('/notification/all', [OrderController::class, 'Notification']);

        Route::get('/orders-details/{random_id}', [OrderController::class, 'orderDetails']);

        Route::post('order/update/{random_id}', [OrderController::class, 'updateOrder']);

        Route::get('/order-history', [OrderController::class, 'orderHistory']);

        Route::get('/payment-history', [OrderController::class, 'paymentHistory']);

       //Checkout
        Route::post('/checkout', [OrderController::class, 'checkOut']);

        //Esewa Checkout
        Route::post('/esewa/checkout', [OrderController::class, 'esewaCheckOut']);

    });

    //delivery person api route
    Route::group(['middleware' => ['api'],'prefix' => 'auth/delivery'], function ($router) {
      Route::post('/login', [DeliveryPersonController::class, 'login']);
      Route::post('/logout', [DeliveryPersonController::class, 'logout']);

      Route::group(['middleware' => 'is_deliveryperson'], function ($router) {
         Route::get('/profile', [DeliveryPersonController::class, 'profileData']);
         Route::get('/assign-orders', [DeliveryPersonController::class, 'assignOrderLists']);
         Route::get('/orders/{status}', [DeliveryPersonController::class, 'orderStatusWiseData']);
         Route::get('/orders-details/{random_id}', [DeliveryPersonController::class, 'orderDetails']);
         Route::post('/order/update/{random_id}', [DeliveryPersonController::class, 'updateOrder']);
      });
});