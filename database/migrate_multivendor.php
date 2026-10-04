<?php
// ========================================================
// MIGRATION SCRIPT: MULTI-VENDOR ARCHITECTURE (MYSQL)
// ========================================================

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/Database.php';

try {
    $db = new Database();

    // 1. Create users table
    $sqlUsers = "CREATE TABLE IF NOT EXISTS `users` (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $db->query($sqlUsers);
    $db->execute();
    echo "[OK] Tabel users siap.\n";

    // 2. Add seller_id to products if not exists
    $db->query("SHOW COLUMNS FROM `products` LIKE 'seller_id'");
    if (!$db->single()) {
        $db->query("ALTER TABLE `products` ADD COLUMN `seller_id` INT DEFAULT 1 AFTER `id`");
        $db->execute();
        echo "[OK] Kolom seller_id ditambahkan ke tabel products.\n";
    }

    // 3. Add user_id to orders if not exists
    $db->query("SHOW COLUMNS FROM `orders` LIKE 'user_id'");
    if (!$db->single()) {
        $db->query("ALTER TABLE `orders` ADD COLUMN `user_id` INT NULL AFTER `id`");
        $db->execute();
        echo "[OK] Kolom user_id ditambahkan ke tabel orders.\n";
    }

    // 4. Add seller_id to order_items if not exists
    $db->query("SHOW COLUMNS FROM `order_items` LIKE 'seller_id'");
    if (!$db->single()) {
        $db->query("ALTER TABLE `order_items` ADD COLUMN `seller_id` INT NULL DEFAULT 1 AFTER `product_id`");
        $db->execute();
        echo "[OK] Kolom seller_id ditambahkan ke tabel order_items.\n";
    }

    // 5. Seed default accounts
    $sellerPass = password_hash('seller123', PASSWORD_DEFAULT);
    $buyerPass  = password_hash('buyer123', PASSWORD_DEFAULT);
    $adminPass  = password_hash('admin123', PASSWORD_DEFAULT);

    // Insert or update Seller (ID 1)
    $sqlSeller = "INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `store_name`, `store_description`, `address`)
        VALUES (1, 'Budi Penjual', 'seller@lumina.com', '081234567891', :pass, 'seller', 'Lumina Official Store', 'Toko resmi koleksi lampu tiram mutiara samudra berstandar ekspor premium.', 'Jakarta Barat, DKI Jakarta')
        ON DUPLICATE KEY UPDATE `password` = :pass, `role` = 'seller', `store_name` = 'Lumina Official Store';";
    $db->query($sqlSeller);
    $db->bind(':pass', $sellerPass);
    $db->execute();
    echo "[OK] Akun Seller default siap (seller@lumina.com / seller123).\n";

    // Insert or update Buyer (ID 2)
    $sqlBuyer = "INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `address`)
        VALUES (2, 'Siti Pembeli', 'buyer@lumina.com', '081298765432', :pass, 'buyer', 'Jl. Kemang Raya No. 12, Jakarta Selatan')
        ON DUPLICATE KEY UPDATE `password` = :pass, `role` = 'buyer';";
    $db->query($sqlBuyer);
    $db->bind(':pass', $buyerPass);
    $db->execute();
    echo "[OK] Akun Buyer default siap (buyer@lumina.com / buyer123).\n";

    // Insert or update Admin (ID 3)
    $sqlAdmin = "INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`)
        VALUES (3, 'Super Administrator', 'admin@lumina.com', '081200000000', :pass, 'admin')
        ON DUPLICATE KEY UPDATE `password` = :pass, `role` = 'admin';";
    $db->query($sqlAdmin);
    $db->bind(':pass', $adminPass);
    $db->execute();
    echo "[OK] Akun Admin terintegrasi siap (admin@lumina.com / admin123).\n";

    // 6. Pastikan seluruh produk yang ada mengacu ke seller_id 1
    $db->query("UPDATE `products` SET `seller_id` = 1 WHERE `seller_id` IS NULL OR `seller_id` = 0");
    $db->execute();
    echo "[OK] Seluruh produk tersinkronisasi ke seller_id 1 (Lumina Official Store).\n";

    echo "\n=== MIGRATION COMPLETED SUCCESSFULLY ===\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
