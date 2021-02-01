<?php

namespace MBober35\Helpers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider as BaseProvider;
use MBober35\Helpers\Commands\HelpersInit;
use MBober35\Helpers\Facades\MenuStructure;
use MBober35\Helpers\Helpers\ActiveRouteManager;
use MBober35\Helpers\Helpers\DateHelperManager;
use MBober35\Helpers\Helpers\MenuStructureManager;
use MBober35\Helpers\Rules\ReCaptcha;
use MBober35\Helpers\View\Components\CheckboxReCaptcha;
use MBober35\Helpers\View\Components\InvisibleReCaptcha;
use MBober35\Helpers\View\Components\NavList;

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
        $this->app->singleton("menu-structure", function () {
            return new MenuStructureManager;
        });

        // Commands.
        if ($this->app->runningInConsole()) {
            $this->commands([
                HelpersInit::class
            ]);
        }

        // Конфигурация.
        $this->addConfigs();
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

        // Расширить Blade.
        $this->extendBlade();
    }

    /**
     * Добавить компоненты и переменные.
     */
    protected function extendBlade()
    {
        // Компоненты.
        Blade::component("re-captcha", InvisibleReCaptcha::class);
        Blade::component("re-captcha-check", CheckboxReCaptcha::class);
        Blade::component("nav-list", NavList::class);

        // Переменные в Blade
        if (config("menu-structure.adminLeftMenu")) {
            view()->composer("layouts.admin", function (View $view) {
                $view->with("leftMenu", config("menu-structure.adminLeftMenu"));
            });
        }
        if (config("menu-structure.appLeftMenu")) {
            view()->composer("layouts.app", function (View $view) {
                $view->with("leftMenu", config("menu-structure.appLeftMenu"));
            });
        }
    }

    /**
     * Добавить конфиги.
     */
    protected function addConfigs()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/dates.php', "dates"
        );
        $this->mergeConfigFrom(
            __DIR__ . "/config/re-captcha.php", "re-captcha"
        );
        $this->mergeConfigFrom(
            __DIR__ . "/config/menu-structure.php", "menu-structure"
        );
    }
}
