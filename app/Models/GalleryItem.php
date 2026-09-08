<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

/**
 * Dokumentasi foto pekerjaan dan armada, dibaca dari config/content.php.
 */
class GalleryItem
{
    /**
     * @return Collection<int, Fluent>
     */
    public static function all(): Collection
    {
        return collect(config('content.gallery'))
            ->map(fn (array $item): Fluent => new Fluent($item))
            ->values();
    }

    /**
     * Daftar kategori untuk tab filter, termasuk opsi "Semua Foto".
     *
     * @return array<string, string>
     */
    public static function categories(): array
    {
        return config('content.gallery_categories');
    }
}
