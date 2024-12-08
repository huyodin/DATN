<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/airline-tickets', [\App\Http\Controllers\User\AirlineTicketsController::class, 'getAPI'])->name('getAPI.airline_tickets');
Route::get('/hotels', [\App\Http\Controllers\User\HotelController::class, 'getAPI'])->name('getAPI.hotels');

