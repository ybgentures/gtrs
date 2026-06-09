<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- INI BARIS YANG HILANG!

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Memaksa HTTPS jika aplikasi berjalan di environment production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}