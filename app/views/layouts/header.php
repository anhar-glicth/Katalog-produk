<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = !empty($_SESSION['user']);
$authUser = $_SESSION['user'] ?? null;
$isAdmin = !empty($_SESSION['admin_user']);
?>
<?php
$siteName = site_setting('app_name', defined('APP_NAME') ? APP_NAME : 'Yeni Mutiara Lombok');
$defaultDesc = 'Pusat aneka kerajinan perhiasan mutiara asli Pulau Lombok: kalung, cincin, bros, gelang, dan kerang mutiara air laut & tawar berkualitas tinggi.';
$siteDesc = site_setting('app_desc', $defaultDesc);
if (empty($siteDesc) || strpos($siteDesc, 'Lumina') !== false) {
    $siteDesc = $defaultDesc;
}

if (empty($title) || strpos($title, 'Lumina Pearl') !== false) {
    $pageTitle = htmlspecialchars($siteName) . ' - Pengrajin & Perhiasan Mutiara Asli Lombok';
} else {
    $cleanTitle = str_ireplace(' | Lumina Pearl', '', $title);
    $cleanTitle = str_ireplace('Lumina Pearl - ', '', $cleanTitle);
    if (stripos($cleanTitle, $siteName) !== false) {
        $pageTitle = htmlspecialchars($cleanTitle);
    } else {
        $pageTitle = htmlspecialchars($cleanTitle) . ' | ' . htmlspecialchars($siteName);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title Tag Utama (Kunci Pencarian Google) -->
    <title><?= $pageTitle ?></title>

    <!-- Google Search Console Verification -->
    <meta name="google-site-verification" content="google7fbbe7ef6de1e4b8">
    <meta name="google-site-verification" content="7fbbe7ef6de1e4b8">

    <!-- Meta SEO & Deskripsi -->
    <meta name="description" content="<?= htmlspecialchars($siteDesc) ?>">
    <meta name="keywords" content="yeni mutiara lombok, mutiara lombok, perhiasan mutiara lombok, toko mutiara lombok, kerajinan mutiara lombok, kalung mutiara lombok, mutiara air laut lombok, mutiara air tawar lombok">
    <meta name="author" content="<?= htmlspecialchars($siteName) ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= BASEURL ?>">

    <!-- Open Graph (WhatsApp, Facebook, Telegram Share) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= htmlspecialchars($siteName) ?>">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= htmlspecialchars($siteDesc) ?>">
    <meta property="og:url" content="<?= BASEURL ?>">
    <meta property="og:image" content="<?= BASEURL ?>images/lumina.png">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $pageTitle ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($siteDesc) ?>">

    <!-- Android & Mobile App Meta Tags -->
    <meta name="theme-color" content="#ffffff">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="stylesheet" href="<?= BASEURL ?>style.css?v=<?= time() ?>">
    <script>
        // Global environment variables untuk sinkronisasi JS dengan backend PHP & MySQL
        window.BASEURL = "<?= BASEURL ?>";
        window.AUTH_USER = <?= !empty($_SESSION['user']) ? json_encode(['id' => $_SESSION['user']['id'], 'name' => $_SESSION['user']['name'], 'phone' => $_SESSION['user']['phone'], 'address' => $_SESSION['user']['address'], 'role' => $_SESSION['user']['role']]) : 'null' ?>;
        window.SERVER_PRODUCTS = <?= !empty($products) ? json_encode(array_column($products, null, 'id')) : '{}' ?>;
        <?php if (!empty($product)): ?>
        window.CURRENT_PRODUCT = <?= json_encode($product) ?>;
        <?php endif; ?>
    </script>
    <style>
        .nav-auth-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 18px;
        }
        .nav-btn-login {
            color: #0b3c5d !important;
            font-weight: 600 !important;
            margin-left: 0 !important;
            padding: 6px 14px;
            border-radius: 20px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .nav-btn-login:hover {
            background: rgba(11, 60, 93, 0.08);
        }
        .nav-btn-register {
            background: #0284c7;
            color: #ffffff !important;
            font-weight: 700 !important;
            margin-left: 0 !important;
            padding: 7px 16px;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.2);
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .nav-btn-register:hover {
            background: #0369a1;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }
        .nav-btn-seller {
            background: #ffffff;
            color: #0284c7 !important;
            border: 1px solid #bae6fd;
            font-weight: 700 !important;
            margin-left: 0 !important;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.88em !important;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        .nav-btn-seller:hover {
            background: #f0f9ff;
            border-color: #0284c7;
        }
        .nav-btn-user {
            background: #f1f5f9;
            color: #0f172a !important;
            border: 1px solid #cbd5e1;
            font-weight: 600 !important;
            margin-left: 0 !important;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.88em !important;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .nav-btn-user:hover {
            background: #e2e8f0;
            color: #0b3c5d !important;
        }
        .nav-btn-logout {
            color: #ef4444 !important;
            font-size: 0.85em !important;
            margin-left: 6px !important;
            opacity: 0.85;
            transition: opacity 0.2s;
            text-decoration: none;
        }
        .nav-btn-logout:hover {
            opacity: 1;
            text-decoration: underline;
        }

        /* =========================================================
           CAVOSH NATIVE MOBILE APP SHELL (SMARTPHONES <= 768px)
           ========================================================= */
        /* Desktop view defaults (>= 769px) */
        @media screen and (min-width: 769px) {
            .mobile-cavosh-header {
                display: none !important;
            }
            .android-bottom-nav {
                display: none !important;
            }
            .mobile-bottom-spacer {
                display: none !important;
            }
            .cavosh-frequently-section {
                display: none !important;
            }
            .card-wishlist-btn {
                display: none !important;
            }
            .plus-icon-mobile {
                display: none !important;
            }
            .cart-icon-desktop {
                display: block !important;
            }
            .pdp-mobile-back-btn,
            .pdp-mobile-wish-btn {
                display: none !important;
            }
        }

        /* Smartphone view (<= 768px Cavosh UI Kit Mobile Experience) */
        @media screen and (max-width: 768px) {
            html, body {
                -webkit-tap-highlight-color: transparent;
                touch-action: manipulation;
                background-color: #f7f9fb !important;
            }

            /* Sembunyikan header desktop di layar smartphone */
            .header-container {
                display: none !important;
            }

            /* TOP APP BAR CONTAINER */
            header {
                position: relative !important;
                z-index: 999 !important;
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                height: auto !important;
            }

            /* CAVOSH CURVED DEEP TEAL HEADER */
            .mobile-cavosh-header {
                display: block !important;
                background: linear-gradient(165deg, #102434 0%, #17364e 100%) !important;
                border-radius: 0 0 28px 28px !important;
                padding: 16px 16px 22px 16px !important;
                box-shadow: 0 10px 30px rgba(16, 36, 52, 0.18) !important;
                color: #ffffff !important;
                position: relative !important;
                overflow: hidden !important;
            }

            .mobile-cavosh-header::before {
                content: '' !important;
                position: absolute !important;
                top: -40px !important;
                right: -30px !important;
                width: 150px !important;
                height: 150px !important;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%) !important;
                border-radius: 50% !important;
                pointer-events: none !important;
            }

            .mobile-cavosh-top-row {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                margin-bottom: 15px !important;
            }

            .cavosh-greeting {
                font-size: 11px !important;
                color: #94a3b8 !important;
                font-weight: 500 !important;
                display: block !important;
                letter-spacing: 0.3px !important;
            }

            .cavosh-username {
                margin: 1px 0 3px 0 !important;
                font-size: 17px !important;
                font-weight: 700 !important;
                color: #ffffff !important;
                letter-spacing: 0.2px !important;
            }

            .cavosh-location {
                display: flex !important;
                align-items: center !important;
                gap: 5px !important;
                font-size: 11px !important;
                color: #cbd5e1 !important;
            }

            .cavosh-location svg {
                stroke: #0284c7 !important;
            }

            .mobile-cavosh-actions {
                display: flex !important;
                align-items: center !important;
                gap: 8px !important;
            }

            .cavosh-action-btn {
                background: rgba(255, 255, 255, 0.12) !important;
                border: 1px solid rgba(255, 255, 255, 0.2) !important;
                color: #ffffff !important;
                width: 40px !important;
                height: 40px !important;
                border-radius: 50% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                position: relative !important;
                cursor: pointer !important;
                transition: transform 0.2s !important;
            }

            .cavosh-action-btn:active {
                transform: scale(0.92) !important;
            }

            .cavosh-action-btn .cavosh-badge {
                position: absolute !important;
                top: -3px !important;
                right: -3px !important;
                background: #0284c7 !important;
                color: #ffffff !important;
                font-size: 9px !important;
                font-weight: 800 !important;
                min-width: 17px !important;
                height: 17px !important;
                border-radius: 9px !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                border: 2px solid #102434 !important;
            }

            .cavosh-auth-pill {
                background: linear-gradient(135deg, #0b3c5d, #0284c7) !important;
                color: #ffffff !important;
                font-size: 12px !important;
                font-weight: 700 !important;
                padding: 7px 15px !important;
                border-radius: 20px !important;
                border: none !important;
                cursor: pointer !important;
                box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35) !important;
                transition: transform 0.2s !important;
            }

            .cavosh-auth-pill:active {
                transform: scale(0.94) !important;
            }

            /* Cavosh Pill Search Bar */
            .mobile-cavosh-search-box {
                background: #ffffff !important;
                border-radius: 26px !important;
                padding: 4px 5px 4px 16px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08) !important;
                cursor: pointer !important;
            }

            .cavosh-search-inner {
                display: flex !important;
                align-items: center !important;
                gap: 8px !important;
                color: #94a3b8 !important;
                font-size: 12.5px !important;
            }

            .cavosh-search-circle-btn {
                background: #0284c7 !important;
                border: none !important;
                width: 36px !important;
                height: 36px !important;
                border-radius: 50% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
                box-shadow: 0 3px 10px rgba(2, 132, 199, 0.4) !important;
                flex-shrink: 0 !important;
            }

            /* ANDROID BOTTOM NAVIGATION BAR (CAVOSH DESIGN) */
            .android-bottom-nav {
                display: grid !important;
                grid-auto-flow: column !important;
                grid-auto-columns: 1fr !important;
                position: fixed !important;
                bottom: 0 !important;
                left: 0 !important;
                right: 0 !important;
                height: 64px !important;
                background: #ffffff !important;
                border-top: 1px solid #eef2f6 !important;
                box-shadow: 0 -6px 24px rgba(0, 0, 0, 0.06) !important;
                border-radius: 22px 22px 0 0 !important;
                z-index: 9999 !important;
                padding-bottom: env(safe-area-inset-bottom, 0) !important;
            }

            .android-nav-item {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                text-decoration: none !important;
                color: #94a3b8 !important;
                gap: 2px !important;
                position: relative !important;
                user-select: none !important;
                transition: all 0.2s !important;
            }

            .android-nav-item.active {
                color: #0284c7 !important;
            }

            .android-nav-item.active::after {
                content: '' !important;
                display: block !important;
                width: 4px !important;
                height: 4px !important;
                border-radius: 50% !important;
                background: #0284c7 !important;
                margin-top: 1px !important;
            }

            .android-nav-item span {
                font-size: 10px !important;
                font-weight: 600 !important;
                letter-spacing: 0.2px !important;
            }

            .android-nav-icon {
                position: relative !important;
                width: 22px !important;
                height: 22px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .android-badge {
                position: absolute !important;
                top: -4px !important;
                right: -8px !important;
                background: #0284c7 !important;
                color: #ffffff !important;
                font-size: 9px !important;
                font-weight: 800 !important;
                min-width: 16px !important;
                height: 16px !important;
                padding: 0 4px !important;
                border-radius: 8px !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                line-height: 1 !important;
                border: 2px solid #ffffff !important;
            }

            .mobile-bottom-spacer {
                display: block !important;
                height: 68px !important;
            }

            /* CATEGORY PILLS HORIZONTAL SCROLL (CAVOSH STYLE) */
            .collection-filter-tabs {
                display: flex !important;
                overflow-x: auto !important;
                white-space: nowrap !important;
                gap: 8px !important;
                padding: 4px 16px 12px 16px !important;
                margin: 0 -16px 16px -16px !important;
                -webkit-overflow-scrolling: touch !important;
                scrollbar-width: none !important;
            }

            .collection-filter-tabs::-webkit-scrollbar {
                display: none !important;
            }

            .filter-btn {
                background: #ffffff !important;
                border: 1px solid #e2e8f0 !important;
                color: #64748b !important;
                border-radius: 20px !important;
                padding: 7px 15px !important;
                font-size: 12.5px !important;
                font-weight: 600 !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02) !important;
                flex-shrink: 0 !important;
                transition: all 0.2s !important;
            }

            .filter-btn.active {
                background: #0284c7 !important;
                border-color: #0284c7 !important;
                color: #ffffff !important;
                box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3) !important;
            }

            /* 2-COLUMN PRODUCT GRID (CAVOSH "NEW IN" STYLE) */
            .products-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
                padding: 0 !important;
            }

            .product-card {
                background: #ffffff !important;
                border: 1px solid #edf2f7 !important;
                border-radius: 18px !important;
                padding: 10px !important;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04) !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                position: relative !important;
                transition: transform 0.2s !important;
            }

            .product-card:active {
                transform: scale(0.98) !important;
            }

            .product-card .product-img-wrap {
                height: 130px !important;
                background: #f8fafc !important;
                border-radius: 14px !important;
                margin-bottom: 8px !important;
                position: relative !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .product-card .product-img-wrap img {
                max-height: 105px !important;
                max-width: 88% !important;
                object-fit: contain !important;
            }

            /* Circular Wishlist Button at Top-Right of Image (Cavosh Spec) */
            .card-wishlist-btn {
                position: absolute !important;
                top: 8px !important;
                right: 8px !important;
                width: 28px !important;
                height: 28px !important;
                border-radius: 50% !important;
                background: rgba(255, 255, 255, 0.95) !important;
                border: 1px solid #f1f5f9 !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                color: #0284c7 !important;
                cursor: pointer !important;
                z-index: 5 !important;
                padding: 0 !important;
            }

            .card-wishlist-btn.liked svg {
                fill: #0284c7 !important;
            }

            .product-card .badge-category {
                position: absolute !important;
                top: 8px !important;
                left: 8px !important;
                background: rgba(255, 255, 255, 0.92) !important;
                border: 1px solid #e2e8f0 !important;
                color: #0b3c5d !important;
                font-size: 9px !important;
                font-weight: 700 !important;
                padding: 2px 7px !important;
                border-radius: 6px !important;
            }

            .product-card .product-info h4 {
                font-size: 12.5px !important;
                line-height: 1.35 !important;
                height: 34px !important;
                color: #102231 !important;
                font-weight: 700 !important;
                margin: 2px 0 4px 0 !important;
                display: -webkit-box !important;
                -webkit-line-clamp: 2 !important;
                -webkit-box-orient: vertical !important;
                overflow: hidden !important;
            }

            .product-card .product-rating {
                font-size: 10.5px !important;
                color: #8092a4 !important;
                margin-bottom: 6px !important;
            }

            .product-card .product-bottom {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                border-top: 1px solid #f8fafc !important;
                padding-top: 6px !important;
            }

            .product-card .product-price {
                font-size: 13.5px !important;
                color: #102231 !important;
                font-weight: 800 !important;
            }

            /* Circular Blue Plus Button (Cavosh Spec) */
            .product-card .add-cart-btn {
                width: 30px !important;
                height: 30px !important;
                border-radius: 50% !important;
                background: #0284c7 !important;
                color: #ffffff !important;
                border: none !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 3px 8px rgba(2, 132, 199, 0.35) !important;
                cursor: pointer !important;
                padding: 0 !important;
                transition: transform 0.2s !important;
            }

            .product-card .add-cart-btn:active {
                transform: scale(0.88) !important;
            }

            .product-card .add-cart-btn svg {
                width: 15px !important;
                height: 15px !important;
            }

            .product-card .add-cart-btn svg.cart-icon-desktop {
                display: none !important;
            }

            .product-card .add-cart-btn svg.plus-icon-mobile {
                display: block !important;
            }

            /* FREQUENTLY ORDERED (HORIZONTAL LIST CARDS) */
            .cavosh-frequently-section {
                display: block !important;
                margin-top: 26px !important;
            }

            .cavosh-section-header {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                margin-bottom: 12px !important;
            }

            .cavosh-section-title {
                font-size: 15px !important;
                font-weight: 800 !important;
                color: #102231 !important;
                margin: 0 !important;
            }

            .cavosh-horizontal-card {
                background: #ffffff !important;
                border: 1px solid #edf2f7 !important;
                border-radius: 16px !important;
                padding: 10px !important;
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
                margin-bottom: 10px !important;
                box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03) !important;
            }

            .cavosh-horiz-img {
                width: 64px !important;
                height: 64px !important;
                background: #f8fafc !important;
                border-radius: 12px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                flex-shrink: 0 !important;
            }

            .cavosh-horiz-img img {
                max-width: 85% !important;
                max-height: 85% !important;
                object-fit: contain !important;
            }

            .cavosh-horiz-content {
                flex-grow: 1 !important;
            }

            .cavosh-horiz-title {
                font-size: 13px !important;
                font-weight: 700 !important;
                color: #102231 !important;
                margin: 0 0 2px 0 !important;
            }

            .cavosh-horiz-sub {
                font-size: 11px !important;
                color: #8092a4 !important;
                margin: 0 0 4px 0 !important;
            }

            .cavosh-horiz-price {
                font-size: 13px !important;
                font-weight: 800 !important;
                color: #0284c7 !important;
            }

            /* CAROUSEL SLIDER HERO OPTIMIZATION FOR SMARTPHONES */
            .carousel {
                height: 380px !important;
                overflow: hidden !important;
                position: relative !important;
                margin-bottom: 10px !important;
            }

            .carousel .list .item:nth-child(2) .introduce {
                width: 88% !important;
                left: 6% !important;
                top: 14px !important;
                transform: none !important;
                position: absolute !important;
                z-index: 15 !important;
            }

            .carousel .list .item .introduce .title {
                font-size: 10px !important;
                letter-spacing: 1.5px !important;
                text-transform: uppercase !important;
                color: #0284c7 !important;
                font-weight: 800 !important;
                margin-bottom: 2px !important;
            }

            .carousel .list .item .introduce .topic {
                font-size: 20px !important;
                line-height: 1.25 !important;
                color: #102231 !important;
                font-weight: 800 !important;
                margin: 2px 0 4px 0 !important;
            }

            .carousel .list .item .introduce .des {
                font-size: 11px !important;
                line-height: 1.4 !important;
                color: #64748b !important;
                display: -webkit-box !important;
                -webkit-line-clamp: 2 !important;
                -webkit-box-orient: vertical !important;
                overflow: hidden !important;
                max-width: 80% !important;
                margin-bottom: 8px !important;
            }

            .carousel .list .item .introduce .seeMore {
                margin-top: 2px !important;
                font-size: 11px !important;
                padding: 5px 12px !important;
                background: #0284c7 !important;
                border: none !important;
                color: #ffffff !important;
                border-radius: 16px !important;
                letter-spacing: 0.5px !important;
                display: inline-block !important;
                box-shadow: 0 3px 8px rgba(2, 132, 199, 0.3) !important;
            }

            .carousel .list .item img {
                width: 68% !important;
                max-height: 180px !important;
                object-fit: contain !important;
                right: 5% !important;
                top: 60% !important;
                transform: translateY(-50%) !important;
                filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.12)) !important;
            }

            .carousel .list .item:nth-child(n+3) {
                display: none !important;
            }

            .carousel .arrows {
                bottom: 12px !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 16px !important;
                left: 0 !important;
                transform: none !important;
                display: flex !important;
                justify-content: space-between !important;
                box-sizing: border-box !important;
                z-index: 20 !important;
                pointer-events: none !important;
            }

            .carousel .arrows #prev,
            .carousel .arrows #next {
                position: relative !important;
                top: auto !important;
                bottom: auto !important;
                left: auto !important;
                right: auto !important;
                margin: 0 !important;
                pointer-events: auto !important;
                width: 36px !important;
                height: 36px !important;
                font-size: 14px !important;
                background: #ffffff !important;
                color: #0b3c5d !important;
                border: 1px solid #cbd5e1 !important;
                border-radius: 50% !important;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
                transition: transform 0.2s !important;
            }

            .carousel .arrows #prev:active,
            .carousel .arrows #next:active {
                transform: scale(0.92) !important;
            }

            .carousel .arrows #back {
                display: none !important;
            }

            /* PDP MOBILE CAVOSH ENHANCEMENTS */
            .pdp-mobile-back-btn {
                position: absolute !important;
                top: 14px !important;
                left: 14px !important;
                width: 36px !important;
                height: 36px !important;
                border-radius: 50% !important;
                background: rgba(255, 255, 255, 0.94) !important;
                color: #102434 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
                z-index: 10 !important;
                text-decoration: none !important;
            }

            .pdp-mobile-wish-btn {
                position: absolute !important;
                top: 14px !important;
                right: 14px !important;
                width: 36px !important;
                height: 36px !important;
                border-radius: 50% !important;
                background: rgba(255, 255, 255, 0.94) !important;
                border: none !important;
                color: #0284c7 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
                z-index: 10 !important;
                cursor: pointer !important;
            }

            .pdp-mobile-wish-btn.liked svg {
                fill: #0284c7 !important;
            }

            .pdp-add-btn {
                background: #0284c7 !important;
                box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35) !important;
                border-radius: 24px !important;
                font-weight: 700 !important;
            }

            .pdp-swatch.active {
                border-color: #0284c7 !important;
            }

            .pdp-size-btn.active {
                background: #0284c7 !important;
                border-color: #0284c7 !important;
                color: #ffffff !important;
            }
        }
    </style>
