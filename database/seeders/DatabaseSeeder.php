<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductCategorySeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
            StoreBalanceSeeder::class,    
            TransactionSeeder::class
        ]);

        $this->command->info('');
        $this->command->info('=== DATABASE SEEDING SELESAI ===');
        $this->command->info('Login Credentials:');
        $this->command->info('Admin    : admin@example.com / password123');
        $this->command->info('Seller   : seller@example.com / password123');
        $this->command->info('Customer : customer@example.com / password123');
        $this->command->info('Store Balance: Rp 0');
    }
}
