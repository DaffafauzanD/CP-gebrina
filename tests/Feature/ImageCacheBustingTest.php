<?php

namespace Tests\Feature;

use App\Support\VersionedAsset;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ImageCacheBustingTest extends TestCase
{
    protected string $publicPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->publicPath = storage_path('framework/testing/public-'.uniqid());
        File::ensureDirectoryExists($this->publicPath.'/images');
        $this->app->usePublicPath($this->publicPath);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->publicPath);

        parent::tearDown();
    }

    public function test_image_url_changes_when_the_photo_is_replaced_under_the_same_name(): void
    {
        File::put($this->publicPath.'/images/foto.jpg', 'foto lama');
        $oldUrl = VersionedAsset::url('images/foto.jpg');

        File::put($this->publicPath.'/images/foto.jpg', 'foto baru');
        $newUrl = VersionedAsset::url('images/foto.jpg');

        $this->assertStringStartsWith(asset('images/foto.jpg').'?v=', $oldUrl);
        $this->assertNotSame($oldUrl, $newUrl);
    }

    public function test_image_url_stays_the_same_while_the_photo_is_unchanged(): void
    {
        File::put($this->publicPath.'/images/foto.jpg', 'isi sama');
        $firstUrl = VersionedAsset::url('images/foto.jpg');

        touch($this->publicPath.'/images/foto.jpg', time() + 3600);
        clearstatcache();

        $this->assertSame($firstUrl, VersionedAsset::url('images/foto.jpg'));
    }

    public function test_missing_image_falls_back_to_the_plain_url(): void
    {
        $this->assertSame(asset('images/tidak-ada.jpg'), VersionedAsset::url('images/tidak-ada.jpg'));
    }
}
