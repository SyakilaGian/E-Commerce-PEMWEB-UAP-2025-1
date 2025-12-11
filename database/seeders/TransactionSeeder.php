<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Store;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama sebagai buyer
        $buyer = User::first();
        // Ambil store pertama sebagai seller
        $store = Store::first();

        // Buat transaksi dummy
        Transaction::create([
            'code' => 'TRX-' . strtoupper(uniqid()),
            'buyer_id' => $buyer->id,
            'store_id' => $store->id,
            'address' => 'Jl. Contoh No. 123',
            'address_id' => 'ADDR001',
            'city' => 'Makassar',
            'postal_code' => '90245',
            'shipping' => 'JNE',
            'shipping_type' => 'REG',
            'shipping_cost' => 20000,
            'tracking_number' => null,
            'tax' => 5000,
            'grand_total' => 150000,
            'payment_status' => 'paid',
            'status' => 'pending', // kolom baru dari migrasi tambahan
            'shipping_receipt' => null, // kolom baru dari migrasi tambahan
        ]);
    }
}