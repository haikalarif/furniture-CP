# Fitur Produk Promo

## 📋 Deskripsi
Fitur ini memungkinkan admin untuk menandai produk sebagai promo dengan harga khusus, persentase diskon, dan periode promo. Section "Produk Promo" akan ditampilkan di halaman home dengan tampilan menarik yang menunjukkan harga coret, harga promo, dan countdown periode promo.

## 🗄️ Struktur Database

### Kolom Baru di Tabel `products`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| `is_promo` | boolean | Status produk promo (default: false) |
| `promo_price` | decimal(12,2) | Harga promo (nullable) |
| `discount_percentage` | integer | Persentase diskon untuk badge (nullable) |
| `promo_start_date` | date | Tanggal mulai promo (nullable) |
| `promo_end_date` | date | Tanggal selesai promo (nullable) |

## 📁 File yang Dibuat/Dimodifikasi

### Migration
- ✅ `database/migrations/2026_02_13_063319_add_promo_fields_to_products_table.php`

### Model
- ✅ `app/Models/Product.php`
  - Fillable ditambah: promo_price, discount_percentage, promo_start_date, promo_end_date, is_promo
  - Casts ditambah: is_promo (boolean), promo_price (decimal), promo_start_date (date), promo_end_date (date)
  - Scope baru: `promo()` - Filter produk promo aktif
  - Method baru:
    - `isPromoActive()` - Cek apakah promo masih berlaku
    - `getEffectivePrice()` - Dapatkan harga efektif (promo atau normal)
    - `getDiscountAmount()` - Hitung jumlah diskon

### Controller
- ✅ `app/Http/Controllers/Admin/ProductController.php`
  - Validasi ditambah untuk field promo
  - Store & Update method diupdate

- ✅ `app/Http/Controllers/Frontend/HomeController.php`
  - Mengirim data `$promoProducts` ke view

### Views Admin
- ✅ `resources/views/admin/products/create.blade.php`
  - Form field promo ditambahkan
  - Checkbox "Produk Promo"
  
- ✅ `resources/views/admin/products/edit.blade.php`
  - Form field promo ditambahkan
  - Checkbox "Produk Promo"

- ✅ `resources/views/admin/products/index.blade.php`
  - Badge "Promo" ditampilkan
  - Harga coret dan harga promo ditampilkan

### Views Frontend
- ✅ `resources/views/frontend/home.blade.php`
  - Section "Produk Promo" ditambahkan
  - Badge diskon persentase
  - Badge "PROMO"
  - Harga coret dan harga promo
  - Jumlah penghematan
  - Countdown tanggal berakhir
  - Tombol "Lihat Detail"

### Seeder
- ✅ `database/seeders/PromoProductSeeder.php`
  - 3 produk promo contoh dengan diskon 30%

## 🎨 Tampilan Frontend

### Section "Produk Promo"
- Layout grid 3 kolom (responsive)
- Badge diskon di pojok kiri atas (merah)
- Badge "PROMO" di pojok kanan atas (kuning)
- Gambar produk dengan hover effect
- Harga normal dicoret
- Harga promo dalam warna merah besar
- Jumlah penghematan dalam warna hijau
- Alert kuning menampilkan tanggal berakhir
- Tombol "Lihat Detail" dengan icon cart
- Background putih (bg-white)

## 🔧 Cara Menggunakan

### Mengelola Produk Promo di Admin

#### 1. Menambah Prod