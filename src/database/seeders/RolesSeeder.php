<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Ability;
use App\Models\AbilityRole;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['id' => 1],
            [
                'id' => 1,
                'name' => 'admin'
            ]
        );

        Ability::updateOrCreate(['id' => 1],
            [
                'id' => 1,
                'name' => 'access_admin'
            ]
        );

        AbilityRole::create([
            'role_id' => 1,
            'ability_id' => 1
        ]);
    }
}
