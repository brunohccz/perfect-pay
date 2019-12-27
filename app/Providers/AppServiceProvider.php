<?php

namespace App\Providers;

use App\Observers\SaleObserver;
use App\Sale;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sale::observe(SaleObserver::class);
    }
}
