<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Equipment;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    protected $model = Equipment::class;
    
    public function definition(): array
    {
        return [
            'eq_id' => fake()->unique()->randomNumber(),
            'eq_name' => fake()->word(),
            'platform' => fake()->randomDigitNotNull(),
            'platform_name' => fake()->word(),
            'location' => fake()->city(),
            'software' => fake()->word(),
            'data_category' => fake()->randomDigitNotNull(),
            'description' => fake()->optional()->sentence(), 
            'updated_at' =>now(),            
            'created_at' =>now(),

        ];
    }
}
