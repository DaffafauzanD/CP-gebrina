<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

/**
 * Testimoni pelanggan, dibaca dari config/content.php.
 */
class Testimonial
{
    /**
     * @return Collection<int, Fluent>
     */
    public static function all(): Collection
    {
        return collect(config('content.testimonials'))
            ->map(fn (array $testimonial): Fluent => new Fluent($testimonial))
            ->values();
    }
}
