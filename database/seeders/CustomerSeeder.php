<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name' => 'Pelanggan 1',
                'agency' => 'SMK Muhammadiyah 1 Tegal',
                'email' => 'pelanggan1@mail.com',
                'address' => '-',
                'phone' => '-',
                'password' => bcrypt(12345),
            ],
            [
                'name' => 'Pelanggan 2',
                'agency' => 'SD Negeri Jatilaba 2',
                'email' => 'pelanggan2@mail.com',
                'address' => '-',
                'phone' => '-',
                'password' => bcrypt(12345),
            ],
            [
                'name' => 'Pelanggan 3',
                'agency' => 'SMP Negeri 1 Brebes',
                'email' => 'pelanggan3@mail.com',
                'address' => '-',
                'phone' => '-',
                'password' => bcrypt(12345),
            ],
        ]);
    }
}
