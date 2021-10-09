<?php

use App\Http\Controllers\{
    HotelController,
    RoomController
};
use App\Models\Advertiser;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/advertisers', function () {
    return Advertiser::paginate(config('constants.default_paginate'));
})->name('advertiser.index');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
