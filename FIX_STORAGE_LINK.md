# 🔧 Fix Storage Link - Gambar Tidak Muncul

## Masalah
Gambar tidak muncul karena `storage:link` belum dijalankan.

## ✅ Solusi: Otomatis Storage Link

File konfigurasi sudah diupdate agar `storage:link` otomatis run setiap deploy.

---

## 🚀 Langkah-langkah

### Step 1: Commit & Push Update
```bash
git add .
git commit -m "Fix: Add automatic storage link on deployment"
git push origin main
```

### Step 2: Tunggu Railway Redeploy
- Railway akan otomatis detect push
- Tunggu 3-5 menit untuk deployment selesai
- Cek logs untuk memastikan `storage:link` berhasil

### Step 3: Verify Gambar Muncul
- Refresh website Anda
- Cek homepage, produk, dan galeri
- Gambar seharusnya sudah muncul! 🎉

---

## 🔍 Cara Cek Logs di Railway

1. **Buka Railway Dashboard**
   - https://railway.app
   - Login dan pilih project

2. **Klik Service Laravel**
   - Klik service yang running

3. **Lihat Logs**
   - Scroll ke bawah, ada section "Logs" atau "Build Logs"
   - Atau klik tab "Deployments" → klik deployment terakhir → "View Logs"

4. **Cari Output Storage Link**
   ```
   The [public/storage] link has been connected to [storage/app/public]
   ```

---

## 📋 What Changed

### nixpacks.json
```json
"start": {
  "cmd": "php artisan storage:link --force && ..."
}
```

### Procfile
```
web: php artisan storage:link --force && ...
```

### railway.json
```json
"startCommand": "php artisan storage:link --force && ..."
```

Sekarang setiap kali deploy, `storage:link` akan otomatis dijalankan!

---

## 🎯 Alternative: Manual Redeploy (Jika Tidak Mau Push)

Jika tidak ingin push code, bisa manual redeploy di Railway:

1. **Buka Railway Dashboard**
2. **Klik Service Laravel**
3. **Klik tab "Deployments"**
4. **Klik tombol "Redeploy"** atau **"Deploy"**
5. Tunggu deployment selesai

Tapi dengan cara ini, storage:link tidak akan run karena konfigurasi belum terupdate.

**Recommended: Push code baru agar storage:link otomatis!**

---

## 🐛 Troubleshooting

### Gambar Masih Belum Muncul Setelah Redeploy

**Check 1: Verify Storage Link di Logs**
- Cek Railway logs
- Cari text: `The [public/storage] link has been connected`
- Jika tidak ada, berarti storage:link gagal

**Check 2: Verify APP_URL**
- Railway Dashboard → Service → Variables
- Pastikan `APP_URL` benar
- Format: `https://your-app-name.up.railway.app`

**Check 3: Verify Gambar Ter-upload**
- Pastikan folder `storage/app/public/` sudah di-push ke GitHub
- Check di GitHub repository: `storage/app/public/products/`
- Seharusnya ada file gambar

**Check 4: Browser Cache**
- Clear browser cache (Ctrl + Shift + Delete)
- Atau buka incognito/private window
- Refresh website

**Check 5: Check Image URL**
- Buka website
- Klik kanan pada gambar yang tidak muncul → "Inspect" atau "Inspect Element"
- Lihat URL gambar di `src` attribute
- Seharusnya: `https://your-app.railway.app/storage/products/xxx.png`
- Jika URL salah, cek APP_URL

---

## 💡 Verify Gambar Sudah Di-push

```bash
# Check di local
git log --oneline | head -5

# Seharusnya ada commit:
# "Add storage images for Railway"
```

Jika belum, run:
```bash
git add storage/app/public/
git commit -m "Add storage images"
git push origin main
```

---

## ✅ Success Indicators

Setelah redeploy berhasil, Anda akan lihat:

1. **Di Railway Logs:**
   ```
   The [public/storage] link has been connected to [storage/app/public]
   Migration table created successfully.
   Configuration cache cleared!
   Route cache cleared!
   View cache cleared!
   Laravel development server started: http://0.0.0.0:XXXX
   ```

2. **Di Website:**
   - Hero background muncul
   - Gambar produk muncul
   - Gambar galeri muncul

---

## 🎉 Done!

Setelah push dan redeploy, gambar seharusnya sudah muncul.

**Jika masih ada masalah, screenshot error dan logs nya!**
