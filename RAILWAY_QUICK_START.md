# 🚀 Railway Quick Start Guide

## Masalah Saat Ini

1. ❌ Login page tampil tidak normal
2. ❌ Gambar tidak muncul
3. ❌ Mungkin ada error 500

## Solusi Cepat (5 Menit)

### Step 1: Install Railway CLI

1. Download Railway CLI:
   - https://railway.app/cli
   - Pilih Windows installer
   - Install seperti biasa

2. Buka Command Prompt (CMD)

3. Login ke Railway:
   ```bash
   railway login
   ```
   - Browser akan terbuka
   - Login dengan akun Railway
   - Kembali ke CMD

4. Link ke project:
   ```bash
   railway link
   ```
   - Pilih project Laravel kamu
   - Pilih service Laravel (bukan MySQL)

---

### Step 2: Jalankan Setup Otomatis

Di folder project, jalankan:

```bash
railway-setup.bat
```

Script ini akan:
- ✅ Run migration
- ✅ Create storage link
- ✅ Clear cache
- ✅ (Optional) Run seeder

---

### Step 3: Buat Admin User

```bash
railway-create-admin.bat
```

Ikuti instruksi:
- Name: Admin (atau nama lain)
- Email: admin@kalkayu.com (atau email lain)
- Password: password123 (atau password lain)

---

### Step 4: Update APP_URL

1. Buka Railway Dashboard: https://railway.app

2. Pilih project → Service Laravel

3. Klik tab "Variables"

4. Cari variable `APP_URL`

5. Update value menjadi: `https://your-app.up.railway.app`
   - **PENTING**: Ganti `your-app` dengan domain Railway kamu
   - **PENTING**: Pakai `https://` bukan `http://`

6. Tambah variable baru:
   - Name: `SESSION_SECURE_COOKIE`
   - Value: `true`

7. Railway akan auto-redeploy

---

### Step 5: Upload Gambar

#### Option A: Via Git (Recommended)

```bash
# Add images
git add storage/app/public/

# Commit
git commit -m "Add images for Railway"

# Push
git push origin main
```

Railway akan auto-deploy dan gambar akan muncul.

#### Option B: Upload Manual

1. Login ke admin panel: `https://your-app.up.railway.app/login`
2. Upload ulang gambar di menu Produk, Gallery, dll

---

## Verify Everything Works

1. **Check Website**
   - Buka: `https://your-app.up.railway.app`
   - Seharusnya tampil normal

2. **Check Login**
   - Buka: `https://your-app.up.railway.app/login`
   - Login dengan credentials yang dibuat di Step 3
   - Seharusnya bisa masuk tanpa error

3. **Check Images**
   - Lihat halaman produk, gallery
   - Gambar seharusnya muncul

4. **Check HTTPS**
   - URL bar seharusnya ada gembok 🔒
   - URL dimulai dengan `https://`

---

## Troubleshooting

### Login Masih Error?

```bash
# Clear cache
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear
```

### Gambar Masih Tidak Muncul?

```bash
# Check storage link
railway run ls -la public/storage

# Re-create storage link
railway run php artisan storage:link --force
```

### Check Logs

```bash
railway logs
```

Atau jalankan:
```bash
railway-check.bat
```

---

## Helper Scripts

Saya sudah buatkan 3 script helper:

1. **railway-setup.bat**
   - Setup awal: migration, storage link, cache clear

2. **railway-create-admin.bat**
   - Buat admin user untuk login

3. **railway-check.bat**
   - Health check: cek connection, variables, logs

---

## Expected Result

Setelah semua step:

✅ Website bisa diakses
✅ Login page tampil normal
✅ Bisa login tanpa error
✅ Gambar muncul semua
✅ Admin panel berfungsi
✅ HTTPS aktif (gembok 🔒)

---

## Need Help?

Jika masih ada masalah, jalankan:

```bash
railway-check.bat
```

Lalu screenshot hasilnya dan tanyakan ke saya.

---

## Dokumentasi Lengkap

- `RAILWAY_LOGIN_FIX.md` - Troubleshooting detail
- `FIX_HTTPS_RAILWAY.md` - Fix HTTPS warning
- `DEPLOY_RAILWAY_STEP_BY_STEP.md` - Deploy guide lengkap

---

**Good luck! 🚀**
