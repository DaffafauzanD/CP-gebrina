<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Providers\AppServiceProvider;
use App\Support\VersionedAsset;
use Tests\TestCase;

class SeoTest extends TestCase
{
    public function test_robots_txt_is_served_dynamically_and_blocks_non_production(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $response->assertSee('Disallow: /', false);
    }

    public function test_robots_txt_opens_crawling_and_points_to_sitemap_in_production(): void
    {
        $this->app->detectEnvironment(fn (): string => 'production');

        $response = $this->get('/robots.txt');

        $response->assertOk();
        $response->assertSee('Allow: /', false);
        $response->assertSee('Sitemap: '.route('sitemap'), false);
    }

    public function test_canonical_and_sitemap_urls_use_app_url_host_regardless_of_requested_host_in_production(): void
    {
        config(['app.url' => 'https://www.cvgebrinajaya.com']);
        $this->app->detectEnvironment(fn (): string => 'production');
        (new AppServiceProvider($this->app))->boot();

        $this->get('https://cvgebrinajaya.com/')
            ->assertOk()
            ->assertSee('<link rel="canonical" href="https://www.cvgebrinajaya.com">', false)
            ->assertDontSee('href="https://cvgebrinajaya.com', false);

        $this->get('https://cvgebrinajaya.com/sitemap.xml')
            ->assertOk()
            ->assertSee('<loc>https://www.cvgebrinajaya.com/layanan</loc>', false)
            ->assertDontSee('<loc>https://cvgebrinajaya.com', false);
    }

    public function test_sitemap_lists_every_service_detail_page(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $this->assertStringStartsWith('<?xml version="1.0" encoding="UTF-8"?>', $response->getContent());
        $response->assertSee(route('home'), false);

        foreach (Service::all() as $service) {
            $response->assertSee(route('services.show', $service->slug), false);
        }
    }

    public function test_home_page_exposes_local_business_structured_data(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('"@type":"LocalBusiness"', false);
        $response->assertSee('<link rel="canonical" href="'.route('home').'">', false);
    }

    public function test_service_detail_page_exposes_service_and_breadcrumb_structured_data(): void
    {
        $service = Service::all()->first();

        $response = $this->get(route('services.show', $service->slug));

        $response->assertOk();
        $response->assertSee('"@type":"Service"', false);
        $response->assertSee('"@type":"BreadcrumbList"', false);
        $response->assertSee('<meta property="og:image" content="'.VersionedAsset::url($service->image_path).'">', false);
    }

    public function test_gallery_is_indexable_with_a_single_canonical_url(): void
    {
        $this->get(route('gallery'))
            ->assertOk()
            ->assertSee('<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">', false)
            ->assertSee('<link rel="canonical" href="'.route('gallery').'">', false);
    }

    public function test_meta_tags_are_escaped_exactly_once(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Sedot WC &amp; Septic Tank', false);
        $response->assertDontSee('&amp;amp;', false);
    }

    public function test_images_are_served_as_webp_with_jpeg_fallback(): void
    {
        $this->get(route('gallery'))
            ->assertOk()
            ->assertSee('type="image/webp"', false)
            ->assertSee('.webp', false);
    }

    public function test_every_image_url_on_the_site_carries_a_cache_busting_version(): void
    {
        $urls = [route('home'), route('about'), route('gallery'), route('services.index'), route('services.show', 'sedot-wc-kantor-ruko')];

        foreach ($urls as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            preg_match_all('#/images/[^"\'\s?]+\.(?:jpe?g|webp|png)(\?v=[0-9a-f]+)?#i', $html, $matches, PREG_SET_ORDER);

            $this->assertNotEmpty($matches, "Tidak ada gambar ditemukan di {$url}");

            foreach ($matches as $match) {
                $this->assertArrayHasKey(
                    1,
                    $match,
                    "URL gambar tanpa ?v= di {$url}: {$match[0]}. Browser akan terus memakai foto lama dari cache. Pakai VersionedAsset::url().",
                );
            }
        }
    }

    public function test_page_titles_keep_the_geo_keyword_visible_in_search_results(): void
    {
        $urls = [
            route('home'),
            route('services.index'),
            route('areas'),
            route('services.show', 'sedot-wc-rumahan'),
            route('services.show', 'sedot-limbah-industri-restoran'),
        ];

        foreach ($urls as $url) {
            preg_match('#<title>(.*?)</title>#', $this->get($url)->getContent(), $matches);

            $title = html_entity_decode($matches[1]);

            $this->assertLessThanOrEqual(62, mb_strlen($title), "Judul terlalu panjang: {$title}");
            $this->assertStringContainsString('Jabodetabek', $title);
            $this->assertLessThan(
                40,
                mb_strpos($title, 'Jabodetabek'),
                "Jabodetabek terlalu jauh di belakang dan akan dipotong Google: {$title}",
            );
        }
    }

    public function test_home_page_declares_the_site_name_google_should_display(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('"@type":"WebSite"', false)
            ->assertSee('"name":"CV Gebrina Jaya"', false);
    }

    public function test_every_referenced_image_exists_with_a_webp_pair(): void
    {
        $paths = collect(config('content.services'))
            ->merge(config('content.gallery'))
            ->pluck('image_path')
            ->push('images/hero-truck.jpg')
            ->push(config('company.owner.photo_path'))
            ->unique();

        foreach ($paths as $path) {
            $jpeg = public_path($path);
            $webp = preg_replace('/[.]jpe?g$/i', '.webp', $jpeg);

            $this->assertFileExists($jpeg, "Gambar tidak ada: {$path}");
            $this->assertFileExists(
                $webp,
                "Pasangan .webp hilang untuk {$path}. <picture> menawarkan webp lebih dulu, "
                .'jadi gambar akan gagal tampil total, bukan turun ke jpeg. Jalankan: php artisan images:webp',
            );
        }
    }

