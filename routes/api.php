<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WeatherController;
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

Route::get('/',[WeatherController::class, 'getAll']);
Route::get('/{city}',[WeatherController::class, 'getWeather']);

Route::post('/search',[SearchController::class, 'search']);

Route::post('/contact-us',[ContactUsController::class, 'store']);


