-- ========================================================
-- DATABASE SCHEMA: Lumina Pearl (Katalog Produk & Checkout)
-- ========================================================

CREATE DATABASE IF NOT EXISTS `katalog_produk` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `katalog_produk`;

-- ========================================================
-- 1. TABEL: products
-- ========================================================
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `couriers`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `users`;

-- ========================================================
-- 0. TABEL: users (Multi-Vendor: Buyer, Seller, Admin)
-- ========================================================
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `email` VARCHAR(150) UNIQUE NOT NULL,
    `phone` VARCHAR(50) NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('buyer', 'seller', 'admin') DEFAULT 'buyer',
    `store_name` VARCHAR(150) NULL,
    `store_description` TEXT NULL,
    `address` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `store_name`, `store_description`, `address`) VALUES
(1, 'Budi Penjual', 'seller@lumina.com', '081234567891', '$2y$10$ghSo1CDX3dJ/uIIeeCdsreZf93OkOzydEu91N7uJ1EB32JlOWNHpi', 'seller', 'Lumina Official Store', 'Toko resmi koleksi lampu tiram mutiara samudra berstandar ekspor premium.', 'Jakarta Barat, DKI Jakarta'),
(2, 'Siti Pembeli', 'buyer@lumina.com', '081298765432', '$2y$10$ghSo1CDX3dJ/uIIeeCdsreZf93OkOzydEu91N7uJ1EB32JlOWNHpi', 'buyer', NULL, NULL, 'Jl. Kemang Raya No. 12, Jakarta Selatan'),
(3, 'Super Administrator', 'admin@lumina.com', '081200000000', '$2y$10$ghSo1CDX3dJ/uIIeeCdsreZf93OkOzydEu91N7uJ1EB32JlOWNHpi', 'admin', NULL, NULL, NULL);

-- ========================================================
-- 1. TABEL: admins (Legacy superadmin compatibility)
-- ========================================================
CREATE TABLE `admins` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(150) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `username`, `password`, `name`) VALUES
(1, 'admin', '$2y$10$ghSo1CDX3dJ/uIIeeCdsreZf93OkOzydEu91N7uJ1EB32JlOWNHpi', 'Administrator Lumina');


-- ========================================================
-- 1. TABEL: categories (Kategori Produk)
-- ========================================================
CREATE TABLE `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `icon` VARCHAR(50) DEFAULT '✨',
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `description`) VALUES
(1, 'Lampu Cangkang Keramik', 'lampu-cangkang-keramik', '🪔', 'Lampu hias dekorasi cangkang tiram keramik porselen glasir premium dengan pendaran cahaya hangat.'),
(2, 'Kerang Alami Samudra', 'kerang-alami-samudra', '🐚', 'Cangkang tiram laut asli dan mutiara air laut alami bermutu tinggi yang dipoles secara organik.'),
(3, 'Koleksi Emas & Mistik', 'koleksi-emas-mistik', '👑', 'Edisi mewah dengan sentuhan glitter emas istana dan resin biru safir bergradasi mistis.'),
(4, 'Aksesoris & Tray Mutiara', 'aksesoris-tray-mutiara', '✨', 'Wadah cincin nikah, nampan perhiasan mewah, dan ornamen dekoratif interior berkelas.');

-- ========================================================
-- 2. TABEL: couriers (Mitra Logistik & Ekspedisi)
-- ========================================================
CREATE TABLE `couriers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `service_type` VARCHAR(100) NOT NULL,
    `base_rate` INT NOT NULL DEFAULT 15000,
    `estimated_days` VARCHAR(50) NOT NULL DEFAULT '2-3 Hari',
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `description` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `couriers` (`id`, `name`, `code`, `service_type`, `base_rate`, `estimated_days`, `status`, `description`) VALUES
(1, 'JNE Express', 'JNE-REG', 'Reguler Delivery', 18000, '2-3 Hari', 'active', 'Layanan pengiriman reguler terpercaya ke seluruh pelosok Indonesia.'),
(2, 'J&T Express', 'JNT-STD', 'Standard Express', 16000, '1-2 Hari', 'active', 'Pengiriman cepat dengan operasional 365 hari tanpa libur.'),
(3, 'SiCepat Cargo & BEST', 'SICEPAT-BEST', 'Next Day Delivery', 22000, '1 Hari', 'active', 'Jaminan sampai esok hari untuk wilayah kota-kota besar.'),
(4, 'POS Indonesia', 'POS-KILAT', 'Pos Kilat Khusus', 14000, '3-4 Hari', 'active', 'Jangkauan pengiriman terlengkap hingga pelosok dan pulau terluar.'),
(5, 'Anteraja', 'ANTERAJA-REG', 'Reguler Eco Service', 15000, '2-3 Hari', 'active', 'Layanan kurir berbasis teknologi dengan pelacakan akurat.'),
(6, 'GoSend Instant', 'GOSEND-INSTANT', 'Instant 3 Jam', 35000, '3 Jam', 'active', 'Pengiriman cepat khusus area Jabodetabek dalam hitungan jam.');

