<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    /**
     * Serve robots.txt dinamis supaya URL sitemap selalu mengikuti APP_URL,
     * dan supaya environment non-produksi tidak pernah terindeks.
     */
    public function __invoke(): Response
    {
        $lines = ['User-agent: *'];

        if (app()->isProduction()) {
            $lines[] = 'Allow: /';
            $lines[] = '';
            $lines[] = 'Sitemap: '.route('sitemap');
        } else {
            $lines[] = 'Disallow: /';
        }

        return response(implode("\n", $lines)."\n", 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }
}
