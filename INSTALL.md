# 🚀 Panduan Instalasi Lengkap - KalKayu Living

## ⚠️ Penting: Baca Ini Dulu!

Aplikasi ini menggunakan **Laravel Breeze** untuk authentication. Breeze harus diinstall secara terpisah karena merupakan dev dependency.

## 📋 Prerequisites

Pastikan sudah terinstall:
- ✅ PHP 8.1 atau lebih tinggi
- ✅ Composer
- ✅ MySQL atau PostgreSQL
- ✅ Node.js & NPM
- ✅ Git (opsional)

### Cek Versi
```bash
php -v
composer -V
node -v
npm -v
mysql --version
```

## 🔧 Instalasi Step-by-Step

### Step 1: Masuk ke Folder Project
```bash
cd kalkayu-living
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

**Jika error:** Pastikan PHP 8.1+ dan Composer sudah terinstall.

### Step 3: Install JavaScript Dependencies
```bash
npm install
```

**Jika error:** Pastikan Node.js dan NPM sudah terinstall.

### Step 4: Setup Environment File
```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### Step 5: Generate Application Key
```bash
php artisan key:generate
```

### Step 6: Konfigurasi Database

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kalkayu_living
DB_USERNAME=root
DB_PASSWORD=
```

### Step 7: Buat Database

Buka MySQL:
```bash
mysql -u root -p
```

Buat database:
```sql
CREATE DATABASE kalkayu_living;
EXIT;
```

### Step 8: Install Laravel Breeze (PENTING!)

Ini adalah step yang paling penting untuk authentication:

```bash
# Install Breeze sebagai dev dependency
composer require laravel/breeze --dev
```

Tunggu sampai selesai, lalu:

```bash
# Install Breeze dengan Blade template
php artisan breeze:install blade
```

Pilih opsi:
- Blade (default)
- No untuk dark mode (atau yes jika mau)
- No untuk TypeScript

Lalu install dependencies yang ditambahkan Breeze:

```bash
npm install
```

### Step 9: Run Migrations & Seeders
```bash
php artisan migrate --seed
```

Ini akan:
- Membuat semua tabel database
- Membuat user admin default
- Membuat data dummy untuk testing

### Step 10: Create Storage Link
```bash
php artisan storage:link
```

Ini membuat symbolic link dari `public/storage` ke `storage/app/public` untuk akses gambar.

### Step 11: Compile Assets

Buka terminal baru dan jalankan:
```bash
npm run dev
```

**Jangan tutup terminal ini!** Vite perlu running untuk compile assets.

### Step 12: Run Laravel Server

Buka terminal baru (kedua) dan jalankan:
```bash
php artisan serve
```

**Jangan tutup terminal ini juga!**

### Step 13: Akses Website

Buka browser dan akses:
- **Frontend:** http://localhost:8000
- **Admin Login:** http://localhost:8000/login

**Kredensial Admin:**
- Email: `admin@kalkayuliving.com`
- Password: `password`

## ✅ Verifikasi Instalasi

### Cek Frontend
1. Buka http://localhost:8000
2. Pastikan tampilan muncul dengan baik
3. Cek menu navigasi berfungsi

### Cek Admin Panel
1. Buka http://localhost:8000/login
2. Login dengan kredensial admin
3. Pastikan dashboard muncul
4. Coba akses menu Products, Articles, dll

### Cek Upload Gambar
1. Login ke admin
2. Coba tambah produk baru
3. Upload gambar
4. Pastikan gambar muncul

## 🐛 Troubleshooting

### Error: "Class 'Laravel\Breeze\BreezeServiceProvider' not found"
**Solusi:**
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
```

### Error: "No application encryption key has been specified"
**Solusi:**
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1049] Unknown database"
**Solusi:**
```bash
# Buat database dulu
mysql -u root -p
CREATE DATABASE kalkayu_living;
EXIT;

# Lalu run migration
php artisan migrate
```

