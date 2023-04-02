<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostcodeController;

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
Route::group(['middleware' => ['api'], 'prefix' => 'v1/postcode', 'namespace' => 'Api\V1'], function () {
    Route::get('/get-all-postcodes',  [PostcodeController::class, 'getAllPostcodes']);
    Route::get('/get-nearby-postcodes', [PostcodeController::class, 'getNearbyPostcodes']);
});