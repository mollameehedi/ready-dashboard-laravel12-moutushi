<?php

use App\Http\Controllers\Admin\Website\DashboadrdController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Website\ProfileController;
use App\Http\Controllers\Admin\Website\BannerController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [DashboadrdController::class, 'index'])->name('dashboard.index');

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

Route::put('profile/password', [ProfileController::class, 'password'])->name('admin.profile.password');
Route::post('profile/upload/image', [ProfileController::class, 'Image'])->name('admin.profile.upload.image');


 Route::get('contact/message', [ContactMessageController::class, 'index'])
->name('contact.message.index');

Route::get('contact/message/show/{id}', [ContactMessageController::class, 'show'])
    ->name('contact.message.show');

Route::delete('contact/message/delete/{id}', [ContactMessageController::class, 'destroy'])
    ->name('contact.message.destroy');


Route::get('settings/general', [SettingController::class, 'index'])->name('settings.general.index');
Route::put('settings/general/update', [SettingController::class, 'update'])->name('settings.general.update');

// Appearance Settings
Route::get('settings/appearance', [SettingController::class, 'appearance'])->name('settings.appearance');
Route::put('settings/appearance', [SettingController::class, 'appearanceUpdate'])->name('settings.appearance.update');

// Social Media Settings
Route::get('settings/social_media', [SettingController::class, 'social_media'])->name('settings.social_media');
Route::put('settings/social_media/update', [SettingController::class, 'social_media_update'])->name('settings.social_media.update');

// Meta Tag Settings
Route::get('settings/meta_tag', [SettingController::class, 'meta_tag'])->name('settings.meta_tag');
Route::put('settings/meta_tag/update', [SettingController::class, 'meta_tag_update'])->name('settings.meta_tag.update');

// Facebook Pixel Settings
Route::get('settings/fb-pixels', [SettingController::class, 'fb_pixel'])->name('settings.fb_pixel');
Route::put('settings/fb/update', [SettingController::class, 'fb_pixel_update'])->name('settings.fb_pixel.update');

// Google Tag Manager (GTM) Settings
Route::get('settings/gtm', [SettingController::class, 'gtm'])->name('settings.gtm');
Route::put('settings/gtm/update', [SettingController::class, 'gtm_update'])->name('settings.gtm.update');

Route::get('/website/map', [SettingController::class, 'map'])
    ->name('website.map.index');

Route::put('/website/map/update', [SettingController::class, 'map_update'])
    ->name('website.map.update');


/*
|--------------------------------------------------------------------------
| Website Page Routes
|--------------------------------------------------------------------------
*/

Route::get('/website/page', [SettingController::class, 'page'])
    ->name('website.page.index');

Route::get('/website/page/{slug}', [SettingController::class, 'pageEdit'])
    ->name('website.page.edit');

Route::post('/website/page/{slug}', [SettingController::class, 'pageupdate'])
    ->name('website.page.update');


/*
|--------------------------------------------------------------------------
| Website Banner Resource
|--------------------------------------------------------------------------
*/

Route::resource('/website/banner', BannerController::class)
    ->names([
        'index'   => 'website.banner.index',
        'create'  => 'website.banner.create',
        'store'   => 'website.banner.store',
        'show'    => 'website.banner.show',
        'edit'    => 'website.banner.edit',
        'update'  => 'website.banner.update',
        'destroy' => 'website.banner.destroy',
    ]);

