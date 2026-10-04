<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Admin Panel | Lumina Pearl') ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #f8fafc;
            --admin-sidebar-bg: #ffffff;
            --admin-card-bg: #ffffff;
            --admin-border: #e2e8f0;
            --admin-accent: #0284c7;
            --admin-text-main: #0f172a;
            --admin-text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body.admin-body {
            background: var(--admin-bg);
            color: var(--admin-text-main);
            margin: 0;
            display: flex;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* SIDEBAR */
        .admin-sidebar {
            width: 250px;
            background: var(--admin-sidebar-bg);
            border-right: 1px solid var(--admin-border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.02);
            z-index: 50;
        }
        .admin-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            text-decoration: none;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--admin-border);
        }
        .admin-brand svg {
            stroke: var(--admin-accent);
        }
        .admin-menu {
            list-style: none;
            padding: 18px 12px;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
        }
        .admin-menu li {
            margin-bottom: 6px;
        }
        .admin-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: #475569;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .admin-menu a:hover {
            color: #0f172a;
            background: #f1f5f9;
            transform: translateX(2px);
        }
        .admin-menu a.active {
            color: var(--admin-accent);
            background: rgba(2, 132, 199, 0.08);
            font-weight: 700;
            border-left: 3px solid var(--admin-accent);
            border-top-left-radius: 2px;
            border-bottom-left-radius: 2px;
        }
        .admin-menu a svg {
            stroke: currentColor;
            flex-shrink: 0;
        }
        .admin-sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--admin-border);
            font-size: 13px;
            background: #ffffff;
        }
        .admin-user-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--admin-text-main);
            margin-bottom: 12px;
        }
        .admin-avatar {
            width: 34px;
            height: 34px;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--admin-accent);
            font-size: 13px;
        }
        .logout-link {
            color: #ef4444;
            text-decoration: none;
            font-size: 12.5px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .logout-link:hover {
            color: #b91c1c;
            text-decoration: underline;
        }

        /* MAIN CONTENT AREA */
        .admin-main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow-y: auto;
            background: var(--admin-bg);
        }
        .admin-topbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--admin-border);
            padding: 16px 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        .admin-topbar h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.3px;
        }
        .admin-content {
            padding: 32px 36px;
            flex-grow: 1;
        }

        /* FLASH ALERTS */
        .flash-alert {
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .flash-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        .flash-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* STATS CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 22px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }
        .stat-card-title {
            color: var(--admin-text-muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 8px;
        }
        .stat-card-val {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
        }
        .stat-card-icon {
            position: absolute;
            right: 18px;
            top: 18px;
            color: var(--admin-accent);
            opacity: 0.85;
        }

        /* TABLES & CARDS */
        .admin-card, .seller-card {
            background: #ffffff;
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 28px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03), 0 1px 2px rgba(0, 0, 0, 0.02);
        }
        .admin-card-header, .seller-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .admin-card-header h3, .seller-card-header h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
        }
        .admin-table-wrap, .seller-table-wrap {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid var(--admin-border);
            background: #ffffff;
        }
        .admin-table, .seller-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
            text-align: left;
        }
        .admin-table th, .seller-table th {
            padding: 12px 16px;
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1px solid var(--admin-border);
        }
        .admin-table td, .seller-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            vertical-align: middle;
            background: #ffffff;
        }
        .admin-table tr:hover td, .seller-table tr:hover td {
            background: #f8fafc;
        }

        /* BUTTONS */
        .btn-admin, .btn-seller {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: inherit;
            line-height: 1.4;
            box-sizing: border-box;
        }
        .btn-sm-admin, .btn-sm-seller {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
        }
        .btn-primary-admin, .btn-primary-seller {
            background: #0284c7;
            color: #ffffff !important;
            border-color: #0284c7;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);
        }
        .btn-primary-admin:hover, .btn-primary-seller:hover {
            background: #0369a1;
            border-color: #0369a1;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.35);
        }
        .btn-secondary-admin, .btn-secondary-seller {
            background: #ffffff;
            color: #334155 !important;
            border: 1px solid #cbd5e1;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }
        .btn-secondary-admin:hover, .btn-secondary-seller:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a !important;
        }
        .btn-danger-admin, .btn-danger-seller {
            background: #fef2f2;
            color: #dc2626 !important;
            border: 1px solid #fecaca;
        }
        .btn-danger-admin:hover, .btn-danger-seller:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff !important;
        }

        /* FORMS & INPUTS */
        .form-control, .form-input-white, .form-input-dark, .form-select {
            width: 100%;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #0f172a;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13.5px;
            box-sizing: border-box;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
            outline: none;
        }
        .form-control:focus, .form-input-white:focus, .form-input-dark:focus, .form-select:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
            background: #ffffff;
        }
        .form-control::placeholder, .form-input-white::placeholder {
            color: #94a3b8;
        }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-hint {
            font-size: 12px;
            color: #64748b;
            margin-top: 5px;
            line-height: 1.4;
        }

        /* BADGES */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            text-decoration: none;
        }
        .badge-active {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .badge-inactive {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .badge-pending {
            background: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        .badge-success {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .badge-shipping {
            background: #f0f9ff;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }
        .badge-cancelled {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-active {
            background: #16a34a;
            box-shadow: 0 0 0 2px rgba(22, 163, 74, 0.2);
        }
        .dot-inactive {
            background: #dc2626;
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2);
        }

        /* SECTION STEP BADGE & CATEGORY ICON BOX */
        .section-step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #e0f2fe;
            color: #0284c7;
            font-size: 12px;
            font-weight: 800;
        }
        .cat-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1px solid #bae6fd;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #0284c7;
            box-shadow: 0 1px 3px rgba(2, 132, 199, 0.1);
        }

        /* MODAL STYLES */
        .custom-modal-backdrop {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }
        .custom-modal-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            width: 92%;
            max-width: 520px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        .custom-modal-box form {
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        .custom-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
        }
        .custom-modal-header h4 {
            margin: 0;
            font-size: 17px;
            color: #0f172a;
            font-weight: 700;
        }
        .close-modal-btn {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 22px;
            cursor: pointer;
            line-height: 1;
            padding: 4px;
            border-radius: 6px;
            transition: color 0.2s, background-color 0.2s;
        }
        .close-modal-btn:hover {
            color: #0f172a;
            background: #f1f5f9;
        }
        .custom-modal-body {
            padding: 22px;
            background: #ffffff;
        }
        .custom-modal-footer {
            padding: 16px 22px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            background: #f8fafc;
        }

        /* FORM GRID UTILITIES */
        .settings-logo-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 20px;
        }
        .settings-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media screen and (max-width: 768px) {
            body.admin-body {
                flex-direction: column;
            }
            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--admin-border);
            }
            .admin-menu {
                display: flex;
                overflow-x: auto;
                padding: 10px 14px;
                gap: 8px;
                white-space: nowrap;
            }
            .admin-menu li {
                margin-bottom: 0;
            }
            .admin-menu a {
                padding: 8px 12px;
                font-size: 12.5px;
            }
            .admin-topbar {
                padding: 12px 16px;
                flex-wrap: wrap;
                gap: 10px;
            }
            .admin-content {
                padding: 16px;
            }
            .admin-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .admin-card-header .btn-admin {
                width: 100%;
                justify-content: center;
                text-align: center;
            }
            .settings-logo-grid,
            .settings-grid-2,
            .order-info-grid {
                grid-template-columns: 1fr !important;
                gap: 14px !important;
            }
            .order-status-form {
                flex-direction: column !important;
                align-items: stretch !important;
                width: 100% !important;
            }
            .order-status-form select,
            .order-status-form button {
                width: 100% !important;
            }
            .settings-actions-bar {
                flex-direction: column-reverse !important;
            }
            .settings-actions-bar .btn-admin {
                width: 100% !important;
                text-align: center !important;
                justify-content: center !important;
            }
        }
    </style>
