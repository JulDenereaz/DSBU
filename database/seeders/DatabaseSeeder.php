<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Equipment;
use App\Models\Projects;
use App\Models\Protocols;
use App\Models\Groups;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Groups::factory(5)->create();
        User::factory()->create([
            'name' => 'Julien Dénéréaz',
            'firstname' => 'Julien',
            'lastname' => 'Dénéréaz',
            'email' => 'denereaz.julien@gmail.com',
            'username' => 'jdenerea',
            'password' => Hash::make('12345678'),
        ]);
        User::factory(49)->create();
        Equipment::factory(50)->create();
        Projects::factory(10)->create();
        Protocols::factory(20)->create();

    }
}
