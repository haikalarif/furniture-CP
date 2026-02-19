# 🚀 Railway Setup - TANPA CLI

## Tidak Perlu Install Railway CLI!

Semua bisa dilakukan via:
- ✅ Railway Dashboard (Web)
- ✅ Git Push
- ✅ Code (Temporary Route)

---

## 3 Langkah Mudah

### 1️⃣ Buat Admin User

**Cara Termudah: Via Temporary Route**

1. Edit `routes/web.php`, tambahkan di paling bawah:

```php
// TEMPORARY - Hapus setelah selesai!
Route::get('/setup-admin-kalkayu-2026', function () {
    try {
        $existingUser = \App\Models\User::where('email', 'admin@kalkayu.com')->first();
        if ($existingUser) {
            return 'User sudah ada! <a href="/login">Login</a>';
        }
        
        $user = new \App\Models\User();
        $user->name = 'Admin';
        $user->email = 'admin@kalkayu.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('password123');
        $user->save();
        
        return 'Admin created! Email: admin@kalkayu.com, Password: password123<br><a href="/login">Login</a><br><br><strong>HAPUS route ini dari routes/web.php!</strong>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
```

2. Commit & Push:
```bash
git add routes/web.php
git commit -m "Add temporary admin route"
git push origin main
```

3. Tunggu Railway deploy selesai

4. Akses: `https://your-app.up.railway.app/setup-admin-kalkayu-2026`

5. **PENTING: Hapus route ini setelah user dibuat!**

---

### 2️⃣ Update Environment Variables

**Via Railway Dashboard:**

1. Buka: https://railway.app
2. Pilih project → Service Laravel
3. Tab "Variables"
4. Update/Tambah:

```
APP_URL = https://your-app.up.railway.app
SESSION_SECURE_COOKIE = true
APP_DEBUG = false
```

**PENTING:** Ganti `your-app` dengan domain Railway kamu!

5. Railway akan auto-redeploy

---

### 3️⃣ Upload Gambar

**Via Git Push:**

```bash
git add storage/app/public/
git commit -m "Add images for Railway"
git push origin main
```

Railway akan auto-deploy dan gambar akan muncul.

---

## Verify

1. **Website:** `https://your-app.up.railway.app` ✅
2. **Login:** `https://your-app.up.railway.app/login` ✅
3. **Credentials:**
   - Email: `admin@kalkayu.com`
   - Password: `password123`
4. **Gambar:** Seharusnya muncul ✅

---

## Troubleshooting

### Login Error 500?

Check Railway logs:
- Dashboard → Deployments → Latest → View Logs
- Cari error message

### Gambar Tidak Muncul?

Check logs ada message:
```
The [public/storage] link has been connected
```

Jika tidak ada, update Procfile (sudah benar di project ini).

### Database Error?

Pastikan MySQL service running:
- Dashboard → Service MySQL → Check status

---

## Dokumentasi Lengkap

- **RAILWAY_NO_CLI.md** - Panduan lengkap tanpa CLI
- **CREATE_ADMIN_ROUTE.md** - Detail cara buat admin user
- **FIX_HTTPS_RAILWAY.md** - Fix HTTPS warning

---

## Kesimpulan

**Tidak perlu Railway CLI!** 

Cukup:
1. ✅ Tambah route temporary untuk buat admin
2. ✅ Update variables via Dashboard
3. ✅ Push gambar via Git

Selesai! 🎉

---

**Good luck! 🚀**
