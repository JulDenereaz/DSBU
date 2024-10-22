<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Groups>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_name' => fake()->word(),
            'fullname' => fake()->name(),
            'address' => fake()->address(),
            'department' => fake()->stateAbbr(),
            'department_name' => fake()->state(),
            'faculty' => fake()->word(),
            'orcid' => fake()->uuid(),
        ];
    }
}
