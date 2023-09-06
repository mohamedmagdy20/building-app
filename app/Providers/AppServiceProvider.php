<?php

namespace App\Providers;

use App\Models\Advertisment;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $advertisments = Advertisment::with('user')->where('abroved',0)->where('created_at',Carbon::today())->latest()->get();
        // return $advertisments;
        // die;      
        View::share(['advertisments'=>$advertisments]);
    }
}
