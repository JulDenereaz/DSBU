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
            'email' => fake()->email(),
            'address' => fake()->address(),
            'department_abb' => fake()->stateAbbr(),
            'department' => fake()->state(),
            'faculty_abb' => fake()->stateAbbr(),
            'faculty' => fake()->word(),
            'orcid' => fake()->uuid(),
        ];
    }
}
