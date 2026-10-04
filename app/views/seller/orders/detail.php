<div style="max-width: 900px; margin: 0 auto;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <a href="<?= BASEURL ?>seller/orders" class="btn-seller btn-secondary-seller">
            &larr; Kembali ke Pesanan Toko
        </a>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 13px; color: var(--seller-text-muted);">Status Saat Ini:</span>
            <?php 
                $badgeClass = 'badge-pending';
                if ($order['status'] === 'Selesai') $badgeClass = 'badge-success';
                elseif ($order['status'] === 'Dikirim') $badgeClass = 'badge-shipping';
                elseif ($order['status'] === 'Diproses') $badgeClass = 'badge-success';
                elseif ($order['status'] === 'Menunggu Konfirmasi Penjual') $badgeClass = 'badge-pending';
                elseif ($order['status'] === 'Dibatalkan') $badgeClass = 'badge-cancelled';
            ?>
            <span class="status-badge <?= $badgeClass ?>" style="font-size: 13px; padding: 6px 14px;">
                <?= htmlspecialchars($order['status']) ?>
            </span>
        </div>
    </div>

    <!-- BUKTI TRANSFER & ACC PEMBAYARAN CARD -->
    <div class="seller-card" style="border-left: 4px solid #10b981; margin-bottom: 24px; background: #ffffff;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
            <div style="flex: 1; min-width: 280px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    <h4 style="margin: 0; color: #0f172a; font-size: 16px; font-weight: 800;">Bukti Transfer Pembayaran Pembeli</h4>
                </div>
                <p style="margin: 0 0 14px 0; color: var(--seller-text-muted); font-size: 13px;">
                    Periksa struk atau screenshot mutasi transfer bank dari pembeli sebelum meng-ACC dan menyiapkan pesanan.
                </p>

                <?php if (!empty($order['payment_proof'])): ?>
                    <div style="display: flex; gap: 16px; align-items: center; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 14px;">
                        <a href="<?= BASEURL . htmlspecialchars($order['payment_proof']) ?>" target="_blank" title="Klik untuk memperbesar bukti transfer">
                            <img src="<?= BASEURL . htmlspecialchars($order['payment_proof']) ?>" alt="Bukti Transfer" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #10b981; box-shadow: 0 2px 6px rgba(0,0,0,0.1); cursor: pointer;">
                        </a>
                        <div>
                            <div style="font-weight: 700; color: #166534; font-size: 13.5px; margin-bottom: 4px; display: flex; align-items: center; gap: 5px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                Bukti Transfer Terlampir
                            </div>
                            <div style="font-size: 12px; color: #15803d; margin-bottom: 6px;">
                                Diunggah: <?= !empty($order['payment_proof_time']) ? date('d M Y, H:i', strtotime($order['payment_proof_time'])) . ' WIB' : 'Baru saja' ?>
                            </div>
                            <a href="<?= BASEURL . htmlspecialchars($order['payment_proof']) ?>" target="_blank" style="font-size: 12.5px; color: #0284c7; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                Lihat Gambar Ukuran Penuh &rarr;
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px; padding: 16px; display: flex; align-items: center; gap: 10px; color: #64748b; font-size: 13px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <span>Pembeli belum mengunggah foto bukti transfer untuk pesanan ini.</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- TOMBOL ACC PEMBAYARAN -->
            <div class="order-acc-box" style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px;">
                <?php if (in_array($order['status'], ['Menunggu Pembayaran', 'Menunggu Konfirmasi Penjual'])): ?>
                    <form action="<?= BASEURL ?>seller/orderApprovePayment/<?= $order['id'] ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin dana pembayaran telah masuk dan ingin meng-ACC pesanan ini? Status pesanan akan otomatis berubah menjadi Diproses (Siap Diantar).');">
                        <button type="submit" class="btn-seller" style="background: #10b981; color: #ffffff; padding: 12px 22px; font-size: 14px; font-weight: 800; border-radius: 8px; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35); border: none; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>ACC Pembayaran (Siap Diantar)</span>
                        </button>
                    </form>
                    <span style="font-size: 11.5px; color: var(--seller-text-muted);">Klik setelah mengecek saldo di rekening bank Anda.</span>
                <?php else: ?>
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Pembayaran Telah Di-ACC & Siap Diantar</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- UPDATE STATUS CARD -->
    <div class="seller-card" style="border-left: 4px solid var(--seller-accent); margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h4 style="margin: 0 0 4px 0; color: #0f172a; font-size: 16px; font-weight: 700;">Perbarui Status Pesanan</h4>
                <p style="margin: 0; color: var(--seller-text-muted); font-size: 13px;">
                    Ubah status saat pesanan mulai disiapkan atau diserahkan ke jasa kurir pengiriman.
                </p>
            </div>
            <form action="<?= BASEURL ?>seller/orderUpdateStatus/<?= $order['id'] ?>" method="POST" class="order-status-form" style="display: flex; gap: 10px; align-items: center;">
                <select name="status" class="form-control" style="width: auto; padding: 9px 14px; font-size: 13px;">
                    <option value="Menunggu Pembayaran" <?= $order['status'] === 'Menunggu Pembayaran' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                    <option value="Menunggu Konfirmasi Penjual" <?= $order['status'] === 'Menunggu Konfirmasi Penjual' ? 'selected' : '' ?>>Menunggu Konfirmasi Penjual</option>
                    <option value="Diproses" <?= $order['status'] === 'Diproses' ? 'selected' : '' ?>>Diproses (Sedang Disiapkan & Siap Diantar)</option>
                    <option value="Dikirim" <?= $order['status'] === 'Dikirim' ? 'selected' : '' ?>>Dikirim (Kurir)</option>
                    <option value="Selesai" <?= $order['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai (Diterima)</option>
                    <option value="Dibatalkan" <?= $order['status'] === 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
                <button type="submit" class="btn-seller btn-primary-seller">
                    Update Status
                </button>
            </form>
        </div>
    </div>

    <!-- ORDER SUMMARY CARD -->
    <div class="seller-card">
        <div class="seller-card-header">
            <div>
                <h3>Invoice Pesanan: #<?= htmlspecialchars($order['order_code']) ?></h3>
                <span style="color: var(--seller-text-muted); font-size: 12.5px;">
                    Tanggal Pemesanan: <?= date('d F Y, H:i', strtotime($order['created_at'])) ?> WIB
                </span>
            </div>
        </div>

        <!-- Customer & Shipping Info -->
        <div class="order-info-grid" style="background: #f8fafc; border: 1px solid var(--seller-border); border-radius: 10px; padding: 20px; margin-bottom: 24px; font-size: 13.5px;">
            <div>
                <span style="color: var(--seller-text-muted); display: block; font-size: 12px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px;">Informasi Pembeli & Tujuan</span>
                <strong style="font-size: 15px; color: #0f172a; display: block; margin-bottom: 4px;"><?= htmlspecialchars($order['customer_name']) ?></strong>
                <div style="color: var(--seller-text-muted);"><?= htmlspecialchars($order['customer_phone']) ?></div>
                <div style="margin-top: 10px; color: #475569; line-height: 1.5;">
                    <?= nl2br(htmlspecialchars($order['customer_address'])) ?>
                </div>
            </div>
            <div>
                <span style="color: var(--seller-text-muted); display: block; font-size: 12px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px;">Pengiriman & Pembayaran</span>
                <div style="margin-bottom: 8px;">
                    <span style="color: var(--seller-text-muted);">Jasa Ekspedisi:</span>
                    <strong style="color: #0f172a;"><?= htmlspecialchars($order['courier']) ?></strong>
                </div>
                <div style="margin-bottom: 8px;">
                    <span style="color: var(--seller-text-muted);">Metode Bayar:</span>
                    <strong style="color: #059669;"><?= htmlspecialchars($order['payment_method']) ?></strong>
                </div>
                <div>
                    <span style="color: var(--seller-text-muted);">Toko Anda:</span>
                    <strong style="color: var(--seller-accent);"><?= htmlspecialchars($user['store_name'] ?? 'Toko Saya') ?></strong>
                </div>
            </div>
        </div>

        <!-- Order Items Table -->
        <h4 style="margin: 0 0 14px 0; font-size: 15px; color: #0f172a; font-weight: 700;">Produk Toko Anda dalam Pesanan Ini</h4>
        <div class="seller-table-wrap" style="margin-bottom: 24px;">
            <table class="seller-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Varian & Ukuran</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sellerSubtotal = 0;
                    if (!empty($sellerItems)): 
                    ?>
                    <?php foreach ($sellerItems as $item): 
                        $sub = $item['price'] * $item['qty'];
                        $sellerSubtotal += $sub;
                    ?>
                    <tr>
                        <td>
                            <strong style="color: #0f172a;"><?= htmlspecialchars($item['product_title']) ?></strong>
                        </td>
                        <td>
                            <span style="color: var(--seller-text-muted); font-size: 12.5px;">
                                <?= htmlspecialchars($item['variant']) ?> &bull; <?= htmlspecialchars($item['size']) ?>
                            </span>
                        </td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td><?= (int)$item['qty'] ?>x</td>
                        <td style="text-align: right; font-weight: 700; color: var(--seller-accent);">
                            Rp <?= number_format($sub, 0, ',', '.') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Breakdown Total Toko -->
        <div class="order-total-card" style="background: #f8fafc; border: 1px solid var(--seller-border); border-radius: 10px; padding: 20px; font-size: 14px; max-width: 380px; margin-left: auto;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: var(--seller-text-muted);">
                <span>Subtotal Produk Toko:</span>
                <strong style="color: #0f172a;">Rp <?= number_format($sellerSubtotal, 0, ',', '.') ?></strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: var(--seller-text-muted); font-size: 12.5px;">
                <span>Total Seluruh Invoice Pembeli:</span>
                <span style="color: #475569;">Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 10px; border-top: 1px solid var(--seller-border); font-size: 16px; font-weight: 700; color: var(--seller-accent);">
                <span>Pendapatan Toko Anda:</span>
                <span>Rp <?= number_format($sellerSubtotal, 0, ',', '.') ?></span>
            </div>
        </div>

    </div>

</div>
