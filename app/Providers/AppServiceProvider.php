<?php

namespace App\Providers;

use App\Data\ExtendedFrontmatterData;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Prezet\Prezet\Data\FrontmatterData;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            FrontmatterData::class,
            ExtendedFrontmatterData::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureHttp();
    }

    protected function configureHttp(): void
    {
        URL::forceScheme('https');
    }
}
