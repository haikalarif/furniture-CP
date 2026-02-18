# Fitur Why Choose Us / Keunggulan Kami

## Deskripsi
Fitur ini menampilkan section "Mengapa Memilih Kami?" di halaman home yang dapat dikelola melalui admin panel. Admin dapat menambah, mengedit, dan menghapus keunggulan perusahaan dengan icon Font Awesome.

## Struktur Database

### Tabel: `features`
- `id` - Primary key
- `title` - Judul keunggulan (required)
- `description` - Deskripsi keunggulan (required)
- `icon` - Class Font Awesome untuk icon (optional)
- `is_active` - Status aktif/nonaktif (boolean)
- `order` - Urutan tampilan (integer)
- `created_at` - Timestamp
- `updated_at` - Timestamp

## File yang Dibuat/Dimodifikasi

### Model
- `app/Models/Feature.php` - Model untuk tabel features

### Controller
- `app/Http/Controllers/Admin/FeatureController.php` - Controller admin untuk CRUD features
- `app/Http/Controllers/Frontend/HomeController.php` - Diupdate untuk mengirim data features ke view

### Views
- `resources/views/admin/features/index.blade.php` - Halaman daftar keunggulan
- `resources/views/admin/features/create.blade.php` - Form tambah keunggulan
- `resources/views/admin/featur