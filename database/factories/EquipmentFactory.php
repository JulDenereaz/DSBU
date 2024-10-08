<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Equipment;
use App\Models\Data_category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
            'name' => fake()->word(),
            'shortname' => fake()->word(),
            'creator_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'platform' => fake()-> stateAbbr(),
            'platform_name' => fake()-> state(),
            'location' => fake()->city(),
            'software' => fake()->word(),
            'data_category_id' => Data_category::inRandomOrder()->first()->id ?? Data_category::factory()->create()->id,
            'description' => fake()->optional()->sentence(), 
            'updated_at' =>now(),            
            'created_at' =>now(),

        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Equipment $equipment) {
            $plat = $equipment->platform;
            $equipment->eq_id = $plat . str_pad($equipment->id, 3, '0', STR_PAD_LEFT);
            $equipment->save(); // Persist the updated eq_id
        });
    }
}
