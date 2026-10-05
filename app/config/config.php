<?php
// ========================================================
// LUMINA PEARL - APPLICATION CONFIGURATION
// ========================================================

// Load environment variables from .env if present
$envFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($k, $v) = explode('=', $line, 2);
            $k = trim($k);
            $v = trim($v, " \t\n\r\0\x0B\"'");
            putenv("$k=$v");
            $_ENV[$k] = $v;
            $_SERVER[$k] = $v;
        }
    }
}

// Database Credentials
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('DB_NAME', getenv('DB_NAME') ?: 'katalog_produk');

// Auto-detect Base URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
// Hapus trailing slash jika ada
$scriptDir = rtrim($scriptDir, '/');
define('BASEURL', $protocol . $host . $scriptDir . '/');

// Application Meta
define('APP_NAME', 'Lumina Pearl');
define('APP_DESC', 'Exclusive Pearl Shell Collection');

/**
 * Helper global untuk mengambil pengaturan website dinamis dari database (Web-Based Customization)
 * @param string $key
 * @param string $default
 * @return string
 */
function site_setting($key, $default = '') {
    static $settings = null;
    if ($settings === null) {
        $settings = [];
        try {
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
            if ($stmt) {
                while ($row = $stmt->fetch()) {
                    $settings[$row['setting_key']] = $row['setting_value'];
                }
            }
        } catch (Exception $e) {
            // Silently ignore DB errors
        }
    }
    return (!empty($settings[$key]) || isset($settings[$key])) ? $settings[$key] : $default;
}

/**
 * Helper to render clean SVG category icons without any emojis
 * @param string $iconSlug
 * @param int $size
 * @return string HTML SVG
 */
function render_category_icon($iconSlug, $size = 20) {
    $slug = strtolower(trim((string)$iconSlug));
    
    // SVG icons (stroke: currentColor, clean vector lines)
    switch ($slug) {
        case 'lamp':
        case 'lampu':
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v8"/><path d="m4.93 10.93 1.41 1.41"/><path d="M2 18h20"/><path d="M20 18v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2"/><path d="m19.07 10.93-1.41 1.41"/><path d="M9 18v-4a3 3 0 0 1 6 0v4"/><circle cx="12" cy="7" r="3"/></svg>';

        case 'shell':
        case 'kerang':
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a9 9 0 0 1 9 9c0 4.97-3.5 8.5-7 10.5-1.5.85-2.5.85-4 0-3.5-2-7-5.53-7-10.5a9 9 0 0 1 9-9z"/><path d="M12 2v20"/><path d="M12 2c2.5 4 4.5 9 3 17"/><path d="M12 2c-2.5 4-4.5 9-3 17"/></svg>';

        case 'crown':
        case 'mahkota':
        case 'mistik':
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 4 3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"/></svg>';

        case 'gem':
        case 'diamond':
        case 'mutiara':
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h12l4 6-10 12L2 9z"/><path d="M11 3 8 9l4 12 4-12-3-6"/><path d="M2 9h20"/></svg>';

        case 'box':
        case 'tray':
        case 'aksesoris':
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>';

        case 'tag':
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m20.59 13.41-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>';

        case 'sparkles':
        default:
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3z"/><path d="M20 3v4"/><path d="M22 5h-4"/><path d="M4 17v2"/><path d="M5 18H3"/></svg>';
    }
}


