<?php

namespace App\Providers;

use Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
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
        Model::unguard();

        Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));

        Blade::if('admin', function () {
            return auth()->user()->admin == 1;
        });
    }
}
