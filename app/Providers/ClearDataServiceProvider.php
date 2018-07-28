<?php

namespace App\Providers;

use App\Services\ClearData;
use App\Services\ImageToUpload;
use Illuminate\Support\ServiceProvider;

class ClearDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('clearData', function($app) {
            return new ClearData;
        });

        $this->app->singleton('image', function ($app) {
            return new ImageToUpload;
        });
    }
}
