# 🚀 Panduan Deploy Railway - Step by Step

## Persiapan Sebelum Deploy

### 1. Pastikan File-file Ini Ada di Repository
- ✅ `.php-version` (berisi: 8.2)
- ✅ `nixpacks.json` (konfigurasi build dengan Node.js)
- ✅ `railway.json` (konfigurasi Railway)
- ✅ `Procfile` (start command)
- ✅ `composer.json` (require PHP ^8.2)
- ✅ `package.json` (npm dependencies untuk Vite)
- ✅ `vite.config.js` (Vite configuration)

### 2. Push ke GitHub
```bash
git add .
git commit -m "Ready for Railway deployment"
git push origin main
```

**Note**: Railway akan otomatis:
- Install PHP 8.2 dan Node.js 20
- Run `composer install`
- Run `npm install` dan `npm run build` (untuk compile assets)
- Run migrations saat start

---

## 📋 Langkah Deploy ke Railway

### STEP 1: Buat Akun Railway
1. Buka https://railway.app
2. Klik **"Login"** atau **"Start a New Project"**
3. Login dengan GitHub
4. Authorize Railway untuk akses repository

---

### STEP 2: Buat Project Baru
1. Di dashboard Railway, klik **"New Project"**
2. Pilih **"Deploy from GitHub repo"**
3. Pilih repository **kalkayu-living** (atau nama repo Anda)
4. Railway akan mulai build (BIARKAN GAGAL DULU, kita perlu setup database)

---

### STEP 3: Tambah MySQL Database
**PENTING: Lakukan ini SEBELUM deploy ulang Laravel**

1. Di project Railway, klik tombol **"+ New"**
2. Pilih **"Database"**
3. Pilih **"Add MySQL"**
4. Tunggu hingga MySQL status menjadi **"Active"** (hijau)
5. Klik MySQL service → tab **"Variables"** → catat credentials

---

### STEP 4: Link Database ke Laravel Service
1. Klik service Laravel Anda (bukan MySQL)
2. Klik tab **"Variables"**
3. Klik **"+ New Variable"** → **"Add Reference"**
4. Pilih MySQL service, lalu tambahkan:
   - `MYSQLHOST` → rename jadi `DB_HOST`
   - `MYSQLPORT` → rename jadi `DB_PORT`
   - `MYSQLDATABASE` → rename jadi `DB_DATABASE`
   - `MYSQLUSER` → rename jadi `DB_USERNAME`
   - `MYSQLPASSWORD` → rename jadi `DB_PASSWORD`

---

### STEP 5: Tambah Environment Variables
Masih di tab **"Variables"**, klik **"+ New Variable"** → **"Add Variables"**

Copy-paste ini (ganti nilai yang perlu):

```env
APP_NAME=KalKayu Living
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stack
LOG_LEVEL=error
FILESYSTEM_DISK=public
```

---

### STEP 6: Generate APP_KEY
**Di komputer lokal**, jalankan:
```bash
php artisan key:generate --show
```

Copy output (contoh: `base64:xxxxxxxxxxxxx`)

Kembali ke Railway → Variables → tambahkan:
```env
APP_KEY=base64:xxxxxxxxxxxxx
```
(paste hasil dari command di atas)

---

### STEP 7: Set APP_URL
1. Di Railway, klik service Laravel → tab **"Settings"**
2. Scroll ke **"Networking"** → klik **"Generate Domain"**
3. Copy domain yang digenerate (contoh: `kalkayu-living-production.up.railway.app`)
4. Kembali ke tab **"Variables"** → tambahkan:
```env
APP_URL=https://kalkayu-living-production.up.railway.app
```
(ganti dengan domain Anda)

---

### STEP 8: Deploy Ulang
1. Klik tab **"Deployments"**
2. Klik **"Deploy"** atau **"Redeploy"**
3. Tunggu proses build (3-5 menit)
4. Lihat logs untuk memastikan:
   - ✅ Build successful
   - ✅ Migration running
   - ✅ Server started

---

### STEP 9: Verifikasi Deployment
1. Buka domain Railway Anda di browser
2. Seharusnya muncul halaman home KalKayu Living
3. Coba akses `/login` untuk test

