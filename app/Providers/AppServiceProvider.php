<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Lets setup our ioc container bindings of our ReadWriteContract and concrete class.
        $this->app->bind(
            'App\Contracts\ReadWriteContract',
            'App\Utils\ReadWriteFile'
        );
        //Lets setup the Product Repository bindings
        $this->app->bind(
            'App\Contracts\Repositories\ProductRepository',
            'App\Repositories\ProductRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
