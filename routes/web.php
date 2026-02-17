<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CouponController;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductCotroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::group(['as'=> 'front.', 'prefix'=> '/'],function(){
Route::get('/',[FrontendController::class,'index'])->name('index');

// contact route here
Route::group(['as' => 'contact.', 'prefix'=> 'contact'],function(){
Route::get('/',[ContactController::class,'index'])->name('index');
Route::post('/store',[ContactController::class,'store'])->name('store');
    });
 // common route
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('login',[AuthenticationController::class,'login'])->name('login');
Route::post('login',[AuthenticationController::class,'login_submit'])->name('login');
Route::post('/coupon/apply', [CouponController::class, 'applyCoupon'])->name('front.coupon.apply');




