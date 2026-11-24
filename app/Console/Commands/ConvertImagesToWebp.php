<?php

namespace App\Console\Commands;

use App\Support\ResponsiveImage;
use GdImage;
use Illuminate\Console\Command;

/**
 * Menjaga setiap foto .jpg di public/images punya pasangan .webp.
 *
 * Komponen <x-picture> menyajikan .webp lebih dulu dengan .jpg sebagai
 * cadangan. Kalau pasangan .webp hilang, browser sudah terlanjur memilih
 * source webp dan gambarnya gagal tampil sama sekali, bukan turun ke jpg.
 * Jadi perintah ini wajib dijalankan setiap kali menambah atau mengganti foto.
 *
 * Selain itu dibuat juga varian kecil (ResponsiveImage::WIDTHS) untuk srcset,
 * supaya pengunjung HP tidak mengunduh foto 1200px.
 */
class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:webp
                            {--force : Buat ulang semua .webp, termasuk yang sudah ada}
                            {--width=1200 : Lebar maksimum foto, sisanya diperkecil proporsional}
                            {--quality=75 : Kualitas WebP (0-100)}';

    protected $description = 'Perkecil foto di public/images dan buat pasangan .webp-nya';

    public function handle(): int
    {
        $maxWidth = (int) $this->option('width');
        $quality = (int) $this->option('quality');
        $converted = 0;
        $skipped = 0;

        foreach ($this->sourceImages() as $jpegPath) {
            $webpPath = preg_replace('/\.jpe?g$/i', '.webp', $jpegPath);

            if (! $this->option('force') && $this->isUpToDate($jpegPath, $webpPath)) {
                $skipped++;

                continue;
            }

            $image = @imagecreatefromjpeg($jpegPath);

            if ($image === false) {
                $this->components->error('Gagal membaca '.$this->relative($jpegPath));

                return self::FAILURE;
            }

            if (imagesx($image) > $maxWidth) {
                $image = imagescale($image, $maxWidth);
                imagejpeg($image, $jpegPath, 82);
            }

            imagewebp($image, $webpPath, $quality);
            $this->writeVariants($image, $webpPath, $quality);
            imagedestroy($image);

            $this->components->twoColumnDetail(
                $this->relative($webpPath),
                number_format(filesize($webpPath) / 1024).' KB',
            );

            $converted++;
        }

        $this->newLine();
        $this->components->info("{$converted} foto dikonversi, {$skipped} sudah mutakhir.");

        return self::SUCCESS;
    }

    /**
     * @return array<int, string>
     */
    protected function sourceImages(): array
    {
        return glob(public_path('images').'/{,*/}*.{jpg,jpeg,JPG,JPEG}', GLOB_BRACE) ?: [];
    }

    protected function writeVariants(GdImage $image, string $webpPath, int $quality): void
    {
        foreach (ResponsiveImage::WIDTHS as $width) {
            if ($width >= imagesx($image)) {
                continue;
            }

            $variant = imagescale($image, $width);
            imagewebp($variant, ResponsiveImage::variantPath($webpPath, $width), $quality);
            imagedestroy($variant);
        }
    }

    protected function isUpToDate(string $jpegPath, string $webpPath): bool
    {
        if (! file_exists($webpPath) || filemtime($webpPath) < filemtime($jpegPath)) {
            return false;
        }

        $width = getimagesize($jpegPath)[0] ?? 0;

        foreach (ResponsiveImage::WIDTHS as $variantWidth) {
            if ($variantWidth < $width && ! file_exists(ResponsiveImage::variantPath($webpPath, $variantWidth))) {
                return false;
            }
        }

        return true;
    }

    protected function relative(string $path): string
    {
        return str_replace(base_path().DIRECTORY_SEPARATOR, '', $path);
    }
}
