<div class="container" style="padding: 40px 16px 80px 16px; max-width: 820px; margin: 0 auto; min-height: 75vh;">

    <!-- FLASH MESSAGES -->
    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <span><?= htmlspecialchars($_SESSION['flash_message']) ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); endif; ?>

    <?php if (!empty($_SESSION['flash_error'])): ?>
    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <span><?= htmlspecialchars($_SESSION['flash_error']) ?></span>
    </div>
    <?php unset($_SESSION['flash_error']); endif; ?>

    <!-- MAIN INVOICE CARD -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 36px 32px; box-shadow: 0 12px 36px rgba(0,0,0,0.06); color: #0f172a;">
        
        <!-- HEADER KODE INVOICE -->
        <div style="text-align: center; margin-bottom: 28px;">
            <div style="width: 60px; height: 60px; background: #f0fdf4; border: 2px solid #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px auto; color: #059669;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h2 style="font-size: 24px; color: #0f172a; font-weight: 800; margin: 0 0 6px 0;">Pesanan Berhasil Dibuat</h2>
            <p style="color: #64748b; font-size: 14px; margin: 0;">
                Terima kasih telah berbelanja di Lumina Pearl. Simpan kode pesanan Anda:
            </p>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: #f8fafc; border: 1px dashed #0284c7; color: #0284c7; font-size: 18px; font-weight: 800; padding: 8px 20px; border-radius: 10px; margin-top: 12px; letter-spacing: 0.5px;">
                <span>#<?= htmlspecialchars($order['order_code']) ?></span>
                <button type="button" onclick="copyText('<?= htmlspecialchars($order['order_code']) ?>', this)" style="background: none; border: none; cursor: pointer; color: #0284c7; font-size: 12px; font-weight: 700; padding: 2px 6px; border-radius: 4px; background: rgba(2, 132, 199, 0.08);" title="Salin Kode Pesanan">
                    Salin
                </button>
            </div>
        </div>

        <!-- PROGRESS STEPPER (5 TAHAPAN PESANAN) -->
        <?php 
            $status = $order['status'];
            $hasProof = !empty($order['payment_proof']);
            
            // Logika aktif per tahapan
            $step1 = true; // Pesanan dibuat
            $step2 = $hasProof || in_array($status, ['Diproses', 'Dikirim', 'Selesai']); // Pembayaran / Bukti
            $step3 = in_array($status, ['Diproses', 'Dikirim', 'Selesai']); // Di-ACC Penjual & Siap Diantar
            $step4 = in_array($status, ['Dikirim', 'Selesai']); // Dalam Pengiriman Kurir
            $step5 = ($status === 'Selesai'); // Selesai Diterima
        ?>
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 20px 14px; margin-bottom: 28px;">
            <div style="text-align: center; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 16px;">
                Alur Progres Transaksi Anda
            </div>
            <div class="invoice-stepper-grid">
                
                <!-- Step 1 -->
                <div style="text-align: center;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #10b981; color: #ffffff; display: flex; align-items: center; justify-content: center; margin: 0 auto 6px auto; font-size: 13px; font-weight: 800;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: #0f172a; line-height: 1.2;">1. Pesanan Dibuat</div>
                </div>

                <!-- Step 2 -->
                <div style="text-align: center;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: <?= $step2 ? '#10b981' : '#f59e0b' ?>; color: #ffffff; display: flex; align-items: center; justify-content: center; margin: 0 auto 6px auto; font-size: 13px; font-weight: 800;">
                        <?php if ($step2): ?>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <?php else: ?>
                            2
                        <?php endif; ?>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: <?= $step2 ? '#0f172a' : '#b45309' ?>; line-height: 1.2;">
                        2. Unggah Bukti
                    </div>
                </div>

                <!-- Step 3 (DI-ACC PENJUAL) -->
                <div style="text-align: center;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: <?= $step3 ? '#10b981' : '#cbd5e1' ?>; color: #ffffff; display: flex; align-items: center; justify-content: center; margin: 0 auto 6px auto; font-size: 13px; font-weight: 800; box-shadow: <?= $step3 ? '0 0 0 3px rgba(16, 185, 129, 0.2)' : 'none' ?>;">
                        <?php if ($step3): ?>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <?php else: ?>
                            3
                        <?php endif; ?>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: <?= $step3 ? '#166534' : '#64748b' ?>; line-height: 1.2;">
                        3. Di-ACC Penjual
                    </div>
                </div>

                <!-- Step 4 -->
                <div style="text-align: center;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: <?= $step4 ? '#0284c7' : '#cbd5e1' ?>; color: #ffffff; display: flex; align-items: center; justify-content: center; margin: 0 auto 6px auto; font-size: 13px; font-weight: 800;">
                        <?php if ($step4): ?>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <?php else: ?>
                            4
                        <?php endif; ?>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: <?= $step4 ? '#0284c7' : '#64748b' ?>; line-height: 1.2;">
                        4. Siap Diantar
                    </div>
                </div>

                <!-- Step 5 -->
                <div style="text-align: center;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: <?= $step5 ? '#10b981' : '#cbd5e1' ?>; color: #ffffff; display: flex; align-items: center; justify-content: center; margin: 0 auto 6px auto; font-size: 13px; font-weight: 800;">
                        <?php if ($step5): ?>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <?php else: ?>
                            5
                        <?php endif; ?>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: <?= $step5 ? '#0f172a' : '#64748b' ?>; line-height: 1.2;">
                        5. Selesai
                    </div>
                </div>

            </div>
        </div>

        <!-- REAL-TIME STATUS BANNER NOTIFICATION -->
        <?php if ($status === 'Diproses'): ?>
            <!-- STATUS 1: PEMBAYARAN TELAH DI-ACC OLEH PENJUAL -->
            <div style="background: #f0fdf4; border: 2px solid #86efac; border-radius: 14px; padding: 22px; margin-bottom: 28px; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.12);">
                <div style="display: flex; gap: 14px; align-items: flex-start;">
                    <div style="color: #10b981; flex-shrink: 0; margin-top: 2px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <div>
                        <h3 style="margin: 0 0 6px 0; font-size: 18px; color: #166534; font-weight: 800;">
                            PEMBAYARAN ANDA TELAH DI-ACC OLEH PENJUAL!
                        </h3>
                        <p style="margin: 0 0 8px 0; color: #15803d; font-size: 14.5px; line-height: 1.5;">
                            Kabar gembira! Penjual telah memverifikasi bukti pembayaran transfer Anda. Saat ini barang pesanan Anda <strong>sedang disiapkan & dikemas</strong> untuk segera diserahkan kepada kurir <strong><?= htmlspecialchars($order['courier']) ?></strong>.
                        </p>
                        <div style="display: inline-flex; align-items: center; gap: 6px; background: #dcfce7; color: #14532d; font-size: 12.5px; font-weight: 700; padding: 5px 12px; border-radius: 20px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            <span>Status: Barang Siap Diantarkan</span>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($status === 'Dikirim'): ?>
            <!-- STATUS 2: BARANG SEDANG DIKIRIM KURIR -->
            <div style="background: #f0f9ff; border: 2px solid #bae6fd; border-radius: 14px; padding: 22px; margin-bottom: 28px;">
                <div style="display: flex; gap: 14px; align-items: flex-start;">
                    <div style="color: #0284c7; flex-shrink: 0; margin-top: 2px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <div>
                        <h3 style="margin: 0 0 6px 0; font-size: 18px; color: #0369a1; font-weight: 800;">
                            PAKET ANDA SEDANG DALAM PENGIRIMAN
                        </h3>
                        <p style="margin: 0; color: #0284c7; font-size: 14px; line-height: 1.5;">
                            Barang Anda telah diserahkan dan sedang diantarkan oleh kurir <strong><?= htmlspecialchars($order['courier']) ?></strong> menuju alamat pengiriman Anda.
                        </p>
                    </div>
                </div>
            </div>

        <?php elseif ($status === 'Menunggu Konfirmasi Penjual'): ?>
            <!-- STATUS 3: BUKTI UDAH DIUPLOAD, MENUNGGU VERIFIKASI PENJUAL -->
            <div style="background: #fffbeb; border: 2px solid #fde68a; border-radius: 14px; padding: 22px; margin-bottom: 28px;">
                <div style="display: flex; gap: 14px; align-items: flex-start;">
                    <div style="color: #d97706; flex-shrink: 0; margin-top: 2px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <div>
                        <h3 style="margin: 0 0 6px 0; font-size: 17px; color: #b45309; font-weight: 800;">
                            BUKTI TRANSFER DITERIMA — MENUNGGU VERIFIKASI (ACC) PENJUAL
                        </h3>
                        <p style="margin: 0; color: #92400e; font-size: 14px; line-height: 1.5;">
                            Terima kasih! Bukti transfer Anda sudah masuk ke sistem kami. Penjual sedang mengecek mutasi rekening bank dan akan segera meng-ACC pesanan ini agar langsung disiapkan.
                        </p>
                    </div>
                </div>
            </div>

        <?php elseif ($status === 'Selesai'): ?>
            <!-- STATUS 4: SELESAI -->
            <div style="background: #f0fdf4; border: 2px solid #bbf7d0; border-radius: 14px; padding: 22px; margin-bottom: 28px;">
                <div style="display: flex; gap: 14px; align-items: flex-start;">
                    <div style="color: #10b981; flex-shrink: 0; margin-top: 2px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <div>
                        <h3 style="margin: 0 0 6px 0; font-size: 18px; color: #166534; font-weight: 800;">
                            TRANSAKSI SELESAI DITERIMA
                        </h3>
                        <p style="margin: 0; color: #15803d; font-size: 14px;">
                            Paket telah sampai dengan selamat. Terima kasih telah mempercayai koleksi mutiara kami!
                        </p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- STATUS 5: MENUNGGU PEMBAYARAN MANUAL -->
            <div style="background: #fff7ed; border: 2px solid #fed7aa; border-radius: 14px; padding: 22px; margin-bottom: 28px;">
                <div style="display: flex; gap: 14px; align-items: flex-start;">
                    <div style="color: #c2410c; flex-shrink: 0; margin-top: 2px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </div>
                    <div>
                        <h3 style="margin: 0 0 6px 0; font-size: 17px; color: #c2410c; font-weight: 800;">
                            SILAKAN TRANSFER & UNGGAH BUKTI PEMBAYARAN
                        </h3>
                        <p style="margin: 0; color: #9a3412; font-size: 14px; line-height: 1.5;">
                            Lakukan transfer sesuai total tagihan ke salah satu nomor rekening resmi di bawah. Setelah transfer berhasil, unggah foto bukti transfer di bawah agar penjual langsung meng-ACC pesanan Anda.
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- KOTAK REKENING TUJUAN TRANSFER BANK (KEMANA SAYA BAYAR) -->
        <?php if (in_array($status, ['Menunggu Pembayaran', 'Menunggu Konfirmasi Penjual'])): ?>
        <div style="background: #ffffff; border: 2px solid #0284c7; border-radius: 16px; padding: 24px; margin-bottom: 28px; box-shadow: 0 6px 20px rgba(2, 132, 199, 0.08);">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 10px;">
                <div>
                    <h3 style="margin: 0; font-size: 17px; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                        <span>Rekening Bank Tujuan Transfer</span>
                    </h3>
                    <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                        Pilih salah satu bank berikut untuk melakukan pembayaran transfer manual:
                    </p>
                </div>
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                    Total Tagihan: Rp <?= number_format($order['total_amount'], 0, ',', '.') ?>
                </div>
            </div>

            <!-- Total Transfer Highlight -->
            <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 10px; padding: 14px 18px; margin-bottom: 18px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span style="font-size: 12px; color: #0369a1; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Nominal Tepat yang Harus Ditransfer:</span>
                    <div style="font-size: 22px; font-weight: 800; color: #0284c7; margin-top: 2px;">
                        Rp <?= number_format($order['total_amount'], 0, ',', '.') ?>
                    </div>
                </div>
                <button type="button" onclick="copyText('<?= (int)$order['total_amount'] ?>', this)" style="background: #0284c7; color: #ffffff; border: none; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer;">
                    Salin Jumlah
                </button>
            </div>

            <!-- List 3 Rekening Bank Resmi -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                
                <!-- 1. BANK BCA -->
                <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; flex-wrap: wrap; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="background: #003882; color: #ffffff; font-weight: 800; font-size: 13px; padding: 6px 12px; border-radius: 6px; letter-spacing: 1px;">
                            BCA
                        </div>
                        <div>
                            <div style="font-size: 16px; font-weight: 800; color: #0f172a; letter-spacing: 0.5px;">
                                <?= htmlspecialchars($settings['bank_account_number'] ?? '8801 2948 1029') ?>
                            </div>
                            <div style="font-size: 12px; color: #64748b;">
                                a/n <?= htmlspecialchars($settings['bank_account_holder'] ?? 'PT Lumina Mutiara Samudra') ?>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="copyText('<?= htmlspecialchars(str_replace(' ', '', $settings['bank_account_number'] ?? '880129481029')) ?>', this)" class="btn-copy-acc" style="background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 7px 16px; border-radius: 6px; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                        Salin No. Rekening
                    </button>
                </div>

                <!-- 2. BANK MANDIRI -->
                <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; flex-wrap: wrap; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="background: #00305a; color: #eab308; font-weight: 800; font-size: 13px; padding: 6px 12px; border-radius: 6px; letter-spacing: 0.5px;">
                            MANDIRI
                        </div>
                        <div>
                            <div style="font-size: 16px; font-weight: 800; color: #0f172a; letter-spacing: 0.5px;">
                                <?= htmlspecialchars($settings['bank_account_number_2'] ?? '137 00 1928374 1') ?>
                            </div>
                            <div style="font-size: 12px; color: #64748b;">
                                a/n <?= htmlspecialchars($settings['bank_account_holder_2'] ?? 'PT Lumina Mutiara Samudra') ?>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="copyText('<?= htmlspecialchars(str_replace(' ', '', $settings['bank_account_number_2'] ?? '1370019283741')) ?>', this)" class="btn-copy-acc" style="background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 7px 16px; border-radius: 6px; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                        Salin No. Rekening
                    </button>
                </div>

                <!-- 3. BANK BRI -->
                <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; flex-wrap: wrap; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="background: #00529c; color: #ffffff; font-weight: 800; font-size: 13px; padding: 6px 12px; border-radius: 6px; letter-spacing: 0.5px;">
                            BRI
                        </div>
                        <div>
                            <div style="font-size: 16px; font-weight: 800; color: #0f172a; letter-spacing: 0.5px;">
                                <?= htmlspecialchars($settings['bank_account_number_3'] ?? '0206 01 002938 50 3') ?>
                            </div>
                            <div style="font-size: 12px; color: #64748b;">
                                a/n <?= htmlspecialchars($settings['bank_account_holder_3'] ?? 'PT Lumina Mutiara Samudra') ?>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="copyText('<?= htmlspecialchars(str_replace(' ', '', $settings['bank_account_number_3'] ?? '020601002938503')) ?>', this)" class="btn-copy-acc" style="background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 7px 16px; border-radius: 6px; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                        Salin No. Rekening
                    </button>
                </div>

            </div>
        </div>
        <?php endif; ?>

        <!-- FORM UPLOAD BUKTI TRANSFER PEMBAYARAN (BUKTI SAYA UPLOAD) -->
        <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 16px; padding: 26px; margin-bottom: 28px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                <h3 style="margin: 0; font-size: 17px; font-weight: 800; color: #0f172a;">
                    Bukti Pembayaran / Struk Transfer
                </h3>
            </div>
            <p style="margin: 0 0 18px 0; color: #64748b; font-size: 13.5px;">
                Unggah foto bukti struk ATM, tangkapan layar m-Banking, atau struk pembayaran Anda agar penjual dapat memverifikasi dan meng-ACC pesanan.
            </p>

            <?php if (!empty($order['payment_proof'])): ?>
                <!-- JIKA SUDAH PERNAH UPLOAD BUKTI -->
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 18px; margin-bottom: 18px; display: flex; align-items: center; gap: 18px; flex-wrap: wrap;">
                    <a href="<?= BASEURL . htmlspecialchars($order['payment_proof']) ?>" target="_blank" title="Klik untuk melihat bukti ukuran penuh">
                        <img src="<?= BASEURL . htmlspecialchars($order['payment_proof']) ?>" alt="Bukti Transfer" style="width: 90px; height: 90px; object-fit: cover; border-radius: 10px; border: 2px solid #10b981; box-shadow: 0 4px 10px rgba(0,0,0,0.08);">
                    </a>
                    <div style="flex: 1; min-width: 220px;">
                        <div style="display: inline-flex; align-items: center; gap: 5px; background: #dcfce7; color: #166534; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 12px; margin-bottom: 6px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Bukti Transfer Berhasil Terkirim</span>
                        </div>
                        <div style="font-size: 13px; color: #1e293b; font-weight: 600;">
                            Waktu Unggah: <?= !empty($order['payment_proof_time']) ? date('d F Y, H:i', strtotime($order['payment_proof_time'])) . ' WIB' : 'Terkirim' ?>
                        </div>
                        <div style="margin-top: 8px;">
                            <a href="<?= BASEURL . htmlspecialchars($order['payment_proof']) ?>" target="_blank" style="color: #0284c7; font-size: 13px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                <span>Lihat Foto Bukti Asli &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- FORM UNGGAH / GANTI BUKTI -->
            <?php if (in_array($status, ['Menunggu Pembayaran', 'Menunggu Konfirmasi Penjual'])): ?>
            <form action="<?= BASEURL ?>order/uploadProof/<?= $order['order_code'] ?>" method="POST" enctype="multipart/form-data" style="background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 22px; text-align: center;">
                
                <input type="file" name="proof_file" id="proofFileInput" accept="image/png, image/jpeg, image/jpg, image/webp" required style="display: none;" onchange="previewProof(this)">
                
                <div id="proofUploadBox" onclick="document.getElementById('proofFileInput').click();" style="cursor: pointer;">
                    <div style="width: 48px; height: 48px; background: #e0f2fe; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto; color: #0284c7;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 14.5px; margin-bottom: 4px;">
                        <?= !empty($order['payment_proof']) ? 'Unggah Ulang Bukti Transfer Baru' : 'Pilih Foto Struk / Bukti Transfer' ?>
                    </div>
                    <div style="color: #64748b; font-size: 12.5px;">
                        Klik di sini untuk memilih file dari galeri HP atau komputer (JPG, PNG, WebP maks 5MB)
                    </div>
                </div>

                <!-- Preview Gambar yang Dipilih -->
                <div id="proofPreviewContainer" style="display: none; margin-top: 14px; padding-top: 14px; border-top: 1px solid #e2e8f0;">
                    <div style="font-size: 12px; color: #166534; font-weight: 700; margin-bottom: 8px;">
                        Pratinjau Foto Bukti:
                    </div>
                    <img id="proofPreviewImg" src="" alt="Pratinjau" style="max-height: 180px; max-width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 2px 8px rgba(0,0,0,0.08); object-fit: contain;">
                </div>

                <div style="margin-top: 16px;">
                    <button type="submit" id="submitProofBtn" style="background: #10b981; color: #ffffff; border: none; padding: 12px 28px; border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        <span>Kirim Bukti Transfer ke Penjual &rarr;</span>
                    </button>
                </div>
            </form>
            <?php else: ?>
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 12px 16px; border-radius: 8px; font-size: 13.5px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Pembayaran pesanan ini sudah diverifikasi & di-ACC oleh penjual.</span>
                </div>
            <?php endif; ?>

        </div>

        <!-- DETAIL PENGIRIMAN & PEMESANAN -->
        <div style="border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 22px 0; margin-bottom: 24px;">
            <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0 0 16px 0;">Detail Pengiriman & Pembeli</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; font-size: 13.5px;">
                <div>
                    <span style="color: #64748b; display: block; font-size: 12px; margin-bottom: 2px;">Nama Penerima</span>
                    <strong style="color: #0f172a; font-size: 14.5px;"><?= htmlspecialchars($order['customer_name']) ?></strong>
                </div>
                <div>
                    <span style="color: #64748b; display: block; font-size: 12px; margin-bottom: 2px;">Nomor Telepon / WA</span>
                    <strong style="color: #0f172a;"><?= htmlspecialchars($order['customer_phone']) ?></strong>
                </div>
                <div>
                    <span style="color: #64748b; display: block; font-size: 12px; margin-bottom: 2px;">Metode Pembayaran</span>
                    <strong style="color: #059669;"><?= htmlspecialchars($order['payment_method']) ?></strong>
                </div>
                <div>
                    <span style="color: #64748b; display: block; font-size: 12px; margin-bottom: 2px;">Jasa Kurir Pengiriman</span>
                    <strong style="color: #0284c7;"><?= htmlspecialchars($order['courier']) ?></strong>
                </div>
                <div style="grid-column: span 2; background: #f8fafc; padding: 12px 16px; border-radius: 8px; border: 1px solid #f1f5f9;">
                    <span style="color: #64748b; display: block; font-size: 12px; margin-bottom: 2px;">Alamat Tujuan Pengiriman</span>
                    <span style="color: #334155; line-height: 1.5;"><?= nl2br(htmlspecialchars($order['customer_address'])) ?></span>
                </div>
            </div>
        </div>

        <!-- RINCIAN PRODUK -->
        <?php if (!empty($order['items'])): ?>
        <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0 0 14px 0;">Rincian Produk Dipesan</h4>
        <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;">
            <?php foreach ($order['items'] as $item): ?>
            <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; padding: 12px 18px; border-radius: 10px; font-size: 13.5px;">
                <div>
                    <strong style="color: #0f172a; font-size: 14px;"><?= htmlspecialchars($item['product_title']) ?></strong>
                    <div style="color: #64748b; font-size: 12px; margin-top: 3px;">
                        Varian: <?= htmlspecialchars($item['variant']) ?> &bull; Ukuran: <?= htmlspecialchars($item['size']) ?> &bull; <?= (int)$item['qty'] ?>x
                    </div>
                </div>
                <div style="font-weight: 800; color: #0284c7; font-size: 14px;">
                    Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- RINCIAN HARGA & TOTAL -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; font-size: 13.5px; margin-bottom: 32px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: #64748b;">
                <span>Subtotal Produk</span>
                <span style="color: #0f172a; font-weight: 600;">Rp <?= number_format($order['subtotal'], 0, ',', '.') ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: #64748b;">
                <span>Ongkos Kirim (<?= htmlspecialchars($order['courier']) ?>)</span>
                <span><?= $order['shipping_fee'] > 0 ? ('Rp ' . number_format($order['shipping_fee'], 0, ',', '.')) : '<span style="color: #059669; font-weight: 700;">Gratis</span>' ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; color: #64748b;">
                <span>Biaya Layanan Admin</span>
                <span style="color: #0f172a; font-weight: 600;">Rp <?= number_format($order['admin_fee'], 0, ',', '.') ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid #e2e8f0; font-size: 17px; font-weight: 800; color: #0284c7;">
                <span>Total Pembayaran</span>
                <span>Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></span>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
            
            <?php 
                $waText = urlencode("Halo Admin Lumina Pearl, saya telah melakukan pemesanan dengan nomor Invoice #" . $order['order_code'] . " sebesar Rp " . number_format($order['total_amount'], 0, ',', '.') . ". Mohon dibantu verifikasi (ACC). Terima kasih!");
                $waPhone = preg_replace('/[^0-9]/', '', $settings['wa_phone'] ?? '081234567891');
                if (substr($waPhone, 0, 1) === '0') $waPhone = '62' . substr($waPhone, 1);
            ?>
            <a href="https://wa.me/<?= $waPhone ?>?text=<?= $waText ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #25d366; color: #ffffff; text-decoration: none; padding: 12px 22px; font-weight: 700; font-size: 13.5px; border-radius: 10px; box-shadow: 0 4px 12px rgba(37, 211, 102, 0.25);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                <span>Konfirmasi via WhatsApp</span>
            </a>

            <button type="button" onclick="window.print()" style="display: inline-flex; align-items: center; gap: 6px; background: #ffffff; border: 1px solid #cbd5e1; color: #334155; padding: 12px 20px; font-weight: 700; font-size: 13.5px; border-radius: 10px; cursor: pointer;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                <span>Cetak Invoice</span>
            </button>

            <a href="<?= BASEURL ?>" style="display: inline-flex; align-items: center; gap: 6px; background: #0284c7; color: #ffffff; text-decoration: none; padding: 12px 24px; font-weight: 700; font-size: 13.5px; border-radius: 10px; transition: background 0.2s;">
                <span>&larr;</span>
                <span>Lanjut Berbelanja</span>
            </a>

        </div>

    </div>
</div>

<!-- JAVASCRIPT HELPER -->
<script>
function copyText(text, btn) {
    if (!navigator.clipboard) {
        const input = document.createElement('input');
        input.value = text;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
    } else {
        navigator.clipboard.writeText(text);
    }
    
    const orig = btn.innerText;
    btn.innerText = 'Tersalin!';
    btn.style.background = '#10b981';
    btn.style.color = '#ffffff';
    setTimeout(() => {
        btn.innerText = orig;
        btn.style.background = '';
        btn.style.color = '';
    }, 2000);
}

function previewProof(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewContainer = document.getElementById('proofPreviewContainer');
            const previewImg = document.getElementById('proofPreviewImg');
            previewImg.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
