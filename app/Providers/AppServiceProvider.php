<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('Frontend.*', function ($view) {
            $view->with('setting',SiteSetting::find(1));
        });
        View::composer('Frontend.*', function ($view) {
            $flash = false;
            $setting = SiteSetting::find(1);
            $today = today();
            if($setting->enable_flash_sale && $today->isBetween($setting->sale_from, $setting->sale_to)){
                $flash = true;
            }
            $view->with('flash',$flash);
        });
        View::composer('auth.*', function ($view) {
                $view->with('setting',SiteSetting::find(1));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
