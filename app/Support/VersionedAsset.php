<?php

namespace App\Support;

/**
 * URL gambar di public/ dengan sidik isi berkas sebagai query string.
 *
 * Hosting mengirim gambar dengan Cache-Control max-age 7 hari, jadi browser
 * pengunjung tidak bertanya ulang ke server selama itu. Kalau foto diganti
 * dengan nama berkas yang sama, pengunjung lama tetap melihat foto lama.
 * Dengan menempelkan hash isi berkas, URL ikut berubah setiap kali isinya
 * berubah, sehingga semua browser otomatis mengambil versi baru tanpa
 * hard refresh. Selama isi berkas sama, URL tetap sama dan cache tetap
 * terpakai.
 *
 * Sengaja memakai hash isi, bukan filemtime: upload ulang lewat File Manager
 * atau FTP mengubah waktu berkas walau isinya sama, dan itu akan membuang
 * cache pengunjung tanpa alasan. Hash xxh3 untuk belasan foto ~250 KB hanya
 * butuh sekitar satu milidetik per halaman.
 */
class VersionedAsset
{
    public static function url(string $path): string
    {
        $absolutePath = public_path($path);

        if (! is_file($absolutePath)) {
            return asset($path);
        }

        return asset($path).'?v='.substr(hash_file('xxh3', $absolutePath), 0, 12);
    }
}
