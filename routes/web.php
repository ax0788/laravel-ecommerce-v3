<?php

use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Backend\AdminProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\AllOrderController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\StripeController;

// Home page Route
Route::get('/', [IndexController::class, 'index'])->name('home');

/////////// Auth Route Group ///////////
Route::group(['middleware' => 'auth'], function () {

    /////////// Admin Route Group ///////////
    Route::group(['middleware' => 'role:admin', 'as' => 'admin.'], function () {

        //   View Dashbaord
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        // Edit Profile
        // Route::get('/profile/edit/{id}',  [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        // Edit Password
        // Route::view('/password/edit', 'admin.password.edit')->name('password.edit');
        // Brand CRUD Routes
        Route::resource('brands', BrandController::class);
        // Categories CRUD Routes
        Route::resource('categories', CategoryController::class);
        // Subcategories CRUD Routes
        Route::resource('subcategories', SubCategoryController::class);


        // AJAX url to get data for specific subcategory depending on category selected from dropdown options in add new products page.
        Route::get('/products/create/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
        // Product Status
        Route::get('/products/inactive/{id}', [ProductController::class, 'InactiveProduct'])->name('products.inactive');
        Route::get('/products/active/{id}', [ProductController::class, 'ActiveProduct'])->name('products.active');
        // Product Images Update
        Route::post('products/thumbnail/update', [ProductController::class, 'UpdateThumbnail'])->name('products.update.thumbnail');
        Route::post('products/multi-image/update', [ProductController::class, 'UpdateMultiImage'])->name('products.update.multiImage');
        // Product Images Delete
        Route::get('products/mutliimage/delete/{id}', [ProductController::class, 'DeleteMultiImage'])->name('products.delete.multiImage');
        // Product Routes
        Route::resource('products', ProductController::class);

        //  Admin Coupon Routes
        Route::prefix('coupon')->group(function () {
            Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
            Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
            Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
            Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
            Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
        });

        ////////////////// Admin Shipping Area Routes Group ///////////////////////////////
        Route::prefix('shipping')->group(function () {
            // Shipping Countries CRUD routes
            Route::get('/country/view', [ShippingAreaController::class, 'CountryIndex'])->name('manage-country');
            Route::post('/country/store', [ShippingAreaController::class, 'CountryStore'])->name('country.store');
            Route::get('/country/edit/{id}', [ShippingAreaController::class, 'CountryEdit'])->name('country.edit');
            Route::post('/country/update/{id}', [ShippingAreaController::class, 'CountryUpdate'])->name('country.update');
            Route::get('/country/delete/{id}', [ShippingAreaController::class, 'CountryDelete'])->name('country.delete');

            // Shipping States CRUD routes
            Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('state.index');
            Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
            Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');
            Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
            Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');

            // Shipping Districts CRUD routes
            Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('district.index');
            Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
            Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
            Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
            Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');
        });

        Route::controller(OrderController::class)
            ->prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::get('/pending', 'Pending')->name('pending');
                Route::get('/details/{order_id}', 'Details')->name('details');
                Route::get('/confirmed', 'Confirmed')->name('confirmed');
                Route::get('/processed', 'Processed')->name('processed');
                Route::get('/picked', 'Picked')->name('picked');
                Route::get('/shipped', 'Shipped')->name('shipped');
                Route::get('/delivered', 'Delivered')->name('delivered');
                Route::get('/canceled', 'Canceled')->name('canceled');

                // Update Status
                Route::get('/pending/{order_id}', 'PendingToConfirm')->name('confirming');
                Route::get('/confirm/{order_id}', 'ConfirmToProcessing')->name('processing');
                Route::get('/process/{order_id}', 'ProcessingToPicked')->name('picking');
                Route::get('/pick/{order_id}', 'PickedToShipped')->name('shipping');
                Route::get('/ship/{order_id}', 'ShippedToDelivered')->name('delivering');
                Route::get('/invoice/{order_id}', 'Invoice')->name('invoice');
            });







        Route::controller(ReportController::class)
            ->prefix('report')
            ->as('report.')
            ->group(function () {
                Route::get('/view', 'ReportIndex')->name('index');
                Route::post('/search/date', 'ReportByDate')->name('date');
                Route::post('/search/month', 'ReportByMonth')->name('month');
                Route::post('/search/year', 'ReportByYear')->name('year');
            });


        Route::get('/users/view', [AdminProfileController::class, 'UsersIndex'])->name('users.index');




        //Youtube Course Remake
        Route::controller(GroupController::class)->group(function () {
            Route::get('/group', 'index');
            Route::get('/group-add', 'create');
        });


    }); /*End Admin Route Group */



    ////////////////// User Routes Group ///////////////////////////////

    //User Profile Settings CRUD
    Route::get('/profile',  [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit/{id}',  [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update',  [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');

    Route::view('/profile/password-change', 'frontend.account.profile.password')->name('password.change');



    //Add to WishList
    Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);
    // Wishlist Page View
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist.index');
    // Wishlist Page Load Data AJAX
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
    // Wishlist Remove Product AJAX
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);
    // Stripe Payment
    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');

    // Cash Payment
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');



    Route::controller(AllOrderController::class)->group(function () {
        // View Orders
        Route::get('/orders', 'MyOrders')->name('orders.index');
        // View Order Details
        Route::get('/order_details/{order_id}', 'OrderDetails')->name('order.detail');
        // Download Invoice
        Route::get('/invoice_download/{order_id}', 'InvoiceDownload')->name('order.invoice');
        // Return Order
        Route::post('/return/order/{order_id}', 'ReturnOrder')->name('order.return');
        // Return Order List
        Route::get('/return/order/list', 'ReturnOrderList')->name('return.order.list');
        // Canceled Orders
        Route::get('/orders/canceled', 'CancelOrders')->name('cancel.order');
    });

}); /* End Auth Route Group */

////////////// Guest Routes ///////////////////

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails'])->name('product.details');

// Product Tags
Route::get('/product/tag/{tag}', [IndexController::class, 'ProductTag']);

// Frontend Category wise Data
Route::get('/{cat_id}/{slug}', [IndexController::class, 'CategoryWiseProduct'])->name('product.category');

// Frontend SubCategory wise Data
Route::get('/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Product View Modal with AJAX
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
// Product Add to Cart Store DATA
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// GET data from mini cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);
//Remove Item from mini cart
Route::get('/product/minicart/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

//Checkout Page View & Store
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout.index');
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');
// Checkout View Page Responsive form-group Selection w/ AJAX
Route::get('/state-get/ajax/{country_id}', [CheckoutController::class, 'StateAjax']);
Route::get('/district-get/ajax/{state_id}', [CheckoutController::class, 'DistrictAjax']);

///////  My Cart Page Routes/////////////
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('cart.index');
Route::get('/get-cart-product', [CartPageController::class, 'GetCartProduct']);
Route::get('/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

/////Frontend Apply & Remove Coupon w/AJAX
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-cal', [CartController::class, 'CouponCal']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);


// Search Autocomplete Product Via Ajax
Route::get('/searchajax', [IndexController::class, 'SearchAutoComplete'])->name('searchproductajax');
Route::post('/searching', [IndexController::class, 'SearchResult'])->name('searchresult');