<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

use App\Http\Controllers\Admins\AdminFoodController;
use App\Http\Controllers\Admins\AdminOrderController;
use App\Http\Controllers\Admins\AdminBookingController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//food details
Route::get('foods/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'foodDetails'])->name('food.details');

//cart
Route::post('foods/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'cart'])->name('food.cart');

Route::get('foods/cart', [App\Http\Controllers\Foods\FoodsController::class, 'displayCartItems'])->name('food.display.cart');

Route::get('foods/delete-cart/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'deleteCartItems'])->name('food.delete.cart');


//booking tables
Route::post('foods/booking', [App\Http\Controllers\Foods\FoodsController::class, 'bookingTables'])->name('food.booking.table');

//menu
Route::get('foods/menu', [App\Http\Controllers\Foods\FoodsController::class, 'menu'])->name('food.menu');

//booking history
Route::get('foods/booking-history', [App\Http\Controllers\Foods\FoodsController::class, 'bookingHistory'])->name('food.booking.history');


// Static pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/services', 'pages.services')->name('services');

// Contact (GET form + POST submit)
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'sendContact'])->name('contact.send');

// admin (public)
Route::prefix('admin')->group(function () {
    Route::get('login',  [\App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login');
    Route::post('login', [\App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

    Route::middleware('admin.auth')->group(function () {
        Route::get('index',  [\App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');
        Route::post('logout',[\App\Http\Controllers\Admins\AdminsController::class, 'logout'])->name('admins.logout');
        
    });
});


Route::prefix('admin')->middleware('admin.auth')->group(function () {

    // FOODS
    Route::get('foods',            [AdminFoodController::class, 'index'])->name('admins.foods.index');
    Route::get('foods/create',     [AdminFoodController::class, 'create'])->name('admins.foods.create');
    Route::post('foods',           [AdminFoodController::class, 'store'])->name('admins.foods.store');
    Route::get('foods/{id}/edit',  [AdminFoodController::class, 'edit'])->name('admins.foods.edit');
    Route::put('foods/{id}',       [AdminFoodController::class, 'update'])->name('admins.foods.update');
    Route::delete('foods/{id}',    [AdminFoodController::class, 'destroy'])->name('admins.foods.destroy');

    // ORDERS
    Route::get('orders',           [AdminOrderController::class, 'index'])->name('admins.orders.index');
    Route::get('orders/create',    [AdminOrderController::class, 'create'])->name('admins.orders.create');
    Route::post('orders',          [AdminOrderController::class, 'store'])->name('admins.orders.store');
    Route::get('orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('admins.orders.edit');
    Route::put('orders/{id}',      [AdminOrderController::class, 'update'])->name('admins.orders.update');
    Route::delete('orders/{id}',   [AdminOrderController::class, 'destroy'])->name('admins.orders.destroy');

    // BOOKINGS (tabel kamu: "booking" singular)
    Route::get('bookings',           [AdminBookingController::class, 'index'])->name('admins.bookings.index');
    Route::get('bookings/create',    [AdminBookingController::class, 'create'])->name('admins.bookings.create');
    Route::post('bookings',          [AdminBookingController::class, 'store'])->name('admins.bookings.store');
    Route::get('bookings/{id}/edit', [AdminBookingController::class, 'edit'])->name('admins.bookings.edit');
    Route::put('bookings/{id}',      [AdminBookingController::class, 'update'])->name('admins.bookings.update');
    Route::delete('bookings/{id}',   [AdminBookingController::class, 'destroy'])->name('admins.bookings.destroy');

});

