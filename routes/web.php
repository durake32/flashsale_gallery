<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CellPayController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\EsewaController as FrontendEsewaController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\ScrapSellController;
use App\Http\Controllers\Frontend\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\Frontend\DirectOrderController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProductFilterController;
use App\Http\Controllers\Frontend\ReviewController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/check', [HomeController::class,'check'])->name('check');

Route::post('/esewa/process', [EsewaController::class, 'esewaPay'])->name('checkout.esewa.process');
Route::get('/success', [EsewaController::class, 'esewaPaySuccess']);
Route::get('/failure', [EsewaController::class, 'esewaPayFailed']);

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/cart', [CartController::class,'cart'])->name('cart.index');
Route::post('/add', [CartController::class,'add'])->name('cart.store');
Route::post('/add-to-cart', [CartController::class,'addFromProductPage'])->name('product-page-cart.store');
Route::post('/update', [CartController::class,'update'])->name('cart.update');
Route::post('/remove', [CartController::class,'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class,'clear'])->name('cart.clear');


Route::post('/subCategory', [HomeController::class,'fetchSubCategory'])->name('subCategory');


Route::get('/direct-order', [DirectOrderController::class,'index'])->name('direct-order.index')->middleware('auth');
Route::post('direct-order', [DirectOrderController::class,'store'])->name('direct-order.store');

Route::get('/checkout', [CheckoutController::class,'cartCheckout'])->name('checkout-from-cart');

// After clicking proceed to pay button
Route::post('payment', [OrderController::class,'paymentMethods'])->name('checkout-payment');

// Start for Esewa

Route::post('/checkout/payment/esewa/process', [FrontendEsewaController::class,'process'])
->name('checkout.payment.esewa.process');

Route::get('/checkout/payment/esewa/completed/{randomOrderID}', [FrontendEsewaController::class,'orderCompleted'])
->name('checkout.payment.esewa.completed');

Route::get('/checkout/payment/esewa/failed/{randomOrderID}', [FrontendEsewaController::class,'orderFailed'])
->name('checkout.payment.esewa.failed');

// Route::get('/checkout/payment/esewa/completed/{randomOrderID}', [
//     'name' => 'Esewa Payment Completed',
//     'as' => 'checkout.payment.esewa.completed',
//     'uses' => [FrontendEsewaController::class,'orderCompleted'],

//     // 'uses' => 'Frontend\EsewaController@orderCompleted',
// ]);

// Route::get('/checkout/payment/failed/{randomOrderID}', [
//     'name' => 'Esewa Payment Failed',
//     'as' => 'checkout.payment.esewa.failed',
//     'uses' => [FrontendEsewaController::class,'orderFailed'],
//     // 'uses' => 'Frontend\EsewaController@orderFailed',
// ]);

// Route::post('/checkout/payment/esewa/process', [
//     'name' => 'Esewa Checkout Payment',
//     'as' => 'checkout.payment.esewa.process',
//     'uses' => [FrontendEsewaController::class,'process'],
//     // 'uses' => 'Frontend\EsewaController@process',
// ]);


// End for esewa

// Start for cash on delivery

// Route::post('/checkout/payment/cod/process', [
//     'name' => 'Cash on Delivery Payment Process',
//     'as' => 'checkout.payment.cod.process',
//     'uses' => [OrderController::class,'cashOnDelivery1'],
// ]);
// Route::post('/checkout/cod', [
//     'name' => 'Cash on Delivery Payment Process',
//     'as' => 'checkout.cod.process',
//     'uses' => [OrderController::class,'cod'],
// ]);

Route::post('/checkout/payment/cod/process', [OrderController::class,'cashOnDelivery1'])
->name('checkout.payment.cod.process');

Route::post('/checkout/cod', [OrderController::class,'cod'])
->name('checkout.cod.process');

// End for cash on delivery

// Start for CellPay

Route::get('/checkout/payment/cellpay/process', [
    'name' => 'CellPay Checkout Process',
    'as' => 'checkout.payment.cellpay.process',
    'uses' => [CellPayController::class,'process'],
]);

Route::post('/checkout/payment/cellpay/completed/{random_order_id}', [
    'name' => 'CellPay Payment Completed',
    'as' => 'checkout.payment.cellpay.completed',
    'uses' => [CellPayController::class,'paymentCompleted'],
]);

Route::get('/checkout/payment/cellpay/failed/{random_order_id}', [
    'name' => 'CellPay Payment Failed',
    'as' => 'checkout.payment.cellpay.failed',
    'uses' => [CellPayController::class,'paymentFailed'],
]);

Route::get('/checkout/payment/cellpay/cancelled/{random_order_id}', [
    'name' => 'CellPay Payment Cancelled',
    'as' => 'checkout.payment.cellpay.cancelled',
    'uses' => [CellPayController::class,'paymentCancelled'],
]);


Route::post('review', [ReviewController::class,'store'])->name('review');
Auth::routes();


Route::get('/login/admin', [LoginController::class,'showAdminLoginForm'])->name('admin.login');
Route::get('/login/retailer', [LoginController::class,'showRetailerLoginForm'])->name('retailer.login');
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/retailer', [LoginController::class,'retailerLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);

Route::get('page/{url}', [PageController::class,'show'])->name('page-wise');

Route::get('product/{slug}', [ProductController::class,'details'])->name('product-details');

Route::get('category/{slug}', [ProductController::class,'categoryWise'])->name('product-category-wise');

Route::get('brand/{slug}', [ProductController::class,'brandWise'])->name('product-brand-wise');

// Filtering category according to price
Route::get('category/filter/price', [ProductFilterController::class,'categoryPrice'])->name('filter-product-by-price');

// Sorting products according to sub category after getting filtered according to price
Route::get('category/filter/min={minPrice}/max={maxPrice}', [ProductFilterController::class,'categoryPriceSort'])->name('category-price-sort');

Route::get('content/{slug}', [ProductController::class,'subCategoryWise'])->name('product-sub-category-wise');

Route::get('subcategory/{slug}', [ProductController::class,'subWiseCategory'])->name('product-sub-category');

// Filtering sub category according to price
Route::get('content/filter/price', [ProductFilterController::class,'subCategoryPrice'])->name('filter-product-by-price');

// Sorting products according to sub category after getting filtered according to price
Route::get('content/filter/min={minPrice}/max={maxPrice}', [ProductFilterController::class,'subCategoryPriceSort'])->name('content-price-sort');

Route::get('/search', [SearchController::class,'search'])->name('search.index');

// Filtering searched according to price
Route::get('search/filter/price', [SearchController::class,'searchByPrice'])->name('search-product-by-price');

// For sorting the product after searching
Route::get('search/product/filter/{product}', [SearchController::class,'justSort'])->name('search-and-sort');

// For sorting the product after sorting according to price
Route::get('search/filter/product={product}/min={minPrice}/max={maxPrice}', [SearchController::class,'searchAndSort'])->name('search-product-and-sort');

Route::get('/contact', [ContactController::class,'index'])->name('contact');

Route::post('contact', [ContactController::class,'contact'])->name('contact-store');

//for index-page-cart
Route::post('/index/cart',[CartController::class,'addindexPageCart'])->name('index.cart.store');

// view all
Route::get('view/just-for-you',[ProductController::class,'viewAllJustForYou'])->name('just.for.you');
Route::get('view/featured-product',[ProductController::class,'viewAllFeaturedProduct'])->name('featured.product');
Route::get('view/new-arrival',[ProductController::class,'viewAllNewArrival'])->name('new.arrival.product');
Route::get('view/top-selling',[ProductController::class,'viewAllTopSelling'])->name('top.selling.product');
Route::get('view/nepali-selling',[ProductController::class,'viewAllNepaliSelling'])->name('nepali.selling.product');

// mail/contact
Route::get('contact/us',[MailController::class,'index'])->name('user.contact.us');
Route::post('mail/us',[MailController::class,'contactForm'])->name('user.mail.us');


Route::get('/scrap-sell',[ScrapSellController::class,'index'])->name('user.scrap-sell')->middleware('auth');
Route::post('/scrap-sell',[ScrapSellController::class,'store'])->name('user.scrap-sell.store')->middleware('auth');
