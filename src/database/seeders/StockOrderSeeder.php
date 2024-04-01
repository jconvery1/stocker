<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all existing order IDs from the orders table
        $existingOrderIds = DB::table('orders')->pluck('id')->toArray();

        // Define dummy data
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $orderId = $existingOrderIds[array_rand($existingOrderIds)]; // Select a random order ID
            $data[] = [
                'order_id' => $orderId,
                'stock_item_id' => rand(1, 10), // Example random stock item ID between 1 and 10
                'quantity' => rand(1, 50), // Example random quantity ordered
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the stock_orders table
        DB::table('stock_orders')->insert($data);
    }
}
