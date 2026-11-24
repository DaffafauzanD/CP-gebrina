@extends('layouts.app')

@section('title', 'Tentang CV Gebrina Jaya | Jasa Sedot WC Jabodetabek')
@section('meta_description', 'Profil lengkap CV GEBRINA JAYA, penyedia jasa sedot WC & sanitasi profesional terpercaya di Jabodetabek sejak 2011 dengan NIB dan izin resmi pembuangan limbah LH.')

@section('schema_json')
    @include('components.schema.breadcrumbs', ['items' => [
        ['name' => 'Beranda', 'url' => route('home')],
        ['name' => 'Tentang Kami', 'url' => route('about')],
    ]])
@endsection

@section('content')

<!-- PAGE HEADER -->
<section class="bg-slate-900 text-white py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-xs font-extrabold text-amber-400 uppercase tracking-widest">Profil Perusahaan</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">Tentang CV GEBRINA JAYA</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-sm sm:text-base">
            Mitra terpercaya masyarakat Jabodetabek dalam penanganan sanitasi, pengurasan septic tank, dan pengolahan limbah cair sejak lebih dari 15 tahun.
        </p>
    </div>
</section>

<!-- COMPANY STORY & HISTORY -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-6 space-y-6">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Dedikasi & Pengalaman Puluhan Tahun Dalam Jasa Sanitasi
                </h2>
                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                    <strong>CV GEBRINA JAYA</strong> didirikan dengan komitmen murni untuk mengatasi permasalahan sanitasi masyarakat perkotaan Jabodetabek yang kian berkembang pesat. Berawal dari 2 unit armada truk sederhana, kini kami berkembang menjadi penyedia jasa spesialis dengan puluhan unit truk tangki vakum berkapasitas besar dan teknisi berpengalaman.
                    Kami memprioritaskan metode kerja yang higienis, ramah lingkungan, cepat tanggap, dan profesional.
                </p>
                
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-2xl font-extrabold text-blue-600">15+ Tahun</div>
                        <div class="text-xs font-semibold text-slate-600">Pengalaman Lapangan</div>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-2xl font-extrabold text-emerald-700">12.500+</div>
                        <div class="text-xs font-semibold text-slate-600">Pelanggan Puas</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-slate-100">
                    @include('components.picture', ['src' => 'images/gallery/tim-teknisi-kerja.jpg', 'alt' => 'Tim Teknisi CV GEBRINA JAYA', 'sizes' => '(min-width: 1024px) 600px, 100vw', 'class' => 'w-full h-[400px] object-cover'])
                </div>
            </div>

        </div>
    </div>
</section>

