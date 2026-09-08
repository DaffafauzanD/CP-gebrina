<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

/**
 * Katalog layanan. Datanya statis dan dibaca dari config/content.php, bukan
 * dari database, karena hanya berubah ketika kode diperbarui.
 */
class Service
{
    /**
     * @return Collection<int, Fluent>
     */
    public static function all(): Collection
    {
        return collect(config('content.services'))
            ->sortBy('order')
            ->map(fn (array $service): Fluent => new Fluent($service))
            ->values();
    }

    public static function findBySlug(string $slug): ?Fluent
    {
        return static::all()->first(fn (Fluent $service): bool => $service->slug === $slug);
    }
}
