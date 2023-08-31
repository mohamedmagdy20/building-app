<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdvertiseController;
use App\Http\Controllers\Admin\AdvertismentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SettingController;
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

    Route::get('/',[HomeController::class,'index'])->name('admin.home');

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


    /** ----------------------Advertisements-------------------------- **/
    Route::group(['controller'=>AdvertiseController::class,'prefix'=>'advertises'],function () {
        /* Route For Advertisements Module */
        $prefix = 'admin.Advertise.';
    Route::get('',       'AllAdvertise')->name($prefix.'index');
    Route::get('/create',     'AddAdvertise')->name($prefix.'create');
    Route::post('/store',      'storeAdvertise')->name($prefix.'store');
    Route::get('/edit/{id}',  'EditAdvertise')->name($prefix.'edit');
    Route::post('/update/{id}','updateAdvertise')->name($prefix.'update');
    Route::get('/delete/{id}','DeletetaskAdvertise')->name($prefix.'delete');
    });
    /** --------------------------------------------------------------- **/

    Route::group(['controller'=>SettingController::class,'prefix'=>'settings'],function(){
        Route::get('/','index')->name('admin.setting.index');
        Route::post('update','update')->name('admin.setting.update');
    });


    Route::group(['controller'=>AdvertismentController::class,'prefix'=>'advertisment'],function(){
        $prefix = 'admin.advertisment.';
        Route::get('/','index')->name($prefix.'index');
        Route::get('data','data')->name($prefix.'data');
        Route::get('accept','accept')->name($prefix.'accept');
        Route::get('block','block')->name($prefix.'block');
        Route::get('{id}/show','show')->name($prefix.'show');
    });

    Route::group(['controller'=>HomeController::class],function(){
        Route::get('get-type','getType')->name('home.get.type');
        Route::get('get-acount-type','getAcountType')->name('home.get.acount.type');
        Route::get('get-user-type','getUserType')->name('home.get.user.type');
        Route::get('get-status','getAdvertismentStatus')->name('home.get.ads.status');
        Route::get('get-category-type','getCategoryType')->name('home.get.category.type');
    });


    Route::group(['controller'=>PlanController::class,'prefix'=>'plans'],function(){
        $prefix = 'admin.plans.';
        Route::get('/'             ,'index')->name($prefix.'index');
        Route::get('/create'       ,'Addplan')->name($prefix.'create');
        Route::post('/store'       ,'storeplan')->name($prefix.'store');
        Route::get('/edit/{id}'    ,'Editplan')->name($prefix.'edit');
        Route::post('/update/{id}' ,'updateplan')->name($prefix.'update');
        Route::get('/delete/{id}'  ,'Deleteplan')->name($prefix.'delete');
    });


});

