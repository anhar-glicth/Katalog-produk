<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3>Daftar Pesanan Pembeli (<?= count($orders) ?> Transaksi)</h3>
            <p style="color: var(--admin-text-muted); font-size: 13px; margin: 4px 0 0 0;">
                Seluruh pesanan masuk dari keranjang checkout pembeli yang tersimpan di MySQL.
            </p>
        </div>
    </div>

    <?php if (empty($orders)): ?>
    <div style="text-align: center; padding: 48px; color: var(--admin-text-muted);">
        Belum ada transaksi pesanan yang masuk.
    </div>
    <?php else: ?>
    <div style="overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Invoice & Waktu</th>
                    <th>Nama Pemesan</th>
                    <th>Kurir Pengiriman</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Tagihan</th>
                    <th>Status Pesanan</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): 
                    $badgeClass = 'badge-pending';
                    if ($o['status'] === 'Selesai') $badgeClass = 'badge-success';
                    elseif ($o['status'] === 'Dikirim' || $o['status'] === 'Diproses') $badgeClass = 'badge-shipping';
                    elseif ($o['status'] === 'Dibatalkan') $badgeClass = 'badge-cancelled';
                ?>
                <tr>
                    <td>
                        <strong style="color: var(--admin-accent); font-family: monospace; font-size: 13px;">
                            #<?= htmlspecialchars($o['order_code']) ?>
                        </strong>
                        <div style="color: var(--admin-text-muted); font-size: 11px; margin-top: 3px;">
                            <?= date('d M Y, H:i', strtotime($o['created_at'])) ?> WIB
                        </div>
                    </td>
                    <td>
                        <strong style="color: var(--admin-text-main);"><?= htmlspecialchars($o['customer_name']) ?></strong>
                        <div style="color: var(--admin-text-muted); font-size: 12px;"><?= htmlspecialchars($o['customer_phone']) ?></div>
                    </td>
                    <td>
                        <div style="font-weight: 500;"><?= htmlspecialchars($o['courier']) ?></div>
                        <span style="color: var(--admin-text-muted); font-size: 11px;">
                            Ongkir: <?= $o['shipping_fee'] > 0 ? ('Rp ' . number_format($o['shipping_fee'], 0, ',', '.')) : 'Bebas Ongkir' ?>
                        </span>
                    </td>
                    <td>
                        <span style="color: #059669; font-weight: 600;"><?= htmlspecialchars($o['payment_method']) ?></span>
                    </td>
                    <td>
                        <strong style="color: var(--admin-text-main); font-size: 14px;">
                            Rp <?= number_format($o['total_amount'], 0, ',', '.') ?>
                        </strong>
                    </td>
                    <td>
                        <span class="status-badge <?= $badgeClass ?>">
                            <?= htmlspecialchars($o['status']) ?>
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= BASEURL ?>admin/orderDetail/<?= $o['id'] ?>" class="btn-admin btn-secondary-admin" style="padding: 6px 14px; font-size: 12px;">
                            Lihat Rincian &rarr;
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
