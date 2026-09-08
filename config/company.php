<?php

return [
    'name' => 'CV GEBRINA JAYA',
    'tagline' => 'Spesialis Jasa Sedot WC & Septic Tank Jabodetabek - Cepat, Clean & Bergaransi',
    'description' => 'CV GEBRINA JAYA adalah penyedia layanan profesional sedot WC, pengurasan septic tank, pelancaran saluran mampet, dan penanganan limbah industri/restoran yang melayani seluruh kawasan Jabodetabek 24 jam nonstop.',

    'contact' => [
        'phone_display' => '0821-1348-4445',
        'phone_raw' => '082113484445',
        'whatsapp_display' => '0853-6007-0006',
        'whatsapp_number' => '6285360070006',
        'whatsapp_message_default' => 'Halo CV GEBRINA JAYA, saya ingin bertanya mengenai layanan sedot WC / septic tank.',
        'email' => 'cvgebrinajaya@gmail.com',
        'address' => 'jabodetabek',
        'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126906.87785461972!2d106.81525287667823!3d-6.310931215444855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed01b8744577%3A0x401e5f1e0d315f0!2sCiracas%2C%20East%20Jakarta%20City%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid',
        'operational_hours' => '24 Jam Nonstop (Senin - Minggu)',

        /**
         * Alamat & koordinat terstruktur, dipakai oleh JSON-LD LocalBusiness.
         */
        'address_parts' => [
            'street' => 'Jl. Raya Bogor KM 26 No. 88, Ciracas',
            'locality' => 'Jakarta Timur',
            'region' => 'DKI Jakarta',
            'postal_code' => '13740',
            'country' => 'ID',
        ],

        'geo' => [
            'latitude' => -6.310931,
            'longitude' => 106.876678,
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
