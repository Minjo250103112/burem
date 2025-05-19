<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'Ismi Amelia',
                'email' => 'ismia@gmail.com',
                'nomor_telepon' => '',
                'role' => 'user',
                'password' => bcrypt('12345'),
            ],
            [
                'nama' => 'User 2',
                'email' => 'user2@gmail.com',
                'nomor_telepon' => '',
                'role' => 'user',
                'password' => bcrypt('12345'),
            ],
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'nomor_telepon' => '',
                'role' => 'admin',
                'password' => bcrypt('12345'),
            ],
        ]);
    }
}
