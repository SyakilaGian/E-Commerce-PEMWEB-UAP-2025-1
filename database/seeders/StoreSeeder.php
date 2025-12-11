<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $seller = User::where('email', 'seller@example.com')->first();

        if (!$seller) {
            $this->command->error('✗ Seller tidak ditemukan! Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        Store::create([
            'user_id' => $seller->id,
            'name' => 'Toko Seller Pertama',
            'logo' => 'stores/logo-default.jpg',
            'about' => 'Toko yang menjual berbagai produk berkualitas dengan harga terbaik. Kami berkomitmen memberikan pelayanan terbaik untuk kepuasan pelanggan.',
            'phone' => '081234567890',
            'address_id' => 'ADDR001', // ⬅️ ISI DENGAN STRING
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta',
            'city' => 'Jakarta Pusat',
            'postal_code' => '10220',
            'is_verified' => true,
        ]);
        
        $this->command->info('✓ Store berhasil dibuat untuk Seller');
    }
}