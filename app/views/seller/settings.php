<div class="seller-card" style="max-width: 860px; margin: 0 auto;">
    <div class="seller-card-header">
        <div>
            <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0;">Pengaturan Website, Logo & Profil Toko</h3>
            <p style="color: var(--seller-text-muted); font-size: 13.5px; margin: 4px 0 0 0;">
                Kustomisasi nama website, unggah logo brand Anda sendiri, dan sesuaikan teks di dashboard langsung dari halaman ini tanpa koding.
            </p>
        </div>
        <a href="<?= BASEURL ?>seller" class="btn-seller btn-secondary-seller">
            &larr; Ke Dashboard
        </a>
    </div>

    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div class="flash-alert flash-success" style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 13.5px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <span><?= htmlspecialchars($_SESSION['flash_message']) ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); endif; ?>

    <!-- SHORTCUT: FLASH SALE PROMO -->
    <div style="background: linear-gradient(135deg, #fefce8 0%, #fef08a 100%); border: 1px solid #fde047; border-radius: 12px; padding: 18px 22px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 14px;">
            <span style="font-size: 26px;"></span>
            <div>
                <h4 style="margin: 0; font-size: 15px; font-weight: 800; color: #854d0e;">Pengaturan Promo Flash Sale & Countdown</h4>
                <p style="margin: 3px 0 0 0; font-size: 13px; color: #a16207;">
                    Ingin mengatur jam hitung mundur, produk diskon, dan status aktif flash sale di halaman Lumina Deals?
                </p>
            </div>
        </div>
        <a href="<?= BASEURL ?>seller/flashsale" class="btn-seller" style="background: #eab308; color: #713f12; border: 1px solid #ca8a04; font-weight: 800; text-decoration: none; padding: 9px 18px; font-size: 13px; box-shadow: 0 2px 6px rgba(234, 179, 8, 0.25);">
             Kelola Flash Sale &rarr;
        </a>
    </div>

    <form action="<?= BASEURL ?>seller/settings" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 24px;">
        
        <!-- BAGIAN 1: BRANDING WEB & LOGO -->
        <div style="background: #f8fafc; border: 1px solid var(--seller-border); border-radius: 12px; padding: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="section-step-badge">1</span> Logo & Identitas Brand Website
                </h4>
                <span style="font-size: 11.5px; background: #e0f2fe; color: var(--seller-accent); font-weight: 700; padding: 3px 10px; border-radius: 20px;">
                    Tampil di Header & Publik
                </span>
            </div>

            <!-- Upload Logo Gambar & Live Preview -->
            <div class="settings-logo-grid" style="align-items: start; margin-bottom: 20px; background: #ffffff; padding: 18px; border-radius: 10px; border: 1px solid #e2e8f0;">
                <!-- Kotak Pratinjau Logo -->
                <div style="text-align: center; border: 2px dashed #cbd5e1; border-radius: 10px; padding: 14px; min-height: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center; background: #f8fafc;">
                    <?php 
                        $curLogo = $settings['app_logo'] ?? '';
                        $logoPreviewSrc = !empty($curLogo) ? ((strpos($curLogo, 'http') === 0) ? $curLogo : (BASEURL . $curLogo)) : '';
                    ?>
                    <div id="logoPreviewContainer" style="width: 100%; display: flex; align-items: center; justify-content: center;">
                        <?php if (!empty($logoPreviewSrc)): ?>
                            <img id="logoPreviewImg" src="<?= htmlspecialchars($logoPreviewSrc) ?>" alt="Logo Website" style="max-height: 70px; max-width: 160px; object-fit: contain;">
                        <?php else: ?>
                            <div id="logoDefaultPlaceholder" style="display: flex; flex-direction: column; align-items: center; gap: 6px; color: var(--seller-accent);">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                                    <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
                                </svg>
                                <span style="font-size: 11px; font-weight: 700; color: #475569;">Logo Bawaan</span>
                            </div>
                            <img id="logoPreviewImg" src="" alt="Logo" style="max-height: 70px; max-width: 160px; object-fit: contain; display: none;">
                        <?php endif; ?>
                    </div>
                    <span id="logoStatusLabel" style="font-size: 11px; color: #64748b; margin-top: 8px;">
                        <?= !empty($curLogo) ? 'Logo Kustom Aktif' : 'Logo Bawaan Aktif' ?>
                    </span>
                </div>

                <!-- Input Pilih File Logo -->
                <div>
                    <label class="form-label" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                        Unggah Logo Baru (PNG, JPG, SVG, WebP)
                    </label>
                    <input type="file" name="logo_file" id="logoFileInput" accept="image/png, image/jpeg, image/jpg, image/webp, image/svg+xml" class="form-control" style="padding: 8px 12px; cursor: pointer; background: #f8fafc;" onchange="previewLogoFile(this)">
                    <div style="font-size: 12px; color: #64748b; margin-top: 6px; line-height: 1.4;">
                        Pilih file logo dari HP atau komputer Anda (disarankan gambar berlatar transparan PNG dengan tinggi sekitar 40-80px).
                    </div>

                    <input type="hidden" name="app_logo" id="appLogoInput" value="<?= htmlspecialchars($curLogo) ?>">

                    <?php if (!empty($curLogo)): ?>
                    <button type="button" onclick="resetToDefaultLogo()" style="margin-top: 8px; background: none; border: 1px solid #fecaca; color: #dc2626; border-radius: 6px; padding: 6px 12px; font-size: 11.5px; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                        <span>Kembalikan ke Logo Bawaan</span>
                    </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="settings-grid-2">
                <div class="form-group">
                    <label class="form-label">Nama Website / Brand Utama *</label>
                    <input type="text" name="app_name" class="form-control" required value="<?= htmlspecialchars($settings['app_name'] ?? 'Lumina Pearl') ?>" placeholder="Misal: Cahaya Mutiara Lombok">
                    <div class="form-hint">Menggantikan tulisan "LUMINA PEARL" di logo header dan nama website.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Slogan / Tagline Brand</label>
                    <input type="text" name="app_desc" class="form-control" value="<?= htmlspecialchars($settings['app_desc'] ?? 'Exclusive Pearl Shell Collection') ?>" placeholder="Misal: Perhiasan Mutiara Air Laut Murni">
                    <div class="form-hint">Slogan yang tampil pada deskripsi dan pencarian.</div>
                </div>
            </div>
        </div>

        <!-- BAGIAN 2: TEKS SAMBUTAN & DASHBOARD -->
        <div style="background: #f8fafc; border: 1px solid var(--seller-border); border-radius: 12px; padding: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 8px;">
                <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="section-step-badge">2</span> Kustomisasi Semua Teks di Dashboard
                </h4>
                <span style="font-size: 11.5px; background: #ecfdf5; color: #059669; font-weight: 700; padding: 3px 10px; border-radius: 20px;">
                    Langsung Berubah di Dashboard
                </span>
            </div>

            <div class="settings-grid-2" style="margin-bottom: 16px;">
                <div class="form-group">
                    <label class="form-label">Teks Badge Toko di Dashboard</label>
                    <input type="text" name="dashboard_badge" class="form-control" value="<?= htmlspecialchars($settings['dashboard_badge'] ?? 'Mitra Penjual Lumina Pearl') ?>" placeholder="Misal: Toko Resmi Rekanan">
                    <div class="form-hint">Badge kecil di atas judul sambutan dashboard.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Sambutan Dashboard</label>
                    <input type="text" name="dashboard_welcome" class="form-control" value="<?= htmlspecialchars($settings['dashboard_welcome'] ?? 'Selamat Datang di Seller Center!') ?>" placeholder="Misal: Selamat Datang di Pusat Penjualan">
                    <div class="form-hint">Judul besar di bagian paling atas halaman Dashboard.</div>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label class="form-label">Teks Pesan / Deskripsi Sambutan Dashboard</label>
                <textarea name="dashboard_desc" class="form-control" rows="2" placeholder="Tulis kalimat sambutan untuk dashboard..."><?= htmlspecialchars($settings['dashboard_desc'] ?? 'Kelola katalog perhiasan mutiara Anda, pantau transaksi masuk secara langsung, dan tingkatkan penjualan toko Anda.') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Teks Pengumuman / Info Toko (Opsional)</label>
                <input type="text" name="dashboard_announcement" class="form-control" value="<?= htmlspecialchars($settings['dashboard_announcement'] ?? 'Selamat datang di panel kelola toko! Pastikan info produk dan stok selalu diperbarui.') ?>" placeholder="Tulis pengumuman atau catatan khusus toko...">
            </div>
        </div>

        <!-- BAGIAN 3: IDENTITAS TOKO MITRA -->
        <div style="background: #f8fafc; border: 1px solid var(--seller-border); border-radius: 12px; padding: 24px;">
            <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0 0 18px 0; display: flex; align-items: center; gap: 10px;">
                <span class="section-step-badge">3</span> Identitas Profil Toko Anda
            </h4>
            
            <div class="settings-grid-2" style="margin-bottom: 16px;">
                <div class="form-group">
                    <label class="form-label">Nama Toko Mitra Anda *</label>
                    <input type="text" name="store_name" class="form-control" required value="<?= htmlspecialchars($user['store_name'] ?? '') ?>" placeholder="Misal: Mutiara Lombok Asli">
                    <div class="form-hint">Nama toko yang tertera di samping produk Anda.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp / Telepon Toko *</label>
                    <input type="text" name="phone" class="form-control" required value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="Misal: 081234567890">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label class="form-label">Deskripsi / Bio Toko Anda</label>
                <textarea name="store_description" class="form-control" rows="2" placeholder="Ceritakan keistimewaan dan asal kerajinan toko Anda..."><?= htmlspecialchars($user['store_description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Workshop / Pengiriman Asal (Pickup Point)</label>
                <textarea name="address" class="form-control" rows="2" placeholder="Alamat lengkap asal pengiriman barang toko Anda..."><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- BAGIAN 4: REKENING BANK TRANSFER MANUAL & WHATSAPP -->
        <div style="background: #f8fafc; border: 1px solid var(--seller-border); border-radius: 12px; padding: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 8px;">
                <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="section-step-badge">4</span> Rekening Bank Pembayaran Manual & Kontak WA
                </h4>
                <span style="font-size: 11.5px; background: #e0f2fe; color: var(--seller-accent); font-weight: 700; padding: 3px 10px; border-radius: 20px;">
                    Tampil pada Invoice Pembeli
                </span>
            </div>
            <p style="color: var(--seller-text-muted); font-size: 13px; margin: 0 0 20px 0;">
                Nomor rekening ini akan ditampilkan kepada pembeli saat mereka memilih pembayaran transfer manual dan ingin mengunggah bukti transfer.
            </p>

            <!-- Bank 1: BCA -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 16px; margin-bottom: 16px;">
                <div style="font-weight: 800; font-size: 13.5px; color: #003882; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                    <span style="display: inline-block; padding: 2px 7px; background: #003882; color: #ffffff; border-radius: 4px; font-size: 11px; font-weight: 800;">BCA</span>
                    <span>1. Rekening Bank Central Asia (BCA)</span>
                </div>
                <div class="settings-grid-2">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Nomor Rekening BCA</label>
                        <input type="text" name="bank_account_number" class="form-control" value="<?= htmlspecialchars($settings['bank_account_number'] ?? '8801 2948 1029') ?>" placeholder="Misal: 8801 2948 1029">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Atas Nama Pemilik (BCA)</label>
                        <input type="text" name="bank_account_holder" class="form-control" value="<?= htmlspecialchars($settings['bank_account_holder'] ?? 'PT Lumina Mutiara Samudra') ?>" placeholder="Misal: PT Lumina Mutiara Samudra">
                    </div>
                </div>
            </div>

            <!-- Bank 2: Mandiri -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 16px; margin-bottom: 16px;">
                <div style="font-weight: 800; font-size: 13.5px; color: #00305a; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                    <span style="display: inline-block; padding: 2px 7px; background: #00305a; color: #ffffff; border-radius: 4px; font-size: 11px; font-weight: 800;">MANDIRI</span>
                    <span>2. Rekening Bank Mandiri</span>
                </div>
                <div class="settings-grid-2">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Nomor Rekening Mandiri</label>
                        <input type="text" name="bank_account_number_2" class="form-control" value="<?= htmlspecialchars($settings['bank_account_number_2'] ?? '137 00 1928374 1') ?>" placeholder="Misal: 137 00 1928374 1">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Atas Nama Pemilik (Mandiri)</label>
                        <input type="text" name="bank_account_holder_2" class="form-control" value="<?= htmlspecialchars($settings['bank_account_holder_2'] ?? 'PT Lumina Mutiara Samudra') ?>" placeholder="Misal: PT Lumina Mutiara Samudra">
                    </div>
                </div>
            </div>

            <!-- Bank 3: BRI -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 16px; margin-bottom: 16px;">
                <div style="font-weight: 800; font-size: 13.5px; color: #00529c; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                    <span style="display: inline-block; padding: 2px 7px; background: #00529c; color: #ffffff; border-radius: 4px; font-size: 11px; font-weight: 800;">BRI</span>
                    <span>3. Rekening Bank BRI</span>
                </div>
                <div class="settings-grid-2">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Nomor Rekening BRI</label>
                        <input type="text" name="bank_account_number_3" class="form-control" value="<?= htmlspecialchars($settings['bank_account_number_3'] ?? '0206 01 002938 50 3') ?>" placeholder="Misal: 0206 01 002938 50 3">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Atas Nama Pemilik (BRI)</label>
                        <input type="text" name="bank_account_holder_3" class="form-control" value="<?= htmlspecialchars($settings['bank_account_holder_3'] ?? 'PT Lumina Mutiara Samudra') ?>" placeholder="Misal: PT Lumina Mutiara Samudra">
                    </div>
                </div>
            </div>

            <!-- Nomor WhatsApp Konfirmasi Cepat -->
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" style="display: flex; align-items: center; gap: 6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #059669;"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    <span>Nomor WhatsApp Customer Service / Konfirmasi Cepat</span>
                </label>
                <input type="text" name="wa_phone" class="form-control" value="<?= htmlspecialchars($settings['wa_phone'] ?? '081234567891') ?>" placeholder="Misal: 081234567891">
                <div class="form-hint">Nomor ini terhubung ke tombol chat 'Konfirmasi via WhatsApp' pada halaman invoice pembeli.</div>
            </div>

        </div>

        <div class="settings-actions-bar" style="display: flex; gap: 14px; justify-content: flex-end; align-items: center; padding-top: 10px;">
            <a href="<?= BASEURL ?>seller" class="btn-seller btn-secondary-seller" style="padding: 12px 24px;">Batal</a>
            <button type="submit" class="btn-seller btn-primary-seller" style="padding: 13px 32px; font-size: 14px; font-weight: 700; box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                <span>Simpan Semua Perubahan</span>
            </button>
        </div>

    </form>
</div>

<script>
function previewLogoFile(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('logoPreviewImg');
            const placeholder = document.getElementById('logoDefaultPlaceholder');
            const label = document.getElementById('logoStatusLabel');
            
            img.src = e.target.result;
            img.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
            if (label) {
                label.innerHTML = 'Foto Logo Baru Dipilih:<br><strong style="color: var(--seller-accent);">' + file.name + '</strong>';
            }
        };
        reader.readAsDataURL(file);
    }
}

function resetToDefaultLogo() {
    document.getElementById('appLogoInput').value = '';
    const img = document.getElementById('logoPreviewImg');
    const placeholder = document.getElementById('logoDefaultPlaceholder');
    const label = document.getElementById('logoStatusLabel');
    const fileInput = document.getElementById('logoFileInput');
    
    if (fileInput) fileInput.value = '';
    if (img) img.style.display = 'none';
    if (placeholder) placeholder.style.display = 'flex';
    if (label) label.innerText = 'Logo akan di-reset ke bawaan setelah disimpan';
}
</script>
