<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return [
        "application" => config('app.name'),
        "framework" => "Laravel",
        "version" => app()->version(),
        "php" => PHP_VERSION,

        "heath-check" => route('health-check'),
        "ping" => route('ping'),

        "api_prefix" => config('app.api.current_version', 'v1'),
    ];
});

Route::get('/health-check', function () {
    return [
        'status' => \Illuminate\Http\Response::HTTP_OK
    ];
})->name('health-check');


Route::get('/ping', function () {
    return 'PONG';
})->name('ping');

Route::get('/laravel', function () {
    return view('welcome');
});
