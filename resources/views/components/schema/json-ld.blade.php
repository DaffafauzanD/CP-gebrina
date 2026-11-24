{{-- Encoder JSON-LD tunggal: array PHP masuk, script aman keluar. --}}
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
