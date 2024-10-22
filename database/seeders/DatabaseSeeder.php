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
use App\Models\Experiment;
use App\Models\Platform;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roleAdmin = Role::create(['name' => 'admin']);
        $rolePi = Role::create(['name' => 'pi']);
        $roleManager = Role::create(['name' => 'manager']);
        $roleUser = Role::create(['name' => 'user']);

        Artisan::call('shield:generate', ['--all' => true]);

        $roleAdmin->givePermissionTo(Permission::all());
        $roleUser->givePermissionTo([
            'view_experiment',
            'create_experiment',
            'view_equipment',
            'view_project',
            'view_protocol',
            'view_user',
            'view_any_experiment',
            'view_any_equipment',
            'view_any_project',
            'view_any_protocol',
            'view_any_user',
        ]);
        $roleManager->syncPermissions($roleUser->permissions->pluck('name')->toArray());
        $roleManager->givePermissionTo([
            'create_protocol',
            'create_project',
            'create_equipment',
            'view_group',
            'update_experiment',
            'update_project',
            'update_protocol',
            'update_user',
        ]);
        $rolePi->syncPermissions($roleManager->permissions->pluck('name')->toArray());
        $rolePi->givePermissionTo([
            'update_group',
            'delete_experiment',
            'delete_project',
            'delete_protocol',
            'delete_user',
        ]);

        Group::factory(5)->create();

        User::factory()->create([
            'firstname' => 'Julien',
            'lastname' => 'Dénéréaz',
            'email' => 'admin@unil.ch',
            'username' => 'jdenerea',
            'password' => Hash::make('12345678'),
        ])->assignRole('admin');

        User::factory()->create([
            'firstname' => 'Cécile',
            'lastname' => 'lebrand',
            'email' => 'pi@unil.ch',
            'username' => 'clebrand',
            'password' => Hash::make('12345678'),
        ])->assignRole('pi');

        User::factory()->create([
            'firstname' => 'user',
            'lastname' => 'test',
            'email' => 'user@unil.ch',
            'username' => 'testests',
            'password' => Hash::make('12345678'),
        ])->assignRole('user');

        $mod = User::factory(5)->create();
        $mod->each(function ($user) {
            $user->assignRole('manager');
        });
        $users = User::factory(48)->create();
        $users->each(function ($user) {
            $user->assignRole('user');
        });
        $categories = ['Imaging', 'Flow Cytometry', 'Sequencing', 'Mass Spectrometry'];
        $icons = ['tabler-microscope', 'tabler-filter-minus', 'tabler-dna-2', 'mdi-molecule'];
        foreach ($categories as $index => $category) {
            Data_category::factory()->create([
                'data_category' => $category,
                'icon' => $icons[$index], // Set the corresponding icon based on the index
            ]);
        }

        $this->call(LibraryValuesSeeder::class);
        Platform::factory(10)->create();
        Data_subcategory::factory(15)->create();
        Equipment::factory(50)->create();
        Project::factory(30)->create();
        Protocol::factory(40)->create();
        Experiment::factory(20)->create();

    }
}
