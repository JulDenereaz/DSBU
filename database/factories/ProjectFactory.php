<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Group;
use App\Models\User;

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
    public function configure(): self
    {
        return $this->afterCreating(function (Project $project) {
            // Fetch a random user with the 'pi' role
            $piUser = User::role('pi')->inRandomOrder()->first();

            // Attach the 'pi' user to the project
            if ($piUser) {
                $project->users()->attach($piUser->id);
            }
        });
    }
}
