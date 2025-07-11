<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
                'identifier' => 'F1E121116',
                'email' => 'user@gmail.com',
                'department' => 'Ruang Baca FST',
                'password' => Hash::make("password123"),
            ]
        );

        $user2 = User::Create(
            [
                'name' => 'admin',
                'identifier' => '212121116',
                'email' => 'admin@gmail.com',
                'program_studi_id' => '13',
                'password' => Hash::make("password123"),
            ]
        );
        $role1 = Role::updateOrCreate(
            ['name' => 'mahasiswa'], // Kondisi untuk mencari data
            ['name' => 'mahasiswa']  // Data yang ingin dibuat atau diperbarui
        );
        $role2 = Role::updateOrCreate(
            ['name' => 'admin'], // Kondisi untuk mencari data
            ['name' => 'admin']  // Data yang ingin dibuat atau diperbarui
        );
        $role2 = Role::updateOrCreate(
            ['name' => 'dosen'], // Kondisi untuk mencari data
            ['name' => 'dosen']  // Data yang ingin dibuat atau diperbarui
        );
        $user1->assignRole('mahasiswa');
        $user2->assignRole('admin');
    }
}
