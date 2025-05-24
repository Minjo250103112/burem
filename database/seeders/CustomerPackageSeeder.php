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
                'domain' => 'mututegal.sch.id',
                'package_id' => 1,
                'status' => 1,
            ],
            [
                'customer_id' => 2,
                'domain' => 'sdnjatilaba2.sch.id',
                'package_id' => 1,
                'status' => 1,
            ],
            [
                'customer_id' => 3,
                'domain' => 'smpnegeri1brebes.sch.id',
                'package_id' => 2,
                'status' => 1,
            ],
        ]);
    }
}
