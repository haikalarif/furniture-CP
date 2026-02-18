# 🎨 Dynamic Hero Section Feature

## ✨ Fitur Baru: Hero Section Dinamis dengan Tema Musiman

Hero section di halaman home sekarang bisa dikustomisasi dari admin panel dengan fitur:
- ✅ Edit tagline/judul utama
- ✅ Edit subtitle/deskripsi
- ✅ Pilih tema musiman (Ramadan, Natal, Idul Fitri, dll)
- ✅ Upload background image custom
- ✅ Animasi dan dekorasi otomatis per tema

## 🎯 Cara Menggunakan

### 1. Akses Admin Panel
```
http://localhost:8000/login
Email: admin@kalkayuliving.com
Password: password
```

### 2. Edit Hero Section
1. Login ke admin panel
2. Klik menu **"Halaman"**
3. Klik **"Edit"** pada halaman **"Home"**
4. Scroll ke bagian **"Hero Section Settings"** (kotak kuning)

### 3. Customize Hero

**Hero Title (Judul Utama):**
- Judul besar yang muncul di tengah hero
- Contoh: "Furniture Premium untuk Hunian Impian"
- Maksimal 255 karakter

**Hero Subtitle (Deskripsi):**
- Deskripsi di bawah judul
- Contoh: "Desain custom minimalis dengan material berkualitas tinggi"
- Bisa lebih panjang dari title

**Tema Hero (Seasonal Theme):**
Pilih tema sesuai musim/event:

1. **🏠 Default (Standar)**
   - Warna: Amber & Stone (coklat kayu)
   - Cocok untuk: Sehari-hari

2. **🌙 Ramadan**
   - Warna: Ungu gelap & Biru malam
   - Dekorasi: Bulan & Bintang
   - Cocok untuk: Bulan Ramadan

3. **✨ Idul Fitri**
   - Warna: Hijau emerald & Teal
   - Dekorasi: Bintang & Pesta
   - Cocok untuk: Lebaran Idul Fitri

4. **🐑 Idul Adha**
   - Warna: Hijau tua
   - Dekorasi: Kambing & Masjid
   - Cocok untuk: Lebaran Idul Adha

5. **🎄 Natal**
   - Warna: Merah & Hijau
   - Dekorasi: Pohon Natal & Snowman
   - Cocok untuk: Natal

6. **🎆 Tahun Baru**
   - Warna: Biru, Ungu, Pink gelap
   - Dekorasi: Kembang api & Confetti
   - Cocok untuk: Tahun Baru

7. **🧧 Imlek**
   - Warna: Merah & Kuning emas
   - Dekorasi: Angpao & Naga
   - Cocok untuk: Tahun Baru Imlek

8. **🇮🇩 Kemerdekaan RI**
   - Warna: Merah & Putih
   - Dekorasi: Bendera Indonesia
   - Cocok untuk: 17 Agustus

**Background Image (Opsional):**
- Upload gambar background custom
- Recommended size: 1920x1080px
- Format: JPG, PNG, WebP
- Max size: 2MB

### 4. Simpan & Lihat Hasil
1. Klik tombol **"Update Halaman"**
2. Buka website: http://localhost:8000
3. Hero section akan berubah sesuai setting

## 🎨 Preview Tema

### Default Theme
```
Background: Gradient amber-stone
Text: Dark gray
Accent: Amber brown
Decoration: None
```

### Ramadan Theme
```
Background: Dark purple-blue gradient
Text: White
Accent: Yellow gold
Decoration: 🌙✨ (animated)
Badge: "Promo Spesial Ramadan!"
```

### Natal Theme
```
Background: Red-green gradient
Text: White
Accent: Yellow gold
Decoration: 🎄⛄ (animated)
Badge: "Promo Spesial Natal!"
```

## 💡 Tips Penggunaan

### Kapan Ganti Tema?

**Ramadan (Bulan Puasa):**
- Aktifkan 1-2 minggu sebelum Ramadan
- Ganti tagline: "Sambut Ramadan dengan Furniture Berkah"

**Idul Fitri (Lebaran):**
- Aktifkan H-7 sampai H+7 Lebaran
- Ganti tagline: "Lebaran Penuh Berkah di Rumah Impian"

**Natal:**
- Aktifkan awal Desember sampai akhir tahun
- Ganti tagline: "Rayakan Natal dengan Kehangatan Rumah"

