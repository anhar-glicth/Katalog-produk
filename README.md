# Lumina Pearl - Platform Multi-Vendor E-Commerce (PHP Native MVC & MySQL)

Website platform e-commerce multi-vendor premium untuk koleksi perhiasan dan kerang mutiara eksklusif (*Lumina Pearl*), dibangun dengan arsitektur **MVC (Model-View-Controller)** murni menggunakan **PHP Native** dan **Database MySQL** di lingkungan XAMPP.

Mendukung 3 peran pengguna terintegrasi: **Penjual (Vendor/Seller)**, **Pembeli (Buyer/Customer)**, dan **Superadmin**.

---

## 🌟 Fitur Utama Platform

### 1. Autentikasi Terpadu & Multi-Role
- **Unified Login (`/auth/login`)**: Satu pintu masuk untuk Penjual, Pembeli, dan Admin dengan auto-redirect cerdas sesuai role.
- **Pendaftaran Akun Berbasis Peran (`/auth/register`)**: Toggle dinamis untuk mendaftar sebagai Pembeli atau membuka Toko Baru sebagai Mitra Penjual.
- **Akun Demo Siap Pakai**:
  - **Penjual**: `seller@lumina.com` / `seller123` &rarr; Masuk ke **Seller Center**
  - **Pembeli**: `buyer@lumina.com` / `buyer123` &rarr; Masuk ke **Pesanan Saya**
  - **Superadmin**: `admin@lumina.com` / `admin123` (atau `admin` / `admin123` di `/admin/login`) &rarr; Masuk ke **Panel Admin**

### 2. Seller Center Khusus Penjual (`/seller`)
- **Dashboard Analitik Toko**: Metrik estimasi omset toko, total pesanan masuk, produk terjual (pcs), dan jumlah katalog aktif.
- **Manajemen Produk Toko (CRUD)**:
  - Melihat produk khusus milik toko penjual (`WHERE seller_id = :id`).
  - Tambah produk baru (`/seller/productAdd`), edit produk (`/seller/productEdit/{id}`), dan hapus produk (`/seller/productDelete/{id}`).
  - **Kontrol Slider Carousel Hero**: Memilih produk mana saja yang ingin ditampilkan di banner slider utama halaman awal (`is_featured`).
  - Isolasi data penuh (*penjual tidak dapat mengedit/menghapus produk toko lain*).
- **Manajemen Pesanan Masuk (`/seller/orders`)**:
  - Melihat pesanan pembeli yang berisi produk dari toko penjual.
  - Memperbarui status pesanan kurir (*Menunggu Pembayaran*, *Diproses*, *Dikirim*, *Selesai*, *Dibatalkan*).
- **Pengaturan Toko (`/seller/settings`)**:
  - Mengubah nama toko/brand, bio toko, nomor kontak WhatsApp, dan alamat workshop/pickup point.

### 3. Portal Pembeli (`/user`)
- **Pesanan Saya (`/user/orders`)**: Pelacakan status pengiriman secara real-time, rincian barang, kuantitas, harga, dan tautan invoice resmi.
- **Profil & Alamat Pengiriman (`/user/profile`)**: Mengelola nama lengkap, kontak, dan alamat default yang otomatis terisi pada checkout drawer.

### 4. Etalase Publik & Checkout System
- **Slider Carousel Hero Dinamis**: Mengambil data produk unggulan pilihan (`is_featured = 1`) yang dikurasi langsung oleh Penjual & Admin dari database MySQL.
- **Badge & Nama Toko Penjual**:
  - Setiap kartu produk di katalog menampilkan label: `🏪 [Nama Toko]`.
  - Halaman detail produk (`/product/detail/{id}`) menampilkan badge verifikasi: `🏪 Penjual: [Nama Toko] &bull; Mitra Resmi`.
- **Checkout Drawer & Sync Otomatis**:
  - Kalkulasi ongkir kurir, diskon promo, dan metode pembayaran (Transfer Bank Manual, VA, CC, COD).
  - Pesanan pembeli yang sedang login otomatis terhubung ke akunnya (`user_id`) dan dicatat ke toko penjual (`seller_id`).

