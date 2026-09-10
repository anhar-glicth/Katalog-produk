# Lumina Pearl - Katalog Produk & Checkout System

Website katalog produk interaktif premium untuk koleksi lampu kerang mutiara eksklusif (Lumina Pearl). Dilengkapi dengan animasi carousel dinamis, halaman detail produk terdedikasi, serta sidebar checkout lengkap dengan pemilihan kurir, penghitungan ongkir otomatis, dan berbagai payment gateway.

## Fitur Utama

- **Animasi Carousel Hero Slider**: Tampilan hero modern interaktif dengan transisi halus.
- **Halaman Detail Produk (`detail.html`)**: Layout e-commerce luxury dengan galeri thumbnail, pemilih varian warna, panduan ukuran, spesifikasi lengkap, dan fitur zoom gambar.
- **Sidebar Drawer Checkout**:
  - Tampilan daftar produk pesanan dengan thumbnail dan opsi varian.
  - Penyesuaian kuantitas produk (`+` dan `-`) serta hapus produk secara langsung.
  - Pilihan ekspedisi/kurir (JNE, SiCepat, J&T, GoSend) dengan kalkulasi ongkir dan promo Bebas Ongkir.
  - Pilihan metode pembayaran (QRIS Instant, BCA/Mandiri Virtual Account, Kartu Kredit, COD).
  - Rincian biaya transparan (Subtotal, Ongkir, Layanan Admin, Total).
  - Modal invoice pembayaran interaktif.
- **Desain Mewah Tanpa Emoji**: Sepenuhnya menggunakan ikon SVG kustom yang elegan dan palet warna solid navy & slate.

## Struktur Direktori

```
katalog-produk/
├── airpod animation web/
│   ├── images/
│   ├── index.html
│   ├── detail.html
│   ├── style.css
│   └── script.js
└── README.md
```

## Cara Menjalankan

1. Salin folder proyek ke dalam direktori web server (misalnya `htdocs` pada XAMPP):
   `C:\xampp\htdocs\katalog-produk`
2. Jalankan Apache melalui XAMPP Control Panel.
3. Buka browser dan akses:
   - `http://localhost/katalog-produk/airpod%20animation%20web/index.html` (Katalog Utama)
   - `http://localhost/katalog-produk/airpod%20animation%20web/detail.html?id=1` (Detail Produk)
