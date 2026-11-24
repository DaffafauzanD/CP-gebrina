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
         *
         * Root URL juga dikunci ke APP_URL (versi www) supaya canonical dan
         * sitemap tidak mengikuti host yang diakses pengunjung. Tanpa ini,
         * cvgebrinajaya.com dan www.cvgebrinajaya.com sama-sama mengaku
         * kanonis dan Google menandainya sebagai duplikat.
         */
        if ($this->app->isProduction()) {
            URL::forceRootUrl(config('app.url'));
            URL::forceScheme('https');
        }
    }
}
