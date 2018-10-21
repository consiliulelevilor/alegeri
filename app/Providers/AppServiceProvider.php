<?php

namespace App\Providers;

use Laravel\Horizon\Horizon;
use Laravel\Passport\Passport;
use Spatie\BladeX\Facades\BladeX;
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
        Horizon::auth(function ($request) {
            return (bool) ($request->user() && $request->user()->hasRole('admin'));
        });

        BladeX::component('components.*');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }
}
