# 🔍 Troubleshoot: Gambar Tidak Muncul di Railway

## Masalah
1. Gambar tidak muncul di website Railway
2. Background login tidak ada gambar (hanya gradient)

---

## ✅ Solusi Lengkap

### Step 1: Verify Gambar Sudah Di-push ke GitHub

```bash
# Check apakah gambar ada di Git
git ls-files storage/app/public/
```

**Jika tidak ada output**, berarti gambar belum di-commit. Jalankan:

```bash
# Add gambar
git add storage/app/public/ -f

# Commit
git commit -m "Add all storage images"

# Push
git push origin main
```

---

### Step 2: Check di GitHub Repository

1. Buka repository GitHub Anda
2. Navigate ke: `storage/app/public/`
3. Pastikan folder ini ada:
   - `products/` (dengan file gambar)
   - `galleries/` (dengan file gambar)
   - `hero/` (dengan file gambar)

**Jika folder kosong atau tidak ada**, gambar belum ter-upload.

---

### Step 3: Force Add Gambar (Jika Step 1 Gagal)

```bash
# Remove .gitignore yang blocking
rm storage/app/public/.gitignore

# Add semua gambar
git add storage/app/public/ -f

# Commit
git commit -m "Force add all storage images"

# Push
git push origin main
```

---

### Step 4: Verify di Railway Logs

Setelah push, tunggu Railway deploy, lalu:

1. Buka Railway Dashboard
2. Klik service Laravel
3. Lihat logs deployment
4. Cari text: `The [public/storage] link has been connected`

---

### Step 5: Check APP_URL di Railway

1. Railway Dashboard → Service → Variables
2. Cari variable `APP_URL`
3. Pastikan valuenya sesuai domain Railway
4. Format: `https://your-app-name.up.railway.app`

**Jika salah atau tidak ada**, tambahkan:
```
APP_URL=https://your-actual-railway-domain.up.railway.app
```

---

## 🔧 Alternative: Upload Gambar Manual via Admin

Jika gambar tetap tidak muncul, cara tercepat:

1. Login ke admin Railway: `https://your-app.railway.app/login`
2. Buat user admin dulu (lihat cara di bawah)
3. Upload gambar ulang via admin panel

---

## 👤 Cara Buat Admin User di Railway

### Option A: Via Railway CLI

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# Link project
railway link

# Run tinker
railway run php artisan tinker
```

Lalu ketik:
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@kalkayu.com',
    'password' => bcrypt('admin123')
]);
```

Tekan Ctrl+D untuk exit.

### Option B: Via Database Seeder

Buat file seeder baru:

```bash
# Local
php artisan make:seeder AdminUserSeeder
```

Edit `database/seeders/AdminUserSeeder.php`:
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin KalKayu',
            'email' => 'admin@kalkayu.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
```

Commit dan push:
```bash
git add database/seeders/AdminUserSeeder.php
git commit -m "Add admin user seeder"
git push origin main
```

Lalu run di Railway:
```bash
railway run php artisan db:seed --class=AdminUserSeeder
```

---

## 🎯 Quick Fix: Pastikan Gambar Ter-commit

Jalankan script ini:

```bash
# Windows (PowerShell)
# Check gambar ada
Get-ChildItem -Path storage\app\public -Recurse -File

# Add ke git (force)
git add storage/app/public/ -f

# Check status
git status

# Commit
git commit -m "Add storage images - force add"

# Push
git push origin main
```

---

## 🐛 Debug: Check Image Path

Buka website Railway, lalu:

1. **Klik kanan** pada area gambar yang tidak muncul
2. **Inspect Element** (atau F12)
3. Lihat tag `<img src="...">`
4. Copy URL gambar
5. Paste di browser baru

**Jika 404**: Gambar tidak ada di server
**Jika 403**: Permission issue
**Jika 500**: Server error

---

## 📋 Checklist Troubleshooting

- [ ] Gambar ada di `storage/app/public/` (local)
- [ ] File `.gitignore` di `storage/app/public/` sudah diupdate
- [ ] Gambar sudah di-commit (`git ls-files storage/app/public/`)
- [ ] Gambar ada di GitHub repository
- [ ] Railway sudah redeploy setelah push
- [ ] `storage:link` berhasil (cek logs)
- [ ] `APP_URL` sudah benar di Railway variables
- [ ] Browser cache sudah di-clear

---

## 💡 Solusi Tercepat

Jika semua cara di atas ribet, cara tercepat:

1. **Buat admin user** (via Railway CLI tinker)
2. **Login ke admin** Railway
3. **Upload ulang gambar** via admin panel
4. **Done!** Gambar akan langsung muncul

---

## 📞 Need More Help?

Jika masih tidak bisa, berikan info:
1. Screenshot Railway logs (bagian deployment)
2. Screenshot GitHub repository (`storage/app/public/`)
3. URL Railway website
4. Screenshot browser console (F12 → Console)

Saya akan bantu debug lebih lanjut!