**Tahun Baru:**
- Aktifkan akhir Desember sampai awal Januari
- Ganti tagline: "Tahun Baru, Rumah Baru, Furniture Baru"

**Imlek:**
- Aktifkan 1 minggu sebelum sampai 1 minggu sesudah
- Ganti tagline: "Hoki Berlimpah di Tahun Baru Imlek"

**Kemerdekaan RI:**
- Aktifkan awal Agustus sampai 20 Agustus
- Ganti tagline: "Merdeka! Furniture Berkualitas untuk Indonesia"

### Contoh Tagline per Tema

**Default:**
```
Title: Furniture Premium untuk Hunian Impian
Subtitle: Desain custom minimalis dengan material berkualitas tinggi
```

**Ramadan:**
```
Title: Sambut Ramadan dengan Furniture Berkah
Subtitle: Ciptakan suasana khusyuk di rumah dengan furniture premium kami
```

**Idul Fitri:**
```
Title: Lebaran Penuh Berkah di Rumah Impian
Subtitle: Furniture premium untuk menyambut tamu dengan kehangatan
```

**Natal:**
```
Title: Rayakan Natal dengan Kehangatan Rumah
Subtitle: Furniture berkualitas untuk momen berharga bersama keluarga
```

**Tahun Baru:**
```
Title: Tahun Baru, Rumah Baru, Furniture Baru
Subtitle: Mulai tahun dengan furniture premium yang menginspirasi
```

## 🔧 Technical Details

### Database Fields
```php
hero_title      // VARCHAR(255) - Judul utama
hero_subtitle   // TEXT - Deskripsi
hero_theme      // VARCHAR(50) - Tema (default, ramadan, natal, dll)
hero_background // VARCHAR(255) - Path gambar background
```

### Theme Configuration
Tema dikonfigurasi di `resources/views/frontend/home.blade.php`:
```php
$themeConfig = [
    'default' => [...],
    'ramadan' => [...],
    'natal' => [...],
    // dst
];
```

### Animasi
- Fade in untuk title
- Bounce untuk dekorasi emoji
- Pulse untuk elemen dekoratif
- Hover scale untuk button

## 📱 Responsive Design

Hero section responsive di semua device:
- **Desktop:** Full height dengan text besar
- **Tablet:** Adjusted text size
- **Mobile:** Optimized layout & text

## 🎯 Best Practices

1. **Update Tema Tepat Waktu:**
   - Jangan terlalu cepat atau terlalu lambat
   - Sesuaikan dengan kalender event

2. **Konsisten dengan Promo:**
   - Jika ganti tema, buat promo yang relevan
   - Update produk featured sesuai tema

3. **Test di Mobile:**
   - Pastikan text readable di mobile
   - Check dekorasi tidak menutupi text

4. **Background Image:**
   - Gunakan gambar berkualitas tinggi
   - Pastikan tidak terlalu ramai
   - Opacity akan otomatis disesuaikan

5. **Tagline Menarik:**
   - Singkat tapi powerful
   - Relevan dengan tema
   - Call-to-action jelas

## 🐛 Troubleshooting

### Hero tidak berubah setelah update
```bash
php artisan view:clear
php artisan cache:clear
# Hard refresh browser (Ctrl+Shift+R)
```

### Background image tidak muncul
```bash
php artisan storage:link
# Check file uploaded di storage/app/public/hero/
```

### Tema tidak sesuai
- Check spelling tema di dropdown
- Pastikan save berhasil
- Clear cache browser

## 📊 Analytics

Track performa hero per tema:
- Conversion rate per tema
- Click-through rate button CTA
- Bounce rate per tema
- Time on page

## 🚀 Future Enhancements

Fitur yang bisa ditambahkan:
- [ ] Video background
- [ ] Slider multiple hero
- [ ] Countdown timer untuk event
- [ ] Auto-switch tema berdasarkan tanggal
- [ ] A/B testing hero variants
- [ ] Custom CSS per tema
- [ ] Hero analytics dashboard

## 📝 Changelog

**v1.0.0 (2024-02-12)**
- ✅ Dynamic hero title & subtitle
- ✅ 8 seasonal themes
- ✅ Custom background image
- ✅ Animated decorations
- ✅ Responsive design
- ✅ Admin panel integration

---

**Selamat menggunakan fitur Dynamic Hero Section! 🎉**

Untuk pertanyaan atau bantuan, baca dokumentasi lengkap di folder project.
