<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\App;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Model::preventLazyLoading();

        // Disable Vite in test environment
        if (App::environment('testing')) {
            app()->singleton(Vite::class, function () {
                return new class extends Vite {
                    public function asset($asset, $buildDirectory = null): string
                    {
                        // You can return fake asset paths or fallback to plain CSS/JS
                        return "/fake/path/{$asset}";
                    }
                };
            });
        }
    }
}
