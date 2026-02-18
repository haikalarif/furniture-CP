# 🔧 Fix Hero Background - Panduan Lengkap

## 📋 Langkah-Langkah Perbaikan

### Step 1: Clear Cache
```bash
# Double click atau jalankan:
clear-cache.bat

# Atau manual:
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

### Step 2: Restart Servers
```bash
# Stop servers (Ctrl+C di kedua terminal)
# Lalu start lagi:

# Terminal 1:
npm run dev

# Terminal 2:
php artisan serve
```

### Step 3: Cek Debug Info
1. Buka: http://localhost:8000
2. Lihat pojok kanan bawah
3. Ada kotak hitam dengan info debug

**Yang Harus Dicek:**
- `Theme:` harus ada nilai (default, ramadan, dll)
- `Background:` harus ada path file (hero/xxxxx.jpg)
- `File Exists:` harus **✓ YES** (hijau)

### Step 4: Jika File Exists = ✗ NO (Merah)

**Artinya:** File tidak ter-upload dengan benar

**Solusi:**

#### A. Cek Folder Upload
```bash
# Buka folder ini:
storage/app/public/hero/
```

Harus ada file gambar yang baru di-upload.

**Jika folder tidak ada:**
```bash
# Buat folder manual
mkdir storage/app/public/hero
```

#### B. Cek Storage Link
```bash
# Hapus link lama
rm public/storage

# Buat link baru
php artisan storage:link
```

Verify: Folder `public/storage` harus ada dan ter-link ke `storage/app/public`

#### C. Upload Ulang Gambar
1. Login admin: http://localhost:8000/login
2. Menu: **Halaman**
3. Edit: **Home**
4. Scroll ke **Hero Section Settings**
5. Upload gambar lagi (pilih gambar < 2MB)
6. Klik **Update Halaman**
7. Lihat pesan sukses

### Step 5: Jika File Exists = ✓ YES (Hijau) Tapi Gambar Tidak Muncul

**Artinya:** File ada, tapi tidak tampil di hero

**Kemungkinan Penyebab:**

#### A. Gradient Terlalu Kuat (Tema Default)
Tema default dengan background image = gradient amber-stone dengan opacity 60%

**Solusi:**
1. Coba pilih tema lain (Ramadan/Natal) untuk test
2. Atau edit opacity di code (lihat section Advanced)

#### B. CSS Tidak Ter-Load
**Solusi:**
```bash
php artisan view:clear
# Hard refresh browser (Ctrl+Shift+R)
```

#### C. Browser Cache
**Solusi:**
- Hard refresh: Ctrl+Shift+R (Windows/Linux)
- Hard refresh: Cmd+Shift+R (Mac)
- Atau buka Incognito/Private mode

### Step 6: Test dengan Tema Berbeda

Untuk memastikan gambar muncul, test dengan tema yang kontras:

1. Edit halaman Home
2. Pilih tema: **🌙 Ramadan** atau **🎄 Natal**
3. Simpan
4. Refresh website

**Tema Ramadan/Natal:**
- Background lebih gelap
- Gambar lebih terlihat
- Text putih dengan shadow

### Step 7: Verify URL Gambar

Dari debug info, copy **Full URL** lalu:

1. Buka tab baru di browser
2. Paste URL gambar
3. Tekan Enter

**Jika gambar muncul:**
✅ Upload berhasil, masalah di view/CSS

**Jika 404 Not Found:**
❌ Storage link atau file tidak ada

## 🎨 Penjelasan Tema & Background

### Tema Default + Background Image
```
Background: Gambar Anda
Overlay: Gradient amber-stone (opacity 60%)
Text: Dark gray dengan shadow
Hasil: Gambar terlihat dengan nuansa coklat kayu
```

### Tema Ramadan + Background Image
```
Background: Gambar Anda
Overlay: Gradient purple-blue (opacity 60%)
Text: White dengan shadow
Hasil: Gambar terlihat dengan nuansa ungu malam
```

### Tema Natal + Background Image
```
Background: Gambar Anda
Overlay: Gradient red-green (opacity 60%)
Text: White dengan shadow
Hasil: Gambar terlihat dengan nuansa merah hijau
```

## 🔍 Advanced Debugging

### Cek Database Manual
```bash
php artisan tinker
```

Jalankan:
```php
$page = App\Models\Page::where('key', 'home')->first();
echo "Background: " . ($page->hero_background ?? 'NULL') . "\n";
echo "Theme: " . ($page->hero_theme ?? 'NULL') . "\n";
echo "Title: " . ($page->hero_title ?? 'NULL') . "\n";

