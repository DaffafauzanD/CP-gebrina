<?php

return [
    'name' => 'CV GEBRINA JAYA',

    /**
     * Nama situs untuk schema WebSite dan og:site_name. Sengaja bukan kapital
     * penuh: Google memakainya apa adanya sebagai judul situs di hasil
     * pencarian, dan huruf kapital memakan lebar tampilan lebih besar.
     */
    'site_name' => 'CV Gebrina Jaya',
    'tagline' => 'Spesialis Jasa Sedot WC & Septic Tank Jabodetabek - Cepat, Clean & Bergaransi',
    'description' => 'CV GEBRINA JAYA adalah penyedia layanan profesional sedot WC, pengurasan septic tank, pelancaran saluran mampet, dan penanganan limbah industri/restoran yang melayani seluruh kawasan Jabodetabek 24 jam nonstop.',

    'contact' => [
        'phone_display' => '0821-1348-4445',
        'phone_raw' => '082113484445',
        'whatsapp_display' => '0853-6007-0006',
        'whatsapp_number' => '6285360070006',
        'whatsapp_message_default' => 'Halo CV GEBRINA JAYA, saya ingin bertanya mengenai layanan sedot WC / septic tank.',
        'email' => 'cvgebrinajaya@gmail.com',
        'address' => 'Griya Asri 2 Blok I, Jl. Siaga 16 No. 62, Sumberjaya, Kabupaten Bekasi, Jawa Barat 17519',
        'google_maps_embed' => 'https://www.google.com/maps?q=-6.2240986824035645,107.07705688476562&z=17&output=embed',
        'operational_hours' => '24 Jam Nonstop (Senin - Minggu)',

        /**
         * Alamat & koordinat terstruktur, dipakai oleh JSON-LD LocalBusiness.
         */
        'address_parts' => [
            'street' => 'Griya Asri 2 Blok I, Jl. Siaga 16 No. 62, Sumberjaya',
            'locality' => 'Kabupaten Bekasi',
            'region' => 'Jawa Barat',
            'postal_code' => '17519',
            'country' => 'ID',
        ],

        'geo' => [
            'latitude' => -6.2240987,
            'longitude' => 107.0770569,
        ],
    ],

    /**
     * Sumber tunggal wilayah operasional: dipakai halaman wilayah layanan,
     * schema areaServed, dan CTA WhatsApp per wilayah.
     */
    'service_areas' => [
        'Jakarta',
        'Bogor',
        'Depok',
        'Tangerang',
        'Bekasi',
    ],

    /**
     * Profil pemilik untuk bagian "Pesan dari Pemilik" di halaman Tentang Kami.
     * Isi 'name' dengan nama asli pemilik; selama masih kosong, halaman
     * menampilkan sebutan jabatan saja supaya tidak ada nama karangan tayang.
     *
     * @var array{name: string, role: string, photo_path: string, quote: string}
     */
    'owner' => [
        'name' => '',
        'role' => 'Pemilik & Penanggung Jawab',
        'photo_path' => 'images/owner-gebrina.jpg',
        'quote' => 'Setiap panggilan pelanggan saya anggap urusan mendesak. Armada dan tim kami siaga 24 jam, dan saya sendiri yang memastikan setiap pekerjaan selesai tuntas, bersih, dan sesuai harga yang disepakati di awal.',
    ],

    'stats' => [
        [
            'number' => '15+',
            'label' => 'Tahun Pengalaman',
            'icon' => 'clock',
        ],
        [
            'number' => '12.500+',
            'label' => 'Septic Tank Disedot',
            'icon' => 'truck',
        ],
        [
            'number' => '30+',
            'label' => 'Armada Truk Tangki',
            'icon' => 'shield',
        ],
        [
            'number' => '100%',
            'label' => 'Garansi Kepuasan',
            'icon' => 'star',
        ],
    ],

    'features' => [
        [
            'title' => 'Respon Cepat 24/7',
            'desc' => 'Tim kami siap meluncur ke lokasi Anda di wilayah Jabodetabek dalam hitungan menit setelah Anda menghubungi kami.',
            'icon' => 'bolt',
        ],
        [
            'title' => 'Armada Modern & Selang Panjang',
            'desc' => 'Dilengkapi truk vakum kapasitas besar dan selang panjang hingga 100+ meter untuk jangkauan lokasi gang sempit.',
            'icon' => 'truck',
        ],
        [
            'title' => 'Hasil Kerja Bergaransi',
            'desc' => 'Pekerjaan dijamin tuntas sampai lancar kembali dengan garansi pengerjaan profesional.',
            'icon' => 'shield',
        ],
        [
            'title' => 'Petugas Profesional & Ramah',
            'desc' => 'Teknisi berpengalaman puluhan tahun, bekerja bersih, rapi, tanpa merusak konstruksi bangunan Anda.',
            'icon' => 'user-group',
        ],
    ],

    'legalities' => [
        // 'nib' => 'NIB: 9120003456781',
        // 'izin_lh' => 'Izin Pembuangan Limbah Resmi LH No. 503/128/IPL-DKI',
        // 'badan_hukum' => 'CV. GEBRINA JAYA - Akta Notaris No. 24 Tahun 2011',
    ],

    'socials' => [
        'facebook' => 'https://facebook.com',
        'instagram' => 'https://instagram.com',
        'youtube' => 'https://youtube.com',
    ],
];
