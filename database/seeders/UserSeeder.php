<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Healthcare',
            'email' => 'admin@healthcare.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'email_verified_at' => now(),
        ]);

        // Create Dokter User
        User::create([
            'name' => 'Dr. John Doe',
            'email' => 'dokter@healthcare.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
            'phone' => '081234567891',
            'email_verified_at' => now(),
        ]);

        // Create Pasien User
        User::create([
            'name' => 'Jane Smith',
            'email' => 'pasien@healthcare.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
            'phone' => '081234567892',
            'email_verified_at' => now(),
        ]);

        // Create more sample users
        User::factory(10)->create([
            'role' => 'pasien',
        ]);
    }
}
