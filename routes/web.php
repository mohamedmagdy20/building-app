<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
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

    Route::group(['controller'=>AdminController::class,'prefix'=>'admins'],function () {
        $prefix = 'admin.users.';

        Route::get('','index')->name($prefix.'index');
        Route::get('/create','create')->name($prefix.'create');
        Route::get('{id}/edit','edit')->name($prefix.'edit');
        Route::get('delete/{id}','delete')->name($prefix.'delete');
        Route::post('/store','store')->name($prefix.'store');
        Route::post('{id}/update','update')->name($prefix.'update');
    });
    

    Route::group(['controller'=>RoleController::class,'prefix'=>'roles'],function () {
        $prefix = 'admin.';
        Route::get('','index')->name($prefix.'role.index');
    });


    Route::group(['controller'=>PermissionController::class,'prefix'=>'permissions'],function () {
        $prefix = 'admin.';
        Route::get('{id}/','index')->name($prefix.'permission.index');
        Route::post('{id}/update','update')->name($prefix.'permission.update');    
    });

    Route::group(['controller'=>UserController::class,'prefix'=>'users'],function () {
        $prefix = 'admin.user';
        Route::get('/','index')->name($prefix.'.index');
        Route::get('data','data')->name($prefix.'.data');
        Route::get('delete','toggleActive')->name($prefix.'.delete');    
        Route::get('force-delete/{id}','delete')->name($prefix.'.force.delete');    

        Route::get('show/{id}','show')->name($prefix.'.show');  
        Route::get('update-points','updatePoints')->name($prefix.'.update-points');  
    });
    


    
});

