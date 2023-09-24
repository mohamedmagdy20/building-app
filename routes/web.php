<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdvertiseController;
use App\Http\Controllers\Admin\AdvertismentController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SpecficationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\SearchLosController;
use App\Http\Controllers\SettingController;
use App\Models\Advertisment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/optimize',function(){
    Artisan::call('optimize');
    // Clear the Spatie Permission cache key
    Cache::forget('spatie.permission.cache');
});
Route::get('/',[HomeController::class,'index'])->middleware('auth:admin')->name('admin.home');

Route::get('admin/login',[AuthController::class,'loginView'])->middleware('guest:admin')->name('admin.login.view');
Route::post('admin/login',[AuthController::class,'login'])->middleware('guest:admin')->name('admin.login');

Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){

    // Route::get('/',[HomeController::class,'index'])->name('admin.home');

    Route::get('logout',[AuthController::class,'logout'])->name('admin.logout');

    Route::group(['controller'=>AdminController::class,'prefix'=>'admins'],function () {
        $prefix = 'admin.users.';

        Route::get('','index')->middleware('permission:Show_Admins')->name($prefix.'index');
        Route::get('/create','create')->middleware('permission:Add_Admins')->name($prefix.'create');
        Route::get('{id}/edit','edit')->middleware('permission:Edit_Admins')->name($prefix.'edit');
        Route::get('delete/{id}','delete')->middleware('permission:Delete_Admins')->name($prefix.'delete');
        Route::post('/store','store')->middleware('permission:Add_Admins')->name($prefix.'store');
        Route::post('{id}/update','update')->middleware('permission:Edit_Admins')->name($prefix.'update');
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
        Route::get('/','index')->middleware('permission:Show_Users')->name($prefix.'.index');
        Route::get('data','data')->middleware('permission:Show_Users')->name($prefix.'.data');
        Route::get('delete','toggleActive')->middleware('permission:Delete_User')->name($prefix.'.delete');
        Route::get('force-delete/{id}','delete')->middleware('permission:Delete_User')->name($prefix.'.force.delete');

        Route::get('show/{id}','show')->middleware('permission:Show_Users')->name($prefix.'.show');
        Route::get('update-points','updatePoints')->middleware('permission:Edit_Users')->name($prefix.'.update-points');
    });


    /** ----------------------Advertisements-------------------------- **/
    Route::group(['controller'=>AdvertiseController::class,'prefix'=>'advertises'],function () {
        /* Route For Advertisements Module */
        $prefix = 'admin.Advertise.';
    Route::get('',       'AllAdvertise')->middleware('permission:Show_Advertises')->name($prefix.'index');
    Route::get('/create',     'AddAdvertise')->middleware('permission:Add_Advertises')->name($prefix.'create');
    Route::post('/store',      'storeAdvertise')->middleware('permission:Add_Advertises')->name($prefix.'store');
    Route::get('/edit/{id}',  'EditAdvertise')->middleware('permission:Edit_Advertises')->name($prefix.'edit');
    Route::post('/update/{id}','updateAdvertise')->middleware('permission:Edit_Advertises')->name($prefix.'update');
    Route::get('/delete/{id}','DeletetaskAdvertise')->middleware('permission:Delete_Advertises')->name($prefix.'delete');
    });
    /** --------------------------------------------------------------- **/

    Route::group(['controller'=>SettingController::class,'prefix'=>'settings'],function(){
        Route::get('/','index')->middleware('permission:Show_Settings')->name('admin.setting.index');
        Route::post('update','update')->middleware('permission:Edit_Settings')->name('admin.setting.update');
    });


    Route::group(['controller'=>AdvertismentController::class,'prefix'=>'advertisment'],function(){
        $prefix = 'admin.advertisment.';
        Route::get('/','index')->middleware('permission:Show_Advertisments')->name($prefix.'index');
        Route::get('data','data')->middleware('permission:Show_Advertisments')->name($prefix.'data');
        Route::get('accept','accept')->middleware('permission:Accept_Advertisments')->name($prefix.'accept');
        Route::get('block','block')->middleware('permission:Block_Advertisments')->name($prefix.'block');
        Route::get('{id}/show','show')->middleware('permission:Show_Advertisments')->name($prefix.'show');
        Route::get('delete/{id}','forceDelete')->middleware('permission:Block_Advertisments')->name($prefix.'delete');
        Route::get('update-type','update')->middleware('permission:Block_Advertisments')->name($prefix.'update-type');
    });

    Route::group(['controller'=>HomeController::class,'middleware'=>'permission:Show_Statictics'],function(){
        Route::get('get-type','getType')->name('home.get.type');
        Route::get('get-acount-type','getAcountType')->name('home.get.acount.type');
        Route::get('get-user-type','getUserType')->name('home.get.user.type');
        Route::get('get-status','getAdvertismentStatus')->name('home.get.ads.status');
        Route::get('get-category-type','getCategoryType')->name('home.get.category.type');
    });


    Route::group(['controller'=>PlanController::class,'prefix'=>'plans'],function(){
        $prefix = 'admin.plans.';
        Route::get('/'             ,'index')->middleware('permission:Show_Plans')->name($prefix.'index');
        Route::get('/create'       ,'Addplan')->middleware('permission:Add_Plans')->name($prefix.'create');
        Route::post('/store'       ,'storeplan')->middleware('permission:Add_Plans')->name($prefix.'store');
        Route::get('/edit/{id}'    ,'Editplan')->middleware('permission:Edit_Plans')->name($prefix.'edit');
        Route::post('/update/{id}' ,'updateplan')->middleware('permission:Edit_Plans')->name($prefix.'update');
        Route::get('/delete/{id}'  ,'Deleteplan')->middleware('permission:Delete_Plans')->name($prefix.'delete');
    });

    Route::group(['controller'=>SearchLosController::class,'prefix'=>'search-history'],function(){
        $prefix = 'admin.search.logs.';
        Route::get('/','index')->middleware('permission:Show_Settings')->name($prefix.'index');
        Route::get('data','data')->middleware('permission:Edit_Settings')->name($prefix.'data');
    });



    Route::group(['controller'=>AreaController::class,'prefix'=>'areas'],function(){
        $prefix = 'admin.areas.';
        Route::get('/','index')->middleware('permission:Show_Areas')->name($prefix.'index');
        Route::get('/create','create')->middleware('permission:Add_Areas')->name($prefix.'create');
        Route::post('/store','store')->middleware('permission:Add_Areas')->name($prefix.'store');
        Route::get('/edit/{id}','edit')->middleware('permission:Edit_Areas')->name($prefix.'edit');
        Route::post('/update/{id}','update')->middleware('permission:Edit_Areas')->name($prefix.'update');
        Route::get('/delete/{id}','delete')->middleware('permission:Delete_Areas')->name($prefix.'delete');
        Route::post('upload-file','uploadAreas')->middleware('permission:Add_Areas')->name($prefix.'upload-excel');
    });

    Route::group(['controller'=>CategoryController::class,'prefix'=>'category'],function(){
        $prefix = 'admin.category.';
        Route::get('/','index')->middleware('permission:Show_Category')->name($prefix.'index');
        Route::get('/create','create')->middleware('permission:Add_Category')->name($prefix.'create');
        Route::post('/store','store')->middleware('permission:Add_Category')->name($prefix.'store');
        Route::get('/edit/{id}','edit')->middleware('permission:Edit_Category')->name($prefix.'edit');
        Route::post('/update/{id}','update')->middleware('permission:Edit_Category')->name($prefix.'update');
        Route::get('/delete/{id}','delete')->middleware('permission:Delete_Category')->name($prefix.'delete');
    });

    Route::group(['controller'=>CalculationController::class,'prefix'=>'calculation'],function(){
        $prefix = 'admin.calculation.';
        Route::get('/','index')->middleware('permission:Show_Calculation')->name($prefix.'index');
        Route::get('/update','update')->middleware('permission:Update_Calculation')->name($prefix.'update');
      });

    Route::group(['controller'=>SpecficationController::class,'prefix'=>'location-specification'],function(){
        $prefix = 'admin.specifications.';
        Route::get('/','index')->middleware('permission:Show_Site_Specfications')->name($prefix.'index');
        Route::get('/create','create')->middleware('permission:Add_Site_Specfications')->name($prefix.'create');
        Route::post('/store','store')->middleware('permission:Add_Site_Specfications')->name($prefix.'store');
        Route::get('/edit/{id}','edit')->middleware('permission:Edit_Site_Specfications')->name($prefix.'edit');
        Route::post('/update/{id}','update')->middleware('permission:Edit_Site_Specfications')->name($prefix.'update');
        Route::get('/delete/{id}','delete')->middleware('permission:Delete_Site_Specfications')->name($prefix.'delete');
    });
});
