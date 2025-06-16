<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

class TestingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        // Disable Vite when testing to prevent errors due to
        // missing manifest.json file
        if (! $this->app->environment('testing')) return;

        $this->app->singleton(Vite::class, function () {
            return new class extends Vite
            {
                public function asset($asset, $buildDirectory = null): string
                {
                    // return empty (or dummy) string
                    // for assets in test mode
                    return '';
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
