@php
    /**
     * Sumber utama yang dibaca Google untuk menentukan nama situs di hasil
     * pencarian. Tanpa ini Google menyimpulkannya sendiri dan sempat
     * menampilkan brand sebagai "cv gebrina jaya" huruf kecil.
     *
     * Hanya dipasang di beranda: Google mengabaikan WebSite di halaman lain.
     */
    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/').'#website',
        'name' => config('company.site_name'),
        'alternateName' => config('company.name'),
        'url' => url('/'),
        'inLanguage' => 'id-ID',
        'publisher' => ['@id' => url('/').'#business'],
    ];
@endphp

@include('components.schema.json-ld', ['schema' => $websiteSchema])
