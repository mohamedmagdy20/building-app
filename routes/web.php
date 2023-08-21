<?php

use App\Http\Controllers\Admin\AuthController;
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
    return view('welcome');
});

Route::get('admin/login',[AuthController::class,'loginView'])->middleware('guest:admin')->name('admin.login.view');
Route::post('admin/login',[AuthController::class,'login'])->middleware('guest:admin')->name('admin.login');

Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('admin.home');
    
    Route::get('logout',[AuthController::class,'logout'])->name('admin.logout');
    
});

