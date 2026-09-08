<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    /**
     * Sitemap XML. Hanya memuat <loc> dan <lastmod>: <changefreq> dan
     * <priority> sengaja tidak dipakai karena diabaikan mesin pencari, dan
     * lastmod palsu (now()) justru melemahkan sinyal crawl.
     */
    public function __invoke(): Response
    {
        $contentUpdatedAt = Carbon::parse(config('content.updated_at'));

        $urls = [
            ['loc' => route('home'), 'lastmod' => $contentUpdatedAt],
            ['loc' => route('services.index'), 'lastmod' => $contentUpdatedAt],
            ['loc' => route('areas')],
            ['loc' => route('gallery'), 'lastmod' => $contentUpdatedAt],
            ['loc' => route('about')],
        ];

        foreach (Service::all() as $service) {
            $urls[] = [
                'loc' => route('services.show', $service->slug),
                'lastmod' => $contentUpdatedAt,
            ];
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
