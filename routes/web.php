<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\TourGuideController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AreaNewController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\StatisticsController;
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

//Route::get('/', [HomeController::class, 'index'])->name('index');
//Route::get('/about', [HomeController::class, 'about'])->name('about');
//Route::get('/service', [HomeController::class, 'service'])->name('service');
//Route::get('/package', [HomeController::class, 'package'])->name('package');
//Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
//Route::get('/single', [HomeController::class, 'single'])->name('single');
//Route::get('/guide', [HomeController::class, 'guide'])->name('guide');
//Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
//Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
//Route::get('/destination', [HomeController::class, 'destination'])->name('destination');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/register', [UserAuthController::class, 'register'])->name('register');
Route::get('/reset-password', [UserAuthController::class, 'ResetPassword'])->name('reset_password');
Route::get('/change-password', [UserAuthController::class, 'ChangePassword'])->name('change_password');
Route::get('/tours', [HomeController::class, 'tours'])->name('tours');
Route::get('/airline-tickets', [HomeController::class, 'AirlineTickets'])->name('airline_tickets');
Route::get('/hotels', [HomeController::class, 'hotels'])->name('hotels');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login/action', [AdminAuthController::class, 'action'])->name('admin.login.action');
Route::post('/login/action', [UserAuthController::class, 'action'])->name('login.action');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/tours', [HomeController::class, 'ToursByUser'])->name('tours');
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'check.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::resource('hotels', HotelController::class);
    Route::resource('tour_guides', TourGuideController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('areanew', AreaNewController::class);
    Route::resource('/tour', TourController::class);
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});
