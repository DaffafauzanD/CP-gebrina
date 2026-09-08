<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        /**
         * Seluruh URL yang dihasilkan di produksi (canonical, OpenGraph, sitemap,
         * dan baris Sitemap di robots.txt) wajib https. Paksa scheme-nya supaya
         * tetap benar walau SSL diterminasi di proxy/CDN yang tidak meneruskan
         * header X-Forwarded-Proto.
         */
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }
    }
}
