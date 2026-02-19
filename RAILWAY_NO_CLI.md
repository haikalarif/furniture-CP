# 🚀 Railway Setup TANPA CLI

## Semua Via Dashboard - Tidak Perlu CLI!

---

## Step 1: Jalankan Migration & Storage Link

### Via Railway Dashboard

1. **Buka Railway Dashboard**
   - https://railway.app
   - Login → Pilih project

2. **Klik Service Laravel**

3. **Klik Tab "Settings"**
   - Scroll ke bawah
   - Cari bagian **"Service"**
   - Lihat **"Start Command"**

4. **Update Start Command**
   
   Ganti dengan command ini:
   ```bash
   php artisan migrate --force && php artisan storage:link --force && php artisan config:clear && php artisan cache:clear && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

5. **Klik "Deploy"** atau tunggu auto-redeploy

6. **Check Logs**
   - Klik tab "Deployments"
   - Pilih deployment terakhir
   - Lihat logs, pastikan ada:
     - `Migration table created successfully`
     - `The [public/storage] link has been connected`

---

## Step 2: Buat Admin User

### Via Railway Dashboard (Tanpa CLI)

Sayangnya untuk buat user, kita butuh akses database. Ada 2 cara:

#### Cara A: Via phpMyAdmin (Paling Mudah)

1. **Install phpMyAdmin di Railway**
   
   - Railway Dashboard → "+ New"
   - Pilih "Template"
   - Search "phpMyAdmin"
   - Deploy
   - Link ke MySQL database yang sama

2. **Buka phpMyAdmin**
   - Klik service phpMyAdmin
   - Klik domain yang digenerate
   - Login dengan credentials MySQL

3. **Buat User Manual**
   
   Pilih database → Pilih table `users` → Insert:
   
   ```
   name: Admin
   email: admin@kalkayu.com
   password: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
   (ini adalah hash untuk password: "password")
   ```

#### Cara B: Via Code (Temporary Route)

1. **Buat Route Temporary**
   
   Edit file `routes/web.php`, tambahkan di paling bawah:
   
   ```php
   // TEMPORARY - Hapus setelah user dibuat!
   Route::get('/create-admin-temp', function () {
       try {
           $user = new \App\Models\User();
           $user->name = 'Admin';
           $user->email = 'admin@kalkayu.com';
           $user->password = bcrypt('password123');
           $user->save();
           
           return 'Admin user created! Email: admin@kalkayu.com, Password: password123<br><br>IMPORTANT: Hapus route ini dari routes/web.php!';
       } catch (\Exception $e) {
           return 'Error: ' . $e->getMessage();
       }
   });
   ```

2. **Commit & Push**
   ```bash
   git add routes/web.php
   git commit -m "Add temporary admin creation route"
   git push origin main
   ```

3. **Tunggu Railway Deploy**

4. **Akses Route**
   - Buka: `https://your-app.up.railway.app/create-admin-temp`
   - Seharusnya muncul: "Admin user created!"

5. **PENTING: Hapus Route Ini!**
   
   Edit `routes/web.php`, hapus route yang baru ditambahkan:
   ```bash
   git add routes/web.php
   git commit -m "Remove temporary admin route"
   git push origin main
   ```

---

## Step 3: Update Environment Variables

1. **Buka Railway Dashboard**
   - Service Laravel → Tab "Variables"

2. **Update APP_URL**
   - Cari variable `APP_URL`
   - Klik untuk edit
   - Ganti dengan: `https://your-app.up.railway.app`
   - **PENTING**: Ganti `your-app` dengan domain Railway kamu
   - **PENTING**: Pakai `https://` bukan `http://`

3. **Tambah Variable Baru**
   
   Klik "+ New Variable", tambahkan:
   
   ```
   Name: SESSION_SECURE_COOKIE
   Value: true
   ```
   
   ```
   Name: APP_DEBUG
   Value: false
   ```

4. **Save & Redeploy**
   - Railway akan auto-redeploy
   - Tunggu sampai selesai

---

## Step 4: Upload Gambar

### Via Git (Recommended)

1. **Pastikan .gitignore Sudah Benar**
   
   File `storage/app/public/.gitignore` seharusnya sudah diupdate.

2. **Commit & Push Images**
   ```bash
   git add storage/app/public/
   git commit -m "Add storage images for Railway"
   git push origin main
   ```

3. **Tunggu Railway Auto-Deploy**

4. **Verify**
   - Buka website
   - Check apakah gambar muncul

### Via Upload Manual (Alternative)

1. **Login ke Admin Panel**
   - `https://your-app.up.railway.app/login`
   - Email: `admin@kalkayu.com`
   - Password: `password123` (atau yang kamu set)

