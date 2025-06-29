<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::Create(
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make("user123"),
            ]
        );
        $user2 = User::Create(
            [
                'name' => 'reviewer',
                'email' => 'reviewer@gmail.com',
                'password' => Hash::make("reviewer123"),
            ],
        );
        $user3 = User::Create(
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make("admin123"),
            ]
        );
        $user1->assignRole('mahasiswa');
        $user2->assignRole('reviewer');
        $user3->assignRole('admin');
    }
}
