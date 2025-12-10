<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Store;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin/Seller
        $user = User::create([
            'name' => 'Dina Seller',
            'email' => 'dina@store.com',
            'password' => bcrypt('password'),
            'role' => 'member',
        ]);
        
        // Buat Wallet untuk User
        $user->balance()->create(['balance' => 0]);

        // 2. Buat Toko
        $store = Store::create([
            'user_id' => $user->id,
            'name' => 'KariSya Official',
            'slug' => 'karisya-official',
            'is_verified' => true,
        ]);

        // 3. Buat Kategori
        $category = ProductCategory::create([
            'name' => 'Fashion Wanita',
            'slug' => 'fashion-wanita',
        ]);

        // 4. Buat 5 Produk Dummy
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'store_id' => $store->id,
                'product_category_id' => $category->id,
                'name' => 'Baju Keren ' . $i,
                'slug' => 'baju-keren-' . $i,
                'price' => 50000 * $i,
                'stock' => 10,
                'weight' => 500, 
                'condition' => 'new',
                'description' => 'Ini adalah deskripsi baju keren nomor ' . $i,
            ]);
        }
    }
}