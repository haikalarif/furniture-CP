# Panduan Setup KalKayu Living

## Langkah-langkah Setup Lengkap

### 1. Persiapan Environment

Pastikan sistem Anda sudah terinstall:
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL atau PostgreSQL
- Node.js & NPM

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Setup Environment File

```bash
# Copy file environment
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kalkayu_living
DB_USERNAME=root
DB_PASSWORD=your_password
```

Buat database baru:
```sql
CREATE DATABASE kalkayu_living;
```

### 5. Install Laravel Breeze (Authentication)

```bash
# Install Breeze
composer require laravel/breeze --dev

# Install Breeze dengan Blade
php artisan breeze:install blade

# Install dependencies yang ditambahkan Breeze
npm install
```

### 6. Jalankan Migration & Seeder

```bash
# Jalankan migration untuk membuat tabel
php artisan migrate

# Jalankan seeder untuk data dummy
php artisan migrate --seed
```

### 7. Setup Storage

```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

### 8. Compile Assets

```bash
# Development mode (dengan watch)
npm run dev

# Atau untuk production
npm run build
```

### 9. Jalankan Server

```bash
# Jalankan development server
php artisan serve
```

Website akan berjalan di: `http://localhost:8000`

### 10. Login ke Admin Panel

Akses: `http://localhost:8000/login`

**Kredensial Default:**
- Email: `admin@kalkayuliving.com`
- Password: `password`

## Troubleshooting

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: Storage link tidak berfungsi
```bash
php artisan storage:link
```

### Error: Permission denied pada folder storage
```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache

# Windows: Pastikan folder storage dan bootstrap/cache memiliki write permission
```

### Error: Class not found
```bash
composer dump-autoload
```

### Error: Mix manifest not found
```bash
npm install
npm run dev
```

## Kustomisasi Awal

### 1. Ganti Nomor WhatsApp

Edit file berikut dan ganti `6281234567890` dengan nomor Anda:
- `resources/views/layouts/frontend.blade.php`
- `resources/views/frontend/home.blade.php`
- `resources/views/frontend/contact.blade.php`

### 2. Upload Logo

1. Login ke admin panel
2. Upload logo di folder `public/images/`
3. Update reference di `resources/views/layouts/frontend.blade.php`

### 3. Edit Konten Halaman

1. Login ke admin panel
2. Menu "Halaman"
3. Edit konten Home, About, dan Process

### 4. Tambah Produk Pertama

1. Login ke admin panel
2. Menu "Produk" > "Tambah Produk"
3. Upload gambar produk (disarankan ukuran 800x800px)
4. Isi detail produk

### 5. Ganti Warna Brand (Opsional)

Edit file `resources/views/layouts/frontend.blade.php`:
- Cari `amber-700` (warna coklat kayu)
- Ganti dengan warna Tailwind lain sesuai brand Anda

## Tips Production

### Optimize untuk Production

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### Clear Cache (jika ada masalah)

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Build Assets untuk Production

```bash
npm run build
```

### Set Environment ke Production

Edit `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

## Backup Database

```bash
# Export database
mysqldump -u root -p kalkayu_living > backup.sql

# Import database
mysql -u root -p kalkayu_living < backup.sql
```

## Update Aplikasi

```bash
# Pull latest changes (jika dari git)
git pull

# Update dependencies
composer install
npm install

# Run migrations
php artisan migrate

# Clear & rebuild cache
php artisan optimize:clear
php artisan optimize

# Rebuild assets
npm run build
```

## Support

Jika mengalami kendala, pastikan:
1. PHP version minimal 8.1
2. Semua extension PHP yang dibutuhkan Laravel sudah aktif
3. Database sudah dibuat dan konfigurasi benar
4. Folder storage dan bootstrap/cache memiliki write permission

---

Selamat menggunakan KalKayu Living! 🎉
