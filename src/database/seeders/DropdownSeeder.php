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

        // Create materials
        foreach ($materials as $material) {
            Dropdown::factory()->create(['dropdown_group' => 'material', 'value' => $material]);
        }

        // Create categories
        foreach ($categories as $category) {
            Dropdown::factory()->create(['dropdown_group' => 'category', 'value' => $category]);
        }

        // Create brands
        foreach ($brands as $brand) {
            Dropdown::factory()->create(['dropdown_group' => 'brand', 'value' => $brand]);
        }
    }
}
