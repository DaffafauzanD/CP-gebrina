@php
    $address = config('company.contact.address_parts');
    $geo = config('company.contact.geo');

    /**
     * Entitas bisnis utama. Dipasang di setiap halaman dengan @id tetap supaya
     * schema lain (Service, Breadcrumb) bisa merujuk ke entitas yang sama.
     */
    $localBusinessSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        '@id' => url('/').'#business',
        'name' => config('company.name'),
        'description' => config('company.description'),
        'url' => url('/'),
        'image' => \App\Support\VersionedAsset::url('images/hero-truck.jpg'),
        'telephone' => config('company.contact.phone_raw'),
        'email' => config('company.contact.email'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $address['street'],
            'addressLocality' => $address['locality'],
            'addressRegion' => $address['region'],
            'postalCode' => $address['postal_code'],
            'addressCountry' => $address['country'],
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => $geo['latitude'],
            'longitude' => $geo['longitude'],
        ],
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens' => '00:00',
                'closes' => '23:59',
            ],
        ],
        'areaServed' => array_map(
            fn (string $area): array => ['@type' => 'City', 'name' => $area],
            config('company.service_areas'),
        ),
        'sameAs' => array_values(array_filter(config('company.socials'))),
    ];
@endphp

@include('components.schema.json-ld', ['schema' => $localBusinessSchema])
