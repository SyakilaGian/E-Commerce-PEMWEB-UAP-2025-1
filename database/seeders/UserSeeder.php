<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin utama
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'), // ganti sesuai kebutuhan
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Seller contoh
        User::firstOrCreate(
            ['email' => 'seller@example.com'],
            [
                'name' => 'Seller Contoh',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'email_verified_at' => now(),
            ]
        );

        // Member contoh
        User::firstOrCreate(
            ['email' => 'member@example.com'],
            [
                'name' => 'Member Contoh',
                'password' => Hash::make('password'),
                'role' => 'member',
                'email_verified_at' => now(),
            ]
        );
    }
}