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


use App\Http\Controllers\Auth\Google\LoginController as GoogleLoginController;
use App\Http\Controllers\Customer\AccountController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\ReviewController as CustomerReviewController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Advertisement1Controller;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\Advertisment2Controller;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BrandWiseProducts;
use App\Http\Controllers\Admin\CalendarEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryWiseSCController;
use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DirectCategoryController;
use App\Http\Controllers\Admin\DirectOrderController as AdminDirectOrderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemsController;
use App\Http\Controllers\Admin\OfflineOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductWiseReviewsController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RetailerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SCWiseBrandsController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\WholesalerController;
use App\Http\Controllers\Commons\ProfileController;
use App\Http\Controllers\PushNotificationController;

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
Route::get('/key-generate', function(){
    \Artisan::call('key:generate');
    echo 'key';
});

Route::get('/cache-clear', function(){
    \Artisan::call('config:clear');
     \Artisan::call('cache:clear');
      \Artisan::call('view:clear');
       \Artisan::call('route:clear');
        \Artisan::call('optimize:clear');
    echo 'cache clear';
});

Route::get('/migrate', function(){
    \Artisan::call('migrate');
    echo ' migrate';
});

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

// End for esewa

Route::post('/checkout/payment/cod/process', [OrderController::class,'cashOnDelivery1'])
->name('checkout.payment.cod.process');

Route::post('/checkout/cod', [OrderController::class,'cod'])
->name('checkout.cod.process');

// End for cash on delivery

// Start for CellPay
Route::post('checkout/payment/cellpay/process', [CellPayController::class,'process'])
->name('checkout.payment.cellpay.process');

Route::post('checkout/payment/cellpay/completed/{random_order_id}', [CellPayController::class,'paymentCompleted'])
->name('checkout.payment.cellpay.completed');

Route::post('checkout/payment/cellpay/failed/{random_order_id}', [CellPayController::class,'paymentFailed'])
->name('checkout.payment.cellpay.failed');

Route::post('checkout/payment/cellpay/cancelled/{random_order_id}', [CellPayController::class,'paymentCancelled'])
->name('checkout.payment.cellpay.cancelled');

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
Route::get('just-for-you',[ProductController::class,'viewAllJustForYou'])->name('just.for.you');
Route::get('featured-product',[ProductController::class,'viewAllFeaturedProduct'])->name('featured.product');
Route::get('new-arrival',[ProductController::class,'viewAllNewArrival'])->name('new.arrival.product');
Route::get('top-selling',[ProductController::class,'viewAllTopSelling'])->name('top.selling.product');
Route::get('nepali-selling',[ProductController::class,'viewAllNepaliSelling'])->name('nepali.selling.product');
Route::get('flash-products', [ProductController::class,'flashSaleProducts'])->name('flashSaleProducts');

// mail/contact
Route::get('contact/us',[MailController::class,'index'])->name('user.contact.us');
Route::post('mail/us',[MailController::class,'contactForm'])->name('user.mail.us');


Route::get('/scrap-sell',[ScrapSellController::class,'index'])->name('user.scrap-sell')->middleware('auth');
Route::post('/scrap-sell',[ScrapSellController::class,'store'])->name('user.scrap-sell.store')->middleware('auth');

/*****************************************************************************
 *****************  CUSTOMER ROUTES ****************
 ******************************************************************************/
Route::get('auth/google', [GoogleLoginController::class,'redirectToGoogle'])->name('google-login-proceed');
Route::get('auth/google/callback', [GoogleLoginController::class,'handleGoogleCallback']);
Route::get('auth/facebook', [GoogleLoginController::class,'redirectToFacebook'])->name('facebook-login-proceed');
Route::get('auth/facebook/callback', [GoogleLoginController::class,'handleFacebookCallback']);


Route::group(['prefix' => 'customer', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [CustomerDashboardController::class,'index'])->name('dashboard');
    Route::get('/calendar', [CustomerDashboardController::class,'calendarEventData'])->name('customer.calendar');

    Route::get('/home', [AccountController::class,'index'])->name('customer.home');
    Route::get('/profile', [CustomerProfileController::class,'index']);
    Route::get('/profile/edit', [CustomerProfileController::class,'edit']);
    Route::put('/profile/update', [CustomerProfileController::class,'update']);
    Route::get('/order', [CustomerOrderController::class,'trackOrder']);
    Route::get('/offline-order', [CustomerOrderController::class,'offlineOrderIndex']);

    Route::get('/reviews', [CustomerReviewController::class,'index']);

    Route::get('/change-password', [ProfileController::class,'changePassword']);
    Route::put('/update-password', [ProfileController::class,'updatePassword']);

    Route::get('/order/excel/download',[CustomerOrderController::class,'exportOrder'])->name('export.order');

    
    Route::get('/track/order', [CustomerOrderController::class,'index'])
    ->name('customer.order');
    Route::get('/payment', [CustomerOrderController::class,'paymentHistory'])->name('customer.payment.history');

    
    Route::get('/check/order/{orderId}', [CustomerOrderController::class,'orderCheck'])->name('customer.order.check');

    Route::get('/cancel/edit/order/{orderId}', [CustomerOrderController::class,'orderCancel'])->name('customer.order.cancel');

    Route::post('/cancel/update/order/{orderId}',[CustomerOrderController::class,'ordersCancel'])->name('ordersCancel');

    Route::get('/invoice_download/{orderId}', [CustomerOrderController::class,'InvoiceDownload'])->name('invoice.download');

    
});


