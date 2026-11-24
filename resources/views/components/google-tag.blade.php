{{--
    Google tag (gtag.js) untuk Google Ads dan Google Tag Manager (gtm.js).
    ID diambil dari GOOGLE_TAG_ID dan GOOGLE_TAG_MANAGER_ID di .env, jadi tag
    hanya tayang di server yang mengisinya (produksi), tidak di lokal.

    Konversi dilacak lewat satu listener klik untuk seluruh halaman: setiap link
    wa.me dan tel: otomatis terhitung tanpa perlu menandai tombolnya satu per satu.

    gtag.js dan gtm.js (masing-masing ~150 KB JavaScript) tidak dimuat langsung
    karena menjadi penyebab utama Total Blocking Time di Lighthouse. Skrip baru
    diunduh saat pengunjung pertama kali berinteraksi (scroll, sentuh, klik,
    ketik) atau 4 detik setelah halaman selesai dimuat, mana yang lebih dulu. Semua panggilan gtag() sebelum
    itu tetap antre di dataLayer, jadi page view dan konversi tidak hilang.
--}}
@php
    $googleTagId = config('services.google_tag.id');
    $googleTagManagerId = config('services.google_tag_manager.id');
    $googleAdsConversions = array_filter(config('services.google_tag.conversions', []));
    $googleTagScripts = array_values(array_filter([
        $googleTagId ? 'https://www.googletagmanager.com/gtag/js?id='.$googleTagId : null,
        $googleTagManagerId ? 'https://www.googletagmanager.com/gtm.js?id='.$googleTagManagerId : null,
    ]));
@endphp
@if($googleTagScripts)
<!-- Google tag (gtag.js) & Google Tag Manager, dimuat tertunda -->
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
@if($googleTagManagerId)
    dataLayer.push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
@endif
@if($googleTagId)
    gtag('config', @js($googleTagId));
@endif

    (function () {
        var loaded = false;
        var events = ['scroll', 'pointerdown', 'touchstart', 'keydown'];

        function loadGoogleTag() {
            if (loaded) {
                return;
            }

            loaded = true;
            events.forEach(function (name) { window.removeEventListener(name, loadGoogleTag); });

            {!! json_encode($googleTagScripts, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS) !!}.forEach(function (src) {
                var script = document.createElement('script');
                script.async = true;
                script.src = src;
                document.head.appendChild(script);
            });
        }

        events.forEach(function (name) { window.addEventListener(name, loadGoogleTag, { once: true, passive: true }); });
        window.addEventListener('load', function () { setTimeout(loadGoogleTag, 4000); });
    })();
@if($googleTagId && $googleAdsConversions)

    (function () {
        var conversions = @js($googleAdsConversions);

        document.addEventListener('click', function (event) {
            var link = event.target.closest('a[href]');

            if (!link) {
                return;
            }

            var href = link.getAttribute('href');
            var type = href.indexOf('https://wa.me/') === 0 ? 'whatsapp'
                : href.indexOf('tel:') === 0 ? 'phone'
                : null;

            if (type && conversions[type]) {
                gtag('event', 'conversion', { send_to: conversions[type], transport_type: 'beacon' });
            }
        });
    })();
@endif
</script>
@endif