-- ========================================================
-- 3. TABEL: products
-- ========================================================
CREATE TABLE `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `seller_id` INT DEFAULT 1,
    `category_id` INT DEFAULT 1,
    `title` VARCHAR(255) NOT NULL,
    `badge` VARCHAR(50) DEFAULT NULL,
    `rating` DECIMAL(2,1) DEFAULT 5.0,
    `reviews_count` INT DEFAULT 0,
    `price` INT NOT NULL,
    `original_price` INT DEFAULT NULL,
    `discount` VARCHAR(50) DEFAULT NULL,
    `description` TEXT,
    `main_image` VARCHAR(255) NOT NULL,
    `thumbnails` LONGTEXT NOT NULL,
    `colors` LONGTEXT NOT NULL,
    `sizes` LONGTEXT NOT NULL,
    `bullets` LONGTEXT NOT NULL,
    `materials` TEXT,
    `specs` LONGTEXT NOT NULL,
    `related_ids` VARCHAR(100) DEFAULT '1,2,3,4',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================================
-- 2. TABEL: orders
-- ========================================================
CREATE TABLE `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_code` VARCHAR(50) UNIQUE NOT NULL,
    `customer_name` VARCHAR(150) NOT NULL,
    `customer_phone` VARCHAR(50) NOT NULL,
    `customer_address` TEXT NOT NULL,
    `courier` VARCHAR(50) NOT NULL,
    `payment_method` VARCHAR(50) NOT NULL,
    `subtotal` INT NOT NULL,
    `shipping_fee` INT NOT NULL DEFAULT 0,
    `admin_fee` INT NOT NULL DEFAULT 2000,
    `total_amount` INT NOT NULL,
    `status` VARCHAR(50) DEFAULT 'Menunggu Pembayaran',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================================
-- 3. TABEL: order_items
-- ========================================================
CREATE TABLE `order_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `product_title` VARCHAR(255) NOT NULL,
    `price` INT NOT NULL,
    `variant` VARCHAR(100) DEFAULT 'Standard',
    `size` VARCHAR(100) DEFAULT 'Standard',
    `qty` INT NOT NULL DEFAULT 1,
    CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================================
