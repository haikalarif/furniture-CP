# 🔧 Fix Login & Gambar di Railway

## 🚨 Masalah yang Terjadi

### 1. Tampilan Login Berbeda/Error
- Halaman login tampil tidak normal
- Mungkin error 500 atau tampilan rusak
- Background tidak muncul

### 2. Gambar Tidak Muncul
- Gambar produk, gallery, hero tidak tampil
- Broken image icon

---

## ✅ Solusi Lengkap

### STEP 1: Pastikan Database Migration Sudah Jalan

1. **Buka Railway Dashboard**
   - https://railway.app
   - Login → Pilih project Laravel

2. **Klik Tab "Deployments"**
   - Pilih deployment terakhir (yang paling atas)
   - Klik untuk lihat detail

3. **Scroll ke Bagian "Deploy Logs"**
   - Cari baris yang ada `php artisan migrate --force`
   - Pastikan tidak ada error
   - Seharusnya ada output: `Migration table created successfully`

4. **Jika Migration Gagal atau Tidak Ada**
   
   Jalankan manual via Railway CLI:
   ```bash
   # Install Railway CLI dulu (jika belum)
   # Windows: Download dari https://railway.app/cli
   
   # Login
   railway login
   
   # Link ke project
   railway link
   
   # Jalankan migration
   railway run php artisan migrate --force
   
   # Jalankan seeder (optional, untuk data dummy)
   railway run php artisan db:seed --force
   ```

---

### STEP 2: Pastikan Storage Link Sudah Jalan

1. **Check Deploy Logs**
   - Railway Dashboard → Deployments → Latest
   - Scroll ke bagian "Start Logs" (bukan Deploy Logs)
   - Cari baris: `The [public/storage] link has been connected`

2. **Jika Tidak Ada atau Error**
   
   Jalankan manual:
   ```bash
   railway run php artisan storage:link --force
   ```

3. **Verify Storage Link**
   ```bash
   # Check apakah folder storage/app/public ada
   railway run ls -la storage/app/public
   
   # Check apakah symlink public/storage ada
   railway run ls -la public/storage
   ```

---

### STEP 3: Upload Gambar ke Railway

Ada 2 cara:

#### Cara A: Via Git (Recommended)

1. **Update .gitignore untuk Allow Images**
   
   File `storage/app/public/.gitignore` sudah diupdate, pastikan isinya:
   ```
   !.gitignore
   !products/
   !galleries/
   !hero/
   ```

2. **Commit & Push Images**
   ```bash
   # Add semua file di storage
   git add storage/app/public/
   
   # Commit
   git commit -m "Add storage images for Railway"
   
   # Push ke GitHub
   git push origin main
   ```

3. **Railway Auto-Deploy**
   - Railway akan otomatis detect push
   - Wait sampai deployment selesai
   - Check website, gambar seharusnya muncul

#### Cara B: Upload Manual via Admin Panel

1. **Buka Railway Website**
   - `https://your-app.up.railway.app`

2. **Login sebagai Admin**
   - Jika belum ada user, buat dulu (lihat STEP 4)

3. **Upload Ulang Gambar**
   - Masuk ke menu Produk → Edit
   - Upload gambar lagi
   - Simpan

---

### STEP 4: Buat Admin User (Jika Belum Ada)

1. **Via Railway CLI**
   ```bash
   railway run php artisan tinker
   ```

2. **Di Tinker, Jalankan:**
   ```php
   $user = new App\Models\User();
   $user->name = 'Admin';
   $user->email = 'admin@kalkayu.com';
   $user->password = bcrypt('password123');
   $user->save();
   exit
   ```

3. **Login**
   - Buka: `https://your-app.up.railway.app/login`
   - Email: `admin@kalkayu.com`
   - Password: `password123`

---

### STEP 5: Fix HTTPS Warning

1. **Update APP_URL di Railway**
   - Railway Dashboard → Service → Variables
   - Cari `APP_URL`
   - Update value: `https://your-app.up.railway.app`
   - **PENTING**: Pakai `https://` bukan `http://`

