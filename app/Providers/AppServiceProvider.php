<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        view()->composer('*', function ($view) {
            $view->with('appName', config('app.name'));
            $view->with('customer', auth()->user());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        \URL::forceScheme('https');
        Paginator::useBootstrapFive();
    }
}
