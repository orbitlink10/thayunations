<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandingServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::post('/events/{event}/tickets', [SiteController::class, 'buyTicket'])->name('tickets.store');
Route::post('/branding-inquiries', [SiteController::class, 'inquiry'])->name('inquiries.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('songs', SongController::class);
        Route::resource('events', EventController::class);
        Route::resource('services', BrandingServiceController::class)->parameters(['services' => 'service']);
    });
});
