<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Protocols;
use App\Models\User;
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
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        return [
            'pr_id' => fake()->word(),
            'pr_name' => fake()->word(),
            'description' => fake()->word(),
            'user_id' => $user->id,
            'group_id' => $user->group_id,
            'category' => fake()->word(),
            'doi' => fake()->word(),
            'abb_list' => fake()->word(),
            'notes' => fake()->word(),
        ];
    }
}