// Cek file exists
if ($page->hero_background) {
    $path = public_path('storage/' . $page->hero_background);
    echo "Full Path: " . $path . "\n";
    echo "Exists: " . (file_exists($path) ? 'YES' : 'NO') . "\n";
}
```

### Cek File System
```bash
# Windows
dir storage\app\public\hero

# Linux/Mac
ls -la storage/app/public/hero/
```

### Test Upload Manual

Jika upload via admin tidak berfungsi, test manual:

1. **Copy gambar ke folder:**
```
storage/app/public/hero/test-background.jpg
```

2. **Update database:**
```bash
php artisan tinker
```

```php
$page = App\Models\Page::where('key', 'home')->first();
$page->hero_background = 'hero/test-background.jpg';
$page->save();
echo "Updated!\n";
```

3. **Clear cache & refresh:**
```bash
php artisan view:clear
# Refresh browser
```

## 💡 Tips

### Rekomendasi Gambar Background
- **Ukuran:** 1920x1080px (Full HD)
- **Format:** JPG (lebih kecil) atau PNG
- **Size:** < 2MB
- **Konten:** Gambar furniture, interior, atau texture kayu
- **Brightness:** Tidak terlalu gelap atau terang

### Kombinasi Tema & Gambar Terbaik

**Untuk Gambar Terang:**
- Gunakan tema: Ramadan, Natal, Tahun Baru (overlay gelap)

**Untuk Gambar Gelap:**
- Gunakan tema: Default, Kemerdekaan (overlay terang)

**Untuk Gambar Netral:**
- Semua tema cocok

### Adjust Opacity (Advanced)

Jika ingin gambar lebih terlihat, edit file:
`resources/views/frontend/home.blade.php`

Cari baris:
```php
<div class="absolute inset-0 bg-gradient-to-br {{ $theme['gradient'] }} opacity-60"></div>
```

Ubah `opacity-60` menjadi:
- `opacity-40` = Gambar lebih terlihat (40%)
- `opacity-50` = Balanced (50%)
- `opacity-70` = Gradient lebih kuat (70%)

## ✅ Checklist Final

- [ ] Clear cache berhasil
- [ ] Restart servers berhasil
- [ ] Debug info muncul di pojok kanan bawah
- [ ] Theme terisi (bukan NULL)
- [ ] Background path terisi (bukan NULL)
- [ ] File Exists = ✓ YES (hijau)
- [ ] URL gambar bisa diakses langsung
- [ ] Gambar muncul di hero section
- [ ] Text terbaca dengan jelas
- [ ] Responsive di mobile

## 🆘 Masih Bermasalah?

### Cek Log Error
```bash
# Buka file log
type storage\logs\laravel.log

# Atau lihat 50 baris terakhir
Get-Content storage\logs\laravel.log -Tail 50
```

### Cek Browser Console
1. Tekan F12
2. Tab Console
3. Lihat error (merah)
4. Screenshot jika ada error

### Reset Complete

Jika semua cara gagal:
```bash
# 1. Clear everything
php artisan optimize:clear
composer dump-autoload

# 2. Recreate storage
rm public/storage
php artisan storage:link

# 3. Restart servers
# Stop (Ctrl+C) lalu start lagi
npm run dev
php artisan serve
```

## 📞 Info Tambahan

**File yang Diubah:**
- `resources/views/frontend/home.blade.php` - View hero
- `resources/views/admin/pages/edit.blade.php` - Form admin
- `app/Http/Controllers/Admin/PageController.php` - Upload handler
- `database/migrations/xxx_add_hero_fields_to_pages_table.php` - Database

**Dokumentasi:**
- `HERO_FEATURE.md` - Fitur lengkap
- `HERO_QUICK_GUIDE.md` - Panduan cepat
- `HERO_TROUBLESHOOTING.md` - Troubleshooting detail

---

**Setelah mengikuti panduan ini, hero background seharusnya sudah muncul! 🎉**

Jika masih ada masalah, screenshot debug info dan error log untuk analisa lebih lanjut.
