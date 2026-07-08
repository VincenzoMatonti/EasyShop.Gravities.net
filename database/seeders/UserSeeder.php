<?php

namespace Database\Seeders;

use App\Enum\Identity\IdentityRole;
use App\Models\Identity\Role;
use App\Models\Identity\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'admin@example.com',
                'password' => 'password',
                'role' => IdentityRole::ADMIN,
            ],
            [
                'email' => 'manager@example.com',
                'password' => 'password',
                'role' => IdentityRole::MANAGER,
            ],
            [
                'email' => 'customer@example.com',
                'password' => 'password',
                'role' => IdentityRole::CUSTOMER,
            ],
        ];

        foreach ($users as $data) {

            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'password' => Hash::make($data['password']),
                ]
            );

            $role = Role::where('name', $data['role'])->firstOrFail();

            $user->roles()->syncWithoutDetaching([$role->id]);
        }
    }
}
