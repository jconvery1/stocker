<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
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
                'order_datetime' => now(),
                'notes' => 'Sample order ' . ($i + 1),
                'user_id' => 1,
                'supplier_id' => 1,
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the orders table
        DB::table('orders')->insert($data);
    }
}
