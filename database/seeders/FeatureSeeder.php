<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'title' => 'Kualitas Premium',
                'description' => 'Menggunakan material kayu pilihan berkualitas tinggi yang tahan lama dan ramah lingkungan',
                'icon' => 'fas fa-gem',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Desain Custom',
                'description' => 'Setiap produk dapat disesuaikan dengan kebutuhan dan selera Anda untuk hasil yang sempurna',
                'icon' => 'fas fa-pencil-ruler',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Garansi Terpercaya',
                'description' => 'Kami memberikan garansi untuk setiap produk sebagai bentuk komitmen terhadap kualitas',
                'icon' => 'fas fa-shield-alt',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Pengerjaan Profesional',
                'description' => 'Dikerjakan oleh craftsman berpengalaman dengan detail dan finishing yang sempurna',
                'icon' => 'fas fa-tools',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Harga Kompetitif',
                'description' => 'Harga terbaik dengan kualitas premium, tanpa mengorbankan kualitas produk',
                'icon' => 'fas fa-tags',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Konsultasi Gratis',
                'description' => 'Tim kami siap membantu Anda menemukan furniture yang tepat untuk hunian impian',
                'icon' => 'fas fa-comments',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
