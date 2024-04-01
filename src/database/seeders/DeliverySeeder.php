<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve order IDs from the orders table
        $orderIds = DB::table('orders')->pluck('id');

        // Define dummy data
        $data = [];

        // Assign order IDs to each delivery record
        foreach ($orderIds as $orderId) {
            $data[] = [
                'order_id' => $orderId,
                'user_id' => 1,
                'delivery_datetime' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the deliveries table
        DB::table('deliveries')->insert($data);
    }
}
