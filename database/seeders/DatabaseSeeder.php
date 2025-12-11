<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Admin/Seller
        $user = User::create([
            'name' => 'Dina Seller',
            'email' => 'dina@store.com',
            'password' => bcrypt('password'),
            'role' => 'member',
        ]);
        
        // Wallet untuk User
        $user->balance()->create(['balance' => 0]);

        // 2. Toko
        $store = Store::create([
            'user_id' => $user->id,
            'name' => 'KariSya Official',
            'slug' => 'karisya-official',
            'is_verified' => true,
            'about' => 'Toko resmi KariSya menyediakan segala kebutuhanmu. Dari fashion sampai elektronik, semuanya ada!',
        ]);

        // 3. Kategori
        $categories = [
            'Fashion Wanita',
            'Fashion Pria',
            'Elektronik & Gadget',
            'Kecantikan & Perawatan Diri',
            'Rumah Tangga & Living'
        ];

        // 4. 10 Produk Dummy
        foreach ($categories as $catName) {
            
            $slugKategori = Str::slug($catName);
            $category = ProductCategory::create([
                'name' => $catName,
                'slug' => $slugKategori,
            ]);

            for ($i = 1; $i <= 10; $i++) {
               Product::create([
                    'store_id' => $store->id,
                    'product_category_id' => $category->id,
                    'name' => $catName . ' Seri ' . $i, 
                    'slug' => Str::slug($catName . ' Seri ' . $i . '-' . Str::random(4)),
                    
                    'image' => 'products/' . $slugKategori . '.jpg', 
                    
                    'price' => rand(50000, 2000000),
                    'stock' => 20,
                    'weight' => 500,
                    'condition' => 'new',
                    'description' => 'Produk original kualitas terbaik kategori ' . $catName,
                ]);
            }
        }
    }
}