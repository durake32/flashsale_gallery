<?php

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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\DirectCategoryController;
use App\Http\Controllers\Admin\DirectOrderController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemsController;
use App\Http\Controllers\Admin\OfflineOrderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductWiseReviewsController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RetailerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SCWiseBrandsController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\WholesalerController;
use App\Http\Controllers\Commons\ProfileController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/logout', [DashboardController::class,'adminlogout'])->name('admin.logout');

    Route::resource('profile',ProfileController::class)->names('admin_profile.profile');
    Route::get('change-password', [ProfileController::class,'changePassword']);
    Route::put('update-password', [ProfileController::class,'updatePassword']);

    // For menucategory
    Route::resource('menu-category', MenuCategoryController::class)->names('admin.menu-category');

    Route::get('menu-category/menu/{id}', [MenuCategoryController::class,'categoryWiseMenus'])
        ->name('admin-menu-category-wise-menus');

    // For menu
    // Route::resource('menu', 'Admin\MenuController', ['as' => 'admin']);
    Route::resource('menu',MenuController::class)->names('admin.menu');

    //  For updating menu order
    Route::post('update-menu', [MenuController::class,'updateOrder'])->name('update-menu');

    // For menu items
    // Route::resource('menu-item', 'Admin\MenuItemsController', ['as' => 'admin']);
    Route::resource('menu-item', MenuItemsController::class)->names('admin.menu-item');


    Route::get('menu-category/menu/menu-items/{id}', [MenuController::class,'menuWiseMenuItems'])
        ->name('admin-menu-wise-menu-items');

    //  For updating menu item order
    Route::post('update-menu-item', [MenuItemsController::class,'updateOrder'])->name('update-menu-item');

    // Route::resource('product-wise-reviews', 'Admin\ProductWiseReviewsController', ['as' => 'admin']);
    Route::resource('product-wise-reviews', ProductWiseReviewsController::class);

    Route::get('product/reviews/{id}', [ProductController::class,'productWiseReviews'])
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
    Route::resource('direct-order', DirectOrderController::class)->names('admin.direct-order');

    Route::get('/invoice_download/{orderId}', [OrderController::class,'InvoiceDownload'])->name('admin.invoice.download');
    Route::resource('order', OrderController::class)->names('admin.order');

    //calendar events
    Route::resource('calendars', CalendarEventController::class)->names('admin.calendars');

    // offline order route
    Route::get('offline-orders/remove-product-items/{id}', [OfflineOrderController::class,'removeOrderProductItem'])->name('admin.offlineorders.removeProduct');
    Route::resource('offline-orders', OfflineOrderController::class)->names('admin.offlineorders');

    Route::get('pending-orders', [
        'as' => 'admin.pending',
        'uses' => [OrderController::class,'pendingOrders']
    ]);

    Route::get('cancelled-orders', [
        'as' => 'admin.cancelled',
        'uses' => [OrderController::class,'cancelledOrders']
    ]);
      Route::get('confirmed-orders', [
        'as' => 'admin.confirm',
        'uses' => [OrderController::class,'confirmedOrders']
    ]);
    Route::get('delivered-orders', [
        'as' => 'admin.delivered',
        'uses' => [OrderController::class,'deliveredOrders']
    ]);

    Route::get('out-for-delivery', [
        'as' => 'admin.out-for-delivery',
        'uses' => [OrderController::class,'outForDelivery']
    ]);

      Route::get('payment-fail', [
        'as' => 'admin.payment-fail',
        'uses' => [OrderController::class,'paymentFail']
    ]);

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

    Route::get('sub-category-wise-brands/create/{slug}', [
        'as' => 'admin.sub-category-wise-brands.create',
        'uses' => [SCWiseBrandsController::class,'create']
    ]);

    Route::resource('brand-wise-products', BrandWiseProducts::class)
        ->names('admin.brand-wise-products');

    Route::get('brand-wise-products/create/{slug}', [
        'as' => 'admin.brand-wise-products.create',
        'uses' => [BrandWiseProducts::class,'create']
    ]);

    Route::resource('payment-method', PaymentMethodController::class)->names('admin.payment-method');

    Route::resource('page', PageController::class)->names('admin.page');

    Route::post('admin-page-ckeditor-image', [CkeditorController::class,'pageImage'])
        ->name('admin-ckeditor-page-image.upload');

    Route::resource('product', ProductController::class)->names('admin.product');

    Route::post('admin-ckeditor-product-image', [CkeditorController::class,'uploadProductImage'])
        ->name('admin-ckeditor-product-image.upload');

    Route::get('delivery-settings', [SiteSettingController::class,'getDeliverySetting']);

    Route::post('delivery-settings/update', [SiteSettingController::class,'deliverySettingUpdate']);

    Route::resource('site-settings', SiteSettingController::class);

    Route::get('admin/product/{product}/destroy',[ProductController::class,'destroyProduct'])->name('admin.destroy.product');
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
    Route::get('/direct-order-category/index',[DirectOrderController::class,'index'])->name('admin.directCategory.index');
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
    

});