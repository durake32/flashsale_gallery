<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\SiteSetting;
use App\Models\SubCategory;
use App\Support\Socialite\SignInWithAppleProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Socialite::extend('apple', function () {
            return Socialite::buildProvider(
                SignInWithAppleProvider::class,
                config('services.apple')
            );
        });

        Gate::define('is_super_admin', function ($user) {
            return Auth::guard('admin')->user()->is_super == 1;
        });

        Gate::define('is_admin', function ($user) {
            return Auth::guard('admin')->user()->is_super == 0;
        });

        Gate::define('is_retailer', function ($user) {
            return Auth::guard('retailer')->check();
        });

        Gate::define('is_wholesaler', function ($user) {
            return Auth::user()->is_wholesaler == 1;
        });

        Gate::define('is_customer', function ($user) {
            return Auth::user()->is_wholesaler == 0;
        });
        //

        View::composer(['Frontend/partials/header', 'Frontend/partials/head', 'Frontend/partials/footer', 'Dashboard/partials/head', 'Frontend/partials/Nav/top', 'Dashboard/partials/sidenav'], function ($headerData) {
            $settings = SiteSetting::select('title', 'facebook', 'about', 'instagram', 'twitter', 'linkedin', 'meta_title', 'meta_keywords', 'site_url', 'email', 'logo', 'meta_description', 'mobile_no')->get();
            $headerData->settings = $settings;
        });

        View::composer('Frontend/partials/categories', function ($subCategoryData) {
            $subCategories = SubCategory::select('name', 'slug')->get()->take(6);
            $subCategoryData->subCategories = $subCategories;
        });


        View::composer('Dashboard/Customer/Partials/side-nav', function ($loggedInUser) {
            $user = Auth::user();
            $loggedInUser->user = $user;
        });

        View::composer('Frontend/partials/Nav/top', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)->with(
                [
                    'menu_items' => function ($menus) {
                        $menus->orderBy('order', 'asc')->where('status', 1);
                    },
                ]
            )->where('status', 1)->where('menu_category_id', $menuCategory[0]->id)->orderBy('order', 'asc')->get();

            $data->menu = $menus;
        });
        View::composer('Frontend/partials/Nav/main-menu', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)->with(
                [
                    'menu_items' => function ($menus) {
                        $menus->orderBy('order', 'asc')->where('status', 1);
                    },
                ]
            )->where('status', 1)->where('menu_category_id', $menuCategory[1]->id)->orderBy('order', 'asc')->get();

            $data->menu = $menus;
        });


        View::composer('Frontend/partials/Footer/links', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)->with(
                [
                    'menu_items' => function ($menus) {
                        $menus->orderBy('order', 'asc')->where('status', 1);
                    },
                ]
            )->where('status', 1)->where('menu_category_id', $menuCategory[2]->id)->orderBy('order', 'asc')->take(4)->get();

            $data->menu = $menus;
        });

        View::composer('Frontend/partials/Footer/policies', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)->with(
                [
                    'menu_items' => function ($menus) {
                        $menus->orderBy('order', 'asc')->where('status', 1);
                    },
                ]
            )->where('status', 1)->where('menu_category_id', $menuCategory[8]->id)->orderBy('order', 'asc')->take(4)->get();

            $data->menu = $menus;
        });

        View::composer('Frontend/partials/Footer/sell', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)
                ->where('menu_category_id', $menuCategory[3]->id)
                ->orderBy('order', 'asc')->get();

            $data->menu = $menus;
        });

        View::composer('Frontend/partials/Footer/shop-here', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)->with(
                [
                    'menu_items' => function ($menus) {
                        $menus->orderBy('order', 'asc')->where('status', 1);
                    },
                ]
            )->where('status', 1)->where('menu_category_id', $menuCategory[4]->id)->orderBy('order', 'asc')->take(3)->get();

            $data->menu = $menus;
        });

        View::composer('Frontend/partials/Footer/benefits', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)->with(
                [
                    'menu_items' => function ($menus) {
                        $menus->orderBy('order', 'asc')->where('status', 1);
                    },
                ]
            )->where('status', 1)->where('menu_category_id', $menuCategory[5]->id)->orderBy('order', 'asc')->get();

            $data->menu = $menus;
        });

        View::composer('Frontend/partials/Footer/about', function ($data) {
            $menuCategory = MenuCategory::orderBy('order')->get();

            $menus = Menu::where('status', 1)->with(
                [
                    'menu_items' => function ($menus) {
                        $menus->orderBy('order', 'asc')->where('status', 1);
                    },
                ]
            )->where('status', 1)->where('menu_category_id', $menuCategory[7]->id)->orderBy('order', 'asc')->get();

            $data->menu = $menus;
        });
    }
}
