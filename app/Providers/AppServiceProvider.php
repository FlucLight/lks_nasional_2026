<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- WAJIB TAMBAHIN INI DI ATAS

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
        // Paksa semua URL asset (CSS/JS) pakai HTTPS kalau di production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}