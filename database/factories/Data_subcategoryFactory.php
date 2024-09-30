<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Data_category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class data_subcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data_subcategory' => fake()->word(1,5),
            'data_category_id' => Data_category::inRandomOrder()->first()->id ?? Data_category::factory()->create()->id,
            'description' => fake()->text(),
        ];
    }
}
