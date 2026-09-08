<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Situs ini tidak memakai database untuk kontennya. Seluruh layanan,
     * galeri, dan testimoni dibaca dari config/content.php.
     */
    public function run(): void
    {
        //
    }
}