</head>
<body class="admin-body">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <a href="<?= BASEURL ?>admin" class="admin-brand">
            <?php 
                $siteLogo = site_setting('app_logo', ''); 
                if (!empty($siteLogo)): 
                    $logoSrc = (strpos($siteLogo, 'http') === 0) ? $siteLogo : (BASEURL . $siteLogo);
            ?>
                <img src="<?= htmlspecialchars($logoSrc) ?>" alt="Logo" style="max-height: 24px; max-width: 24px; object-fit: contain;">
            <?php else: ?>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                    <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
                </svg>
            <?php endif; ?>
            <span><?= htmlspecialchars(strtoupper(site_setting('app_name', 'LUMINA ADMIN'))) ?></span>
        </a>

        <ul class="admin-menu">
            <li>
                <a href="<?= BASEURL ?>admin" class="<?= ($page ?? '') === 'dashboard' ? 'active' : '' ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL ?>admin/products" class="<?= ($page ?? '') === 'products' ? 'active' : '' ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span>Produk List</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL ?>admin/categories" class="<?= ($page ?? '') === 'categories' ? 'active' : '' ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                    <span>Produk Kategori</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL ?>admin/couriers" class="<?= ($page ?? '') === 'couriers' ? 'active' : '' ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <span>Kurir List</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL ?>admin/users" class="<?= ($page ?? '') === 'users' ? 'active' : '' ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>User Management</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL ?>admin/orders" class="<?= ($page ?? '') === 'orders' ? 'active' : '' ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span>Kelola Pesanan</span>
                </a>
            </li>
            <li>
                <a href="<?= BASEURL ?>admin/settings" class="<?= ($page ?? '') === 'settings' ? 'active' : '' ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    <span>Pengaturan Web & Logo</span>
                </a>
            </li>
            <li style="margin-top: 14px; border-top: 1px solid var(--admin-border); padding-top: 12px;">
                <a href="<?= BASEURL ?>" target="_blank">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                    <span>Lihat Toko Publik &#8599;</span>
                </a>
            </li>
        </ul>

        <div class="admin-sidebar-footer">
            <div class="admin-user-pill">
                <div class="admin-avatar">
                    <?= strtoupper(substr($admin['name'] ?? 'A', 0, 1)) ?>
                </div>
                <div>
                    <strong style="display: block; font-size: 13px; color: #0f172a;"><?= htmlspecialchars($admin['name'] ?? 'Admin') ?></strong>
                    <span style="color: var(--admin-text-muted); font-size: 11px;">@<?= htmlspecialchars($admin['username'] ?? 'admin') ?></span>
                </div>
            </div>
            <a href="<?= BASEURL ?>admin/logout" class="logout-link">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Keluar (Logout)</span>
            </a>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="admin-main">
        <header class="admin-topbar">
            <h2><?= htmlspecialchars($title ?? 'Panel Admin') ?></h2>
            <div style="display: flex; gap: 10px;">
                <a href="<?= BASEURL ?>admin/productAdd" class="btn-admin btn-primary-admin">
                    <span>&plus;</span> Tambah Produk
                </a>
            </div>
        </header>

        <main class="admin-content">
            <?php if (!empty($_SESSION['flash_message'])): ?>
            <div class="flash-alert flash-success">
                <span>&#10004;</span>
                <span><?= htmlspecialchars($_SESSION['flash_message']) ?></span>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="flash-alert flash-error">
                <span>&#9888;</span>
                <span><?= htmlspecialchars($_SESSION['flash_error']) ?></span>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
            <?php endif; ?>