<!-- OWNER PROFILE -->
@php($owner = config('company.owner'))
<section class="py-16 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

            {{-- Foto asli berorientasi potret 9:16. Dibingkai 4:5 dengan pemotongan
                 tengah karena subjek berada di bagian tengah foto, sehingga sosok
                 pemilik dan truk di belakangnya tetap utuh terlihat. --}}
            <div class="lg:col-span-4">
                <div class="relative max-w-xs mx-auto lg:mx-0">
                    <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white ring-1 ring-slate-200">
                        @include('components.picture', [
                            'src' => $owner['photo_path'],
                            'alt' => trim(($owner['name'] ?: 'Pemilik').' - '.$owner['role'].' CV GEBRINA JAYA'),
                            'loading' => 'lazy',
                            'sizes' => '320px',
                            'class' => 'w-full aspect-[4/5] object-cover',
                        ])
                    </div>
                    <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 lg:left-4 lg:translate-x-0 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-extrabold shadow-lg whitespace-nowrap">
                        {{ $owner['role'] }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6 pt-6 lg:pt-0">
                <span class="text-xs font-extrabold text-blue-600 uppercase tracking-widest">Pesan dari Pemilik</span>

                <blockquote class="relative">
                    <svg class="w-10 h-10 text-blue-100 absolute -top-2 -left-1" fill="currentColor" viewBox="0 0 24 24"><path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/></svg>
                    <p class="relative pl-8 text-lg sm:text-xl text-slate-800 font-medium leading-relaxed italic">
                        {{ $owner['quote'] }}
                    </p>
                </blockquote>

                <div class="pl-8 space-y-0.5">
                    <div class="text-base font-extrabold text-slate-900">{{ $owner['name'] ?: $owner['role'] }}</div>
                    <div class="text-sm text-slate-500 font-semibold">{{ $owner['name'] ? $owner['role'].' · ' : '' }}{{ config('company.name') }}</div>
                </div>

                <div class="pl-8 grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-sm font-extrabold text-slate-900">Turun Langsung</div>
                        <div class="text-xs text-slate-600">Memantau pengerjaan di lapangan</div>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-sm font-extrabold text-slate-900">Harga Disepakati</div>
                        <div class="text-xs text-slate-600">Dibicarakan jelas sebelum bekerja</div>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-sm font-extrabold text-slate-900">Bisa Dihubungi</div>
                        <div class="text-xs text-slate-600">Keluhan ditangani sampai tuntas</div>
                    </div>
                </div>

                <div class="pl-8 pt-2">
                    <a href="https://wa.me/{{ config('company.contact.whatsapp_number') }}?text={{ urlencode('Halo CV GEBRINA JAYA, saya ingin berbicara langsung dengan pemilik mengenai layanan sedot WC.') }}" target="_blank" rel="noopener" class="inline-flex items-center space-x-2 px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm transition-colors">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span>Hubungi Kami Langsung</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- VISION & MISSION -->
<section class="py-16 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xl">
                    V
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Visi Kami</h3>
                <p class="text-slate-600 leading-relaxed text-sm">
                    Menjadi perusahaan penyedia jasa sanitasi dan pengolahan limbah cair terdepan, paling tepercaya, dan ramah lingkungan di seluruh wilayah Jabodetabek dengan standar layanan internasional.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-bold text-xl">
                    M
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Misi Perusahaan</h3>
                <ul class="space-y-2 text-slate-600 text-sm list-disc list-inside">
                    <li>Memberikan respon darurat 24 jam yang cepat dan tepat waktu ke lokasi pelanggan.</li>
                    <li>Menggunakan peralatan teknologis modern seperti mesin roto-cleaner & vakum high-pressure.</li>
                    <li>Memberikan pelayanan terbaik dengan garansi pengerjaan tuntas dan rapi.</li>
                    <li>Memastikan pembuangan limbah secara legal dan bertanggung jawab demi kelestarian lingkungan.</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- LEGALITIES & PROOF OF QUALITY -->
<!-- <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden">
            <div class="relative z-10 max-w-3xl space-y-6">
                <span class="text-xs font-extrabold text-amber-400 uppercase tracking-widest">Aspek Legalitas & Keamanan</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white">Usaha Resmi & Memiliki Izin Lingkungan</h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Anda tenang bekerja dengan perusahaan yang sah secara hukum. CV GEBRINA JAYA terdaftar resmi dan mematuhi aturan kelestarian lingkungan hidup Pemda DKI Jakarta & Jawa Barat.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <div class="p-4 bg-slate-800/80 rounded-xl border border-slate-700 space-y-1">
                        <div class="text-xs text-amber-400 font-bold uppercase">Nomor Induk Berusaha</div>
                        <div class="text-sm font-extrabold text-white">{{ config('company.legalities.nib') }}</div>
                    </div>
                    <div class="p-4 bg-slate-800/80 rounded-xl border border-slate-700 space-y-1">
                        <div class="text-xs text-emerald-400 font-bold uppercase">Izin Pembuangan Limbah</div>
                        <div class="text-sm font-extrabold text-white">{{ config('company.legalities.izin_lh') }}</div>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="https://wa.me/{{ config('company.contact.whatsapp_number') }}" target="_blank" class="inline-flex items-center space-x-2 px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm transition-colors">
                        <span>Hubungi Perusahaan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> -->

@endsection
