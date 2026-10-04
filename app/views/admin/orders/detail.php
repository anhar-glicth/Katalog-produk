<div style="max-width: 860px; margin: 0 auto;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <a href="<?= BASEURL ?>admin/orders" class="btn-admin btn-secondary-admin">
            &larr; Kembali ke Daftar Pesanan
        </a>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 13px; color: var(--admin-text-muted);">Status Saat Ini:</span>
            <?php 
                $badgeClass = 'badge-pending';
                if ($order['status'] === 'Selesai') $badgeClass = 'badge-success';
                elseif ($order['status'] === 'Dikirim' || $order['status'] === 'Diproses') $badgeClass = 'badge-shipping';
                elseif ($order['status'] === 'Dibatalkan') $badgeClass = 'badge-cancelled';
            ?>
            <span class="status-badge <?= $badgeClass ?>" style="font-size: 13px; padding: 6px 14px;">
                <?= htmlspecialchars($order['status']) ?>
            </span>
        </div>
    </div>

    <!-- UPDATE STATUS CARD -->
    <div class="admin-card" style="border-left: 4px solid var(--admin-accent); margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h4 style="margin: 0 0 4px 0; color: #0f172a; font-size: 16px; font-weight: 700;">Ubah Status Pesanan</h4>
                <p style="margin: 0; color: var(--admin-text-muted); font-size: 13px;">
                    Perbarui status proses pengiriman atau pembayaran pesanan ini.
                </p>
            </div>
            <form action="<?= BASEURL ?>admin/orderUpdateStatus/<?= $order['id'] ?>" method="POST" class="order-status-form" style="display: flex; gap: 10px; align-items: center;">
                <select name="status" class="form-control" style="width: auto; padding: 9px 14px; font-size: 13px;">
                    <option value="Menunggu Pembayaran" <?= $order['status'] === 'Menunggu Pembayaran' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                    <option value="Diproses" <?= $order['status'] === 'Diproses' ? 'selected' : '' ?>>Diproses (Packaging)</option>
                    <option value="Dikirim" <?= $order['status'] === 'Dikirim' ? 'selected' : '' ?>>Dikirim (Kurir)</option>
                    <option value="Selesai" <?= $order['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai (Diterima)</option>
                    <option value="Dibatalkan" <?= $order['status'] === 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
                <button type="submit" class="btn-admin btn-primary-admin">
                    Simpan Status
                </button>
            </form>
        </div>
    </div>

    <!-- ORDER SUMMARY CARD -->
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3>Invoice Pesanan: #<?= htmlspecialchars($order['order_code']) ?></h3>
                <span style="color: var(--admin-text-muted); font-size: 12px;">
                    Dibuat pada: <?= date('d F Y, H:i', strtotime($order['created_at'])) ?> WIB
                </span>
            </div>
        </div>

        <!-- Customer & Shipping Info -->
        <div class="order-info-grid" style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 10px; padding: 20px; margin-bottom: 24px; font-size: 13px;">
            <div>
                <span style="color: var(--admin-text-muted); display: block; font-size: 12px; margin-bottom: 4px;">Informasi Penerima</span>
                <strong style="font-size: 15px; color: var(--admin-text-main); display: block; margin-bottom: 4px;"><?= htmlspecialchars($order['customer_name']) ?></strong>
                <div style="color: var(--admin-text-muted);"><?= htmlspecialchars($order['customer_phone']) ?></div>
                <div style="margin-top: 10px; color: #475569; line-height: 1.5;">
                    <?= nl2br(htmlspecialchars($order['customer_address'])) ?>
                </div>
            </div>
            <div>
                <span style="color: var(--admin-text-muted); display: block; font-size: 12px; margin-bottom: 4px;">Metode Pengiriman & Pembayaran</span>
                <div style="margin-bottom: 8px;">
                    <span style="color: var(--admin-text-muted);">Kurir:</span>
                    <strong style="color: var(--admin-text-main);"><?= htmlspecialchars($order['courier']) ?></strong>
                </div>
                <div style="margin-bottom: 8px;">
                    <span style="color: var(--admin-text-muted);">Pembayaran:</span>
                    <strong style="color: #059669;"><?= htmlspecialchars($order['payment_method']) ?></strong>
                </div>
            </div>
        </div>

        <!-- Order Items Table -->
        <h4 style="margin: 0 0 12px 0; font-size: 15px; color: var(--admin-text-main);">Daftar Produk yang Dipesan</h4>
        <div style="overflow-x: auto; margin-bottom: 24px;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Varian & Ukuran</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($order['items'])): ?>
                    <?php foreach ($order['items'] as $item): ?>
                    <tr>
                        <td>
                            <strong style="color: var(--admin-text-main);"><?= htmlspecialchars($item['product_title']) ?></strong>
                        </td>
                        <td>
                            <span style="color: var(--admin-text-muted); font-size: 12px;">
                                <?= htmlspecialchars($item['variant']) ?> &bull; <?= htmlspecialchars($item['size']) ?>
                            </span>
                        </td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td><?= (int)$item['qty'] ?>x</td>
                        <td style="text-align: right; font-weight: 700; color: var(--admin-accent);">
                            Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Breakdown Total -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 10px; padding: 20px; font-size: 14px; max-width: 360px; margin-left: auto;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: var(--admin-text-muted);">
                <span>Subtotal Produk:</span>
                <span style="color: var(--admin-text-main); font-weight: 600;">Rp <?= number_format($order['subtotal'], 0, ',', '.') ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: var(--admin-text-muted);">
                <span>Biaya Pengiriman:</span>
                <span><?= $order['shipping_fee'] > 0 ? ('Rp ' . number_format($order['shipping_fee'], 0, ',', '.')) : '<span style="color: #059669; font-weight: 600;">Gratis</span>' ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; color: var(--admin-text-muted);">
                <span>Biaya Layanan Admin:</span>
                <span>Rp <?= number_format($order['admin_fee'], 0, ',', '.') ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 10px; border-top: 1px solid var(--admin-border); font-size: 16px; font-weight: 700; color: var(--admin-accent);">
                <span>Total Tagihan:</span>
                <span>Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></span>
            </div>
        </div>

    </div>

</div>
