<div class="seller-card">
    <div class="seller-card-header">
        <div>
            <h3>Pesanan Masuk Toko (<?= count($orders) ?> Transaksi)</h3>
            <p style="color: var(--seller-text-muted); font-size: 13.5px; margin: 4px 0 0 0;">
                Daftar pesanan pembeli yang memuat produk dari toko <strong><?= htmlspecialchars($user['store_name'] ?? 'Toko Anda') ?></strong>.
            </p>
        </div>
    </div>

    <?php if (empty($orders)): ?>
    <div style="text-align: center; padding: 50px 20px; color: var(--seller-text-muted);">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 12px; opacity: 0.5;">
            <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
            <line x1="12" y1="22.08" x2="12" y2="12"></line>
        </svg>
        <div style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Belum Ada Pesanan Masuk</div>
        <p style="margin: 0; font-size: 13px;">Ketika pelanggan melakukan pembelian atas produk toko Anda, rincian pesanannya akan muncul di sini secara otomatis.</p>
    </div>
    <?php else: ?>
    <div class="seller-table-wrap">
        <table class="seller-table">
            <thead>
                <tr>
                    <th>Invoice & Waktu</th>
                    <th>Nama Pembeli</th>
                    <th>Produk Toko Anda</th>
                    <th>Kurir & Pembayaran</th>
                    <th>Status Pesanan</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): 
                    $badgeClass = 'badge-pending';
                    if ($o['status'] === 'Selesai') $badgeClass = 'badge-success';
                    elseif ($o['status'] === 'Dikirim') $badgeClass = 'badge-shipping';
                    elseif ($o['status'] === 'Diproses') $badgeClass = 'badge-success';
                    elseif ($o['status'] === 'Menunggu Konfirmasi Penjual') $badgeClass = 'badge-pending';
                    elseif ($o['status'] === 'Dibatalkan') $badgeClass = 'badge-cancelled';
                ?>
                <tr>
                    <td>
                        <strong style="color: var(--seller-accent); font-family: monospace; font-size: 13.5px;">
                            #<?= htmlspecialchars($o['order_code']) ?>
                        </strong>
                        <div style="color: var(--seller-text-muted); font-size: 11.5px; margin-top: 3px;">
                            <?= date('d M Y, H:i', strtotime($o['created_at'])) ?> WIB
                        </div>
                    </td>
                    <td>
                        <strong style="color: #0f172a;"><?= htmlspecialchars($o['customer_name']) ?></strong>
                        <div style="color: var(--seller-text-muted); font-size: 12px;"><?= htmlspecialchars($o['customer_phone']) ?></div>
                    </td>
                    <td>
                        <?php if (!empty($o['seller_items'])): ?>
                            <?php foreach ($o['seller_items'] as $item): ?>
                                <div style="font-size: 12.5px; margin-bottom: 4px;">
                                    &bull; <strong><?= htmlspecialchars($item['product_title']) ?></strong>
                                    <span style="color: var(--seller-text-muted);">
                                        (<?= (int)$item['qty'] ?>x @ Rp <?= number_format($item['price'], 0, ',', '.') ?>)
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span style="color: var(--seller-text-muted);">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="font-weight: 500; font-size: 13px; color: #1e293b;"><?= htmlspecialchars($o['courier']) ?></div>
                        <div style="color: #059669; font-size: 12px; font-weight: 600;"><?= htmlspecialchars($o['payment_method']) ?></div>
                    </td>
                    <td>
                        <span class="status-badge <?= $badgeClass ?>">
                            <?= htmlspecialchars($o['status']) ?>
                        </span>
                        <?php if (!empty($o['payment_proof'])): ?>
                            <div style="margin-top: 5px;">
                                <span style="font-size: 11px; font-weight: 700; color: #166534; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 2px 7px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                    Bukti Transfer
                                </span>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= BASEURL ?>seller/orderDetail/<?= $o['id'] ?>" class="btn-seller btn-secondary-seller btn-sm-seller">
                            Proses & Rincian &rarr;
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
