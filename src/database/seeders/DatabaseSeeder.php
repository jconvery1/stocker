<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            AutomationSeeder::class,
            DropdownSeeder::class,
            SupplierSeeder::class,
            SaleSeeder::class,
            StockItemSeeder::class,
            OrderSeeder::class,
            DeliverySeeder::class,
            StockOrderSeeder::class,
            StockSaleSeeder::class
        ]);
    }
}
