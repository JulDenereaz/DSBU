<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Protocols;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProtocolsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pr_id' => fake()->word(),
            'pr_name' => fake()->word(),
            'description' => fake()->word(),
            'user_id' => fake()->randomDigitNotNull(),
            'group' => fake()->word(),
            'category' => fake()->word(),
            'doi' => fake()->word(),
            'abb_list' => fake()->word(),
            'notes' => fake()->word(),
        ];
    }
}
