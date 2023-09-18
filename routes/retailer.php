<?php

use Illuminate\Support\Facades\Route;


Route::prefix('retailer')->group(function () {
    //retailer password reset routes
    Route::post('/password/email', 'Auth\RetailerForgotPasswordController@sendResetLinkEmail')->name('retailer.password.email');
    Route::get('/password/reset', 'Auth\RetailerForgotPasswordController@showLinkRequestForm')->name('retailer.password.request');
    Route::post('/password/reset', 'Auth\RetailerResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\RetailerResetPasswordController@showResetForm')->name('retailer.password.reset');
});

Route::group(['prefix' => 'retailer', 'middleware' => ['auth:retailer']], function () {
    Route::get('/dashboard', 'Retailer\DashboardController@index')->name('admin.dashboard');

    Route::resource('profile', 'Commons\ProfileController', ['as' => 'retailer_profile']);

    Route::get('/change-password', 'Commons\ProfileController@changePassword');
    Route::put('/update-password', 'Commons\ProfileController@updatePassword');


    Route::resource('brand', 'Admin\BrandController', ['as' => 'retailer']);

    Route::resource('order', 'Admin\OrderController', ['as' => 'retailer']);

    Route::get('pending-orders', [
        'as' => 'retailer.pending',
        'uses' => 'Admin\OrderController@pendingOrders'
    ]);
    Route::get('delivered-orders', [
        'as' => 'retailer.delivered',
        'uses' => 'Admin\OrderController@deliveredOrders'
    ]);

    Route::get('out-for-delivery', [
        'as' => 'retailer.out-for-delivery',
        'uses' => 'Admin\OrderController@outForDelivery'
    ]);

    Route::resource('product-wise-reviews', 'Admin\ProductWiseReviewsController', ['as' => 'retailer']);

    Route::get('product/reviews/{id}', 'Admin\ProductController@productWiseReviews')
        ->name('retailer-product-wise-reviews');

    Route::resource('category', 'Admin\CategoryController', ['as' => 'retailer']);

    Route::resource('category-wise-sub-category', 'Admin\CategoryWiseSCController', ['as' => 'retailer']);

    Route::get('category-wise-sub-category/create/{slug}', [
        'as' => 'retailer.category-wise-sub-category.create',
        'uses' => 'Admin\CategoryWiseSCController@create'
    ]);

    Route::resource('sub-category', 'Admin\SubCategoryController', ['as' => 'retailer']);

    Route::resource('sub-category-wise-brands', 'Admin\SCWiseBrandsController', ['as' => 'retailer']);

    Route::get('sub-category-wise-brands/create/{slug}', [
        'as' => 'retailer.sub-category-wise-brands.create',
        'uses' => 'Admin\SCWiseBrandsController@create'
    ]);

    Route::resource('brand-wise-products', 'Admin\BrandWiseProducts', ['as' => 'retailer']);

    Route::get('brand-wise-products/create/{slug}', [
        'as' => 'retailer.brand-wise-products.create',
        'uses' => 'Admin\BrandWiseProducts@create'
    ]);

    Route::resource('product', 'Admin\ProductController', ['as' => 'retailer']);

    Route::post('retailer-ckeditor-product-image', 'Admin\CkeditorController@uploadProductImage')
        ->name('retailer-ckeditor-product-image.upload');
});