<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'ABC Shoes',
                'email' => 'abcshoes@example.com',
                'phone_number' => '555-1234',
                'address' => '123 Main St, Anytown USA',
            ],
            [
                'name' => 'XYZ Footwear',
                'email' => 'info@xyzfootwear.com',
                'phone_number' => '555-5678',
                'address' => '456 Elm St, Anytown USA',
            ],
            [
                'name' => 'Smith Shoe Company',
                'email' => 'sales@smithshoes.com',
                'phone_number' => '555-9012',
                'address' => '789 Oak St, Anytown USA',
            ],
            [
                'name' => 'Jones Footwear Inc',
                'email' => 'info@jonesfootwear.com',
                'phone_number' => '555-3456',
                'address' => '321 Maple St, Anytown USA',
            ],
            [
                'name' => 'Johnson Shoes',
                'email' => 'info@johnsonshoes.com',
                'phone_number' => '555-7890',
                'address' => '654 Pine St, Anytown USA',
            ],
            [
                'name' => 'Wilson Footwear',
                'email' => 'sales@wilsonfootwear.com',
                'phone_number' => '555-2345',
                'address' => '987 Cedar St, Anytown USA',
            ],
            [
                'name' => 'Green Shoe Co',
                'email' => 'info@greenshoeco.com',
                'phone_number' => '555-6789',
                'address' => '234 Birch St, Anytown USA',
            ],
            [
                'name' => 'Baker Footwear',
                'email' => 'sales@bakerfootwear.com',
                'phone_number' => '555-0123',
                'address' => '567 Maple St, Anytown USA',
            ],
            [
                'name' => 'Lee Shoe Corporation',
                'email' => 'info@leeshoe.com',
                'phone_number' => '555-4567',
                'address' => '890 Oak St, Anytown USA',
            ],
            [
                'name' => 'Taylor Footwear LLC',
                'email' => 'sales@taylorfootwear.com',
                'phone_number' => '555-8901',
                'address' => '432 Pine St, Anytown USA',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
