# 🚀 START HERE - Panduan Cepat

## ⚠️ PENTING: Baca Ini Dulu!

Jika website masih tampil **welcome Laravel** atau **admin panel kosong**, ikuti langkah di bawah ini:

## 🔧 Langkah Perbaikan (5 Menit)

### 1. Stop Semua Server
Tekan `Ctrl+C` di semua terminal yang sedang running

### 2. Clear Cache
**Double click file ini:**
```
clear-cache.bat
```

Atau jalankan manual:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

### 3. Verify Routes Sudah Benar
```bash
php artisan route:list
```

Cari baris ini (harus ada):
```
GET|HEAD  /                    › Frontend\HomeController@index
GET|HEAD  /admin/dashboard     › Admin\DashboardController@index
```

### 4. Restart Servers
**Double click file ini:**
```
start-dev.bat
```

Atau jalankan manual (buka 2 terminal):

**Terminal 1:**
```bash
npm run dev
```

**Terminal 2:**
```bash
php artisan serve
```

### 5. Test Website

✅ **Frontend:** http://localhost:8000
- Harus tampil halaman KalKayu Living (BUKAN welcome Laravel)
- Ada menu navigasi: Home, Tentang Kami, Produk, Proses, Artikel, Kontak

✅ **Login:** http://localhost:8000/login
- Email: `admin@kalkayuliving.com`
- Password: `password`

✅ **Admin Panel:** http://localhost:8000/admin/dashboard
- Harus tampil dashboard dengan sidebar
- Ada menu: Dashboard, Produk, Testimoni, Artikel, Halaman

## ✅ Checklist

- [ ] Stop semua server
- [ ] Clear cache (jalankan clear-cache.bat)
- [ ] Verify routes (php artisan route:list)
- [ ] Restart servers (jalankan start-dev.bat)
- [ ] Test frontend (/)
- [ ] Test login (/login)
- [ ] Test admin (/admin/dashboard)

## 🐛 Masih Error?

### Error: "Target class does not exist"
```bash
composer dump-autoload
php artisan optimize:clear
```

### Error: Database
```bash
# Pastikan database sudah dibuat
mysql -u root -p
CREATE DATABASE kalkayu_living;
EXIT;

# Run migration
php artisan migrate --seed
```

### Error: Gambar tidak muncul
```bash
php artisan storage:link
```

### Masih bermasalah?
Baca file **TROUBLESHOOTING.md** untuk solusi lengkap!

## 📚 Dokumentasi Lengkap

Setelah website berjalan, baca dokumentasi ini:

1. **TROUBLESHOOTING.md** - Solusi semua error umum
2. **FIX_ROUTES.md** - Cara fix routes yang tidak berfungsi
3. **INSTALL.md** - Panduan instalasi lengkap
4. **CUSTOMIZATION_GUIDE.md** - Cara customize website
5. **CODE_STRUCTURE.md** - Memahami struktur code

## 💡 Tips

1. **Gunakan batch files** untuk mempermudah:
   - `clear-cache.bat` - Clear cache
   - `start-dev.bat` - Start servers

2. **Selalu clear cache** setelah:
   - Mengubah routes
   - Mengubah controller
   - Mengubah .env

3. **Jangan lupa** jalankan 2 terminal:
   - Terminal 1: `npm run dev`
   - Terminal 2: `php artisan serve`

## 🎯 Next Steps

Setelah website berjalan normal:

1. **Login ke admin panel**
2. **Ganti password admin**
3. **Tambah produk pertama**
4. **Tambah artikel pertama**
5. **Edit halaman About & Process**
6. **Ganti nomor WhatsApp** (cari `6281234567890` di views)

## 🆘 Butuh Bantuan?

1. Baca **TROUBLESHOOTING.md**
2. Check `storage/logs/laravel.log`
3. Verify semua requirements terpenuhi (PHP 8.1+, MySQL, Node.js)

---

**Selamat menggunakan KalKayu Living! 🎉**
