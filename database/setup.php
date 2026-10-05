<?php
// ========================================================
// LUMINA PEARL - ONE CLICK DATABASE INSTALLER / MIGRATION
// ========================================================

require_once dirname(__DIR__) . '/app/config/config.php';

$host = defined('DB_HOST') ? DB_HOST : 'localhost';
$user = defined('DB_USER') ? DB_USER : 'root';
$pass = defined('DB_PASS') ? DB_PASS : '';
$dbname = defined('DB_NAME') ? DB_NAME : 'katalog_produk';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Lumina Pearl MVC</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #0f172a;
            color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 32px;
            max-width: 580px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        h1 {
            font-size: 24px;
            margin-top: 0;
            color: #ffd166;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .step {
            padding: 12px 16px;
            margin-bottom: 12px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.5;
        }
        .step.success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid #10b981;
            color: #6ee7b7;
        }
        .step.error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid #ef4444;
            color: #fca5a5;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #ffd166, #d4af37);
            color: #0f172a;
            text-decoration: none;
            padding: 12px 24px;
            font-weight: 700;
            border-radius: 8px;
            margin-top: 20px;
            transition: opacity 0.2s;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>
            <span>&#9881;</span> Database Setup Lumina Pearl
        </h1>
        <p style="color: #94a3b8; font-size: 14px; margin-bottom: 24px;">
            Memasang skema database MySQL dan data awal produk secara otomatis.
        </p>

        <?php
        try {
            // 1. Coba koneksi langsung ke database yang sudah dibuat (Hostinger / cPanel)
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
                echo '<div class="step success">&#10004; Terhubung langsung ke database <strong>' . htmlspecialchars($dbname) . '</strong> di <strong>' . htmlspecialchars($host) . '</strong>.</div>';
            } catch (PDOException $exDirect) {
                // Jika database belum ada dan punya izin root (misal local XAMPP), coba create database
                $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $pdo->exec("USE `$dbname`");
                echo '<div class="step success">&#10004; Database <strong>' . htmlspecialchars($dbname) . '</strong> berhasil dibuat di server MySQL.</div>';
            }

            // 2. Read SQL file
            $sqlFile = __DIR__ . '/lumina_pearl.sql';
            if (!file_exists($sqlFile)) {
                throw new Exception("File lumina_pearl.sql tidak ditemukan di direktori database.");
            }
            $sql = file_get_contents($sqlFile);

            // 3. Execute SQL batch
            $pdo->exec($sql);
            echo '<div class="step success">&#10004; Skema tabel (products, orders, order_items, users, admins, couriers, categories, site_settings) berhasil dibuat!</div>';

            // 4. Verify products count
            $stmt = $pdo->query("SELECT COUNT(*) FROM `products`");
            $count = $stmt->fetchColumn();

            echo '<div class="step success">&#10004; Berhasil mengimpor <strong>' . $count . ' produk</strong> Lumina Pearl ke dalam database.</div>';
            echo '<a href="../" class="btn">Buka Beranda Katalog &rarr;</a>';

        } catch (PDOException $e) {
            echo '<div class="step error"><strong>Gagal menghubungkan ke MySQL:</strong><br>' . htmlspecialchars($e->getMessage()) . '<br><br><small>Pastikan MySQL di XAMPP Control Panel sudah berstatus "Running".</small></div>';
        } catch (Exception $e) {
            echo '<div class="step error"><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
        ?>
    </div>
</body>
</html>
