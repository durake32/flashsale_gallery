
<?php

use App\Http\Controllers\Auth\Google\LoginController;
use App\Http\Controllers\Customer\AccountController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('auth/google', [LoginController::class,'redirectToGoogle'])->name('google-login-proceed');
Route::get('auth/google/callback', [LoginController::class,'handleGoogleCallback']);
Route::get('auth/facebook', [LoginController::class,'redirectToFacebook'])->name('facebook-login-proceed');
Route::get('auth/facebook/callback', [LoginController::class,'handleFacebookCallback']);


Route::group(['prefix' => 'customer', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/calendar', [DashboardController::class,'calendarEventData'])->name('customer.calendar');

    Route::get('/home', [AccountController::class,'index'])->name('customer.home');
    Route::get('/profile', [ProfileController::class,'index']);
    Route::get('/profile/edit', [ProfileController::class,'edit']);
    Route::put('/profile/update', [ProfileController::class,'update']);
    Route::get('/order', [OrderController::class,'trackOrder']);
    Route::get('/offline-order', [OrderController::class,'offlineOrderIndex']);

    Route::get('/reviews', [ReviewController::class,'index']);

    Route::get('/change-password', [ProfileController::class,'changePassword']);
    Route::put('/update-password', [ProfileController::class,'updatePassword']);

    Route::get('/order/excel/download',[OrderController::class,'exportOrder'])->name('export.order');

    
    Route::get('/track/order', [OrderController::class,'index'],['as' => 'customer.order'])->name('customer.order');
    Route::get('/payment', [OrderController::class,'paymentHistory'])->name('customer.payment.history');

    
    Route::get('/check/order/{orderId}', [OrderController::class,'orderCheck'])->name('customer.order.check');

    Route::get('/cancel/edit/order/{orderId}', [OrderController::class,'orderCancel'])->name('customer.order.cancel');

    Route::post('/cancel/update/order/{orderId}',[OrderController::class,'ordersCancel'])->name('ordersCancel');

    Route::get('/invoice_download/{orderId}', [OrderController::class,'InvoiceDownload'])->name('invoice.download');

});