2. **Tambah Variable Baru**
   - Klik "+ New Variable"
   - Name: `SESSION_SECURE_COOKIE`
   - Value: `true`

3. **Redeploy**
   - Railway auto-redeploy setelah update variable
   - Atau manual: Tab "Deployments" → "Redeploy"

---

## 🔍 Troubleshooting

### Problem: Login Masih Error 500

**Solusi:**
```bash
# Clear cache
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear

# Restart service
# Railway Dashboard → Service → Settings → Restart
```

### Problem: Gambar Masih Tidak Muncul

**Check 1: Verify Storage Link**
```bash
railway run ls -la public/storage
# Seharusnya output: public/storage -> ../storage/app/public
```

**Check 2: Verify Images Exist**
```bash
railway run ls -la storage/app/public/products
railway run ls -la storage/app/public/galleries
railway run ls -la storage/app/public/hero
```

**Check 3: Verify APP_URL**
```bash
railway run php artisan config:show app.url
# Seharusnya: https://your-app.up.railway.app
```

**Check 4: File Permissions**
```bash
railway run chmod -R 755 storage
railway run chmod -R 755 public/storage
```

### Problem: Database Connection Refused

**Solusi:**
1. Railway Dashboard → Service MySQL → Variables
2. Copy semua variable (DB_HOST, DB_PORT, DB_DATABASE, dll)
3. Paste ke Service Laravel → Variables
4. Pastikan nama variable sama persis
5. Redeploy

---

## 📋 Checklist Lengkap

- [ ] Migration sudah jalan (check deploy logs)
- [ ] Storage link sudah jalan (check start logs)
- [ ] Gambar sudah di-commit ke Git
- [ ] Gambar sudah di-push ke GitHub
- [ ] Railway sudah auto-deploy
- [ ] APP_URL pakai `https://` (bukan `http://`)
- [ ] SESSION_SECURE_COOKIE=true sudah ditambahkan
- [ ] Admin user sudah dibuat
- [ ] Bisa login tanpa error
- [ ] Gambar muncul di website

---

## 🎯 Quick Commands

```bash
# Install Railway CLI (Windows)
# Download: https://railway.app/cli

# Login & Link
railway login
railway link

# Run Migration
railway run php artisan migrate --force

# Run Seeder
railway run php artisan db:seed --force

# Storage Link
railway run php artisan storage:link --force

# Clear Cache
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear

# Create Admin User
railway run php artisan tinker
# Lalu jalankan code PHP di atas

# Check Logs
railway logs

# Check Variables
railway variables
```

---

## 🚀 Expected Result

Setelah semua step selesai:

1. ✅ Website bisa diakses: `https://your-app.up.railway.app`
2. ✅ Login page tampil normal dengan background gradient
3. ✅ Bisa login tanpa error atau warning
4. ✅ Gambar produk, gallery, hero muncul semua
5. ✅ Admin panel berfungsi normal
6. ✅ URL bar menampilkan gembok 🔒 (HTTPS aktif)

---

## 💡 Tips

1. **Selalu Check Logs**
   - Deploy Logs: untuk build & migration
   - Start Logs: untuk runtime & storage link
   - Application Logs: untuk error aplikasi

2. **Railway CLI Sangat Berguna**
   - Install untuk troubleshooting lebih mudah
   - Bisa run command langsung ke server
   - Bisa lihat logs real-time

3. **Backup Database**
   ```bash
   # Export database dari Railway
   railway run mysqldump -u root -p database_name > backup.sql
   ```

4. **Monitor Resource Usage**
   - Railway Dashboard → Service → Metrics
   - Check CPU, Memory, Network usage

---

## 📞 Butuh Bantuan?

Jika masih ada masalah:

1. Screenshot error message
2. Copy paste deploy logs
3. Copy paste start logs
4. Share Railway domain URL
5. Tanyakan ke saya dengan detail lengkap

---

**Good luck! 🚀**
