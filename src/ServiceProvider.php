<?php

namespace MBober35\Helpers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;
use MBober35\Helpers\Commands\HelpersInit;
use MBober35\Helpers\Helpers\ActiveRouteManager;

class ServiceProvider extends BaseProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Facades.
        $this->app->singleton("active-route", function () {
            return new ActiveRouteManager;
        });

        // Commands.
        if ($this->app->runningInConsole()) {
            $this->commands([
                HelpersInit::class
            ]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Assets.
        $this->publishes([
            __DIR__ . '/resources/js/components' => resource_path('js/components/Helpers'),
        ], 'public');
    }
}