---

### STEP 10: Storage Link (Untuk Upload Gambar)
**Setelah deployment berhasil**, jalankan command ini:

#### Option A: Via Railway CLI
```bash
# Install Railway CLI (jika belum)
npm i -g @railway/cli

# Login
railway login

# Link ke project
railway link

# Run storage link
railway run php artisan storage:link
```

#### Option B: Via Railway Dashboard
1. Klik service Laravel → tab **"Shell"**
2. Tunggu shell terbuka
3. Ketik: `php artisan storage:link`
4. Enter

---

## 🎉 Selesai!

Website Anda sekarang live di Railway!

---

## 🔧 Troubleshooting

### ❌ Build Failed
**Cek logs untuk error spesifik:**
1. Tab "Deployments" → klik deployment terakhir
2. Lihat error message
3. Biasanya karena:
   - Composer dependencies error → cek `composer.json`
   - PHP version mismatch → pastikan `.php-version` ada
   - NPM build error → cek `package.json` dan `vite.config.js`

**Error: "npm: command not found"**
- Pastikan `nixpacks.json` include `nodejs_20` dan `npm-9_x`
- Redeploy setelah update nixpacks.json

**Error: "npm run build failed"**
- Cek apakah `package.json` ada
- Cek apakah `vite.config.js` ada
- Pastikan dependencies di `package.json` valid

### ❌ Migration Failed
**Error: "Connection refused"**
- Pastikan MySQL service sudah **Active** (hijau)
- Pastikan database variables sudah di-link dengan benar
- Coba deploy ulang

**Error: "Access denied"**
- Cek DB_USERNAME dan DB_PASSWORD
- Pastikan menggunakan reference variables dari MySQL service

### ❌ 500 Error di Website
**Cek logs:**
1. Tab "Deployments" → klik "View Logs"
2. Lihat error Laravel

**Kemungkinan penyebab:**
- APP_KEY tidak di-set → generate dan set di variables
- APP_DEBUG=true → ubah jadi false
- Database connection error → cek DB credentials

### ❌ Gambar Tidak Muncul
- Jalankan `php artisan storage:link` via Railway CLI/Shell
- Pastikan APP_URL sudah benar
- Cek FILESYSTEM_DISK=public

---

## 📝 Checklist Environment Variables

Pastikan semua ini sudah di-set:

- [ ] `APP_NAME`
- [ ] `APP_ENV=production`
- [ ] `APP_KEY` (dari php artisan key:generate)
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` (domain Railway)
- [ ] `DB_CONNECTION=mysql`
- [ ] `DB_HOST` (reference dari MySQL)
- [ ] `DB_PORT` (reference dari MySQL)
- [ ] `DB_DATABASE` (reference dari MySQL)
- [ ] `DB_USERNAME` (reference dari MySQL)
- [ ] `DB_PASSWORD` (reference dari MySQL)
- [ ] `SESSION_DRIVER=file`
- [ ] `QUEUE_CONNECTION=sync`
- [ ] `LOG_CHANNEL=stack`
- [ ] `LOG_LEVEL=error`
- [ ] `FILESYSTEM_DISK=public`

---

## 🚀 Deploy Update Selanjutnya

Setelah setup awal, untuk deploy update:

1. Push ke GitHub:
```bash
git add .
git commit -m "Update feature"
git push origin main
```

2. Railway akan **auto-deploy** (jika webhook aktif)
3. Atau manual: Dashboard → Deployments → Deploy

---

## 📞 Butuh Bantuan?

- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
- Railway Status: https://status.railway.app

---

## 💡 Tips

1. **Monitoring**: Cek logs secara berkala di tab "Deployments"
2. **Database Backup**: Railway MySQL tidak auto-backup, pertimbangkan backup manual
3. **Custom Domain**: Bisa tambahkan domain sendiri di Settings → Networking
4. **Environment**: Jangan pernah set APP_DEBUG=true di production
5. **Scaling**: Railway auto-scale, tapi perhatikan usage limits

---

**Good luck! 🎉**
