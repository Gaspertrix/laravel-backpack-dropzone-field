<?php

namespace Gaspertrix\Backpack\DropzoneField;

use Illuminate\Support\ServiceProvider;

class DropzoneFieldServiceProvider extends ServiceProvider
{
    protected $commands = [
        \Gaspertrix\Backpack\DropzoneField\App\Console\Commands\Install::class,
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

        // publish field
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/backpack/crud')], 'views');

        // publish public assets
        $this->publishes([__DIR__ . '/public' => public_path('vendor/gaspertrix/laravel-backpack-dropzone-field')], 'public');
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
