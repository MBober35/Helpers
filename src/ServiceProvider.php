<?php

namespace MBober35\Helpers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;
use MBober35\Helpers\Facades\ActiveRouteManager;

class ServiceProvider extends BaseProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("active-route", function () {
            return new ActiveRouteManager;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function (View $view) {
            $view->with("currentRoute", Route::currentRouteName());
        });
    }
}
