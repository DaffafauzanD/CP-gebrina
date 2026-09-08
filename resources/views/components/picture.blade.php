@php
    /**
     * Menyajikan WebP dengan fallback JPEG. Setiap gambar situs punya pasangan
     * .webp hasil kompresi, jadi nama berkasnya cukup diturunkan.
     *
     * Kelas "contents" pada <picture> membuatnya tidak menghasilkan kotak
     * layout sendiri, sehingga kelas ukuran pada <img> tetap mengacu ke
     * elemen induk seperti sebelum dibungkus.
     */
    $jpegPath = $src;
    $webpPath = preg_replace('/\.jpe?g$/i', '.webp', $src);
@endphp

<picture class="contents">
    <source srcset="{{ asset($webpPath) }}" type="image/webp">
    <img src="{{ asset($jpegPath) }}" alt="{{ $alt }}" @if($loading ?? false) loading="{{ $loading }}" @endif class="{{ $class }}">
</picture>
