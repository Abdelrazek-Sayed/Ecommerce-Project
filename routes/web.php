<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MainUserContrller;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Web\WishlistController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubAdminController;
use App\Http\Controllers\Admin\HomeIndexController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Web\OrderController as WebOrderController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Web\NewsLetterController as WebNewsLetterController;

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

Route::get('/', function () {
    return view('web.home.homeIndex');
})->name('main.home.page');


Route::prefix('admin')->middleware(['admin:admin'])->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});
Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');


Route::middleware(['auth:admin', 'verified'])->get('admin/dashboard', [HomeIndexController::class, 'adminHome'])->name('admin.dashboard');


Route::middleware(['auth:sanctum,web', 'verified'])->get('dashboard', function () {
    $user = auth()->user();
    return view('user.index', compact('user'));
})->name('user.profile');




Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::prefix('user')->middleware(['auth', 'verified'])->group(function () {

    Route::get('register', function () {
        return view('auth.login');
    })->name('user.register');

    Route::get('logout', [MainUserContrller::class, 'logout'])->name('user.logout');
    // Route::get('profile', [MainUserContrller::class, 'profile'])->name('user.profile');
    Route::get('edit/profile', [MainUserContrller::class, 'editProfile'])->name('user.edit.profile');
    Route::post('update/profile', [MainUserContrller::class, 'updateProfile'])->name('user.update.profile');
    Route::get('/edit/password', [MainUserContrller::class, 'editPassword'])->name('user.edit.password');
    Route::post('/update/password', [MainUserContrller::class, 'updatePassword'])->name('user.update.password');
    Route::post('newsletter/store', [WebNewsLetterController::class, 'storeNewsLetter'])->name('store.newsletter');
});

Route::prefix('admin')->middleware(['auth:sanctum,web', 'verified'])->group(function () {
    Route::get('profile', [MainAdminController::class, 'adminProfile'])->name('admin.profile');
    Route::get('edit/profile', [MainAdminController::class, 'editProfile'])->name('admin.edit.profile');
    Route::post('update/profile', [MainAdminController::class, 'updateProfile'])->name('admin.update.profile');
    Route::get('edit/password', [MainAdminController::class, 'editaPassword'])->name('admin.edit.password');
    Route::post('update/password', [MainAdminController::class, 'updatePassword'])->name('admin.update.password');
});


