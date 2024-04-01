<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutomationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define dummy data
        $data = [
            [
                'reorder_level' => 20,
                'reorder_amount' => 80,
                'enabled' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more data as needed
        ];

        // Insert data into the automation table
        DB::table('automation')->insert($data);
    }
}
