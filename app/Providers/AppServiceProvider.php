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
        // Langsung paksa HTTPS dalam kondisi apapun
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}