    public function test_gallery_never_shows_the_same_photo_twice(): void
    {
        $hashes = collect(config('content.gallery'))
            ->map(fn (array $item): string => md5_file(public_path($item['image_path'])));

        $this->assertSame(
            $hashes->count(),
            $hashes->unique()->count(),
            'Ada foto galeri yang isinya kembar, pengunjung akan melihat gambar sama dua kali.',
        );
    }

    public function test_google_tag_is_rendered_in_head_when_tag_id_is_configured(): void
    {
        config(['services.google_tag.id' => 'AW-1234567890']);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('https://www.googletagmanager.com/gtag/js?id=AW-1234567890', false);
        $response->assertSee("gtag('config', 'AW-1234567890');", false);
        $this->assertLessThan(
            strpos($response->getContent(), '</head>'),
            strpos($response->getContent(), 'googletagmanager.com'),
        );
    }

    public function test_google_ads_conversions_are_tracked_for_whatsapp_and_phone_clicks(): void
    {
        config([
            'services.google_tag.id' => 'AW-1234567890',
            'services.google_tag.conversions' => [
                'whatsapp' => 'AW-1234567890/wa-label',
                'phone' => 'AW-1234567890/phone-label',
            ],
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('wa-label', false);
        $response->assertSee('phone-label', false);
        $response->assertSee("gtag('event', 'conversion'", false);
    }

    public function test_header_offers_a_phone_link_next_to_whatsapp_for_call_conversions(): void
    {
        $content = $this->get('/')->assertOk()->getContent();
        $header = substr($content, 0, strpos($content, '<main') ?: strlen($content));
        $phoneLink = 'href="tel:'.config('company.contact.phone_raw').'"';

        $this->assertGreaterThanOrEqual(3, substr_count($header, $phoneLink), 'Header harus punya link telepon di desktop, ikon mobile, dan menu mobile.');
    }

    public function test_google_ads_conversion_listener_is_omitted_without_conversion_labels(): void
    {
        config([
            'services.google_tag.id' => 'AW-1234567890',
            'services.google_tag.conversions' => ['whatsapp' => null, 'phone' => null],
        ]);

        $this->get('/')->assertOk()->assertDontSee("gtag('event', 'conversion'", false);
    }

    public function test_google_tag_script_is_deferred_until_interaction_or_after_load(): void
    {
        config(['services.google_tag.id' => 'AW-1234567890']);

        $content = $this->get('/')->assertOk()->getContent();

        $this->assertStringNotContainsString('<script async src="https://www.googletagmanager.com', $content);
        $this->assertStringContainsString("window.addEventListener('load'", $content);
    }

    public function test_hero_image_is_prioritized_and_offers_responsive_webp_variants(): void
    {
        $content = $this->get('/')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('#hero-truck-480w\.webp\?v=[0-9a-f]+ 480w#', $content);
        $this->assertMatchesRegularExpression('#<img src="[^"]*hero-truck\.jpg[^"]*"[^>]*fetchpriority="high"#', $content);
        $this->assertDoesNotMatchRegularExpression('#<img src="[^"]*hero-truck\.jpg[^"]*"[^>]*loading="lazy"#', $content);
    }

    public function test_google_fonts_stylesheet_does_not_block_rendering(): void
    {
        $content = $this->get('/')->assertOk()->getContent();

        $this->assertDoesNotMatchRegularExpression('#<link href="https://fonts\.googleapis\.com/css2[^"]*" rel="stylesheet">#', $content);
        $this->assertStringContainsString('rel="preload" as="style" href="https://fonts.googleapis.com/css2', $content);
    }

    public function test_google_tag_manager_container_is_loaded_when_configured(): void
    {
        config([
            'services.google_tag.id' => null,
            'services.google_tag_manager.id' => 'GTM-TEST123',
        ]);

        $content = $this->get('/')->assertOk()->getContent();
        $head = substr($content, 0, strpos($content, '</head>'));

        $this->assertStringContainsString('https://www.googletagmanager.com/gtm.js?id=GTM-TEST123', $head);
        $this->assertStringContainsString("'gtm.start'", $head);
        $this->assertStringContainsString('googletagmanager.com/ns.html?id=GTM-TEST123', $content);
        $this->assertStringNotContainsString("gtag('config'", $content);
    }

    public function test_google_tag_manager_and_ads_tag_can_run_together(): void
    {
        config([
            'services.google_tag.id' => 'AW-1234567890',
            'services.google_tag_manager.id' => 'GTM-TEST123',
        ]);

        $this->get('/')->assertOk()
            ->assertSee('https://www.googletagmanager.com/gtag/js?id=AW-1234567890', false)
            ->assertSee('https://www.googletagmanager.com/gtm.js?id=GTM-TEST123', false);
    }

    public function test_icon_only_header_controls_have_accessible_names(): void
    {
        $content = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('aria-label="Buka menu navigasi"', $content);
        $this->assertStringContainsString('aria-label="Chat WhatsApp CV GEBRINA JAYA"', $content);
    }

    public function test_responses_include_security_headers(): void
    {
        $this->get('/')->assertOk()
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Cross-Origin-Opener-Policy', 'same-origin-allow-popups')
            ->assertHeaderMissing('Strict-Transport-Security');
    }

    public function test_google_tag_is_omitted_when_tag_id_is_not_configured(): void
    {
        config(['services.google_tag.id' => null, 'services.google_tag_manager.id' => null]);

        $this->get('/')->assertOk()->assertDontSee('googletagmanager.com', false);
    }
}
