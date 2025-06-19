<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;  // <== adicione essa linha

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Força HTTPS em produção
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Blade::component('banner-slider', \App\View\Components\BannerSlider::class);
    }
}
