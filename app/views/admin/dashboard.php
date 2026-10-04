<!-- METRIC STATS CARDS -->
<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));">
    <a href="<?= BASEURL ?>admin/products" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Produk List</div>
        <div class="stat-card-val" style="color: #0f172a;"><?= (int)($totalProducts ?? 0) ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Item</span></div>
        <div class="stat-card-icon" style="color: #0284c7;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>admin/categories" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Produk Kategori</div>
        <div class="stat-card-val" style="color: #0f172a;"><?= (int)($totalCategories ?? 0) ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Kategori</span></div>
        <div class="stat-card-icon" style="color: #0284c7;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                <line x1="7" y1="7" x2="7.01" y2="7"></line>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>admin/couriers" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Kurir List</div>
        <div class="stat-card-val" style="color: #0f172a;"><?= (int)($totalCouriers ?? 0) ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Mitra</span></div>
        <div class="stat-card-icon" style="color: #059669;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>admin/users" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">User Management</div>
        <div class="stat-card-val" style="color: #0f172a;"><?= (int)($totalUsers ?? 0) ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">Akun</span></div>
        <div class="stat-card-icon" style="color: #6366f1;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
    </a>

    <a href="<?= BASEURL ?>admin/orders" class="stat-card" style="text-decoration: none; display: block;">
        <div class="stat-card-title">Total Pesanan</div>
        <div class="stat-card-val" style="color: #0f172a;"><?= (int)($totalOrders ?? 0) ?></div>
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
        <div class="stat-card-title">Total Pendapatan</div>
        <div class="stat-card-val" style="color: #059669; font-size: 22px;">Rp <?= number_format($totalRevenue ?? 0, 0, ',', '.') ?></div>
        <div class="stat-card-icon" style="color: #059669;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"></line>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
            </svg>
        </div>
    </div>
</div>

<!-- RECENT ORDERS TABLE -->
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3>Pesanan Terbaru Masuk</h3>
            <p style="margin: 4px 0 0 0; font-size: 13px; color: var(--admin-text-muted);">
                Pantau pesanan pelanggan yang masuk dari seluruh toko mitra.
            </p>
        </div>
        <a href="<?= BASEURL ?>admin/orders" class="btn-admin btn-secondary-admin">Lihat Semua Pesanan &rarr;</a>
    </div>

    <?php if (empty($recentOrders)): ?>
    <div style="text-align: center; padding: 40px; color: var(--admin-text-muted);">
        Belum ada pesanan masuk saat ini.
    </div>
    <?php else: ?>
    <div style="overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th>Kurir & Metode</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentOrders as $order): 
                    $badgeClass = 'badge-pending';
                    if ($order['status'] === 'Selesai') $badgeClass = 'badge-success';
                    elseif ($order['status'] === 'Dikirim' || $order['status'] === 'Diproses') $badgeClass = 'badge-shipping';
                    elseif ($order['status'] === 'Dibatalkan') $badgeClass = 'badge-cancelled';
                ?>
                <tr>
                    <td>
                        <strong style="color: var(--admin-accent); font-family: monospace; font-size: 13px;">
                            #<?= htmlspecialchars($order['order_code']) ?>
                        </strong>
                        <div style="color: var(--admin-text-muted); font-size: 11px; margin-top: 2px;">
                            <?= date('d M Y H:i', strtotime($order['created_at'])) ?>
                        </div>
                    </td>
                    <td>
                        <strong style="color: #0f172a;"><?= htmlspecialchars($order['customer_name']) ?></strong>
                        <div style="color: var(--admin-text-muted); font-size: 12px;"><?= htmlspecialchars($order['customer_phone']) ?></div>
                    </td>
                    <td>
                        <div style="font-weight: 500;"><?= htmlspecialchars($order['courier']) ?></div>
                        <span style="color: #059669; font-size: 12px; font-weight: 600;"><?= htmlspecialchars($order['payment_method']) ?></span>
                    </td>
                    <td>
                        <strong style="color: #0f172a;">Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></strong>
                    </td>
                    <td>
                        <span class="status-badge <?= $badgeClass ?>">
                            <?= htmlspecialchars($order['status']) ?>
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= BASEURL ?>admin/orderDetail/<?= $order['id'] ?>" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;">
                            Detail &rarr;
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
