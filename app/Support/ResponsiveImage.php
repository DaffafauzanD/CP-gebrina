<?php

namespace App\Support;

/**
 * Versi .webp berukuran kecil untuk srcset.
 *
 * Foto asli lebarnya 1200px (~200 KB). Di HP layar ~400px, browser tidak
 * perlu mengunduh sebesar itu, jadi `php artisan images:webp` juga membuat
 * versi selebar WIDTHS (mis. hero-truck-480w.webp). Komponen picture lalu
 * menawarkan semuanya lewat srcset dan browser memilih yang paling pas.
 */
class ResponsiveImage
{
    /**
     * Lebar varian yang dibuat di samping berkas aslinya.
     *
     * @var array<int, int>
     */
    public const WIDTHS = [480, 800];

    public static function variantPath(string $webpPath, int $width): string
    {
        return preg_replace('/\.webp$/i', "-{$width}w.webp", $webpPath);
    }

    /**
     * Isi atribut srcset: varian yang benar-benar ada, ditambah berkas asli.
     */
    public static function srcset(string $webpPath): string
    {
        $originalWidth = self::width($webpPath);
        $candidates = [];

        foreach (self::WIDTHS as $width) {
            $variant = self::variantPath($webpPath, $width);

            if ($width < $originalWidth && is_file(public_path($variant))) {
                $candidates[] = VersionedAsset::url($variant)." {$width}w";
            }
        }

        $candidates[] = VersionedAsset::url($webpPath).($originalWidth ? " {$originalWidth}w" : '');

        return implode(', ', $candidates);
    }

    /**
     * @return array{0: int, 1: int}|null
     */
    public static function dimensions(string $path): ?array
    {
        $absolutePath = public_path($path);

        if (! is_file($absolutePath) || ! ($size = @getimagesize($absolutePath))) {
            return null;
        }

        return [$size[0], $size[1]];
    }

    protected static function width(string $path): int
    {
        return self::dimensions($path)[0] ?? 0;
    }
}
