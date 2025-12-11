<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\StoreBalance;

class StoreBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = Store::first();
        
        if (!$store) {
            $this->command->error('✗ Store tidak ditemukan! Jalankan StoreSeeder terlebih dahulu.');
            return;
        }

        // Buat store balance dengan balance = 0
        StoreBalance::create([
            'store_id' => $store->id,
            'balance' => 0,
        ]);

        $this->command->info('✓ Store Balance berhasil dibuat (Balance: 0)');
    }
}