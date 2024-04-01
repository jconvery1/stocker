<?php

namespace Database\Factories;

use App\Models\Dropdown;
use Illuminate\Database\Eloquent\Factories\Factory;

class DropdownFactory extends Factory
{
    protected $model = Dropdown::class;

    public function definition()
    {
        return [
            'value' => $this->faker->unique()->word, // Ensure uniqueness
            'dropdown_group' => $this->faker->randomElement(['material', 'category', 'brand']),
        ];
    }
}
