<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner',
        ]);

        $fundraiserRole = Role::create([
            'name' => 'fundraiser',
        ]);

        $userOwner = User::create([
            'name' => 'Dedy Septya',
            'avatar' => 'images/default-avatar.png',
            'email' => 'dedy@example.test',
            'password' => Hash::make('12345678'),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}