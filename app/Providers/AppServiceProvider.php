<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WilayahModifiedService;
use App\Services\Impl\WilayahModifiedServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Wilayah Modified Service
        $this->app->singleton(WilayahModifiedService::class,WilayahModifiedServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
