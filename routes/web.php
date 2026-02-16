<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Website\DashboadrdController;
use App\Http\Controllers\Admin\ContactMessageController;


use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Website\ProfileController;
use App\Http\Controllers\Admin\Website\BannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';

