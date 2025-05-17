<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'code' => 'CS',
                'name' => 'Customer Support',
            ],
            [
                'code' => 'PM',
                'name' => 'Payment',
            ],
            [
                'code' => 'TX',
                'name' => 'Taxes',
            ],
        ]);
    }
}