2. **Upload Ulang Gambar**
   - Menu Produk → Edit → Upload gambar
   - Menu Gallery → Edit → Upload gambar
   - Menu Pages → Edit Home → Upload hero image

---

## Step 5: Verify Everything

### Check 1: Website Bisa Diakses
- Buka: `https://your-app.up.railway.app`
- Seharusnya tampil normal

### Check 2: Login Page
- Buka: `https://your-app.up.railway.app/login`
- Seharusnya tampil dengan background gradient
- Tidak ada error 500

### Check 3: Login Berhasil
- Login dengan credentials admin
- Seharusnya masuk ke dashboard admin

### Check 4: Gambar Muncul
- Check halaman produk
- Check halaman gallery
- Gambar seharusnya tampil

### Check 5: HTTPS Aktif
- URL bar ada gembok 🔒
- URL dimulai dengan `https://`

---

## Troubleshooting

### Problem: Login Page Error 500

**Solusi:**

1. Check Logs di Railway:
   - Tab "Deployments" → Latest → View logs
   - Cari error message

2. Pastikan migration sudah jalan:
   - Logs seharusnya ada: `Migration table created successfully`

3. Jika migration belum jalan, update Start Command (lihat Step 1)

### Problem: Gambar Tidak Muncul

**Solusi:**

1. Check Start Command sudah include `storage:link`:
   ```bash
   php artisan storage:link --force
   ```

2. Check logs ada message:
   ```
   The [public/storage] link has been connected
   ```

3. Jika tidak ada, update Start Command (lihat Step 1)

### Problem: Database Connection Error

**Solusi:**

1. Railway Dashboard → Service MySQL → Tab "Variables"

2. Copy semua variable:
   - `MYSQL_DATABASE`
   - `MYSQL_HOST`
   - `MYSQL_PASSWORD`
   - `MYSQL_PORT`
   - `MYSQL_USER`

3. Paste ke Service Laravel → Tab "Variables":
   - `DB_DATABASE` = `MYSQL_DATABASE`
   - `DB_HOST` = `MYSQL_HOST`
   - `DB_PASSWORD` = `MYSQL_PASSWORD`
   - `DB_PORT` = `MYSQL_PORT`
   - `DB_USERNAME` = `MYSQL_USER`

4. Redeploy

### Problem: HTTPS Warning Saat Login

**Solusi:**

1. Pastikan `APP_URL` pakai `https://` (bukan `http://`)

2. Pastikan `SESSION_SECURE_COOKIE=true` sudah ditambahkan

3. Clear browser cache:
   - Ctrl + Shift + Delete
   - Clear cache & cookies

4. Refresh page

---

## Cara Lihat Logs (Tanpa CLI)

1. **Railway Dashboard**
   - Service Laravel → Tab "Deployments"

2. **Pilih Deployment Terakhir**
   - Klik deployment paling atas

3. **View Logs**
   - **Build Logs**: Proses build & migration
   - **Deploy Logs**: Proses deployment
   - **View Logs**: Runtime logs (aplikasi jalan)

4. **Cari Error**
   - Ctrl + F untuk search
   - Cari kata: "error", "failed", "exception"

---

## Alternative: Gunakan Railway Template

Jika masih banyak masalah, coba deploy ulang dengan template:

1. **Backup Database**
   - Export data penting (produk, gallery, dll)

2. **Deploy Baru**
   - Railway Dashboard → "+ New"
   - Pilih "Deploy from GitHub repo"
   - Pilih repository
   - Railway akan auto-detect Laravel

3. **Setup Variables**
   - Tambahkan semua environment variables
   - Link ke MySQL database

4. **Import Data**
   - Via phpMyAdmin atau SQL file

---

## Checklist

- [ ] Start Command sudah include migration & storage:link
- [ ] Deployment berhasil (check logs)
- [ ] Admin user sudah dibuat
- [ ] APP_URL pakai `https://`
- [ ] SESSION_SECURE_COOKIE=true sudah ditambahkan
- [ ] Gambar sudah di-commit & push
- [ ] Website bisa diakses
- [ ] Login berhasil
- [ ] Gambar muncul

---

## Summary

**Tanpa CLI, kamu bisa:**

1. ✅ Setup migration & storage via Start Command
2. ✅ Buat admin user via temporary route atau phpMyAdmin
3. ✅ Update environment variables via Dashboard
4. ✅ Upload gambar via Git push
5. ✅ Monitor logs via Dashboard

**Tidak perlu CLI sama sekali!**

---

## Need Help?

Jika masih ada masalah:

1. Screenshot error message
2. Screenshot Railway logs
3. Share Railway domain URL
4. Tanyakan dengan detail lengkap

---

**Good luck! 🚀**
