@php
    /**
     * @var \App\Models\Service $service
     */
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => route('services.show', $service->slug).'#service',
        'name' => $service->name,
        'serviceType' => $service->name,
        'description' => $service->short_description,
        'url' => route('services.show', $service->slug),
        'image' => asset($service->image_path ?? 'images/hero-truck.jpg'),
        'provider' => ['@id' => url('/').'#business'],
        'areaServed' => array_map(
            fn (string $area): array => ['@type' => 'City', 'name' => $area],
            config('company.service_areas'),
        ),
        'availableChannel' => [
            '@type' => 'ServiceChannel',
            'serviceUrl' => route('services.show', $service->slug),
            'servicePhone' => config('company.contact.phone_raw'),
        ],
    ];
@endphp

@include('components.schema.json-ld', ['schema' => $serviceSchema])