</head>

<body class="<?= !empty($product) ? 'pdp-page-body' : '' ?>">

    <!-- STICKY SITE HEADER (FULL WIDTH) -->
    <header>
        <div class="header-container">
            <a href="<?= BASEURL ?>" class="logo">
                <?php 
                    $siteLogo = site_setting('app_logo', ''); 
                    if (!empty($siteLogo)): 
                        $logoSrc = (strpos($siteLogo, 'http') === 0) ? $siteLogo : (BASEURL . $siteLogo);
                ?>
                    <img src="<?= htmlspecialchars($logoSrc) ?>" alt="<?= htmlspecialchars(site_setting('app_name', 'LUMINA PEARL')) ?>" style="max-height: 34px; max-width: 140px; object-fit: contain;">
                <?php else: ?>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="logo-svg">
                        <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                        <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
                    </svg>
                <?php endif; ?>
                <span><?= htmlspecialchars(strtoupper(site_setting('app_name', 'LUMINA PEARL'))) ?></span>
            </a>
            <nav>
                <a href="<?= BASEURL ?>">Beranda</a>
                <a href="<?= BASEURL ?>#tentang">Mengapa Kami</a>
                <a href="<?= BASEURL ?>collection">Koleksi</a>
                
                <?php if ($isLoggedIn): ?>
                <a href="javascript:void(0)" class="header-cart" id="headerCartBtn">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span>Keranjang</span>
                    <span class="cart-badge">0</span>
                </a>
                <?php endif; ?>

                <!-- DYNAMIC AUTH NAV -->
                <div class="nav-auth-group">
                    <?php if ($isAdmin): ?>
                        <a href="<?= BASEURL ?>admin" class="nav-btn-seller" style="border-color: #38bdf8; color: #38bdf8 !important; display: inline-flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            Admin
                        </a>
                        <a href="<?= BASEURL ?>admin/logout" class="nav-btn-logout">Keluar</a>
                    <?php elseif ($isLoggedIn && ($authUser['role'] ?? '') === 'seller'): ?>
                        <a href="<?= BASEURL ?>seller" class="nav-btn-seller" style="display: inline-flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Seller Center
                        </a>
                        <a href="<?= BASEURL ?>auth/logout" class="nav-btn-logout">Keluar</a>
                    <?php elseif ($isLoggedIn && ($authUser['role'] ?? '') === 'buyer'): ?>
                        <a href="<?= BASEURL ?>user/orders" class="nav-btn-user" style="display: inline-flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            Pesanan Saya
                        </a>
                        <a href="<?= BASEURL ?>user/profile" class="nav-btn-login" style="padding: 6px 10px;">
                            Profil
                        </a>
                        <a href="<?= BASEURL ?>auth/logout" class="nav-btn-logout">Keluar</a>
                    <?php else: ?>
                        <a href="javascript:void(0)" onclick="openAuthModal('login')" class="nav-btn-login">Masuk</a>
                        <a href="javascript:void(0)" onclick="openAuthModal('register')" class="nav-btn-register">Daftar</a>
                    <?php endif; ?>
                </div>

            </nav>
        </div>
        
        <!-- CAVOSH MOBILE CURVED HEADER (VISIBLE ON SMARTPHONES ONLY) -->
        <?php if (empty($page) || $page !== 'collection'): ?>
        <div class="mobile-cavosh-header">
            <div class="mobile-cavosh-top-row">
                <div class="mobile-cavosh-user-info">
                    <span class="cavosh-greeting">Selamat datang,</span>
                    <h3 class="cavosh-username"><?= $isLoggedIn ? htmlspecialchars($authUser['name'] ?? $authUser['nama'] ?? 'Pelanggan') : 'Tamu Lumina' ?></h3>
                    <div class="cavosh-location">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>Jakarta, Indonesia</span>
                    </div>
                </div>
                <div class="mobile-cavosh-actions">
                    <?php if ($isLoggedIn): ?>
                    <button class="cavosh-action-btn" onclick="openCartDrawer()" title="Keranjang" aria-label="Keranjang">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="cavosh-badge cart-badge">0</span>
                    </button>
                    <?php else: ?>
                    <button class="cavosh-auth-pill" onclick="openAuthModal('login')">
                        Masuk
                    </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cavosh Pill Search Bar with Coral Circular Search Button -->
            <div class="mobile-cavosh-search-box" onclick="window.location.href='<?= BASEURL ?>collection';">
                <div class="cavosh-search-inner">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span>Cari perhiasan mutiara & kerang...</span>
                </div>
                <button class="cavosh-search-circle-btn" type="button" aria-label="Search">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </header>
