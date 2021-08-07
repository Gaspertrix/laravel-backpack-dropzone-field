<?php

namespace Gaspertrix\LaravelBackpackDropzoneField;

use Gaspertrix\LaravelBackpackDropzoneField\App\Console\Commands\Install;
use Illuminate\Support\ServiceProvider;

class DropzoneFieldServiceProvider extends ServiceProvider
{
    protected $commands = [
        Install::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }

        // Publish field
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/gaspertrix/laravel-backpack-dropzone-field')], 'views');

        // Publish public assets
        $this->publishes([__DIR__ . '/public' => public_path('vendor/gaspertrix/laravel-backpack-dropzone-field')], 'public');

        // Load translations
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'dropzone');

        // Load custom views first
        $customViewsFolder = resource_path('views/vendor/gaspertrix/laravel-backpack-dropzone-field');

        if (file_exists($customViewsFolder)) {
            $this->loadViewsFrom($customViewsFolder, 'dropzone');
        }

        // Load default views
        $this->loadViewsFrom(__DIR__ .  '/resources/views', 'dropzone');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
