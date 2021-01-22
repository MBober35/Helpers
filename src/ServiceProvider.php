<?php

namespace MBober35\Helpers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider as BaseProvider;
use MBober35\Helpers\Commands\HelpersInit;
use MBober35\Helpers\Helpers\ActiveRouteManager;
use MBober35\Helpers\Helpers\DateHelperManager;
use MBober35\Helpers\Rules\ReCaptcha;
use MBober35\Helpers\View\Components\CheckboxReCaptcha;
use MBober35\Helpers\View\Components\InvisibleReCaptcha;

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
        $this->app->singleton("date-helper", function () {
            return new DateHelperManager;
        });

        // Commands.
        if ($this->app->runningInConsole()) {
            $this->commands([
                HelpersInit::class
            ]);
        }

        // Конфигурация.
        $this->mergeConfigFrom(
            __DIR__ . '/config/dates.php', "dates"
        );
        $this->mergeConfigFrom(
            __DIR__ . "/config/re-captcha.php", "re-captcha"
        );
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

        // Подключение шаблонов.
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'helpers');

        // Компоненты.
        Blade::component("re-captcha", InvisibleReCaptcha::class);
        Blade::component("re-captcha-check", CheckboxReCaptcha::class);
    }
}
