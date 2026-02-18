# Quick Start Guide - KalKayu Living

## 🚀 Setup dalam 5 Menit

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database
Edit `.env`:
```env
DB_DATABASE=kalkayu_living
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install Authentication
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
```

### 5. Setup Database
```bash
php artisan migrate --seed
php artisan storage:link
```

### 6. Run Development Server
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server
npm run dev
```

### 7. Login Admin
- URL: `http://localhost:8000/login`
- Email: `admin@kalkayuliving.com`
- Password: `password`

## 📁 File Penting

| File | Fungsi |
|------|--------|
| `routes/web.php` | Definisi routes |
| `app/Http/Controllers/` | Logic controllers |
| `app/Models/` | Database models |
| `resources/views/` | Blade templates |
| `database/migrations/` | Database schema |
| `.env` | Configuration |

## 🎯 Fitur Utama

### Frontend
- ✅ Home dengan hero section
- ✅ Katalog produk dengan filter
- ✅ Detail produk
- ✅ Blog/artikel
- ✅ Testimoni klien
- ✅ Halaman kontak
- ✅ WhatsApp integration

### Admin Panel
- ✅ Dashboard statistik
- ✅ CRUD Produk
- ✅ CRUD Artikel
- ✅ CRUD Testimoni
- ✅ Edit halaman dinamis

## 🛠️ Command Berguna

```bash
# Clear cache
php artisan optimize:clear

# Rebuild cache
php artisan optimize

# Create new controller
php artisan make:controller NamaController

# Create new model with migration
php artisan make:model NamaModel -m

# Run specific migration
php artisan migrate --path=/database/migrations/nama_file.php

# Rollback migration
php artisan migrate:rollback

# Fresh migration (reset all)
php artisan migrate:fresh --seed
```

## 📝 Kustomisasi Cepat

### Ganti Nomor WhatsApp
Cari dan ganti `6281234567890` di:
- `resources/views/layouts/frontend.blade.php`
- `resources/views/frontend/home.blade.php`
- `resources/views/frontend/contact.blade.php`

### Ganti Warna Brand
Edit `resources/views/layouts/frontend.blade.php`:
- Ganti `amber-700` dengan warna Tailwind lain
- Contoh: `blue-600`, `green-700`, `purple-600`

### Tambah Menu Navigasi
Edit `resources/views/layouts/frontend.blade.php` bagian navigation

## 🐛 Troubleshooting

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Storage link not working"
```bash
php artisan storage:link
```

### Error: "Mix manifest not found"
```bash
npm install
npm run dev
```

### Error: Permission denied (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

## 📚 Dokumentasi Lengkap

- `README.md` - Overview & instalasi
- `SETUP_GUIDE.md` - Panduan setup detail
- `CODE_STRUCTURE.md` - Penjelasan struktur kode
- `DEPLOYMENT_CHECKLIST.md` - Checklist deployment
- `PORTFOLIO.md` - Dokumentasi portfolio

## 🎓 Tech Stack

- **Backend:** Laravel 10
- **Frontend:** Blade + Tailwind CSS
- **Database:** MySQL
- **Auth:** Laravel Breeze
- **Assets:** Vite

## 📞 Support

Jika ada pertanyaan atau issue:
1. Cek dokumentasi di folder project
2. Review error logs: `storage/logs/laravel.log`
3. Cek Laravel documentation: https://laravel.com/docs

---

**Happy Coding! 🎉**
