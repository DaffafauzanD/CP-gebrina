<?php

/**
 * Konten situs. Sengaja disimpan sebagai konfigurasi, bukan tabel database:
 * isinya hanya berubah ketika kode diperbarui, tidak ada form maupun panel
 * admin yang menulisinya. Menjalankan MySQL untuk data sebanyak ini hanya
 * menambah biaya hosting dan titik kegagalan tanpa manfaat.
 *
 * Cara memperbarui konten: edit berkas ini, lalu unggah ulang ke server.
 */

return [
    /**
     * Tanggal perubahan konten terakhir, dipakai sebagai <lastmod> di sitemap.
     * Perbarui setiap kali isi berkas ini diubah.
     */
    'updated_at' => '2026-09-08',

    'services' => [
        [
            'name' => 'Sedot WC Rumahan & Perumahan',
            'slug' => 'sedot-wc-rumahan',
            'short_description' => 'Layanan kuras septic tank penuh untuk rumah tinggal, kontrakan, & perumahan dengan truk vakum bertenaga tinggi.',
            'description' => 'Layanan Sedot WC Rumahan dari CV GEBRINA JAYA dirancang khusus untuk mengatasi masalah septic tank penuh pada hunian Anda. Menggunakan armada truk tangki vakum modern berkapasitas besar dan selang hingga 100 meter, kami mampu menjangkau lokasi perkampungan maupun gang sempit tanpa mengganggu kenyamanan tetangga.

Kami menjamin proses kerja yang higienis, bersih, tanpa bau menyengat yang tertinggal, serta tanpa perlu membongkar struktur fisik rumah Anda secara berlebihan.',
            'icon' => 'home',
            'image_path' => 'images/services/service-sedot-wc.jpg',
            'features' => [
                'Selang ekstra panjang hingga 100+ meter',
                'Proses sedot cepat & tanpa bau menyengat',
                'Penanganan profesional tanpa merusak ubin',
                'Garansi pekerjaan 30 hari',
            ],
            'order' => 1,
        ],
        [
            'name' => 'Sedot WC Kantor, Ruko & Gedung',
            'slug' => 'sedot-wc-kantor-ruko',
            'short_description' => 'Solusi pengurasan septic tank skala besar untuk area komersial, ruko, perkantoran, rumah sakit, & gedung bertingkat.',
            'description' => 'Layanan khusus untuk sektor usaha, kantor, ruko, restoran, dan fasilitas publik. Penanganan septic tank berkapasitas besar membutuhkan armada truk vakum khusus bertekanan tinggi yang siap bekerja di luar jam operasional kantor Anda (malam/akhir pekan) agar tidak mengganggu operasional bisnis.

Tim CV GEBRINA JAYA dibekali APD lengkap dan standar K3 lingkungan yang ketat untuk menjamin keamanan area kerja komersial Anda.',
            'icon' => 'building-office',
            'image_path' => 'images/services/service-kantor.jpg',
            'features' => [
                'Melayani pengerjaan malam / luar jam kerja',
                'Armada kapasitas tangki besar (4000-6000 Liter)',
                'Faktur tagihan & kelengkapan administrasi resmi',
                'Penanganan standar K3 & ramah lingkungan',
            ],
            'order' => 2,
        ],
        [
            'name' => 'Pelancaran Saluran Mampet (Tanpa Bongkar)',
            'slug' => 'pelancaran-saluran-mampet',
            'short_description' => 'Atasi saluran pipa meluap, wastafel tersumbat, kran mati, atau floor drain mampet dengan teknologi modern tanpa pembongkaran.',
            'description' => 'Saluran pipa tersumbat lemak, sisa makanan, rambut, atau kerak semen? Jangan terburu-buru membongkar keramik lantai Anda! CV GEBRINA JAYA menggunakan mesin *spiral rigid cleaner* canggih dan *high-pressure hydro-jetting* yang mampu menghancurkan sumbatan di dalam saluran pipa PVC tanpa merusak pipa atau struktur bangunan.

Proses pengerjaan cepat (30-60 menit) dan saluran langsung lancar seperti baru kembali.',
            'icon' => 'wrench-screwdriver',
            'image_path' => 'images/services/service-saluran-mampet.jpg',
            'features' => [
                'Teknologi Spiral Roto-Rooter modern',
                'Tanpa bongkar lantai & keramik',
                'Mampu menghancurkan kerak lemak & lemak restoran',
                'Garansi saluran lancar 100%',
            ],
            'order' => 3,
        ],
        [
            'name' => 'Pembuatan & Perbaikan Septic Tank Baru',
            'slug' => 'pembuatan-septic-tank-baru',
            'short_description' => 'Jasa kontraksi pembuatan septic tank kedap air, sistem resapan biopori modern, & perbaikan dinding septic tank retak.',
            'description' => 'Septic tank lama Anda sering penuh meski baru disedot? Itu tandanya resapan air sudah tersumbat lumpur atau terjadi resapan buruk. CV GEBRINA JAYA melayani jasa pembuatan septic tank baru berstandar SNI dengan sistem filter bio-tech atau beton kedap air yang tahan puluhan tahun.

Kami juga melayani renovasi septic tank lama, pembuatan resapan baru, serta pemasangan pipa ventilasi udara anti-meledak.',
            'icon' => 'cog-6-teeth',
            'image_path' => 'images/services/service-septic-tank.jpg',
            'features' => [
                'Standar konstruksi SNI & ramah lingkungan',
                'Sistem bio-filter pencegah bau & cepat rembes',
                'Termasuk penggalian & kerapian struktur',
                'Daya tahan puluhan tahun',
            ],
            'order' => 4,
        ],
        [
            'name' => 'Sedot Limbah Industri & Restoran (Fat Trap)',
            'slug' => 'sedot-limbah-industri-restoran',
            'short_description' => 'Pengangkutan limbah cair non-B3, lemak olahan makanan (grease trap) restoran, & pengurasan kolam penampungan.',
            'description' => 'Lumpur olahan makanan (grease trap) pada restoran dan cafe jika dibiarkan dapat menimbulkan bau membusuk dan menyumbat saluran utama. CV GEBRINA JAYA menyediakan kontrak perawatan rutin maupun panggilan darurat pengurasan limbah lemak cair dan limbah pabrik non-B3.

Seluruh limbah yang diangkut akan dibuang ke Tempat Pembuangan Limbah Resmi (IPLT) yang terdaftar pada Dinas Lingkungan Hidup.',
            'icon' => 'beaker',
            'image_path' => 'images/services/service-limbah.jpg',
            'features' => [
                'Pembersihan total jebakan lemak (grease trap)',
                'Disposal ke IPLT resmi Pemda',
                'Tersedia paket langganan bulanan restoran',
                'Surat keterangan pembuangan resmi',
            ],
            'order' => 5,
        ],
    ],

    'gallery_categories' => [
        'all' => 'Semua Foto',
        'sedot-wc' => 'Sedot WC',
        'saluran-mampet' => 'Saluran Mampet',
        'septic-tank' => 'Septic Tank',
        'limbah-industri' => 'Limbah & Restoran',
        'armada' => 'Armada & Tim',
    ],

    'gallery' => [
        [
            'title' => 'Armada Truk Tangki Vakum Modern CV GEBRINA JAYA',
            'image_path' => 'images/gallery/truk-armada-1.jpg',
            'category' => 'armada',
            'description' => 'Truk tangki vakum kapasitas 5000 Liter siap melayani kawasan Jakarta & sekitarnya.',
        ],
        [
            'title' => 'Penyedotan Septic Tank Perumahan di Kebayoran Baru',
            'image_path' => 'images/gallery/sedot-wc-rumah-1.jpg',
            'category' => 'sedot-wc',
            'description' => 'Proses pengurasan penuh tanpa bongkar keramik dengan selang jangkauan 50 meter.',
        ],
        [
            'title' => 'Pelancaran Pipa Wastafel Mampet Restoran di BSD Tangerang',
            'image_path' => 'images/gallery/saluran-mampet-1.jpg',
            'category' => 'saluran-mampet',
            'description' => 'Pembersihan endapan lemak membeku menggunakan mesin spiral roto-cleaner.',
        ],
        [
            'title' => 'Pengurasan Grease Trap & Penampungan Lemak Restoran',
            'image_path' => 'images/gallery/limbah-restoran-1.jpg',
            'category' => 'limbah-industri',
            'description' => 'Penyedotan limbah cair lemak restoran secara berkala dengan standar higienis.',
        ],
        [
            'title' => 'Pembuatan Septic Tank Bio-Tech Kedap Air di Depok',
            'image_path' => 'images/gallery/septic-tank-baru-1.jpg',
            'category' => 'septic-tank',
            'description' => 'Konstruksi septic tank biopori ramah lingkungan bebas bau dan tahan bocor.',
        ],
        [
            'title' => 'Tim Teknisi Berpengalaman Siap Bertugas 24/7',
            'image_path' => 'images/gallery/tim-teknisi-1.jpg',
            'category' => 'armada',
            'description' => 'Petugas profesional dibekali seragam dan perlengkapan K3 keselamatan kerja.',
        ],
        [
            'title' => 'Proses Sedot Septic Tank Gedung Perkantoran Cikarang',
            'image_path' => 'images/gallery/sedot-wc-kantor-1.jpg',
            'category' => 'sedot-wc',
            'description' => 'Pengerjaan pengurasan septic tank skala besar pada jam malam di area pabrik.',
        ],
        [
            'title' => 'Pembersihan Saluran Kloset Tersumbat di Perumahan Cibubur',
            'image_path' => 'images/gallery/saluran-mampet-2.jpg',
            'category' => 'saluran-mampet',
            'description' => 'Pelancaran kloset meluap dalam hitungan menit tanpa merusak pipa bawah tanah.',
        ],
    ],

    'testimonials' => [
        [
            'customer_name' => 'Bpk. Hendra Gunawan',
            'location' => 'Kebayoran Baru, Jakarta Selatan',
            'content' => 'Sangat puas dengan pelayanan CV Gebrina Jaya. Malam hari jam 10 WC rumah meluap, respon via WhatsApp super cepat. Dalam 45 menit armada truk sudah datang ke rumah dan pengerjaannya sangat bersih tanpa bau!',
            'rating' => 5,
            'service_used' => 'Sedot WC Rumahan',
        ],
        [
            'customer_name' => 'Ibu Ratna Dewi',
            'location' => 'BSD City, Tangerang Selatan',
            'content' => 'Rumah saya ada di gang yang lumayan sempit, tapi teknisi membawa selang panjang 60 meter jadi bisa sampai ke septic tank belakang. Pelayanannya sangat cepat dan profesional. Recommended!',
            'rating' => 5,
            'service_used' => 'Sedot WC Rumahan',
        ],
        [
            'customer_name' => 'Pak Bambang (Manager Restoran)',
            'location' => 'Margonda, Depok',
            'content' => 'Sudah langganan kuras grease trap & saluran kitchen mampet di CV Gebrina Jaya. Selalu datang tepat waktu di luar jam buka resto. Kerja rapi, tidak merusak pipa, dan ada garansinya.',
            'rating' => 5,
            'service_used' => 'Sedot Limbah Restoran',
        ],
        [
            'customer_name' => 'Bpk. Irwan Syahputra',
            'location' => 'Cibinong, Bogor',
            'content' => 'Dulu septic tank di rumah cepat penuh terus walau baru disedot. Konsultasi sama Pak teknisi Gebrina Jaya disarankan bikin resapan biopori baru. Sekarang sudah 2 tahun aman tidak pernah mampet lagi!',
            'rating' => 5,
            'service_used' => 'Pembuatan Septic Tank Baru',
        ],
        [
            'customer_name' => 'Ibu Fransiska',
            'location' => 'Harapan Indah, Bekasi',
            'content' => 'Wastafel dapur tersumbat lemak keras. Dipanggil teknisinya pakai mesin spiral rotar-rooter, 30 menit langsung lancar plong tanpa perlu bongkar keramik kitchen set. Luar biasa!',
            'rating' => 5,
            'service_used' => 'Pelancaran Saluran Mampet',
        ],
    ],

];