### Error: "The stream or file could not be opened"
**Solusi (Windows):**
```bash
# Buat folder jika belum ada
mkdir storage\logs
mkdir bootstrap\cache

# Atau hapus dan buat ulang
rmdir /s storage\logs
mkdir storage\logs
```

**Solusi (Linux/Mac):**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error: "Mix manifest not found"
**Solusi:**
```bash
npm install
npm run dev
```

### Error: "Storage link not working"
**Solusi:**
```bash
# Hapus link lama
rm public/storage

# Buat link baru
php artisan storage:link
```

### Error: "Port 8000 already in use"
**Solusi:**
```bash
# Gunakan port lain
php artisan serve --port=8001
```

### Error saat npm install
**Solusi:**
```bash
# Hapus node_modules dan package-lock.json
rm -rf node_modules package-lock.json

# Install ulang
npm install
```

### Error: "Class not found"
**Solusi:**
```bash
composer dump-autoload
```

## 🔄 Reset Instalasi (Jika Perlu)

Jika ingin mulai dari awal:

```bash
# 1. Drop database
mysql -u root -p
DROP DATABASE kalkayu_living;
CREATE DATABASE kalkayu_living;
EXIT;

# 2. Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 3. Run migration ulang
php artisan migrate:fresh --seed

# 4. Recreate storage link
php artisan storage:link
```

## 📝 Checklist Instalasi

Gunakan checklist ini untuk memastikan semua step sudah dilakukan:

- [ ] PHP 8.1+ terinstall
- [ ] Composer terinstall
- [ ] Node.js & NPM terinstall
- [ ] MySQL terinstall
- [ ] `composer install` berhasil
- [ ] `npm install` berhasil
- [ ] File `.env` sudah dibuat
- [ ] `php artisan key:generate` berhasil
- [ ] Database sudah dibuat
- [ ] Konfigurasi database di `.env` benar
- [ ] Laravel Breeze sudah diinstall
- [ ] `php artisan migrate --seed` berhasil
- [ ] `php artisan storage:link` berhasil
- [ ] `npm run dev` running
- [ ] `php artisan serve` running
- [ ] Website bisa diakses di browser
- [ ] Login admin berhasil

## 🎯 Next Steps

Setelah instalasi berhasil:

1. **Ganti Password Admin**
   - Login ke admin panel
   - Ganti password default

2. **Kustomisasi Konten**
   - Edit halaman About, Process
   - Tambah produk pertama
   - Tambah artikel pertama

3. **Ganti Nomor WhatsApp**
   - Cari `6281234567890` di views
   - Ganti dengan nomor Anda

4. **Upload Logo**
   - Upload logo ke `public/images/`
   - Update reference di layout

5. **Baca Dokumentasi**
   - CUSTOMIZATION_GUIDE.md
   - CODE_STRUCTURE.md
   - BEST_PRACTICES.md

## 💡 Tips

1. **Selalu jalankan 2 terminal:**
   - Terminal 1: `php artisan serve`
   - Terminal 2: `npm run dev`

2. **Jika ada perubahan di .env:**
   ```bash
   php artisan config:clear
   ```

3. **Jika ada perubahan di routes:**
   ```bash
   php artisan route:clear
   ```

4. **Jika ada perubahan di views:**
   ```bash
   php artisan view:clear
   ```

5. **Backup database secara berkala:**
   ```bash
   mysqldump -u root -p kalkayu_living > backup.sql
   ```

## 🆘 Masih Ada Masalah?

1. Cek error log: `storage/logs/laravel.log`
2. Baca SETUP_GUIDE.md untuk detail lebih lengkap
3. Pastikan semua requirements terpenuhi
4. Coba reset instalasi (lihat section di atas)

## 📚 Dokumentasi Lainnya

- **README.md** - Overview project
- **QUICK_START.md** - Setup cepat
- **SETUP_GUIDE.md** - Setup detail
- **CODE_STRUCTURE.md** - Struktur code
- **CUSTOMIZATION_GUIDE.md** - Cara customize

---

**Selamat! Jika semua step berhasil, aplikasi sudah siap digunakan! 🎉**
