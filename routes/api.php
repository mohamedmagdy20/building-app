<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Middleware\EnsureTokenIsValid;

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
// login/register
Route::post('/handle-register', [ApiAuthController::class,'handleRegister']);
Route::post('/handle-login', [ApiAuthController::class,'handleLogin']);
Route::get('plan',[ProfileController::class,'index']);
Route::get('category',[CategoryController::class,'index']);
Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::post('/logout',[ApiAuthController::class,'logout']);
    Route::group(['controller'=>ProfileController::class,'prefix'=>'profile'],function(){
        Route::get('/','profile');
        Route::post('update','update');
    });
});

