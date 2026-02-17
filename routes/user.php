<?php

use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','verified']], function () {
    // Dashboard Route
    Route::get('dashboard',[DashboardController::class,'index'])->name('index');
    Route::get('profile',[DashboardController::class,'profile'])->name('profile');
    Route::post('profile',[DashboardController::class,'store'])->name('profile.store');
    Route::get('order/history',[DashboardController::class,'history'])->name('history');
});
