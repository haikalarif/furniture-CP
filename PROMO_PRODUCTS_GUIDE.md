# 🔥 Panduan Produk Promo

## Cara Menambah Produk Promo

### 1. Buat Produk Baru atau Edit Produk Existing
- Login ke admin panel
- Klik menu "Produk"
- Klik "Tambah Produk" atau edit produk yang sudah ada

### 2. Isi Data Promo
- **Harga Normal**: Isi harga asli produk
- **Harga Promo**: Isi harga setelah diskon (harus lebih kecil dari harga normal)
- **Diskon (%)**: Isi persentase diskon (contoh: 30 untuk 30%)
- **Tanggal Mulai Promo**: Kapan promo dimulai (opsional)
- **Tanggal Selesai Promo**: Kapan promo berakhir (opsional)
- **Centang "Produk Promo"**: Aktifkan checkbox ini

### 3. Simpan
- Klik "Simpan Produk" atau "Update Produk"
- Produk promo akan muncul di section "Produk Promo" di homepage

## Contoh Pengisian

### Contoh 1: Promo Terbatas Waktu
- Nama: Meja Makan Minimalis
- Harga: 5.000.000
- Harga Promo: 3.500.000
- Diskon: 30
- Tanggal Mulai: 2026-02-13
- Tanggal Selesai: 2026-03-15
- ✅ Produk Promo

### Contoh 2: Promo Tanpa Batas Waktu
- Nama: Kursi Kantor Ergonomis
- Harga: 2.000.000
- Harga Promo: 1.500.000
- Diskon: 25
- Tanggal Mulai: (kosongkan)
- Tanggal Selesai: (kosongkan)
- ✅ Produk Promo

## Logika Promo

### Promo Aktif Jika:
1. Checkbox "Produk Promo" dicentang
2. Harga promo diisi dan lebih kecil dari harga normal
3. Jika ada tanggal mulai: hari ini >= tanggal mulai
4. Jika ada tanggal selesai: hari ini <= tanggal selesai

### Promo Tidak Aktif Jika:
- Checkbox "Produk Promo" tidak dicentang
- Belum sampai tanggal mulai promo
- Sudah lewat tanggal selesai promo

## Tampilan di Frontend

### Badge yang Muncul:
- **Badge Merah (-30%)**: Persentase diskon di pojok kiri atas
- **Badge Kuning (PROMO)**: Label promo di pojok kanan atas

### Informasi Harga:
- Harga normal dicoret (abu-abu)
- Harga promo besar (merah)
- Jumlah penghematan (hijau)

### Alert Countdown:
- Jika ada tanggal selesai, akan muncul alert kuning
- Format: "Berakhir: 15 Mar 2026"

## Tips & Best Practices

### ✅ DO (Lakukan)
- Isi harga promo yang realistis
- Gunakan persentase diskon yang menarik (20-50%)
- Set tanggal selesai untuk menciptakan urgency
- Update status promo secara berkala
- Gunakan gambar produk yang menarik

### ❌ DON'T (Jangan)
- Harga promo lebih besar dari harga normal
- Diskon terlalu kecil (< 10%)
- Promo tanpa batas waktu terlalu banyak
- Lupa uncheck "Produk Promo" setelah promo selesai

## Mengelola Promo yang Sudah Berakhir

### Otomatis:
- Sistem akan otomatis menyembunyikan promo yang sudah lewat tanggal selesai
- Tidak perlu manual uncheck "Produk Promo"

### Manual:
- Jika ingin menghentikan promo sebelum waktunya:
  1. Edit produk
  2. Uncheck "Produk Promo"
  3. Atau ubah tanggal selesai menjadi hari ini

## Troubleshooting

### Produk promo tidak muncul di homepage?
- ✅ Pastikan checkbox "Produk Promo" dicentang
- ✅ Pastikan checkbox "Aktif" dicentang
- ✅ Pastikan harga promo lebih kecil dari harga normal
- ✅ Cek tanggal mulai dan selesai promo
- ✅ Refresh halaman (Ctrl + F5)

### Harga tidak muncul coret?
- ✅ Pastikan harga normal dan harga promo terisi
- ✅ Pastikan promo masih aktif (cek tanggal)

### Badge diskon tidak muncul?
- ✅ Isi field "Diskon (%)"
- ✅ Pastikan angka antara 0-100

## Statistik & Monitoring

### Cek Produk Promo Aktif:
```bash
php artisan tinker --execute="echo App\Models\Product::promo()->count();"
```

### Lihat Semua Produk Promo:
- Login ke admin
- Klik menu "Produk"
- Lihat badge "Promo" di kolom nama

---

**Fitur promo sudah siap digunakan!** 🎉

Untuk pertanyaan lebih lanjut, hubungi tim developer.
