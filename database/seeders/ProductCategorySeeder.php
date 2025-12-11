<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'tagline' => 'Gadget & Elektronik Terkini',
                'description' => 'Produk elektronik dan gadget terbaru dengan teknologi canggih',
                'image' => 'categories/elektronik.jpg',
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'tagline' => 'Gaya & Trend Fashion',
                'description' => 'Pakaian dan aksesoris fashion terkini untuk tampil percaya diri',
                'image' => 'categories/fashion.jpg',
            ],
            [
                'name' => 'Makanan & Minuman',
                'slug' => 'makanan-minuman',
                'tagline' => 'Kuliner Lezat',
                'description' => 'Produk makanan dan minuman berkualitas untuk keluarga',
                'image' => 'categories/makanan.jpg',
            ],
            [
                'name' => 'Kesehatan & Kecantikan',
                'slug' => 'kesehatan-kecantikan',
                'tagline' => 'Sehat & Cantik',
                'description' => 'Produk kesehatan dan perawatan kecantikan untuk hidup lebih baik',
                'image' => 'categories/kesehatan.jpg',
            ],
            [
                'name' => 'Rumah Tangga',
                'slug' => 'rumah-tangga',
                'tagline' => 'Perlengkapan Rumah',
                'description' => 'Peralatan dan perlengkapan rumah tangga untuk kenyamanan keluarga',
                'image' => 'categories/rumah-tangga.jpg',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::firstOrCreate(
                ['slug' => $category['slug']], // cek berdasarkan slug
                $category // data yang akan dibuat kalau belum ada
            );
        }

        $this->command->info('✓ 5 Kategori berhasil dibuat atau sudah ada');
    }
}