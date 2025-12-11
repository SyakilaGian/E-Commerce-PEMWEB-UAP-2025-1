<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $store = Store::first();
        if (!$store) {
            $this->command->error('✗ Store tidak ditemukan!');
            return;
        }

        $elektronik = ProductCategory::where('slug', 'elektronik')->first();
        $fashion = ProductCategory::where('slug', 'fashion')->first();
        $makanan = ProductCategory::where('slug', 'makanan-minuman')->first();
        $kesehatan = ProductCategory::where('slug', 'kesehatan-kecantikan')->first();
        $rumahTangga = ProductCategory::where('slug', 'rumah-tangga')->first();

        $products = [
            // Elektronik
            [
                'store_id' => $store->id,
                'product_category_id' => $elektronik->id,
                'name' => 'Smartphone Samsung Galaxy A54',
                'slug' => 'smartphone-samsung-galaxy-a54',
                'description' => 'Smartphone dengan kamera 50MP',
                'condition' => 'new',
                'price' => 4500000,
                'stock' => 15,
                'weight' => 500,
            ],
            [
                'store_id' => $store->id,
                'product_category_id' => $elektronik->id,
                'name' => 'Laptop ASUS VivoBook 14',
                'slug' => 'laptop-asus-vivobook-14',
                'description' => 'Laptop ringan Intel Core i5',
                'condition' => 'new',
                'price' => 7500000,
                'stock' => 8,
                'weight' => 1500,
            ],
            // Fashion
            [
                'store_id' => $store->id,
                'product_category_id' => $fashion->id,
                'name' => 'Kaos Polos Premium Cotton',
                'slug' => 'kaos-polos-premium-cotton',
                'description' => 'Kaos cotton combed 30s',
                'condition' => 'new',
                'price' => 85000,
                'stock' => 50,
                'weight' => 200,
            ],
            [
                'store_id' => $store->id,
                'product_category_id' => $fashion->id,
                'name' => 'Celana Jeans Denim Slim Fit',
                'slug' => 'celana-jeans-denim-slim-fit',
                'description' => 'Celana jeans denim berkualitas',
                'condition' => 'new',
                'price' => 250000,
                'stock' => 30,
                'weight' => 400,
            ],
            // Makanan
            [
                'store_id' => $store->id,
                'product_category_id' => $makanan->id,
                'name' => 'Kopi Arabica Gayo 250gr',
                'slug' => 'kopi-arabica-gayo-250gr',
                'description' => 'Kopi arabica premium Aceh Gayo',
                'condition' => 'new',
                'price' => 75000,
                'stock' => 100,
                'weight' => 250,
            ],
            [
                'store_id' => $store->id,
                'product_category_id' => $makanan->id,
                'name' => 'Keripik Singkong Pedas Manis',
                'slug' => 'keripik-singkong-pedas-manis',
                'description' => 'Keripik singkong renyah',
                'condition' => 'new',
                'price' => 25000,
                'stock' => 200,
                'weight' => 150,
            ],
            // Kesehatan
            [
                'store_id' => $store->id,
                'product_category_id' => $kesehatan->id,
                'name' => 'Vitamin C 1000mg Isi 30 Tablet',
                'slug' => 'vitamin-c-1000mg-30-tablet',
                'description' => 'Suplemen vitamin C',
                'condition' => 'new',
                'price' => 150000,
                'stock' => 40,
                'weight' => 100,
            ],
            [
                'store_id' => $store->id,
                'product_category_id' => $kesehatan->id,
                'name' => 'Serum Wajah Glowing Niacinamide',
                'slug' => 'serum-wajah-glowing-niacinamide',
                'description' => 'Serum mencerahkan wajah',
                'condition' => 'new',
                'price' => 120000,
                'stock' => 35,
                'weight' => 50,
            ],
            // Rumah Tangga
            [
                'store_id' => $store->id,
                'product_category_id' => $rumahTangga->id,
                'name' => 'Panci Stainless Steel Set 5 Pcs',
                'slug' => 'panci-stainless-steel-set-5pcs',
                'description' => 'Set panci stainless steel',
                'condition' => 'new',
                'price' => 350000,
                'stock' => 20,
                'weight' => 3000,
            ],
            [
                'store_id' => $store->id,
                'product_category_id' => $rumahTangga->id,
                'name' => 'Blender Philips 2 Liter HR2223',
                'slug' => 'blender-philips-2l-hr2223',
                'description' => 'Blender 2 liter 400 watt',
                'condition' => 'new',
                'price' => 450000,
                'stock' => 12,
                'weight' => 2500,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
        $this->command->info('✓ 10 Produk berhasil dibuat');
    }
}