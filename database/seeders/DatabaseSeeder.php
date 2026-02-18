<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kalkayuliving.com',
            'password' => bcrypt('password'),
        ]);

        // Create Pages
        Page::create([
            'key' => 'home',
            'title' => 'Home',
            'content' => 'Selamat datang di KalKayu Living - Furniture premium untuk hunian impian Anda.',
            'hero_title' => 'Furniture Premium untuk Hunian Impian',
            'hero_subtitle' => 'Desain custom minimalis dengan material berkualitas tinggi, dibuat khusus untuk Anda',
            'hero_theme' => 'default',
        ]);

        Page::create([
            'key' => 'about',
            'title' => 'Tentang Kami',
            'content' => 'KalKayu Living adalah perusahaan furniture custom premium yang berfokus pada desain minimalis modern dengan material berkualitas tinggi. Kami berkomitmen menghadirkan furniture yang tidak hanya indah, tetapi juga fungsional dan tahan lama.',
        ]);

        Page::create([
            'key' => 'process',
            'title' => 'Proses Pengerjaan',
            'content' => '1. Konsultasi & Desain\n2. Pemilihan Material\n3. Produksi\n4. Quality Control\n5. Pengiriman & Instalasi',
        ]);

        // Sample Products
        $categories = ['Meja', 'Kursi', 'Lemari', 'Rak'];
        
        foreach ($categories as $index => $category) {
            Product::create([
                'name' => $category . ' Minimalis Premium',
                'slug' => strtolower($category) . '-minimalis-premium',
                'category' => $category,
                'description' => 'Desain minimalis modern dengan material kayu jati berkualitas tinggi. Cocok untuk ruang tamu, ruang kerja, atau kamar tidur Anda.',
                'image' => 'products/sample.jpg',
                'price' => rand(2000000, 10000000),
                'material' => 'Kayu Jati',
                'dimensions' => '120 x 60 x 75 cm',
                'is_featured' => $index < 3,
                'is_active' => true,
                'order' => $index,
            ]);
        }

        // Sample Testimonials
        $testimonials = [
            [
                'client_name' => 'Budi Santoso',
                'client_company' => 'PT. Maju Jaya',
                'content' => 'Kualitas furniture sangat bagus dan sesuai dengan ekspektasi. Proses pemesanan juga mudah dan cepat.',
                'rating' => 5,
            ],
            [
                'client_name' => 'Siti Nurhaliza',
                'client_company' => 'Rumah Cantik Interior',
                'content' => 'Desainnya modern dan elegan. Sangat puas dengan hasil akhirnya. Recommended!',
                'rating' => 5,
            ],
            [
                'client_name' => 'Ahmad Wijaya',
                'client_company' => null,
                'content' => 'Pelayanan ramah dan profesional. Furniture yang dipesan sesuai dengan desain yang diminta.',
                'rating' => 4,
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            Testimonial::create(array_merge($testimonial, [
                'is_active' => true,
                'order' => $index,
            ]));
        }

        // Sample Articles
        $articles = [
            [
                'title' => 'Tips Memilih Furniture Minimalis untuk Rumah Kecil',
                'excerpt' => 'Panduan lengkap memilih furniture yang tepat untuk rumah dengan ruang terbatas.',
                'content' => 'Memilih furniture untuk rumah kecil memerlukan pertimbangan khusus. Berikut adalah beberapa tips yang dapat membantu Anda...',
            ],
            [
                'title' => '5 Tren Desain Interior 2024',
                'excerpt' => 'Simak tren desain interior terkini yang akan populer di tahun 2024.',
                'content' => 'Tahun 2024 membawa berbagai tren desain interior yang menarik. Dari warna-warna natural hingga material sustainable...',
            ],
            [
                'title' => 'Cara Merawat Furniture Kayu Agar Awet',
                'excerpt' => 'Tips perawatan furniture kayu agar tetap indah dan tahan lama.',
                'content' => 'Furniture kayu memerlukan perawatan khusus agar tetap awet dan indah. Berikut adalah cara-cara yang dapat Anda lakukan...',
            ],
        ];

        foreach ($articles as $article) {
            Article::create(array_merge($article, [
                'featured_image' => 'articles/sample.jpg',
                'author' => 'Admin',
                'is_published' => true,
                'published_at' => now(),
            ]));
        }
    }
}
