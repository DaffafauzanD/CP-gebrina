<?php

namespace Tests\Feature;

use App\Models\Service;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_returns_successful_response(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_about_page_returns_successful_response(): void
    {
        $this->get('/tentang-kami')->assertOk();
    }

    public function test_services_index_page_returns_successful_response(): void
    {
        $this->get('/layanan')->assertOk();
    }

    public function test_service_show_page_returns_successful_response(): void
    {
        $service = Service::all()->first();

        $this->get('/layanan/'.$service->slug)->assertOk();
    }

    public function test_unknown_service_slug_returns_not_found(): void
    {
        $this->get('/layanan/layanan-yang-tidak-ada')->assertNotFound();
    }

    public function test_areas_page_returns_successful_response(): void
    {
        $this->get('/wilayah-layanan')->assertOk();
    }

    public function test_gallery_page_returns_successful_response(): void
    {
        $this->get('/galeri')->assertOk();
    }

    public function test_contact_page_returns_not_found(): void
    {
        $this->get('/kontak')->assertNotFound();
    }
}
