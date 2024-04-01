<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all existing sale IDs from the sales table
        $existingSaleIds = DB::table('sales')->pluck('id')->toArray();

        // Get all existing stock item IDs from the stock_items table
        $existingStockItemIds = DB::table('stock_items')->pluck('id')->toArray();

        // Define dummy data
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $saleId = $existingSaleIds[array_rand($existingSaleIds)]; // Select a random sale ID
            $stockItemId = $existingStockItemIds[array_rand($existingStockItemIds)]; // Select a random stock item ID
            $data[] = [
                'sale_id' => $saleId,
                'stock_item_id' => $stockItemId,
                'quantity' => rand(1, 50), // Example random quantity sold
                'price' => rand(10, 100), // Example random price per item
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the stock_sales table
        DB::table('stock_sales')->insert($data);
    }
}
