<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\PublicAccessController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::controller(PublicAccessController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/images/{folder}/{filename}', 'images');
});

Route::controller(BuyerController::class)
    ->middleware(['auth', 'role:buyer'])
    ->prefix('buyer')
    ->group((function () {
        Route::get('/properties', 'properties')->name('buyer.properties');
        Route::get('/bookings', 'bookings')->name('buyer.bookings');
        Route::post('/properties/{id}/book', 'book_property')->name('buyer.book_property');
    }));

Route::controller(SellerController::class)
    ->middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->group((function () {
        Route::get('/add-property', 'add_property_view')->name('seller.add_property_view');
        Route::post('/add-property', 'add_property')->name('seller.add_property');
        Route::get('/properties', 'properties')->name('seller.properties');
        Route::delete('/properties/{id}', 'remove_property')->name('seller.remove_property');
        Route::get('/bookings/{id}', 'bookings')->name('seller.bookings');
        Route::put('/bookings/{id}/confirm', 'confirm_booking')->name('seller.confirm_booking');
        Route::put('/bookings/{id}/cancel', 'cancel_booking')->name('seller.cancel_booking');
    }));

Route::controller(AdminController::class)
    ->middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group((function () {
        Route::get('/properties', 'properties')->name('admin.properties');
        Route::delete('/properties/{id}', 'remove_property')->name('admin.remove_property');
        Route::get('/bookings/{id}', 'bookings')->name('admin.bookings');
        Route::put('/bookings/{id}/confirm', 'confirm_booking')->name('admin.confirm_booking');
        Route::put('/bookings/{id}/cancel', 'cancel_booking')->name('admin.cancel_booking');
    }));