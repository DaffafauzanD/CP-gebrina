<?php

namespace Tests\Feature;

use App\Models\Service;
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
        $response->assertSee('<meta property="og:image" content="'.asset($service->image_path).'">', false);
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
}
