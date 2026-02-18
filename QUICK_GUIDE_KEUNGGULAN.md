# 🚀 Panduan Cepat - Kelola Keunggulan Kami

## Akses Admin Panel

1. Login ke admin: `http://localhost:8000/login`
2. Klik menu **"Keunggulan"** di sidebar kiri

## Menambah Keunggulan Baru

1. Klik tombol **"Tambah Keunggulan"**
2. Isi form:
   - **Judul**: Nama keunggulan (contoh: "Kualitas Premium")
   - **Icon**: Class Font Awesome (contoh: `fas fa-gem`)
   - **Deskripsi**: Penjelasan keunggulan
   - **Aktif**: Centang untuk menampilkan di website
3. Klik **"Simpan Keunggulan"**

## Icon Font Awesome - Copy & Paste

Pilih salah satu dan copy ke field Icon:

### Kualitas & Premium
- `fas fa-gem` - Berlian
- `fas fa-crown` - Mahkota
- `fas fa-star` - Bintang
- `fas fa-award` - Penghargaan
- `fas fa-medal` - Medali

### Keamanan & Garansi
- `fas fa-shield-alt` - Perisai
- `fas fa-lock` - Gembok
- `fas fa-check-circle` - Centang
- `fas fa-certificate` - Sertifikat

### Layanan & Support
- `fas fa-headset` - Headset
- `fas fa-comments` - Chat
- `fas fa-phone` - Telepon
- `fas fa-user-tie` - Profesional

### Kecepatan & Efisiensi
- `fas fa-bolt` - Kilat
- `fas fa-rocket` - Roket
- `fas fa-tachometer-alt` - Speedometer
- `fas fa-clock` - Jam

### Desain & Kreativitas
- `fas fa-pencil-ruler` - Desain
- `fas fa-palette` - Palet
- `fas fa-magic` - Magic
- `fas fa-lightbulb` - Ide

### Harga & Value
- `fas fa-tags` - Label harga
- `fas fa-dollar-sign` - Dollar
- `fas fa-percentage` - Persen
- `fas fa-gift` - Hadiah

### Tools & Profesional
- `fas fa-tools` - Alat
- `fas fa-wrench` - Kunci
- `fas fa-hammer` - Palu
- `fas fa-cogs` - Gear

### Kepuasan & Positif
- `fas fa-heart` - Hati
- `fas fa-smile` - Senyum
- `fas fa-thumbs-up` - Jempol
- `fas fa-handshake` - Jabat tangan

## Contoh Keunggulan yang Sudah Ada

1. **Kualitas Premium** (`fas fa-gem`)
   - Material kayu pilihan berkualitas tinggi

2. **Desain Custom** (`fas fa-pencil-ruler`)
   - Disesuaikan dengan kebutuhan Anda

3. **Garansi Terpercaya** (`fas fa-shield-alt`)
   - Garansi untuk setiap produk

4. **Pengerjaan Profesional** (`fas fa-tools`)
   - Dikerjakan craftsman berpengalaman

5. **Harga Kompetitif** (`fas fa-tags`)
   - Harga terbaik dengan kualitas premium

6. **Konsultasi Gratis** (`fas fa-comments`)
   - Tim siap membantu Anda

## Tips Menulis Keunggulan yang Baik

### ✅ DO (Lakukan)
- Gunakan judul yang singkat dan jelas (2-4 kata)
- Deskripsi fokus pada manfaat untuk customer
- Pilih icon yang relevan dengan keunggulan
- Maksimal 2-3 kalimat untuk deskripsi
- Gunakan bahasa yang mudah dipahami

### ❌ DON'T (Jangan)
- Judul terlalu panjang (lebih dari 5 kata)
- Deskripsi terlalu teknis atau rumit
- Icon tidak sesuai dengan konteks
- Deskripsi lebih dari 1 paragraf
- Menggunakan bahasa yang terlalu formal

## Urutan Tampilan

Keunggulan akan ditampilkan berdasarkan:
1. Kolom **"order"** (semakin kecil, semakin atas)
2. Tanggal dibuat (terbaru di atas)

## Tampilan di Website

Section "Mengapa Memilih Kami?" akan muncul di:
- **Halaman Home** (setelah section Produk Unggulan)
- Layout: 3 kolom di desktop, 2 di tablet, 1 di mobile
- Maksimal 6 keunggulan ditampilkan

## Troubleshooting

### Keunggulan tidak muncul di website?
- ✅ Pastikan status "Aktif" dicentang
- ✅ Refresh halaman website (Ctrl + F5)
- ✅ Clear cache: `php artisan cache:clear`

### Icon tidak muncul?
- ✅ Pastikan format benar: `fas fa-nama-icon`
- ✅ Cek koneksi internet (Font Awesome dari CDN)
- ✅ Lihat referensi icon di form create/edit

### Perubahan tidak tersimpan?
- ✅ Pastikan semua field required terisi
- ✅ Cek pesan error di atas form
- ✅ Pastikan tidak ada karakter khusus di icon

## Link Berguna

- **Font Awesome Icons**: https://fontawesome.com/icons
- **Admin Panel**: http://localhost:8000/admin/dashboard
- **Halaman Home**: http://localhost:8000/

---

**Butuh bantuan?** Hubungi tim developer atau lihat dokumentasi lengkap di `WHY_CHOOSE_US_FEATURE.md`
