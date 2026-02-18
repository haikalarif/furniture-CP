# 🚀 Quick Guide: Dynamic Hero Section

## ⚡ Setup Cepat (5 Menit)

### 1. Migration Sudah Dijalankan ✅
```bash
# Sudah otomatis dijalankan
# Field baru ditambahkan ke table pages:
# - hero_title
# - hero_subtitle  
# - hero_theme
# - hero_background
```

### 2. Clear Cache & Restart
```bash
# Double click:
clear-cache.bat

# Lalu restart servers:
start-dev.bat
```

### 3. Test Hero Section

**Frontend:**
- Buka: http://localhost:8000
- Hero section sekarang menggunakan data dari database
- Default theme aktif

**Admin:**
- Login: http://localhost:8000/login
- Ke menu: **Halaman**
- Edit: **Home**
- Lihat section **"Hero Section Settings"** (kotak kuning)

## 🎨 Cara Edit Hero

### Step 1: Login Admin
```
http://localhost:8000/login
Email: admin@kalkayuliving.com
Password: password
```

### Step 2: Edit Halaman Home
1. Klik menu **"Halaman"**
2. Klik **"Edit"** pada baris **"Home"**

### Step 3: Edit Hero Settings
Di bagian **"Hero Section Settings"** (kotak kuning):

**Hero Title:**
```
Contoh: Furniture Premium untuk Hunian Impian
```

**Hero Subtitle:**
```
Contoh: Desain custom minimalis dengan material berkualitas tinggi
```

**Tema Hero:**
Pilih salah satu:
- 🏠 Default (Standar)
- 🌙 Ramadan
- ✨ Idul Fitri
- 🐑 Idul Adha
- 🎄 Natal
- 🎆 Tahun Baru
- 🧧 Imlek
- 🇮🇩 Kemerdekaan RI

**Background Image (Opsional):**
- Upload gambar 1920x1080px
- Format: JPG, PNG, WebP
- Max 2MB

### Step 4: Simpan
Klik **"Update Halaman"**

### Step 5: Lihat Hasil
Buka: http://localhost:8000

## 🎯 Contoh Penggunaan

### Untuk Ramadan:
```
Title: Sambut Ramadan dengan Furniture Berkah
Subtitle: Ciptakan suasana khusyuk di rumah dengan furniture premium kami
Theme: 🌙 Ramadan
```

**Hasil:**
- Background: Ungu gelap & biru malam
- Dekorasi: 🌙✨ (animated)
- Badge: "Promo Spesial Ramadan!"
- Text: Putih

### Untuk Natal:
```
Title: Rayakan Natal dengan Kehangatan Rumah
Subtitle: Furniture berkualitas untuk momen berharga bersama keluarga
Theme: 🎄 Natal
```

**Hasil:**
- Background: Merah & hijau gradient
- Dekorasi: 🎄⛄ (animated)
- Badge: "Promo Spesial Natal!"
- Text: Putih

### Untuk Default:
```
Title: Furniture Premium untuk Hunian Impian
Subtitle: Desain custom minimalis dengan material berkualitas tinggi
Theme: 🏠 Default (Standar)
```

**Hasil:**
- Background: Amber & stone gradient
- Dekorasi: None
- Badge: None
- Text: Dark gray

## ✅ Checklist

- [ ] Migration berhasil (field hero_* ada di table pages)
- [ ] Clear cache
- [ ] Restart servers
- [ ] Login ke admin berhasil
- [ ] Menu "Halaman" ada
- [ ] Edit Home page berhasil
- [ ] Section "Hero Section Settings" tampil (kotak kuning)
- [ ] Bisa edit title & subtitle
- [ ] Bisa pilih tema
- [ ] Bisa upload background image
- [ ] Simpan berhasil
- [ ] Hero di frontend berubah sesuai setting

## 🐛 Troubleshooting

### Hero tidak berubah
```bash
php artisan view:clear
php artisan cache:clear
# Refresh browser (Ctrl+Shift+R)
```

### Section "Hero Section Settings" tidak muncul
- Pastikan edit halaman **"Home"** (bukan About/Process)
- Clear view cache: `php artisan view:clear`

### Background image tidak muncul
```bash
php artisan storage:link
```

### Error saat save
- Check ukuran gambar (max 2MB)
- Check format gambar (JPG, PNG, WebP)
- Check field tidak kosong

## 📱 Test di Device

**Desktop:**
- Hero full height
- Text besar & jelas
- Dekorasi tampil sempurna

**Mobile:**
- Hero responsive
- Text readable
- Button accessible

## 💡 Tips

1. **Ganti tema sesuai musim** untuk engagement lebih baik
2. **Update tagline** yang relevan dengan tema
3. **Test di mobile** setelah update
4. **Gunakan background image** untuk visual lebih menarik
5. **Clear cache** setelah setiap perubahan

## 📚 Dokumentasi Lengkap

Baca **HERO_FEATURE.md** untuk:
- Detail semua tema
- Contoh tagline per tema
- Best practices
- Technical details
- Future enhancements

## 🎉 Selesai!

Hero section sekarang dinamis dan bisa disesuaikan dengan musim/event!

**Test sekarang:**
1. Edit hero di admin
2. Pilih tema Ramadan/Natal
3. Lihat hasilnya di frontend
4. Wow! 🎨✨

---

**Fitur ini siap digunakan untuk meningkatkan engagement website! 🚀**
