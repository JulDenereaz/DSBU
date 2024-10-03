<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Experiment;
use App\Models\Data_subcategory;
use App\Models\Group;
use App\Models\Equipment;
use App\Models\User;
use App\Models\Protocol;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExperimentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $equipment = Equipment::inRandomOrder()->first();
        $data_category_id = $equipment->data_category_id;
        $data_subcategory_id = Data_subcategory::where('data_category_id', $data_category_id)
            ->inRandomOrder()
            ->first()
            ->id;
        $user = User::inRandomOrder()->first();
        return [
            'name' => fake()->word(),
            'group_id' => $user->group_id,
            'user_id' => $user->id,
            'protocol_id' => Protocol::inRandomOrder()->first()->id,
            'equipment_id' => $equipment->id,
            'project_id' => Project::inRandomOrder()->first()->id,
            'data_subcategory_id' => $data_subcategory_id,
            'status' => fake()->randomElement(['INCOMPLETE', 'READY', 'CREATED', 'ARCHIVED', 'DELETED']),
            'collection_date' => fake()->date(),
            'samples' => fake()->sentence(),
            'description' => fake()->sentence(),
            'file_structure' => fake()->sentence(),
            'supp_table' => fake()->sentence(),
            'is_personal' => fake()->boolean(),
            'is_sensitive' => fake()->boolean(),
            'is_encrypted' => fake()->boolean(),
            'is_archived' => fake()->boolean(),
            'is_deposited' => fake()->boolean(),
            'storage_period' => fake()->boolean(),
            'license' => fake()->word(),
        ];
    }
}
