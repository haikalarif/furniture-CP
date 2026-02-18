# KalKayu Living - Premium Furniture Company Profile

Website company profile dinamis untuk bisnis furniture custom premium dengan admin panel CMS yang mudah digunakan.

## 🎯 Fitur Utama

### Frontend (Public)
- **Home** - Hero section, produk unggulan, testimoni, artikel terbaru
- **Tentang Kami** - Profil perusahaan
- **Produk/Portofolio** - Katalog produk dengan filter kategori
- **Proses Pengerjaan** - Alur kerja pembuatan furniture
- **Testimoni** - Review dari klien
- **Artikel/Blog** - Tips dan inspirasi seputar furniture & interior
- **Kontak** - Form kontak dan WhatsApp CTA
- **Desain Responsive** - Mobile-friendly
- **UI Premium** - Minimalist luxury design

### Admin Panel (CMS)
- **Dashboard** - Statistik dan overview
- **Kelola Produk** - CRUD produk dengan upload gambar
- **Kelola Testimoni** - CRUD testimoni klien
- **Kelola Artikel** - CRUD artikel/blog
- **Kelola Halaman** - Edit konten halaman About & Home
- **Autentikasi** - Login system dengan Laravel Breeze

## 🛠️ Tech Stack

- **Framework**: Laravel 10.x
- **Database**: MySQL/PostgreSQL
- **Frontend**: Blade Templates + Tailwind CSS
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage (public disk)

## 📦 Instalasi

### Requirements
- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

### Langkah Instalasi

1. **Masuk ke folder project**
```bash
cd kalkayu-living
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
copy .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kalkayu_living
DB_USERNAME=root
DB_PASSWORD=
```

5. **Buat database**
```sql
CREATE DATABASE kalkayu_living;
```

6. **Install Laravel Breeze untuk autentikasi**
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
```

7. **Jalankan migration & seeder**
```bash
php artisan migrate --seed
```

8. **Create storage link**
```bash
php artisan storage:link
```

9. **Compile assets**
```bash
npm run dev
```

10. **Jalankan server (buka 2 terminal)**

Terminal 1 - Laravel:
```bash
php artisan serve
```

Terminal 2 - Vite:
```bash
npm run dev
```

Website akan berjalan di: `http://localhost:8000`

## 👤 Default Login

- **Email**: admin@kalkayuliving.com
- **Password**: password

## 📁 Struktur Project

```
kalkayu-living/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   └── Frontend/       # Frontend controllers
│   ├── Models/             # Eloquent models
│   └── Services/           # Business logic services
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/
│       ├── layouts/        # Layout templates
│       ├── frontend/       # Frontend views
│       └── admin/          # Admin views
├── routes/
│   └── web.php            # Route definitions
└── public/
    └── storage/           # Public storage (images)
```

## 🎨 Kustomisasi

### Mengubah Warna Brand
Edit file `resources/views/layouts/frontend.blade.php` dan sesuaikan class Tailwind:
- Primary: `amber-700` (coklat kayu)
- Secondary: `gray-900` (hitam)

### Mengubah Konten Halaman
1. Login ke admin panel
2. Menu "Halaman"
3. Edit konten sesuai kebutuhan

### Menambah Produk
1. Login ke admin panel
2. Menu "Produk" > "Tambah Produk"
3. Upload gambar dan isi detail produk

## 📱 WhatsApp Integration

Edit nomor WhatsApp di:
- `resources/views/layouts/frontend.blade.php` (line ~50)
- `resources/views/frontend/home.blade.php` (CTA section)

Ganti `6281234567890` dengan nomor WhatsApp bisnis Anda.

## 🚀 Deployment

### Persiapan Production

1. **Set environment ke production**
```env
APP_ENV=production
APP_DEBUG=false
```

2. **Optimize aplikasi**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Build assets untuk production**
```bash
npm run build
```

4. **Set permission folder**
```bash
chmod -R 775 storage bootstrap/cache
```

## 📝 Best Practices yang Diterapkan

✅ **Clean Code**
- Penamaan konsisten dan deskriptif
- Separation of concerns (Controller, Model, Service)
- DRY principle (Don't Repeat Yourself)

✅ **Laravel Standards**
- Eloquent ORM untuk database operations
- Form Request Validation
- Resource Controllers
- Blade Components & Layouts

✅ **Security**
- CSRF Protection
- SQL Injection Prevention (Eloquent)
- XSS Protection (Blade escaping)
- Authentication & Authorization

✅ **Scalability**
- Service layer untuk business logic
- Reusable Blade components
- Modular structure
- Easy to extend

## 🎓 Cocok Untuk

- Portfolio freelance developer
- Project UMKM furniture/interior
- Belajar Laravel best practices
- Template company profile dinamis

## 📄 License

Open source - bebas digunakan untuk project pribadi atau komersial.

## 🤝 Support

Untuk pertanyaan atau bantuan, silakan buka issue di repository ini.

---

**Dibuat dengan ❤️ menggunakan Laravel**
