<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\TourGuideController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\AreaNewController;
use App\Http\Controllers\Admin\TourController as AdminTourController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\User\AirlineTicketsController;
use App\Http\Controllers\User\HotelController as UserHotelController;
use App\Http\Controllers\User\TourController as UserTourController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/register', [UserAuthController::class, 'register'])->name('register');
Route::post('/register/action', [UserAuthController::class, 'registerAction'])->name('registerAction');
Route::get('/verify-email', [UserAuthController::class, 'verifyEmail'])->name('verify.email');
Route::get('/reset-password', [UserAuthController::class, 'ResetPassword'])->name('reset_password');
Route::post('/reset-password/action', [UserAuthController::class, 'ResetPasswordAction'])->name('ResetPasswordAction');
Route::get('/sended-mail', [UserAuthController::class, 'sendedMail'])->name('sendedMail');
Route::get('/change-password', [UserAuthController::class, 'ChangePassword'])->name('change_password');
Route::post('/change-password/action', [UserAuthController::class, 'ChangePasswordAction'])->name('ChangePasswordAction');
Route::get('/tours', [UserTourController::class, 'tours'])->name('tours');
Route::get('/tours/{id}', [UserTourController::class, 'detailTour'])->name('detailTour');
Route::post('/tours/payment', [UserTourController::class, 'payment'])->name('payment');
Route::get('/airline-tickets', [AirlineTicketsController::class, 'AirlineTickets'])->name('airline_tickets');
Route::get('/hotels', [UserHotelController::class, 'hotels'])->name('hotels');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login/action', [AdminAuthController::class, 'action'])->name('admin.login.action');
Route::post('/login/action', [UserAuthController::class, 'action'])->name('login.action');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::middleware('check.verify_email')->group(function () {
        Route::get('/tours', [UserTourController::class, 'ToursByUser'])->name('tours');
    });

    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'check.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::resource('hotels', AdminHotelController::class);
    Route::resource('tour_guides', TourGuideController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('areanew', AreaNewController::class);
    Route::resource('/tour', AdminTourController::class);
    Route::resource('bookings', BookingController::class);

    Route::post('bookings/update-payment-status', [BookingController::class, 'updatePaymentStatus'])->name('bookings.updatePaymentStatus');

    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});
