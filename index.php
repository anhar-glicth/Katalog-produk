<?php
// ========================================================
// LUMINA PEARL - FRONT CONTROLLER & APPLICATION ENTRY POINT
// ========================================================

// Start Hardened PHP Session
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}

// Load Application Config
require_once __DIR__ . '/app/config/config.php';

// Load Core Architecture Classes
require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/app/core/Controller.php';
require_once __DIR__ . '/app/core/App.php';

// Instantiate and Run Application
$app = new App();
