# 🔧 Troubleshooting - KalKayu Living

## 🚨 Masalah: Website Masih Tampil Welcome Laravel

### Penyebab
Routes ter-overwrite oleh Laravel Breeze saat instalasi.

### Solusi Lengkap

#### Step 1: Stop Semua Server
Tekan `Ctrl+C` di semua terminal yang running

#### Step 2: Clear Cache (PENTING!)

**Cara 1 - Menggunakan Batch File (Mudah):**
```bash
# Double click file ini:
clear-cache.bat
```

**Cara 2 - Manual:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
composer dump-autoload
```

#### Step 3: Verify Routes
```bash
php artisan route:list
```

Cari routes berikut (harus ada):
```
GET|HEAD  /                    home › Frontend\HomeController@index
GET|HEAD  /produk              products.index › Frontend\ProductController@index
GET|HEAD  /admin/dashboard     admin.dashboard › Admin\DashboardController@index
```

#### Step 4: Restart Servers

**Cara 1 - Menggunakan Batch File (Mudah):**
```bash
# Double click file ini:
start-dev.bat
```

**Cara 2 - Manual (Buka 2 Terminal):**

Terminal 1:
```bash
npm run dev
```

Terminal 2:
```bash
php artisan serve
```

#### Step 5: Test Website

1. **Test Frontend:** http://localhost:8000
   - Harus tampil halaman KalKayu Living (bukan welcome Laravel)
   - Ada menu: Home, Tentang Kami, Produk, dll

2. **Test Login:** http://localhost:8000/login
   - Login dengan: admin@kalkayuliving.com / password

3. **Test Admin:** http://localhost:8000/admin/dashboard
   - Harus tampil dashboard dengan sidebar menu
   - Ada menu: Dashboard, Produk, Testimoni, Artikel, Halaman

## 🚨 Masalah: Admin Panel Tidak Ada Menu

### Penyebab
View cache atau layout admin belum ter-load

### Solusi

1. **Clear view cache:**
```bash
php artisan view:clear
```

2. **Verify file layout ada:**
```bash
# Check file ini ada:
resources/views/layouts/admin.blade.php
```

3. **Restart browser** (hard refresh: Ctrl+Shift+R)

4. **Check apakah sudah login** ke admin panel

## 🚨 Masalah: Error "Target class does not exist"

### Error Message
```
Target class [App\Http\Controllers\Frontend\HomeController] does not exist
```

### Solusi

```bash
# 1. Dump autoload
composer dump-autoload

# 2. Clear cache
php artisan optimize:clear

# 3. Restart server
```

## 🚨 Masalah: Error "View [welcome] not found"

### Solusi

1. **Clear view cache:**
```bash
php artisan view:clear
```

2. **Verify routes:**
```bash
php artisan route:list | findstr "GET /"
```

Harus tampil:
```
GET|HEAD  /  home › Frontend\HomeController@index
```

3. **Restart server**

## 🚨 Masalah: Gambar Tidak Muncul

### Solusi

```bash
# Create storage link
php artisan storage:link
```

Verify link dibuat:
```bash
# Check folder ini ada:
public/storage
```

## 🚨 Masalah: Error Database

### Error: "SQLSTATE[HY000] [1049] Unknown database"

**Solusi:**
```bash
# Buat database
mysql -u root -p
CREATE DATABASE kalkayu_living;
EXIT;

# Run migration
php artisan migrate --seed
```

### Error: "SQLSTATE[HY000] [2002] No connection"

**Solusi:**
1. Pastikan MySQL running
2. Check kredensial di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kalkayu_living
DB_USERNAME=root
DB_PASSWORD=
```

3. Clear config cache:
```bash
php artisan config:clear
```

## 🚨 Masalah: npm run dev Error

### Error: "Cannot find module"

**Solusi:**
```bash
# Hapus dan install ulang
rmdir /s /q node_modules
del package-lock.json
npm install
```

### Error: "Port 5173 already in use"

**Solusi:**
```bash
# Kill process di port 5173
netstat -ano | findstr :5173
taskkill /PID [PID_NUMBER] /F

# Atau restart komputer
```

## 🚨 Masalah: php artisan serve Error

### Error: "Port 8000 already in use"

**Solusi:**
```bash
# Gunakan port lain
php artisan serve --port=8001

# Atau kill process
netstat -ano | findstr :8000
taskkill /PID [PID_NUMBER] /F
```

## 📋 Complete Reset (Nuclear Option)

Jika semua cara di atas gagal, lakukan complete reset:

```bash
# 1. Stop semua server (Ctrl+C)

# 2. Clear everything
php artisan optimize:clear
composer dump-autoload
rmdir /s /q bootstrap\cache
mkdir bootstrap\cache

# 3. Clear database (HATI-HATI!)
php artisan migrate:fresh --seed

# 4. Recreate storage link
php artisan storage:link

# 5. Rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Restart servers
npm run dev  # Terminal 1
php artisan serve  # Terminal 2
```

## 🔍 Debug Checklist

Jika masih error, cek satu per satu:

### 1. File Structure
```bash
# Verify controllers ada
dir app\Http\Controllers\Frontend\HomeController.php
dir app\Http\Controllers\Admin\DashboardController.php

# Verify views ada
dir resources\views\frontend\home.blade.php
dir resources\views\layouts\frontend.blade.php
dir resources\views\layouts\admin.blade.php
```

### 2. Routes
```bash
php artisan route:list
```

Harus ada minimal:
- GET / → HomeController@index
- GET /produk → ProductController@index
- GET /admin/dashboard → DashboardController@index

### 3. Database
```bash
php artisan migrate:status
```

Harus tampil semua migration "Ran"

### 4. Cache
```bash
# Clear semua cache
php artisan optimize:clear
```

### 5. Permissions (jika di Linux/Mac)
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 6. Logs
Check error di:
```
storage/logs/laravel.log
```

## 💡 Prevention Tips

Untuk menghindari masalah di masa depan:

1. **Selalu clear cache** setelah:
   - Mengubah routes
   - Mengubah controller
   - Mengubah .env
   - Install package baru

2. **Gunakan batch files:**
   - `clear-cache.bat` untuk clear cache
   - `start-dev.bat` untuk start servers

3. **Backup database** secara berkala:
```bash
mysqldump -u root -p kalkayu_living > backup.sql
```

4. **Commit ke Git** setelah perubahan penting

## 🆘 Masih Bermasalah?

1. **Check Laravel Log:**
```bash
type storage\logs\laravel.log
```

2. **Check Browser Console:**
   - Buka Developer Tools (F12)
   - Lihat tab Console untuk error JavaScript

3. **Verify PHP Version:**
```bash
php -v
```
Harus PHP 8.1 atau lebih tinggi

4. **Verify Composer:**
```bash
composer diagnose
```

5. **Reinstall Dependencies:**
```bash
composer install
npm install
```

## 📞 Quick Commands Reference

```bash
# Clear cache
php artisan optimize:clear

# Verify routes
php artisan route:list

# Check migration status
php artisan migrate:status

# Recreate storage link
php artisan storage:link

# Dump autoload
composer dump-autoload

# Start servers
npm run dev  # Terminal 1
php artisan serve  # Terminal 2
```

---

**Jika mengikuti panduan ini dengan teliti, masalah seharusnya teratasi!**

Untuk bantuan lebih lanjut, baca:
- FIX_ROUTES.md
- INSTALL.md
- SETUP_GUIDE.md
