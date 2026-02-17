<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LoginLogController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\Website\BannerController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// profile route here
       Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/update/password', [ProfileController::class, 'password'])->name('password');
        Route::post('/upload', [ProfileController::class, 'image'])->name('upload.image');
    });
// general settings route here
        Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
        Route::group(['as' => 'general.', 'prefix' => 'general'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('update', [SettingController::class, 'update'])->name('update');
        });
        Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance');
        Route::put('appearance', [SettingController::class, 'appearanceUpdate'])->name('appearance.update');

        Route::get('social_media', [SettingController::class, 'social_media'])->name('social_media');
        Route::put('social_media/update', [SettingController::class, 'social_media_update'])->name('social_media.update');
        Route::get('meta_tag', [SettingController::class, 'meta_tag'])->name('meta_tag');
        Route::put('meta_tag/update', [SettingController::class, 'meta_tag_update'])->name('meta_tag.update');
        Route::get('fb-pixels', [SettingController::class, 'fb_pixel'])->name('fb_pixel');
        Route::put('fb/update', [SettingController::class, 'fb_pixel_update'])->name('fb_pixel.update');
        Route::get('gtm', [SettingController::class, 'gtm'])->name('gtm');
        Route::put('gtm/update', [SettingController::class, 'gtm_update'])->name('gtm.update');


        //website setting route here
        Route::group(['as' => 'website.', 'prefix' => 'website'], function () {
        Route::group(['as' => 'map.', 'prefix' => 'map'], function () {
        Route::get('/',[SettingController::class,'map'])->name('index');
        Route::put('/update',[SettingController::class,'map_update'])->name('update');
            });
        Route::group(['as' => 'page.', 'prefix' => 'page'], function () {
        Route::get('/', [SettingController::class, 'page'])->name('index');
        Route::get('/{slug}', [SettingController::class, 'pageEdit'])->name('edit');
        Route::post('/{slug}', [SettingController::class, 'pageupdate'])->name('update');
            });
        Route::resource('banner',BannerController::class);
        });
        });

        // contact message route here
        Route::group(['as' => 'contact.', 'prefix' => 'contact'], function () {
        Route::group(['as' => 'message.', 'prefix' => 'message'], function () {
        Route::get('/', [ContactMessageController::class, 'index'])->name('index');
        Route::get('/show/{id}', [ContactMessageController::class, 'show'])->name('show');
        Route::delete('/delete/{id}', [ContactMessageController::class, 'destroy'])->name('destroy');
        });
    });
    Route::get('login-log',[LoginLogController::class,'index'])->name('loginlog.index');
});
