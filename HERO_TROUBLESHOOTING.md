# 🔧 Hero Background Troubleshooting

## 🐛 Masalah: Background Image Tidak Muncul

### Checklist Debugging

#### 1. Cek Storage Link
```bash
# Pastikan storage link ada
php artisan storage:link
```

Verify folder `public/storage` ada dan ter-link ke `storage/app/public`

#### 2. Cek File Ter-Upload
Setelah upload gambar di admin, cek folder:
```
storage/app/public/hero/
```

Harus ada file gambar dengan nama seperti: `1234567890_hero_abc123.jpg`

#### 3. Cek Database
Buka database dan cek table `pages`:
```sql
SELECT id, key, hero_title, hero_subtitle, hero_theme, hero_background 
FROM pages 
WHERE key = 'home';
```

Field `hero_background` harus berisi path seperti: `hero/1234567890_hero_abc123.jpg`

#### 4. Cek Permission (Linux/Mac)
```bash
chmod -R 775 storage
chmod -R 775 storage/app/public
```

#### 5. Test URL Gambar
Buka browser dan test URL:
```
http://localhost:8000/storage/hero/[nama_file].jpg
```

Ganti `[nama_file]` dengan nama file yang ada di database.

Jika gambar muncul = Upload berhasil, masalah di view
Jika 404 = Storage link atau file tidak ada

### Solusi Berdasarkan Masalah

#### Masalah A: Gambar Tidak Ter-Upload
**Gejala:** Field `hero_background` di database kosong/null

**Solusi:**
1. Check max upload size di `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

2. Restart web server setelah ubah php.ini

3. Coba upload gambar lebih kecil (< 2MB)

#### Masalah B: Storage Link Tidak Ada
**Gejala:** URL gambar 404, folder `public/storage` tidak ada

**Solusi:**
```bash
# Hapus link lama (jika ada)
rm public/storage

# Buat link baru
php artisan storage:link
```

#### Masalah C: Gambar Ada Tapi Tidak Tampil
**Gejala:** URL gambar bisa diakses, tapi tidak muncul di hero

**Solusi:**
1. Clear cache:
```bash
php artisan view:clear
php artisan cache:clear
```

2. Hard refresh browser (Ctrl+Shift+R)

3. Check browser console (F12) untuk error

#### Masalah D: Background Putih Polos
**Gejala:** Hero section putih, tidak ada gradient atau gambar

**Kemungkinan Penyebab:**
1. Tema "default" dengan background image = Gradient terlalu kuat
2. CSS tidak ter-load
3. View cache

**Solusi:**
1. Pilih tema selain "default" (coba Ramadan/Natal)
2. Clear view cache:
```bash
php artisan view:clear
```
3. Check browser console untuk CSS error

### Debug Mode

Tambahkan kode ini di `resources/views/frontend/home.blade.php` setelah `@php` section untuk debug:

```php
{{-- DEBUG INFO --}}
@if(config('app.debug'))
<div class="fixed bottom-4 right-4 bg-black bg-opacity-75 text-white p-4 rounded-lg text-xs z-50 max-w-md">
    <div class="font-bold mb-2">Hero Debug Info:</div>
    <div>Theme: {{ $currentTheme }}</div>
    <div>Title: {{ $heroTitle }}</div>
    <div>Background: {{ $homePage->hero_background ?? 'NULL' }}</div>
    @if($homePage && $homePage->hero_background)
        <div>Full Path: {{ asset('storage/' . $homePage->hero_background) }}</div>
        <div>File Exists: {{ file_exists(public_path('storage/' . $homePage->hero_background)) ? 'YES' : 'NO' }}</div>
    @endif
</div>
@endif
```

Aktifkan debug mode di `.env`:
```env
APP_DEBUG=true
```

### Test Manual

#### Test 1: Upload Gambar
1. Login admin
2. Edit halaman Home
3. Upload gambar (pilih gambar < 2MB)
4. Klik "Update Halaman"
5. Cek pesan sukses muncul

#### Test 2: Cek Database
```bash
php artisan tinker
```

Lalu jalankan:
```php
$page = App\Models\Page::where('key', 'home')->first();
echo "Background: " . $page->hero_background . "\n";
echo "Full path: " . public_path('storage/' . $page->hero_background) . "\n";
echo "Exists: " . (file_exists(public_path('storage/' . $page->hero_background)) ? 'YES' : 'NO') . "\n";
```

#### Test 3: Cek File System
```bash
# Windows
dir storage\app\public\hero

# Linux/Mac
ls -la storage/app/public/hero/
```

Harus ada file gambar yang baru di-upload.

### Solusi Cepat

Jika masih tidak bisa, coba langkah ini:

```bash
# 1. Clear semua cache
php artisan optimize:clear

# 2. Recreate storage link
rm public/storage
php artisan storage:link

# 3. Check permission (Linux/Mac)
chmod -R 775 storage

# 4. Restart server
# Stop (Ctrl+C) lalu start lagi
php artisan serve
```

### Alternatif: Upload Manual

Jika upload via admin tidak berfungsi:

1. Copy gambar ke folder:
```
storage/app/public/hero/test-hero.jpg
```

2. Update database manual:
```bash
php artisan tinker
```

```php
$page = App\Models\Page::where('key', 'home')->first();
$page->hero_background = 'hero/test-hero.jpg';
$page->save();
```

3. Refresh website

### Cek Hasil

Setelah troubleshooting, test:

1. **Frontend:** http://localhost:8000
   - Hero harus tampil dengan background image
   - Gradient overlay transparan (60% opacity)
   - Text terbaca dengan jelas (ada shadow)

2. **Tema Default dengan Gambar:**
   - Background: Gambar yang di-upload
   - Overlay: Gradient amber-stone (60% opacity)
   - Text: Dark gray dengan shadow

3. **Tema Lain dengan Gambar:**
   - Background: Gambar yang di-upload
   - Overlay: Gradient sesuai tema (60% opacity)
   - Text: White dengan shadow

### Kontak Support

Jika masih bermasalah:
1. Screenshot error
2. Check `storage/logs/laravel.log`
3. Check browser console (F12)
4. Baca dokumentasi lengkap

---

**Semoga berhasil! 🚀**
