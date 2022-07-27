<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ApiAuthController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1',], function () {
    Route::post('appUserLogin',[ApiAuthController::class,'appUserLogin'])->name('appUserLogin.api');
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('appUserLogout',[ApiAuthController::class,'appUserLogout'])->name('appUserLogout.api');     
    }); 
});