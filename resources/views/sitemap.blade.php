{{-- Dirangkai per potongan supaya "<" dan "?" tidak pernah bersebelahan di
     source: kalau short_open_tag aktif, tokenizer Blade akan mengira itu tag
     pembuka PHP dan gagal mengompilasi baris ini. --}}
{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
@if (! empty($url['lastmod']))
        <lastmod>{{ $url['lastmod']->toAtomString() }}</lastmod>
@endif
    </url>
@endforeach
</urlset>