/*****************************************************************************
 *****************  ADMIN ROUTES ****************
 ******************************************************************************/
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/logout', [AdminDashboardController::class,'adminlogout'])->name('admin.logout');

    Route::resource('profile',ProfileController::class)->names('admin_profile.profile');
    Route::get('change-password', [ProfileController::class,'changePassword']);
    Route::put('update-password', [ProfileController::class,'updatePassword']);

    // For menu category
    Route::resource('menu-category', MenuCategoryController::class)->names('admin.menu-category');

    Route::get('menu-category/menu/{id}', [MenuCategoryController::class,'categoryWiseMenus'])
        ->name('admin-menu-category-wise-menus');

    // For menu
    Route::resource('menu',MenuController::class)->names('admin.menu');

    //  For updating menu order
    Route::post('update-menu', [MenuController::class,'updateOrder'])->name('update-menu');

    // For menu items
    Route::resource('menu-item', MenuItemsController::class)->names('admin.menu-item');


    Route::get('menu-category/menu/menu-items/{id}', [MenuController::class,'menuWiseMenuItems'])
        ->name('admin-menu-wise-menu-items');

    //  For updating menu item order
    Route::post('update-menu-item', [MenuItemsController::class,'updateOrder'])->name('update-menu-item');

    Route::resource('product-wise-reviews', ProductWiseReviewsController::class);

    Route::get('product/reviews/{id}', [AdminProductController::class,'productWiseReviews'])
        ->name('admin-product-wise-reviews');

    Route::resource('banner', BannerController::class);

    Route::resource('retailer', RetailerController::class);

    Route::resource('wholesaler', WholesalerController::class);

    Route::resource('locations', LocationController::class)
        ->only('index','store','update','destroy')->names('admin.locations');

    Route::resource('customer-types', CustomerTypeController::class)
        ->only('index','store','update','destroy')->names('admin.customer_types');

    Route::get('customer/deactive', [CustomerController::class,'deactiveCustomer'])->name('admin.customerDeactive');
    Route::resource('customer', CustomerController::class);

    Route::post('admin/assign-role', [AdminController::class,'assignRoleToUser'])->name('admin.assignRoleToUser');
    Route::resource('admin', AdminController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('brand', BrandController::class)->names('admin.brand');
    Route::resource('direct-order', AdminDirectOrderController::class)->names('admin.direct-order');

    Route::get('/invoice_download/{orderId}', [AdminOrderController::class,'InvoiceDownload'])->name('admin.invoice.download');
    Route::resource('order', AdminOrderController::class)->names('admin.order');

    //calendar events
    Route::resource('calendars', CalendarEventController::class)->names('admin.calendars');

    // offline order route
    Route::get('offline-orders/remove-product-items/{id}', [OfflineOrderController::class,'removeOrderProductItem'])->name('admin.offlineorders.removeProduct');
    Route::resource('offline-orders', OfflineOrderController::class)->names('admin.offlineorders');

    Route::get('pending-orders', [AdminOrderController::class,'pendingOrders'])->name('admin.pending');
    Route::get('cancelled-orders', [AdminOrderController::class,'cancelledOrders'])->name('admin.cancelled');
    Route::get('confirmed-orders', [AdminOrderController::class,'confirmedOrders'])->name('admin.confirm');
    Route::get('delivered-orders', [AdminOrderController::class,'deliveredOrders'])->name('admin.delivered');
    Route::get('out-for-delivery', [AdminOrderController::class,'outForDelivery'])->name('admin.out-for-delivery');
    Route::get('payment-fail', [AdminOrderController::class,'paymentFail'])->name('admin.payment-fail');

    Route::post('customer/paymentfail/update/order/{orderId}',[CustomerOrderController::class,'paymentFail'])
    ->name('paymentFail');

    Route::resource('query', QueryController::class);

    Route::resource('category', CategoryController::class)->names('admin.category');

    Route::resource('category-wise-sub-category', CategoryWiseSCController::class)
    ->names('admin.category-wise-sub-category');
    Route::get('category-wise-sub-category/create/{slug}', [CategoryWiseSCController::class,'create'])
    ->name('admin.category-wise-sub-category.create');

    Route::resource('sub-category', SubCategoryController::class)->names('admin.sub-category');
    Route::resource('sub-category-wise-brands', SCWiseBrandsController::class)->names('admin.sub-category-wise-brands');

    Route::get('sub-category-wise-brands/create/{slug}', [SCWiseBrandsController::class,'create'])
    ->name('admin.sub-category-wise-brands.create');

    Route::resource('brand-wise-products', BrandWiseProducts::class)
        ->names('admin.brand-wise-products');

    Route::get('brand-wise-products/create/{slug}', [BrandWiseProducts::class,'create'])
        ->name('admin.brand-wise-products.create');

    Route::resource('payment-method', PaymentMethodController::class)->names('admin.payment-method');

    Route::resource('page', AdminPageController::class)->names('admin.page');

    Route::post('admin-page-ckeditor-image', [CkeditorController::class,'pageImage'])
        ->name('admin-ckeditor-page-image.upload');
    
    Route::get('product-image/{productId}/gallery',[AdminProductController::class,'createProductImage'])->name('admin.createProductImage');
    Route::post('product-image/{productId}/store',[AdminProductController::class,'storeProductImage'])->name('admin.storeProductImage');
    Route::get('product-image/{productImage}/destroy',[AdminProductController::class,'removeProductImage'])->name('admin.removeProductImage');
    
    Route::get('admin/product/{product}/destroy',[AdminProductController::class,'destroyProduct'])->name('admin.destroy.product');
    Route::resource('product', AdminProductController::class)->names('admin.product');

    Route::post('admin-ckeditor-product-image', [CkeditorController::class,'uploadProductImage'])
        ->name('admin-ckeditor-product-image.upload');

    Route::get('delivery-settings', [SiteSettingController::class,'getDeliverySetting']);

    Route::post('delivery-settings/update', [SiteSettingController::class,'deliverySettingUpdate']);

    Route::resource('site-settings', SiteSettingController::class);

    Route::get('admin/brand/{brand}/destroy/',[BrandController::class,'destroyBrand'])->name('admin.destroy.brand');

    Route::get('admin/category/{category}/destroy/',[CategoryController::class,'destroyCategory'])->name('admin.destroy.category');

    //advertisement
    Route::resource('advertisement',AdvertisementController::class)->names('admin.advertisement');
    Route::resource('advertisement1',Advertisement1Controller::class)->names('admin.advertisement1');
    Route::resource('educational-partners',Advertisment2Controller::class)
            ->names('admin.advertisement2')->except('show');

    //map
    Route::get('/map/edit',[MapController::class,'edit'])->name('admin.map.edit');
    Route::put('/map/update',[MapController::class,'update'])->name('admin.map.update');

    //Direct Order Category
    Route::get('/direct-order-category/index',[DirectCategoryController::class,'index'])->name('admin.directCategory.index');
    Route::get('/direct-order-category/create',[DirectCategoryController::class,'create'])->name('admin.directCategory.create');
    Route::get('/direct-order-category/{directCategory}',[DirectCategoryController::class,'edit'])->name('admin.directCategory.edit');
    Route::post('/direct-order-category',[DirectCategoryController::class,'store'])->name('admin.directCategory.store');
    Route::get('/direct-order-category/{directCategory}/delete',[DirectCategoryController::class,'destroy'])->name('admin.directCategory.destroy');
    Route::put('/direct-order-category/{directCategory}',[DirectCategoryController::class,'update'])->name('admin.directCategory.update');

    // Notification Controllers
    Route::post('/notifications/send',[PushNotificationController::class,'bulksend'])->name('admin.notification.send');
    Route::get('/notifications', [PushNotificationController::class,'index'])->name('admin.notification.index');
    Route::get('/notifications/create', [PushNotificationController::class,'create'])->name('admin.notification.create');

    //Report 
    Route::prefix('report')->group(function(){
        Route::get('customer',[ReportController::class,'customer'])->name('admin.report.customer');
        Route::get('order',[ReportController::class,'order'])->name('admin.report.order');
        Route::get('customer-product',[ReportController::class,'customer_product'])->name('admin.report.customer_product');
    });
    
    Route::get('gallery-image/{id}/remove',[GalleryController::class,'removeGalleryImage'])->name('admin.gallery.removeImage');
    Route::resource('gallery',GalleryController::class)->names('admin.gallery');
    Route::resource('video',VideoController::class)
    ->only(['index','store','update','destroy'])->names('admin.video');


});