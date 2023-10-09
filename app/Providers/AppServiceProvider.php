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
            $view->with('setting',SiteSetting::first());
        });

        View::composer('auth.*', function ($view) {
                $view->with('setting',SiteSetting::first());
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
