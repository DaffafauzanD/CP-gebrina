@php
    /**
     * Menyajikan WebP dengan fallback JPEG. Setiap gambar situs punya pasangan
     * .webp hasil kompresi, jadi nama berkasnya cukup diturunkan.
     *
     * URL memakai VersionedAsset agar foto yang diganti dengan nama berkas
     * sama langsung terlihat oleh semua pengunjung tanpa hard refresh.
     *
     * srcset berisi varian 480w/800w (lihat ResponsiveImage) dan $sizes memberi
     * tahu browser lebar tampil gambar, sehingga HP mengunduh versi kecil.
     * $priority dipakai untuk gambar utama di layar pertama (elemen LCP):
     * diunduh lebih dulu dan tidak pernah di-lazy-load.
     *
     * Kelas "contents" pada <picture> membuatnya tidak menghasilkan kotak
     * layout sendiri, sehingga kelas ukuran pada <img> tetap mengacu ke
     * elemen induk seperti sebelum dibungkus.
     */
    $jpegPath = $src;
    $webpPath = preg_replace('/\.jpe?g$/i', '.webp', $src);
    $sizes ??= '100vw';
    $priority ??= false;
    $loading = $priority ? null : ($loading ?? null);
    $dimensions = \App\Support\ResponsiveImage::dimensions($jpegPath);
@endphp

<picture class="contents">
    <source srcset="{{ \App\Support\ResponsiveImage::srcset($webpPath) }}" sizes="{{ $sizes }}" type="image/webp">
    <img src="{{ \App\Support\VersionedAsset::url($jpegPath) }}" alt="{{ $alt }}" @if($dimensions) width="{{ $dimensions[0] }}" height="{{ $dimensions[1] }}" @endif @if($loading) loading="{{ $loading }}" @endif @if($priority) fetchpriority="high" @else decoding="async" @endif class="{{ $class }}">
</picture>
