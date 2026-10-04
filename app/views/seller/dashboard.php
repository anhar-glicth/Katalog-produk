<!-- SELLER CENTER DASHBOARD -->
<?php 
    $dashAnnouncement = site_setting('dashboard_announcement', '');
    if (!empty($dashAnnouncement)): 
?>
<div class="announcement-banner" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);">
    <div style="display: flex; align-items: center; gap: 10px; font-size: 13.5px; font-weight: 500;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>
        <span><?= htmlspecialchars($dashAnnouncement) ?></span>
    </div>
    <a href="<?= BASEURL ?>seller/settings" style="color: #ffffff; background: rgba(255,255,255,0.2); text-decoration: none; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 700; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
        <span>Edit Teks Ini</span>
    </a>
</div>
<?php endif; ?>

<div class="dashboard-welcome-box" style="margin-bottom: 24px; background: #ffffff; border: 1px solid var(--seller-border); border-radius: 12px; padding: 24px 28px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);">
    <div>
        <div style="display: inline-block; font-size: 11px; font-weight: 700; color: #0284c7; background: #f0f9ff; border: 1px solid #bae6fd; padding: 2px 9px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
            <?= htmlspecialchars(site_setting('dashboard_badge', 'Mitra Penjual Lumina Pearl')) ?>
        </div>
        <h1 style="margin: 0 0 6px 0; font-size: 22px; font-weight: 800; color: #0f172a; letter-spacing: -0.4px;">
            <?= htmlspecialchars(site_setting('dashboard_welcome', 'Selamat Datang')) ?>, <?= htmlspecialchars($user['store_name'] ?? $user['name']) ?>!
        </h1>
        <p style="margin: 0; color: #64748b; font-size: 13.5px; max-width: 600px; line-height: 1.5;">
            <?= htmlspecialchars(site_setting('dashboard_desc', 'Kelola katalog perhiasan mutiara Anda, pantau transaksi masuk secara langsung, dan tingkatkan penjualan toko Anda.')) ?>
        </p>
    </div>
    <div class="dashboard-actions-group">
        <a href="<?= BASEURL ?>seller/settings" class="btn-seller" style="background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd;" title="Ganti Nama, Logo & Teks Website">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 20h9"></path>
                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
            </svg>
            <span>Ubah Teks & Logo Web</span>
        </a>
        <a href="<?= BASEURL ?>seller/productAdd" class="btn-seller btn-primary-seller">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Tambah Produk</span>
        </a>
        <a href="<?= BASEURL ?>seller/settings" class="btn-seller btn-secondary-seller">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
            </svg>
            <span>Profil Toko</span>
        </a>
    </div>
</div>

<!-- STATS CARDS -->
<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));">
    <a href="<?= BASEURL ?>seller/products" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Produk List</div>
        <div class="stat-card-val" style="color: #0f172a;">
            <?= number_format($totalProducts ?? 0, 0, ',', '.') ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Item</span>
        </div>
        <div class="stat-card-icon" style="color: #0284c7;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>seller/categories" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Produk Kategori</div>
        <div class="stat-card-val" style="color: #0f172a;">
            <?= number_format($totalCategories ?? 0, 0, ',', '.') ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Kategori</span>
        </div>
        <div class="stat-card-icon" style="color: #0284c7;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                <line x1="7" y1="7" x2="7.01" y2="7"></line>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>seller/couriers" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Kurir List</div>
        <div class="stat-card-val" style="color: #0f172a;">
            <?= number_format($totalCouriers ?? 0, 0, ',', '.') ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Mitra</span>
        </div>
        <div class="stat-card-icon" style="color: #059669;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>seller/users" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">User Management</div>
        <div class="stat-card-val" style="color: #0f172a;">
            <?= number_format($totalUsers ?? 0, 0, ',', '.') ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Akun</span>
        </div>
        <div class="stat-card-icon" style="color: #6366f1;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>seller/orders" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Total Pesanan</div>
        <div class="stat-card-val" style="color: #0f172a;">
            <?= number_format($stats['total_orders'] ?? 0, 0, ',', '.') ?>
        </div>
        <div class="stat-card-icon" style="color: #d97706;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
        </div>
    </a>

    <div class="stat-card">
        <div class="stat-card-title">Omset Toko</div>
        <div class="stat-card-val" style="color: #059669; font-size: 22px;">
            Rp <?= number_format($stats['revenue'] ?? 0, 0, ',', '.') ?>
        </div>
        <div class="stat-card-icon" style="color: #059669;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"></line>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
            </svg>
        </div>
    </div>
</div>

<!-- RECENT ORDERS SECTION -->
<div class="seller-card">
    <div class="seller-card-header">
        <div>
            <h3>Pesanan Masuk Terbaru</h3>
            <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--seller-text-muted);">
                Pesanan pembeli yang berisi produk dari toko Anda
            </p>
        </div>
        <a href="<?= BASEURL ?>seller/orders" class="btn-seller btn-secondary-seller btn-sm-seller">
            Lihat Semua Pesanan &rarr;
        </a>
    </div>

    <div class="seller-table-wrap">
        <table class="seller-table">
            <thead>
                <tr>
                    <th>Kode Order</th>
                    <th>Pembeli</th>
                    <th>Produk Toko Anda</th>
                    <th>Kurir & Metode</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recentOrders)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--seller-text-muted);">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px; opacity: 0.5;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <div>Belum ada pesanan masuk untuk toko Anda.</div>
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($recentOrders as $ord): 
                        $statusClass = 'badge-pending';
                        if ($ord['status'] === 'Diproses') $statusClass = 'badge-pending';
                        if ($ord['status'] === 'Dikirim') $statusClass = 'badge-shipping';
                        if ($ord['status'] === 'Selesai') $statusClass = 'badge-success';
                        if ($ord['status'] === 'Dibatalkan') $statusClass = 'badge-cancelled';
                    ?>
                    <tr>
                        <td>
                            <strong style="color: var(--seller-accent); font-family: monospace; font-size: 13px;">
                                #<?= htmlspecialchars($ord['order_code']) ?>
                            </strong>
                            <div style="font-size: 11.5px; color: var(--seller-text-muted);">
                                <?= date('d M Y, H:i', strtotime($ord['created_at'])) ?>
                            </div>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($ord['customer_name']) ?></strong>
                            <div style="font-size: 12px; color: var(--seller-text-muted);"><?= htmlspecialchars($ord['customer_phone']) ?></div>
                        </td>
                        <td>
                            <?php if (!empty($ord['seller_items'])): ?>
                                <?php foreach ($ord['seller_items'] as $item): ?>
                                    <div style="font-size: 12.5px; margin-bottom: 3px;">
                                        &bull; <?= htmlspecialchars($item['product_title']) ?> <span style="color: var(--seller-text-muted);">(<?= (int)$item['qty'] ?>x)</span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span style="color: var(--seller-text-muted);">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="font-size: 12.5px;"><?= htmlspecialchars($ord['courier']) ?></div>
                            <div style="font-size: 11.5px; color: var(--seller-text-muted);"><?= htmlspecialchars($ord['payment_method']) ?></div>
                        </td>
                        <td>
                            <span class="status-badge <?= $statusClass ?>">
                                <?= htmlspecialchars($ord['status']) ?>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="<?= BASEURL ?>seller/orderDetail/<?= $ord['id'] ?>" class="btn-seller btn-secondary-seller btn-sm-seller">
                                Rincian & Status
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
