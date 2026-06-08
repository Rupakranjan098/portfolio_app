<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            // Fail silently or log if migration fails
        }
    }
}