### 5. Superadmin Panel (`/admin`)
- Pengawasan menyeluruh seluruh katalog produk semua vendor, kurasi hero carousel beranda platform, rekapitulasi seluruh pesanan, dan monitoring omset global.

---

## 📁 Struktur Direktori MVC

```text
katalog-produk/
├── app/
│   ├── config/
│   │   └── config.php          # Konfigurasi database & auto-detect BASEURL
│   ├── core/
│   │   ├── App.php             # Router URL (Clean URL & query fallback)
│   │   ├── Controller.php      # Base Controller (render view, model loader, json response)
│   │   └── Database.php        # PDO Database Singleton Wrapper
│   ├── controllers/
│   │   ├── HomeController.php  # Beranda publik & katalog produk
│   │   ├── ProductController.php # Detail produk dinamis & REST API
│   │   ├── OrderController.php # Checkout & invoice pemesanan
│   │   ├── AuthController.php  # Login terpadu, registrasi, logout
│   │   ├── SellerController.php# Dashboard & fitur Seller Center
│   │   ├── UserController.php  # Portal pembeli (pesanan saya & profil)
│   │   └── AdminController.php # Panel Superadmin
│   ├── models/
│   │   ├── UserModel.php       # Model akun users (buyer, seller, admin)
│   │   ├── ProductModel.php    # Model data produk (dengan join vendor seller_id)
│   │   ├── OrderModel.php      # Model transaksi pesanan (user_id & seller_id)
│   │   └── AdminModel.php      # Model kredensial admin
│   └── views/
│       ├── layouts/
│       │   ├── header.php      # Header publik dengan navbar autentikasi dinamis
│       │   └── footer.php      # Footer global & script cart drawer
│       ├── auth/
│       │   ├── login.php       # Form login dengan tombol demo cepat
│       │   └── register.php    # Form daftar akun (Pembeli / Penjual)
│       ├── seller/
│       │   ├── layout/         # Sidebar & navbar dark luxury Seller Center
│       │   ├── dashboard.php   # Metrik omset & pesanan terbaru penjual
│       │   ├── products/       # Tabel & form tambah/edit produk toko
│       │   ├── orders/         # Daftar pesanan masuk & pengubah status kurir
│       │   └── settings.php    # Pengaturan identitas & alamat toko
│       ├── user/
│       │   ├── orders.php      # Halaman Pesanan Saya pembeli
│       │   └── profile.php     # Halaman profil & alamat pengiriman
│       ├── home/index.php      # Beranda publik
│       ├── product/detail.php  # Detail produk dengan badge toko penjual
│       └── order/success.php   # Bukti invoice pesanan berhasil
├── database/
│   ├── lumina_pearl.sql        # Skrip skema database multi-vendor & seed data
│   ├── setup.php               # Installer database otomatis
│   └── migrate_multivendor.php # Skrip migrasi kolom multi-vendor
├── images/                     # Aset foto produk mutiara
├── style.css                   # Desain visual mewah solid navy & gold
├── script.js                   # Interaktivitas client-side, cart, & AJAX sync
├── .htaccess                   # Apache URL rewrite untuk Clean URL
└── index.php                   # Front Controller (Single entry point)
```

---

## 🚀 Panduan Menjalankan di XAMPP

1. **Aktifkan Apache & MySQL**:
   Buka **XAMPP Control Panel**, pastikan modul **Apache** dan **MySQL** berstatus **Running**.
2. **Inisialisasi / Perbarui Database**:
   Akses installer otomatis via browser:
   `http://localhost/katalog-produk/database/setup.php`
   *(Database `katalog_produk` dan tabel `users`, `products`, `orders`, `order_items` otomatis siap pakai).*
3. **Akses Rute Aplikasi**:
   - **Katalog Publik**: `http://localhost/katalog-produk/`
   - **Masuk / Login**: `http://localhost/katalog-produk/auth/login`
   - **Daftar Akun Baru**: `http://localhost/katalog-produk/auth/register`
   - **Seller Center**: `http://localhost/katalog-produk/seller` (login: `seller@lumina.com` / `seller123`)
   - **Pesanan Saya**: `http://localhost/katalog-produk/user/orders` (login: `buyer@lumina.com` / `buyer123`)
   - **Panel Admin**: `http://localhost/katalog-produk/admin` (login: `admin@lumina.com` / `admin123`)
