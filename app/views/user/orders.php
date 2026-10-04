<div class="container" style="padding: 40px 20px 80px 20px; max-width: 960px; margin: 0 auto; min-height: 75vh;">

    <!-- HEADER / USER GREETING & TABS -->
    <div style="margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
        <div>
            <div style="font-size: 12px; font-weight: 700; color: #0284c7; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px;">
                Akun Pembeli Lumina
            </div>
            <h1 style="margin: 0 0 6px 0; font-size: 26px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px;">
                Pesanan Saya
            </h1>
            <p style="margin: 0; color: #64748b; font-size: 14px;">
                Pantau proses transaksi, pengiriman kurir, dan riwayat belanja perhiasan Anda.
            </p>
        </div>

        <!-- TABS -->
        <div style="display: flex; gap: 8px; background: #ffffff; padding: 5px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
            <a href="<?= BASEURL ?>user/orders" style="padding: 8px 16px; border-radius: 8px; font-size: 13.5px; font-weight: 700; text-decoration: none; background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd;">
                Pesanan Saya (<?= count($orders) ?>)
            </a>
            <a href="<?= BASEURL ?>user/profile" style="padding: 8px 16px; border-radius: 8px; font-size: 13.5px; font-weight: 600; text-decoration: none; color: #64748b; transition: all 0.2s;">
                Profil & Alamat
            </a>
        </div>
    </div>

    <!-- FLASH MESSAGES -->
    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div style="padding: 14px 18px; border-radius: 10px; font-size: 14px; margin-bottom: 24px; background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; display: flex; align-items: center; gap: 10px;">
        <span>&#10004;</span>
        <span><?= htmlspecialchars($_SESSION['flash_message']) ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <!-- ORDERS LIST -->
    <?php if (empty($orders)): ?>
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 60px 24px; text-align: center; color: #64748b; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
        <div style="width: 64px; height: 64px; border-radius: 50%; background: #f0f9ff; border: 1px solid #bae6fd; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto; color: #0284c7;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
        </div>
        <h3 style="color: #0f172a; font-size: 18px; margin: 0 0 8px 0; font-weight: 700;">Belum Ada Riwayat Pesanan</h3>
        <p style="margin: 0 0 24px 0; font-size: 14px; max-width: 440px; margin-left: auto; margin-right: auto; line-height: 1.5;">
            Anda belum pernah memesan produk di Lumina Pearl. Temukan kilau mutiara alami impian Anda sekarang.
        </p>
        <a href="<?= BASEURL ?>collection" style="display: inline-flex; align-items: center; gap: 8px; background: #0284c7; color: #ffffff; text-decoration: none; padding: 12px 28px; font-weight: 700; border-radius: 8px; font-size: 14px; box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);">
            Mulai Belanja &rarr;
        </a>
    </div>
    <?php else: ?>
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <?php foreach ($orders as $ord): 
            $badgeClass = 'background: #fffbeb; color: #b45309; border: 1px solid #fde68a;';
            if ($ord['status'] === 'Selesai') {
                $badgeClass = 'background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;';
            } elseif ($ord['status'] === 'Dikirim') {
                $badgeClass = 'background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd;';
            } elseif ($ord['status'] === 'Dibatalkan') {
                $badgeClass = 'background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca;';
            }
        ?>
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
            
            <!-- ORDER TOP INFO -->
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 16px; margin-bottom: 18px; flex-wrap: wrap; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                    <div style="font-family: monospace; font-size: 15px; font-weight: 700; color: #0284c7;">
                        #<?= htmlspecialchars($ord['order_code']) ?>
                    </div>
                    <div style="color: #64748b; font-size: 12.5px;">
                        <?= date('d M Y, H:i', strtotime($ord['created_at'])) ?> WIB
                    </div>
                    <div style="font-size: 12.5px; color: #475569; background: #f8fafc; padding: 3px 10px; border-radius: 6px; border: 1px solid #e2e8f0;">
                        Kurir: <?= htmlspecialchars($ord['courier']) ?>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 20px; <?= $badgeClass ?>">
                        <?= htmlspecialchars($ord['status']) ?>
                    </span>
                    <a href="<?= BASEURL ?>order/success/<?= $ord['order_code'] ?>" target="_blank" style="color: #0284c7; font-size: 13px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                        Lihat Invoice &#8599;
                    </a>
                </div>
            </div>

            <!-- ORDER ITEMS LIST -->
            <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 18px;">
                <?php if (!empty($ord['items'])): ?>
                    <?php foreach ($ord['items'] as $it): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 12px 18px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <div>
                            <strong style="color: #0f172a; font-size: 14px; display: block; margin-bottom: 3px;">
                                <?= htmlspecialchars($it['product_title']) ?>
                            </strong>
                            <div style="font-size: 12px; color: #64748b;">
                                Varian: <?= htmlspecialchars($it['variant']) ?> &bull; Ukuran: <?= htmlspecialchars($it['size']) ?> &bull; <?= (int)$it['qty'] ?> barang
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-weight: 700; color: #0f172a; font-size: 14px;">
                                Rp <?= number_format($it['price'] * $it['qty'], 0, ',', '.') ?>
                            </div>
                            <span style="font-size: 11px; color: #64748b;">@ Rp <?= number_format($it['price'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- FOOTER TOTAL & RECIPIENT -->
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; padding-top: 14px; border-top: 1px solid #f1f5f9; font-size: 13px;">
                <div style="color: #64748b;">
                    Tujuan Pengiriman: <strong style="color: #0f172a;"><?= htmlspecialchars($ord['customer_name']) ?></strong> (<?= htmlspecialchars($ord['customer_phone']) ?>)
                </div>
                <div style="display: flex; align-items: baseline; gap: 8px;">
                    <span style="color: #64748b;">Total Tagihan:</span>
                    <strong style="font-size: 18px; color: #0284c7; font-weight: 800;">
                        Rp <?= number_format($ord['total_amount'], 0, ',', '.') ?>
                    </strong>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
