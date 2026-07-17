<?php

namespace Database\Seeders;

use App\Enum\Identity\IdentityRole;
use App\Models\Identity\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (IdentityRole::cases() as $role) {
            Role::firstOrCreate([
                'name' => $role->value,
            ]);
        }
    }
}
