# 🔧 Fix Routes & Clear Cache

Jika website masih menampilkan halaman welcome Laravel atau routes tidak berfungsi, ikuti langkah berikut:

## 🚨 Langkah Perbaikan

### 1. Stop Semua Server
Tekan `Ctrl+C` di kedua terminal (Laravel serve dan npm dev)

### 2. Clear All Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

### 3. Verify Routes
```bash
php artisan route:list
```

Pastikan routes berikut muncul:
- `GET /` → HomeController@index
- `GET /produk` → ProductController@index
- `GET /admin/dashboard` → DashboardController@index

### 4. Restart Servers

**Terminal 1 - Vite:**
```bash
npm run dev
```

**Terminal 2 - Laravel:**
```bash
php artisan serve
```

### 5. Test Website

Buka browser dan test:
- Frontend: http://localhost:8000
- Admin: http://localhost:8000/admin/dashboard (setelah login)

## ✅ Checklist

- [ ] Stop semua server
- [ ] Clear cache (semua command di atas)
- [ ] Verify routes dengan `route:list`
- [ ] Restart npm run dev
- [ ] Restart php artisan serve
- [ ] Test frontend (/)
- [ ] Test login (/login)
- [ ] Test admin dashboard (/admin/dashboard)

## 🐛 Jika Masih Error

### Error: "Target class [HomeController] does not exist"

**Solusi:**
```bash
composer dump-autoload
php artisan optimize:clear
```

### Error: "View [welcome] not found" atau masih tampil welcome

**Cek routes:**
```bash
php artisan route:list | findstr "GET /"
```

Harus menampilkan:
```
GET / ... HomeController@index
```

Jika tidak, pastikan file `routes/web.php` sudah benar.

### Error: "Class 'App\Http\Controllers\Frontend\HomeController' not found"

**Cek file controller ada:**
```bash
dir app\Http\Controllers\Frontend\HomeController.php
```

Jika tidak ada, controller belum dibuat. Pastikan semua file controller sudah ada.

### Admin Panel Kosong (Tidak Ada Menu)

**Cek:**
1. Sudah login?
2. File `resources/views/layouts/admin.blade.php` ada?
3. Clear view cache: `php artisan view:clear`

## 📝 Verify Files

Pastikan file-file ini ada:

### Controllers
```
app/Http/Controllers/Frontend/
├── HomeController.php
├── ProductController.php
└── ArticleController.php

app/Http/Controllers/Admin/
├── DashboardController.php
├── ProductController.php
├── ArticleController.php
├── TestimonialController.php
└── PageController.php
```

### Views
```
resources/views/
├── layouts/
│   ├── frontend.blade.php
│   └── admin.blade.php
├── frontend/
│   ├── home.blade.php
│   ├── about.blade.php
│   ├── process.blade.php
│   ├── contact.blade.php
│   ├── products/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   └── articles/
│       ├── index.blade.php
│       └── show.blade.php
└── admin/
    ├── dashboard.blade.php
    ├── products/
    ├── articles/
    ├── testimonials/
    └── pages/
```

## 🔄 Complete Reset (Last Resort)

Jika semua cara di atas tidak berhasil:

```bash
# 1. Stop servers (Ctrl+C)

# 2. Clear everything
php artisan optimize:clear
composer dump-autoload

# 3. Rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Restart servers
npm run dev  # Terminal 1
php artisan serve  # Terminal 2
```

## 💡 Tips

1. **Selalu clear cache** setelah mengubah routes atau controller
2. **Restart server** setelah clear cache
3. **Check route:list** untuk verify routes
4. **Check browser console** untuk error JavaScript
5. **Check Laravel log** di `storage/logs/laravel.log`

## 🆘 Masih Bermasalah?

1. Cek `storage/logs/laravel.log` untuk error detail
2. Pastikan database sudah di-migrate: `php artisan migrate`
3. Pastikan seeder sudah dijalankan: `php artisan db:seed`
4. Pastikan storage link sudah dibuat: `php artisan storage:link`

---

**Setelah mengikuti langkah di atas, website seharusnya sudah berfungsi normal!**