Route::prefix('admin/dashboard')->middleware('auth:admin')->group(function () {

    // add new admin
    Route::prefix('subadmin')->group(function () {
        Route::get('all', [SubAdminController::class, 'allAdmin'])->name('all.admin');
        Route::get('add', [SubAdminController::class, 'addAdmin'])->name('add.admin');
        Route::post('store', [SubAdminController::class, 'storeAdmin'])->name('store.admin');
        Route::get('edit/{id}', [SubAdminController::class, 'editAdmin'])->name('edit.admin');
        Route::post('update{id}', [SubAdminController::class, 'updateAdmin'])->name('update.admin');
        Route::get('delete/{id}', [SubAdminController::class, 'deleteAdmin'])->name('delete.admin');
    });

    // category
    Route::prefix('cat')->group(function () {
        Route::get('all', [CategoryController::class, 'allCats'])->name('admin.cat');
        Route::get('edit/{id}', [CategoryController::class, 'editCat'])->name('admin.edit.cat');
        Route::post('update/{id}', [CategoryController::class, 'updateCat'])->name('admin.update.cat');
        Route::get('delete/{id}', [CategoryController::class, 'deleteCat'])->name('admin.delete.cat');
        Route::post('store', [CategoryController::class, 'storeCat'])->name('admin.store.cat');
    });
    // subcats
    Route::prefix('subcat')->group(function () {
        Route::get('all', [SubCategoryController::class, 'allSubCats'])->name('admin.subcat');
        Route::get('edit/{id}', [SubCategoryController::class, 'editSubCat'])->name('admin.edit.subcat');
        Route::post('update/{id}', [SubCategoryController::class, 'updateSubCat'])->name('admin.update.subcat');
        Route::get('delete/{id}', [SubCategoryController::class, 'deleteSubCat'])->name('admin.delete.subcat');
        Route::post('store', [SubCategoryController::class, 'storeSubCat'])->name('admin.store.subcat');
    });


    Route::prefix('brand')->group(function () {
        Route::get('all', [BrandController::class, 'allBrands'])->name('admin.brand');
        Route::get('edit/{id}', [BrandController::class, 'editBrand'])->name('admin.edit.brand');
        Route::post('update/{id}', [BrandController::class, 'updateBrand'])->name('admin.update.brand');
        Route::get('delete/{id}', [BrandController::class, 'deleteBrand'])->name('admin.delete.brand');
        Route::post('store', [BrandController::class, 'storeBrand'])->name('admin.store.brand');
    });

    Route::prefix('coupon')->group(function () {
        Route::get('all', [CouponController::class, 'allCoupons'])->name('admin.coupon');
        Route::get('edit/{id}', [CouponController::class, 'editCoupons'])->name('admin.edit.coupon');
        Route::post('update/{id}', [CouponController::class, 'updateCoupons'])->name('admin.update.coupon');
        Route::get('delete/{id}', [CouponController::class, 'deleteCoupons'])->name('admin.delete.coupon');
        Route::post('store', [CouponController::class, 'storeCoupons'])->name('admin.store.coupon');
    });

    Route::prefix('newsletter')->group(function () {
        Route::get('all', [NewsLetterController::class, 'allNewsLetter'])->name('admin.newsletter');
        Route::get('delete/{id}', [NewsLetterController::class, 'deleteNewsLetter'])->name('admin.delete.newsletter');
        Route::delete('deleteSelected', [NewsLetterController::class, 'deleteSelected'])->name('admin.deleteSelected.newsletter');
    });

    Route::prefix('product')->group(function () {
        Route::get('all', [ProductController::class, 'allProduct'])->name('all.product');
        Route::get('add', [ProductController::class, 'addProduct'])->name('add.product');
        Route::post('store', [ProductController::class, 'storeProduct'])->name('store.product');
        Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
        Route::get('edit/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
        Route::post('update/{id}', [ProductController::class, 'updateProductWithoutPhoto'])->name('update.product');
        Route::post('updatePhoto/{id}', [ProductController::class, 'updateProductPhoto'])->name('update.product.photo');
        Route::get('/toggle/{id}', [ProductController::class, 'toggleProduct'])->name('toggle.product');
        Route::get('/show/{id}', [ProductController::class, 'showproduct'])->name('show.product');
        Route::get('/get/subcategory/{category_id}', [ProductController::class, 'getSubCat'])->name('add.subcat');



        //stock
        Route::get('stock', [ProductController::class, 'Stock'])->name('product.stock');
    });

    Route::prefix('blog')->group(function () {
        Route::prefix('cat')->group(function () {
            Route::get('all', [PostController::class, 'allBlogs'])->name('all.blogCats');
            Route::get('edit/{id}', [PostController::class, 'editBlog'])->name('admin.edit.blogCat');
            Route::post('update/{id}', [PostController::class, 'updateBlog'])->name('admin.update.blogCat');
            Route::get('delete/{id}', [PostController::class, 'deleteBlog'])->name('admin.delete.blogCat');
            Route::post('store', [PostController::class, 'storeBlog'])->name('admin.store.blogCat');
        });
        Route::prefix('post')->group(function () {
            Route::get('add', [PostController::class, 'addPost'])->name('add.blogPost');
            Route::get('all', [PostController::class, 'allPosts'])->name('all.blogPost');
            Route::post('store', [PostController::class, 'storePost'])->name('store.blogPost');
            Route::get('edit/{id}', [PostController::class, 'editPost']);
            Route::post('update/{id}', [PostController::class, 'updatePost']);
            Route::get('delete/{id}', [PostController::class, 'deletePost']);
        });
    });


    // order

    Route::prefix('order')->group(function () {
        Route::get('pending', [OrderController::class, 'pendingOrders'])->name('pending.orders');
        Route::get('accepted', [OrderController::class, 'acceptedOrders'])->name('accepted.orders');
        Route::get('cancelled', [OrderController::class, 'cancelledOrders'])->name('cancelled.orders');
        Route::get('indelivery', [OrderController::class, 'indeliveryOrders'])->name('indelivery.orders');
        Route::get('success', [OrderController::class, 'successOrders'])->name('success.orders');

        Route::get('pending/view/{id}', [OrderController::class, 'viewOrder'])->name('view.order');

        Route::get('accept/{id}', [OrderController::class, 'acceptOrder'])->name('accept.order');
        Route::get('cancel/{id}', [OrderController::class, 'cancelOrder'])->name('cancel.order');
        Route::get('process/{id}', [OrderController::class, 'processDelivery'])->name('process.delivery');
        Route::get('done/{id}', [OrderController::class, 'deliveryDone'])->name('delivery.done');
    });

    // seo
    Route::prefix('seo')->group(function () {
        Route::get('view', [SeoController::class, 'viewSeo'])->name('view.seo');
        Route::post('update/{id}', [SeoController::class, 'updateSeo'])->name('update.seo');
    });


    // daily reports
    Route::prefix('report')->group(function () {
        Route::get('order', [ReportController::class, 'todayOrder'])->name('today.order');
        Route::get('delivery', [ReportController::class, 'todayDelivery'])->name('today.delivery');

        Route::get('this/month', [ReportController::class, 'thisMonth'])->name('this.month');

        Route::get('search', [ReportController::class, 'search'])->name('search.oredr');
        Route::post('search/year', [ReportController::class, 'searchYear'])->name('search.year');
        Route::post('search/month', [ReportController::class, 'searchMonth'])->name('search.month');
        Route::post('search/date', [ReportController::class, 'searchDate'])->name('search.date');
    });
    // setting
    Route::prefix('sitesetting')->group(function () {
        Route::get('edit', [SiteSettingController::class, 'editSetting'])->name('edit.setting');
        Route::post('update', [SiteSettingController::class, 'updateSetting'])->name('update.setting');
    });
    // return order
    Route::prefix('order')->group(function () {
        Route::get('return/request', [OrderController::class, 'retuenRequest'])->name('return.request');
        Route::get('accept/return/{id}', [OrderController::class, 'acceptReturn'])->name('accept.return');
        Route::get('requests', [OrderController::class, 'allRequests'])->name('all.requests');
    });

    // contact- messages
    Route::prefix('contact')->group(function () {
        Route::get('messages', [MessageController::class, 'Messages'])->name('all.message');
        Route::get('show/message/{id}', [MessageController::class, 'showMessage'])->name('show.message');
        Route::get('delete/message/{id}', [MessageController::class, 'deleteMessage'])->name('delete.message');
        Route::post('/response/{id}', [MessageController::class, 'responseMessage'])->name('response.message');
    });
});




// web routes
Route::prefix('web')->middleware(['auth:sanctum,web', 'verified', 'lang'])->group(function () {
    Route::get('product', [HomeController::class, 'homePageProduct']);
    Route::get('home/cats', [HomeController::class, 'homeCats']);


    Route::get('wishlist/{id}', [WishlistController::class, 'addwishlist']);
    Route::get('add/to/cart/{id}', [CartController::class, 'addToCart']);
    Route::get('/cart/show', [CartController::class, 'showCart'])->name('cart.show');


    Route::get('product/details/{id}', [WebProductController::class, 'productDetails']);
    Route::post('/cart/product/add/{id}', [WebProductController::class, 'addToCart']);
    Route::get('/cart/product/remove/{id}', [CartController::class, 'removeFromCart']);
    Route::post('/cart/product/update', [CartController::class, 'updateCart'])->name('cart.update');


    Route::get('/product/modal/view/{id}', [CartController::class, 'viewModalCart']);
    Route::post('update/product/modaldata/', [CartController::class, 'insertModalCartData'])->name('insert.modal.data');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
    Route::get('/wishlist', [CartController::class, 'wishlist'])->name('user.wishlist');
    Route::post('/apply/coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');

    Route::get('/coupon/remove/', [CartController::class, 'removeCoupon'])->name('coupon.remove');


    Route::get('/lang/english', [BlogController::class, 'english'])->name('lang.english');
    Route::get('/lang/arabic', [BlogController::class, 'arabic'])->name('lang.arabic');

    Route::get('/lang/{lang}', [LangController::class, 'set']);


    Route::get('blog', [BlogController::class, 'blog'])->name('blog');
    Route::get('blog/post/{id}', [BlogController::class, 'blogPost'])->name('blog.post');



    Route::get('payment/page', [PaymentController::class, 'paymentPage'])->name('payment.page');
    Route::post('payment/process', [PaymentController::class, 'payment'])->name('payment.process');

    Route::post('users/charge/stripe', [PaymentController::class, 'chargeStripe'])->name('stripe.charge');
    Route::post('users/charge/cash', [PaymentController::class, 'chargeCash'])->name('cash.charge');

    Route::get('cat/page/{id}', [WebProductController::class, 'Cat']);
    Route::get('subcat/page/{id}', [WebProductController::class, 'Subcat']);


    Route::get('home', [HomeController::class, 'home']);


    Route::prefix('order')->group(function () {
        Route::get('view/{id}', [WebOrderController::class, 'viewOrder'])->name('web.view.order');
        Route::post('track', [WebOrderController::class, 'trackOrder'])->name('order.track');


        Route::get('list', [WebOrderController::class, 'listOrder'])->name('order.list');
        Route::get('return/{id}', [WebOrderController::class, 'returnOrder'])->name('return.order');
    });


    // messages
    Route::prefix('contact')->group(function () {
        Route::get('page', [ContactController::class, 'ContactPage'])->name('contact.page');
        Route::post('send', [ContactController::class, 'sendMessage'])->name('send.message');
    });


    // product search
    Route::prefix('product')->group(function () {
        Route::post('search', [WebProductController::class, 'productSearch'])->name('product.search');
    });
});


//google login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



//facebook login
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
