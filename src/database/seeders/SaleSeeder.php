<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define dummy data
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'sale_price' => rand(50, 200), // Example random sale price between 50 and 200
                'user_id' => 1, // Set user ID to 1 for all records
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the sales table
        DB::table('sales')->insert($data);
    }
}
