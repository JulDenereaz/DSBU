<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\Protocol;
use App\Models\Group;
use App\Models\Data_category;
use App\Models\Data_subcategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Group::factory(5)->create();
        User::factory()->create([
            'firstname' => 'Julien',
            'lastname' => 'Dénéréaz',
            'email' => 'denereaz.julien@gmail.com',
            'username' => 'jdenerea',
            'password' => Hash::make('12345678'),
        ]);
        User::factory(49)->create();
        $categories = ['Imaging', 'Flow Cytometry', 'Sequencing', 'Mass Spectrometry'];

        foreach ($categories as $category) {
            Data_category::factory()->create([
                'data_category' => $category
            ]);
        }
        Data_subcategory::factory(15)->create();
        Equipment::factory(50)->create();
        Project::factory(10)->create();
        Protocol::factory(20)->create();

    }
}
