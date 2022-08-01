<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\front\PagesController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\sign\sign_in_upController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

Route::get('langs/{locale}',[profileController::class,'langSwitcher'])
    ->name('lang.swithcher');




Route::group(['middleware'=>'locale'], function (){
    Route::get('/', [PagesController::class, 'index'])
        ->name('front.home');

    Route::get('haqqimizda', [PagesController::class, 'about'])
        ->name('front.about');

    Route::get('elaqe', [PagesController::class, 'contact'])
        ->name('front.contact');

    Route::post('/contact', [PagesController::class,'contactPost'])
        ->name('front.contact.post');

    Route::get('/products/{category_slug}', [PagesController::class,'products'])
        ->name('front.products');

    Route::get('/products/{category_slug}/{product_slug}', [PagesController::class,'productsDetails'])
        ->name('front.product.details');

    Route::post('/product-details-modal', [PagesController::class,'productDetailsModal'])
        ->name('front.product.details.modal');

    Route::post('sebet', [PagesController::class,'sebet'])
        ->name('front.sebet');

    Route::post('call-sebet', [PagesController::class,'call_sebet'])
        ->name('front.call.sebet');

    Route::post('product-removal', [PagesController::class,'productRemoval'])
        ->name('front.product.removal');

    Route::get('shopping-cart', [PagesController::class,'shoppingCart'])
        ->name('front.shopping.cart');

    Route::post('order',[PagesController::class,'Order'])
        ->name('front.order');

    Route::get('test', function (){
        $array = unserialize(Cookie::get('sebet'));
        dd($array);
    });

    Route::get('login',[PagesController::class,'login'])
        ->middleware(['locale','guest'])
//        ->middleware('throttle:5,60')
        ->name('login');

    Route::post('login',[PagesController::class,'loginPost'])
        ->middleware(['locale','guest'])
//        ->middleware('throttle:5,60')
        ->name('login.post');

    Route::get('logout',[PagesController::class,'logout'])
        ->middleware( 'auth' )
        ->name( 'logout' );

    Route::post('avatar-upload',[ profileController::class,'avatarUpload' ])
        ->name('front.avatar.upload')
        ->middleware('auth');

    Route::post('profile',[ profileController::class,'profileUpdate' ])
        ->name('front.profile.update')
        ->middleware('auth');

});


Route::group(['prefix'=>'admin','middleware'=>['admin', 'locale']],function (){
    Route::get('/',[AdminController::class,'index'])
        ->name('back.dashboard');

    Route::get('profile',[profileController::class,'profile'])
        ->name('back.profile');

    Route::resource('option',OptionController::class);
    Route::resource('home-banner', HomeBannerController::class);
    Route::resource('about', AboutController::class);

    Route::resource('category', CategoryController::class);
    Route::post('category-status',[CategoryController::class,'Status'])->name('category.status');

    Route::resource('product', ProductController::class);
    Route::post('product-switcher', [ProductController::class, 'Switcher'])->name('back.switcher');
    Route::post('product-photo-save', [ProductController::class, 'photoSave'])->name('back.photo.save');
    Route::post('product-old-photos', [ProductController::class, 'oldPhotos'])->name('back.old.photos');
    Route::post('product-photo-delete', [ProductController::class, 'photoDelete'])->name('back.photo.delete');

    Route::resource('review', ReviewController::class);
});
