<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Group;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'start_date' => fake()->date('Y-m-d'),
            'end_date' => fake()->date('Y-m-d'),
            'funding' => fake()->word(),
            'group_id' => Group::inRandomOrder()->first()->id ?? Group::factory()->create()->id,
        ];
    }
}
