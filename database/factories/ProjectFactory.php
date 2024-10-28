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
            'created_by_id' => User::role('pi')->inRandomOrder()->first()->id,
        ];
    }
    public function configure(): self
    {
        return $this->afterCreating(function (Project $project) {
            // Use the created_by_id as the 'pi' user and attach it to the project
            if ($project->created_by_id) {
                $project->users()->attach($project->created_by_id);
            }
        });
    }
}
