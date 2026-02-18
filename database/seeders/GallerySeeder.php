<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Ruang Tamu Modern Minimalis',
                'description' => 'Desain ruang tamu dengan furniture minimalis dan pencahayaan natural',
                'image' => 'galleries/default-interior-1.jpg',
                'category' => 'interior',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Ruang Makan Keluarga',
                'description' => 'Set meja makan kayu jati dengan kursi empuk untuk keluarga',
                'image' => 'galleries/default-interior-2.jpg',
                'category' => 'interior',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Kamar Tidur Utama',
                'description' => 'Desain kamar tidur dengan tempat tidur king size dan lemari built-in',
                'image' => 'galleries/default-interior-3.jpg',
                'category' => 'interior',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Teras Outdoor Minimalis',
                'description' => 'Furniture outdoor untuk teras dengan material tahan cuaca',
                'image' => 'galleries/default-exterior-1.jpg',
                'category' => 'exterior',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Gazebo Taman',
                'description' => 'Gazebo kayu dengan furniture outdoor untuk area taman',
                'image' => 'galleries/default-exterior-2.jpg',
                'category' => 'exterior',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Detail Ukiran Kayu Jati',
                'description' => 'Close-up detail ukiran tangan pada furniture kayu jati',
                'image' => 'galleries/default-detail-1.jpg',
                'category' => 'detail',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'title' => 'Finishing Natural Wood',
                'description' => 'Detail finishing natural pada permukaan kayu mahoni',
                'image' => 'galleries/default-detail-2.jpg',
                'category' => 'detail',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'title' => 'Ruang Kerja Home Office',
                'description' => 'Setup ruang kerja dengan meja dan rak buku custom',
                'image' => 'galleries/default-interior-4.jpg',
                'category' => 'interior',
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
