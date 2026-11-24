@php
    /**
     * Satu tempat untuk seluruh meta tag SEO. Setiap halaman boleh menimpa
     * nilainya lewat section: title, meta_description, canonical, robots,
     * og_type, og_image, dan og_image_alt.
     *
     * Catatan: Blade sudah menjalankan e() pada isi section inline, jadi nilai
     * default di sini ikut di-escape lalu dicetak mentah supaya tidak dobel.
     */
    $seoTitle = $__env->yieldContent('title', e(config('company.name').' - '.config('company.tagline')));
    $seoDescription = $__env->yieldContent('meta_description', e(config('company.description')));
    $seoCanonical = $__env->yieldContent('canonical', e(url()->current()));
    $seoRobots = $__env->yieldContent('robots', e('index, follow, max-image-preview:large, max-snippet:-1'));
    $seoOgType = $__env->yieldContent('og_type', e('website'));
    $seoOgImage = $__env->yieldContent('og_image', e(\App\Support\VersionedAsset::url('images/hero-truck.jpg')));
    $seoOgImageAlt = $__env->yieldContent('og_image_alt', e(config('company.name')));
@endphp

<title>{!! $seoTitle !!}</title>
<meta name="description" content="{!! $seoDescription !!}">
<meta name="robots" content="{!! $seoRobots !!}">
<meta name="author" content="{{ config('company.name') }}">
<link rel="canonical" href="{!! $seoCanonical !!}">

<!-- Open Graph / Facebook / WhatsApp -->
<meta property="og:site_name" content="{{ config('company.site_name') }}">
<meta property="og:locale" content="id_ID">
<meta property="og:type" content="{!! $seoOgType !!}">
<meta property="og:url" content="{!! $seoCanonical !!}">
<meta property="og:title" content="{!! $seoTitle !!}">
<meta property="og:description" content="{!! $seoDescription !!}">
<meta property="og:image" content="{!! $seoOgImage !!}">
<meta property="og:image:alt" content="{!! $seoOgImageAlt !!}">

<!-- Twitter / X -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{!! $seoTitle !!}">
<meta name="twitter:description" content="{!! $seoDescription !!}">
<meta name="twitter:image" content="{!! $seoOgImage !!}">
