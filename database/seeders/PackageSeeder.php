<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            [
                'code' => 'PRO1',
                'name' => 'Web Profesional + Domain 1 Tahun',
                'price' => 1300000,
                'description' => 'Layanan website sekolah 1 tahun'
            ],
            [
                'code' => 'EXC1',
                'name' => 'Web Exclusive + Domain 1 Tahun',
                'price' => 2000000,
                'description' => 'Layanan website sekolah 1 tahun'
            ],
            [
                'code' => 'CTM1',
                'name' => 'Web Custom + Domain 1 Tahun',
                'price' => 3500000,
                'description' => 'Layanan website sekolah 1 tahun'
            ],
            [
                'code' => 'PRE1',
                'name' => 'Web Premium + Domain 1 Tahun',
                'price' => 5000000,
                'description' => 'Layanan website sekolah 1 tahun'
            ],
        ]);
    }
}
