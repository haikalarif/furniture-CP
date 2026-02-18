<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class PromoProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update beberapa produk existing menjadi promo
        // Atau buat produk baru dengan promo
        
        $promoProducts = [
            [
                'name' => 'Meja Makan Minimalis Promo',
                'slug' => 'meja-makan-minimalis-promo',
                'category' => 'Meja Makan',
                'description' => 'Meja makan minimalis dengan desain modern dan elegan. Cocok untuk ruang makan keluarga. Material kayu jati berkualitas tinggi dengan finishing natural.',
                'image' => 'products/default-table.jpg',
                'price' => 5000000,
                'promo_price' => 3500000,
                'discount_percentage' => 30,
                'promo_start_date' => Carbon::now(),
                'promo_end_date' => Carbon::now()->addDays(30),
                'material' => 'Kayu Jati',
                'dimensions' => '150 x 80 x 75 cm',
                'is_featured' => false,
                'is_promo' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Kursi Tamu Set Promo Spesial',
                'slug' => 'kursi-tamu-set-promo-spesial',
                'category' => 'Kursi',
                'description' => 'Set kursi tamu 3+2+1 dengan desain klasik modern. Bantalan empuk dan nyaman. Rangka kayu mahoni solid dengan finishing glossy.',
                'image' => 'products/default-chair.jpg',
                'price' => 8000000,
                'promo_price' => 5600000,
                'discount_percentage' => 30,
                'promo_start_date' => Carbon::now(),
                'promo_end_date' => Carbon::now()->addDays(30),
                'material' => 'Kayu Mahoni',
                'dimensions' => 'Set 3+2+1',
                'is_featured' => false,
                'is_promo' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Lemari Pakaian 3 Pintu Diskon',
                'slug' => 'lemari-pakaian-3-pintu-diskon',
                'category' => 'Lemari',
                'description' => 'Lemari pakaian 3 pintu dengan cermin besar. Banyak ruang penyimpanan dengan laci dan gantungan. Material kayu jati dengan finishing natural.',
                'image' => 'products/default-wardrobe.jpg',
                'price' => 7500000,
                'promo_price' => 5250000,
                'discount_percentage' => 30,
                'promo_start_date' => Carbon::now(),
                'promo_end_date' => Carbon::now()->addDays(30),
                'material' => 'Kayu Jati',
                'dimensions' => '180 x 60 x 200 cm',
                'is_featured' => false,
                'is_promo' => true,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($promoProducts as $product) {
            Product::create($product);
        }
    }
}
