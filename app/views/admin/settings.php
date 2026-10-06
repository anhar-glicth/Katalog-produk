<div class="admin-card" style="max-width: 860px; margin: 0 auto;">
    <div class="admin-card-header">
        <div>
            <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0;">Pengaturan Website, Logo & Branding</h3>
            <p style="color: var(--admin-text-muted); font-size: 13.5px; margin: 4px 0 0 0;">
                Kustomisasi nama website, unggah logo brand Anda sendiri, dan sesuaikan teks di dashboard langsung dari antarmuka ini.
            </p>
        </div>
        <a href="<?= BASEURL ?>admin" class="btn-admin btn-secondary-admin">
            &larr; Ke Dashboard
        </a>
    </div>

    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 13.5px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <span><?= htmlspecialchars($_SESSION['flash_message']) ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); endif; ?>

    <!-- SHORTCUT: FLASH SALE PROMO -->
    <div style="background: linear-gradient(135deg, #fefce8 0%, #fef08a 100%); border: 1px solid #fde047; border-radius: 12px; padding: 18px 22px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 14px;">
            <span style="font-size: 26px;">⚡</span>
            <div>
                <h4 style="margin: 0; font-size: 15px; font-weight: 800; color: #854d0e;">Pengaturan Promo Flash Sale & Countdown</h4>
                <p style="margin: 3px 0 0 0; font-size: 13px; color: #a16207;">
                    Ingin mengatur jam hitung mundur, produk diskon, dan status aktif flash sale di halaman Lumina Deals?
                </p>
            </div>
        </div>
        <a href="<?= BASEURL ?>admin/flashsale" class="btn-admin" style="background: #eab308; color: #713f12; border: 1px solid #ca8a04; font-weight: 800; text-decoration: none; padding: 9px 18px; font-size: 13px; box-shadow: 0 2px 6px rgba(234, 179, 8, 0.25);">
            ⚡ Kelola Flash Sale &rarr;
        </a>
    </div>

    <form action="<?= BASEURL ?>admin/settings" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 24px;">
        
        <!-- BAGIAN 1: BRANDING WEB & LOGO -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 12px; padding: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="section-step-badge">1</span> Logo & Identitas Brand Website
                </h4>
                <span style="font-size: 11.5px; background: #e0f2fe; color: var(--admin-accent); font-weight: 700; padding: 3px 10px; border-radius: 20px;">
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
                            <div id="logoDefaultPlaceholder" style="display: flex; flex-direction: column; align-items: center; gap: 6px; color: var(--admin-accent);">
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
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                        Unggah Logo Baru (PNG, JPG, SVG, WebP)
                    </label>
                    <input type="file" name="logo_file" id="logoFileInput" accept="image/png, image/jpeg, image/jpg, image/webp, image/svg+xml" class="form-control" style="padding: 8px 12px; cursor: pointer; background: #f8fafc;" onchange="previewLogoFile(this)">
                    <div style="font-size: 12px; color: #64748b; margin-top: 6px; line-height: 1.4;">
                        Pilih file logo dari HP atau komputer Anda (disarankan gambar format transparan PNG dengan tinggi 40-80px).
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
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Website / Brand Utama *</label>
                    <input type="text" name="app_name" class="form-control" required value="<?= htmlspecialchars($settings['app_name'] ?? 'Lumina Pearl') ?>" placeholder="Misal: Cahaya Mutiara Lombok">
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 4px;">Menggantikan tulisan "LUMINA PEARL" di seluruh header web.</div>
                </div>

                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Slogan / Tagline Brand</label>
                    <input type="text" name="app_desc" class="form-control" value="<?= htmlspecialchars($settings['app_desc'] ?? 'Exclusive Pearl Shell Collection') ?>" placeholder="Misal: Perhiasan Mutiara Air Laut Murni">
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 4px;">Slogan yang tampil pada deskripsi dan meta.</div>
                </div>
            </div>
        </div>

        <!-- BAGIAN 2: TEKS SAMBUTAN & DASHBOARD -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 12px; padding: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 8px;">
                <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="section-step-badge">2</span> Kustomisasi Teks di Dashboard
                </h4>
                <span style="font-size: 11.5px; background: #ecfdf5; color: #059669; font-weight: 700; padding: 3px 10px; border-radius: 20px;">
                    Langsung Berubah di Dashboard
                </span>
            </div>

            <div class="settings-grid-2" style="margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Teks Badge Toko di Dashboard</label>
                    <input type="text" name="dashboard_badge" class="form-control" value="<?= htmlspecialchars($settings['dashboard_badge'] ?? 'Mitra Penjual Lumina Pearl') ?>" placeholder="Misal: Toko Resmi Rekanan">
                </div>

                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Judul Sambutan Dashboard</label>
                    <input type="text" name="dashboard_welcome" class="form-control" value="<?= htmlspecialchars($settings['dashboard_welcome'] ?? 'Selamat Datang di Seller Center!') ?>" placeholder="Misal: Selamat Datang di Pusat Penjualan">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Teks Pesan / Deskripsi Sambutan Dashboard</label>
                <textarea name="dashboard_desc" class="form-control" rows="2" placeholder="Tulis kalimat sambutan untuk dashboard..."><?= htmlspecialchars($settings['dashboard_desc'] ?? 'Kelola katalog perhiasan mutiara Anda, pantau transaksi masuk secara langsung, dan tingkatkan penjualan toko Anda.') ?></textarea>
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Teks Pengumuman / Info Toko (Banner)</label>
                <input type="text" name="dashboard_announcement" class="form-control" value="<?= htmlspecialchars($settings['dashboard_announcement'] ?? 'Selamat datang di panel kelola toko! Pastikan info produk dan stok selalu diperbarui.') ?>" placeholder="Tulis pengumuman atau catatan khusus...">
            </div>
        </div>

        <div class="settings-actions-bar" style="display: flex; gap: 14px; justify-content: flex-end; align-items: center; padding-top: 10px;">
            <a href="<?= BASEURL ?>admin" class="btn-admin btn-secondary-admin" style="padding: 12px 24px;">Batal</a>
            <button type="submit" class="btn-admin btn-primary-admin" style="padding: 13px 32px; font-size: 14px; font-weight: 700; box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);">
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
                label.innerHTML = 'Foto Logo Baru Dipilih:<br><strong style="color: var(--admin-accent);">' + file.name + '</strong>';
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
