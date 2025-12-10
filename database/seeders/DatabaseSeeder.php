<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ADMIN
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'user_balance' => 0,
        ]);

        // 2. SELLER
        $seller = User::factory()->create([
            'name' => 'Seller User',
            'email' => 'seller@example.com',
            'role' => 'seller',
            'user_balance' => 0,
        ]);

        // Store untuk Seller
        $store = Store::factory()->create([
            'user_id' => $seller->id,
            'store_name' => 'Toko Seller',
        ]);

        // 3. CUSTOMER
        $customer = User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'role' => 'customer',
            'user_balance' => 0,
        ]);

        // 4. Category
        $categories = Category::factory()->count(5)->create();

        // 5. Product (10 item)
        foreach (range(1, 10) as $i) {
            Product::factory()->create([
                'store_id' => $store->id,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
