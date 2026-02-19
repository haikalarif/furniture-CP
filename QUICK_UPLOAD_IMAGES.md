# 🚀 Quick Guide: Upload Images ke Railway

## Cara Tercepat (3 Langkah)

### 1️⃣ Jalankan Script
```bash
# Windows
upload-images.bat

# Atau manual
git add storage/app/public/
```

### 2️⃣ Commit & Push
```bash
git commit -m "Add storage images"
git push origin main
```

### 3️⃣ Tunggu Railway Deploy
- Railway auto-deploy (3-5 menit)
- Cek website, gambar sudah muncul!

---

## Verify Gambar Sudah Ter-commit

```bash
git status
```

Seharusnya muncul:
```
Changes to be committed:
  new file:   storage/app/public/products/xxx.png
  new file:   storage/app/public/galleries/xxx.png
  new file:   storage/app/public/hero/xxx.png
```

---

## Setelah Deploy

### Jika Gambar Belum Muncul
```bash
railway run php artisan storage:link
```

### Check Logs
```bash
railway logs
```

---

## File yang Diupload

Folder yang akan di-commit:
- ✅ `storage/app/public/products/` - Gambar produk
- ✅ `storage/app/public/galleries/` - Gambar galeri
- ✅ `storage/app/public/hero/` - Hero background
- ✅ `storage/app/public/testimonials/` - Avatar testimonial (jika ada)

---

## Total Size Check

```bash
# Check total size
dir storage\app\public /s
```

Pastikan tidak terlalu besar (< 100MB recommended)

---

**Dokumentasi lengkap**: Lihat `UPLOAD_IMAGES_TO_RAILWAY.md`
