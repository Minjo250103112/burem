<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_packages')->insert([
            [
                'customer_id' => 1,
                'package_id' => 1,
                'status' => 1,
            ],
            [
                'customer_id' => 2,
                'package_id' => 1,
                'status' => 1,
            ],
            [
                'customer_id' => 2,
                'package_id' => 2,
                'status' => 1,
            ],
            [
            'customer_id' => 3,
                'package_id' => 2,
                'status' => 1,
            ],
        ]);
    }
}
