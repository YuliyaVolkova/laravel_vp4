<?php

namespace App\Providers;

use App\Cat;
use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.catsList', function($view)
        {
            $view->with('cats', Cat::all());
        });
        view()->composer('partials.randomProduct', function ($view)
        {
            $view->with('productRandom', Product::randomProduct());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
