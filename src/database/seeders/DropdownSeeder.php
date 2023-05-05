<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dropdown;

class DropdownSeeder extends Seeder
{
    public function run()
    {
        $materials = ['Leather', 'Canvas', 'Suede', 'Synthetic', 'Mesh', 'Rubber', 'Foam', 'Textile'];
        $categories = ['Running', 'Walking', 'Hiking', 'Training', 'Basketball', 'Football', 'Sneakers', 'Casual'];
        $brands = ['Nike', 'Adidas', 'Puma', 'New Balance', 'Reebok', 'Under Armour', 'Asics', 'Saucony'];

        $dropdowns = [];

        // Generate 10 entries for each group
        for ($i = 0; $i < 10; $i++) {
            $dropdowns[] = [
                'dropdown_group' => 'material',
                'value' => $materials[array_rand($materials)]
            ];

            $dropdowns[] = [
                'dropdown_group' => 'category',
                'value' => $categories[array_rand($categories)]
            ];

            $dropdowns[] = [
                'dropdown_group' => 'brand',
                'value' => $brands[array_rand($brands)]
            ];
        }

        // Insert data into the database
        Dropdown::insert($dropdowns);
    }
}