-- SEED DATA: 8 Produk Lumina Pearl
-- ========================================================
INSERT INTO `products` (`id`, `title`, `badge`, `rating`, `reviews_count`, `price`, `original_price`, `discount`, `description`, `main_image`, `thumbnails`, `colors`, `sizes`, `bullets`, `materials`, `specs`, `related_ids`) VALUES
(
    1,
    'Ivory Pearl Classic Shell Lamp',
    'Terlaris',
    4.9,
    184,
    289000,
    399000,
    '28% OFF',
    'Lampu dekorasi cangkang tiram keramik porselen putih mutiara dengan pendaran cahaya hangat menenangkan, menghadirkan estetika mewah di ruangan Anda.',
    'images/pearl-white.png',
    '["images/pearl-white.png", "images/pearl-ocean.png", "images/pearl-gold.png", "images/pearl-natural.png"]',
    '[{"name":"Ivory White","hex":"#f8f5ee","img":"images/pearl-white.png"},{"name":"Ocean Abyss","hex":"#1e3a5f","img":"images/pearl-ocean.png"},{"name":"Royal Sunset","hex":"#d4af37","img":"images/pearl-gold.png"},{"name":"Natural Oyster","hex":"#8c7853","img":"images/pearl-natural.png"}]',
    '["S (14 cm)", "M (17 cm)", "L (20 cm)", "XL (25 cm)"]',
    '["Cangkang kerang porselen glasir premium", "Cahaya Warm LED 2700K relaksasi mata", "Baterai Lithium Rechargeable Type-C (8-10 Jam)", "Sensor sentuh cerdas dengan dimmer kecerahan", "Mutiara kristal padat ber-luster alami tinggi"]',
    'Material utama menggunakan tanah liat kaolin murni yang dibakar pada suhu 1.250°C untuk menghasilkan keramik porselen glasir yang padat, halus, dan tahan lama. Mutiara terbuat dari kristal padat dengan pelapisan nacre organik yang memantulkan spektrum cahaya alami. Semua bahan bebas zat berbahaya dan ramah lingkungan.',
    '[{"label":"Material Utama","val":"Fine Glazed Ceramic"},{"label":"Sumber Cahaya","val":"Warm LED (Dimmable)"},{"label":"Kapasitas Baterai","val":"1200 mAh Lithium"},{"label":"Tipe Pengisian Daya","val":"USB Type-C (5V/1A)"},{"label":"Dimensi Produk","val":"17 x 15 x 16 cm"},{"label":"Bobot Total","val":"680 gram"}]',
    '2,3,4,5'
),
(
    2,
    'Deep Sea Mystic Pearl',
    'Edisi Mistik',
    4.9,
    142,
    349000,
    480000,
    '27% OFF',
    'Mengangkat keindahan palung laut terdalam, kerang artistik resin kristal ini memancarkan alur ombak cair bergradasi biru safir dengan mutiara bercahaya cyan bioluminescent.',
    'images/pearl-ocean.png',
    '["images/pearl-ocean.png", "images/pearl-white.png", "images/pearl-gold.png", "images/pearl-natural.png"]',
    '[{"name":"Ocean Abyss","hex":"#0f2b48","img":"images/pearl-ocean.png"},{"name":"Ivory White","hex":"#f8f5ee","img":"images/pearl-white.png"},{"name":"Royal Sunset","hex":"#d4af37","img":"images/pearl-gold.png"},{"name":"Natural Akoya","hex":"#8c7853","img":"images/pearl-natural.png"}]',
    '["S (15 cm)", "M (18 cm)", "L (22 cm)", "XL (26 cm)"]',
    '["Alur ombak samudra artistik resin & kristal", "Pendaran cahaya Oceanic Cyan Bioluminescent", "USB-C Fast Charging dengan daya tahan 12 Jam", "Touch sensor kontrol dengan 3 level kecerahan", "Tahan kelembapan dan tidak mudah pudar"]',
    'Dibuat dengan teknik cetak resin artistik polimer bening dan bubuk kristal laut dalam. Menghasilkan tekstur gelombang cair yang menangkap bias cahaya secara dramatis tanpa panas berlebih.',
    '[{"label":"Material Utama","val":"Artisan Resin & Crystal"},{"label":"Warna Pendaran","val":"Oceanic Cyan / Blue"},{"label":"Kapasitas Baterai","val":"1500 mAh Lithium"},{"label":"Tipe Pengisian Daya","val":"USB Type-C Fast Charge"},{"label":"Dimensi Produk","val":"18 x 16 x 15 cm"},{"label":"Bobot Total","val":"720 gram"}]',
    '1,6,3,4'
),
(
    3,
    'Imperial Golden Clam',
    'Kemewahan',
    4.8,
    98,
    379000,
    499000,
    '24% OFF',
    'Lambang kemewahan istana. Cangkang kerang berdiri dengan tepian glitter emas berkilau membingkai mutiara bulat besar dengan pantulan warna sunset champagne hangat.',
    'images/pearl-gold.png',
    '["images/pearl-gold.png", "images/pearl-white.png", "images/pearl-ocean.png", "images/pearl-natural.png"]',
    '[{"name":"Royal Sunset Gold","hex":"#d4af37","img":"images/pearl-gold.png"},{"name":"Ivory White","hex":"#f8f5ee","img":"images/pearl-white.png"},{"name":"Ocean Abyss","hex":"#1e3a5f","img":"images/pearl-ocean.png"},{"name":"Natural Oyster","hex":"#8c7853","img":"images/pearl-natural.png"}]',
    '["M (17 cm)", "L (20 cm)", "XL (25 cm)"]',
    '["Finishing glitter emas mewah tidak mudah rontok", "Mutiara raksasa berdiameter 55mm warna champagne", "Pencahayaan Sunset Amber Glow menenangkan", "Dudukan kokoh anti-selip dengan lapisan beludru", "Sangat ideal sebagai hadiah pernikahan & kado mewah"]',
    'Perpaduan bahan keramik stoneware berkualitas ekspor dengan aksen leburan emas sintesis dan partikel glitter kristal mikro berpelindung bening anti-gores.',
    '[{"label":"Material Utama","val":"Glazed Ceramic & Gold Trim"},{"label":"Diameter Mutiara","val":"55 mm Giant Pearl"},{"label":"Kapasitas Baterai","val":"1200 mAh Lithium"},{"label":"Tipe Pengisian Daya","val":"USB Type-C"},{"label":"Dimensi Produk","val":"17 x 15 x 16 cm"},{"label":"Bobot Total","val":"790 gram"}]',
    '7,1,2,4'
),
(
    4,
    'Natural Akoya Oyster',
    'Kolektor',
    5.0,
    76,
    450000,
    590000,
    '24% OFF',
    'Cangkang tiram laut asli (Pinctada Maxima) dengan lapisan nacre multi-warna organik dan mutiara air laut murni pilihan bernilai estetika tinggi.',
    'images/pearl-natural.png',
    '["images/pearl-natural.png", "images/pearl-white.png", "images/pearl-ocean.png", "images/pearl-gold.png"]',
    '[{"name":"Natural Organic","hex":"#8c7853","img":"images/pearl-natural.png"},{"name":"Ivory White","hex":"#f8f5ee","img":"images/pearl-white.png"},{"name":"Royal Sunset","hex":"#d4af37","img":"images/pearl-gold.png"}]',
    '["Alami (15-17 cm)", "Koleksi Ekstra (18-20 cm)"]',
    '["100% cangkang tiram laut asli perairan tropis", "Lapisan nacre prismatik memantulkan bias pelangi alami", "Mutiara air laut Grade AAA kualitas tinggi", "Dipoles tangan secara lembut mempertahankan tekstur asli", "Sangat cocok sebagai wadah cincin nikah & koleksi seni"]',
    'Cangkang tiram laut alami dari spesies Pinctada Maxima yang dipanen secara lestari dan dipoles dengan teknik pemolesan kering alami tanpa pewarna kimia buatan.',
    '[{"label":"Asal Spesies","val":"Pinctada Maxima (Laut Tropis)"},{"label":"Grade Mutiara","val":"South Sea Pearl AAA"},{"label":"Tipe Kerajinan","val":"100% Hand-Polished Organic"},{"label":"Dimensi Cangkang","val":"15 x 13 x 10 cm (Alami)"},{"label":"Bobot Total","val":"420 gram"},{"label":"Sertifikasi","val":"Keaslian Bahan Organik"}]',
    '8,1,2,3'
),
(
    5,
    'Aurora Celestial Shell Lamp',
    'Edisi Baru',
    4.9,
    53,
    310000,
    420000,
    '26% OFF',
    'Lampu cangkang porselen berona putih kristal dengan cahaya lembut bertingkat. Dirancang khusus untuk ruang istirahat yang menenangkan.',
    'images/pearl-white.png',
    '["images/pearl-white.png", "images/pearl-ocean.png", "images/pearl-gold.png"]',
    '[{"name":"Pure White","hex":"#ffffff","img":"images/pearl-white.png"},{"name":"Soft Cyan","hex":"#1e3a5f","img":"images/pearl-ocean.png"}]',
    '["M (16 cm)", "L (19 cm)"]',
    '["Porselen glasir putih salju mutiara", "Mode cahaya malam anti-silau (eye-care LED)", "USB-C port tersembunyi di bagian bawah", "Daya tahan hingga 10 jam pemakaian non-stop"]',
    'Keramik porselen kaolin putih bersuhu tinggi.',
    '[{"label":"Material","val":"Porselen Glasir Putih"},{"label":"LED","val":"Soft Warm 2700K"},{"label":"Dimensi","val":"16 x 15 x 15 cm"}]',
    '1,2,3,4'
),
(
    6,
    'Midnight Sapphire Oyster',
    'Favorit',
    4.8,
    115,
    365000,
    490000,
    '25% OFF',
    'Karya seni samudra dalam bernuansa safir malam dengan alur ombak kristal berkilau dan mutiara berpendar biru tenang.',
    'images/pearl-ocean.png',
    '["images/pearl-ocean.png", "images/pearl-white.png", "images/pearl-gold.png"]',
    '[{"name":"Midnight Sapphire","hex":"#0a192f","img":"images/pearl-ocean.png"},{"name":"Ivory White","hex":"#f8f5ee","img":"images/pearl-white.png"}]',
    '["M (17 cm)", "L (20 cm)"]',
    '["Gradasi warna biru safir laut dalam", "Cahaya relaksasi biru laut menyejukkan suasana", "Baterai tahan lama 12 jam pemakaian", "Sensor sentuh responsif"]',
    'Resin artistik polimer dan kristal nacre.',
    '[{"label":"Material","val":"Resin Artistik & Kristal"},{"label":"Baterai","val":"1500 mAh"},{"label":"Dimensi","val":"18 x 16 x 15 cm"}]',
    '2,1,3,4'
),
(
    7,
    'Royal Sunset Glow Clam',
    'Eksklusif',
    4.9,
    89,
    399000,
    520000,
    '23% OFF',
    'Cangkang kerang vertikal megah dengan kilau emas dan mutiara mawar senja bercahaya lembut untuk dekorasi ruang tamu berkelas.',
    'images/pearl-gold.png',
    '["images/pearl-gold.png", "images/pearl-white.png", "images/pearl-ocean.png"]',
    '[{"name":"Sunset Gold","hex":"#d4af37","img":"images/pearl-gold.png"},{"name":"Ivory White","hex":"#f8f5ee","img":"images/pearl-white.png"}]',
    '["M (17 cm)", "L (21 cm)"]',
    '["Detail ukiran alur kerang simetris megah", "Tepian glitter emas berkilau mewah", "Mutiara besar berona champagne pink", "Baterai USB Type-C isi ulang"]',
    'Keramik stoneware dengan glasir emas khusus.',
    '[{"label":"Material","val":"Stoneware & Gold Glitter"},{"label":"Dimensi","val":"18 x 16 x 17 cm"}]',
    '3,1,2,4'
),
(
    8,
    'South Sea Mother of Pearl',
    'Organik',
    5.0,
    42,
    480000,
    620000,
    '22% OFF',
    'Koleksi cangkang tiram laut alami langka dengan mutiara South Sea berkualitas tinggi, mahakarya alam tak ternilai untuk kolektor.',
    'images/pearl-natural.png',
    '["images/pearl-natural.png", "images/pearl-gold.png", "images/pearl-white.png"]',
    '[{"name":"Natural Mother of Pearl","hex":"#8c7853","img":"images/pearl-natural.png"}]',
    '["Ukuran Alami (16-18 cm)"]',
    '["100% Cangkang tiram laut asli langka", "Kilau nacre prismatik warna-warni", "Mutiara air laut murni pilihan", "Wadah perhiasan elegan dan tahan selamanya"]',
    'Cangkang tiram laut alami Pinctada Maxima murni.',
    '[{"label":"Spesies","val":"Pinctada Maxima Asli"},{"label":"Dimensi","val":"16 x 14 x 11 cm"}]',
    '4,1,2,3'
);
