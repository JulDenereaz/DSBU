<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DataCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DataMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'method' => fake()->word(1,5),
            'data_category_id' => DataCategory::inRandomOrder()->first()->id ?? DataCategory::factory()->create()->id,
            'description' => fake()->text(),
        ];
    }
}
