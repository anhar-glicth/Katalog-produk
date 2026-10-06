<div class="admin-card" style="margin-bottom: 24px;">
    <div class="admin-card-header" style="border-bottom: 1px solid var(--admin-border); padding-bottom: 18px; margin-bottom: 22px;">
        <div>
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; background: #fef08a; color: #854d0e; border-radius: 8px; font-size: 18px;">⚡</span>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0;">Pengaturan Flash Sale & Diskon Kilat (Admin)</h3>
                <span class="badge-status" style="background: <?= (!empty($flashActive) && $flashActive !== '0') ? '#dcfce7; color: #166534;' : '#f1f5f9; color: #64748b;' ?> font-weight: 700; padding: 4px 10px; border-radius: 20px; font-size: 11.5px;">
                    <?= (!empty($flashActive) && $flashActive !== '0') ? '● Promo Aktif' : '○ Promo Nonaktif' ?>
                </span>
            </div>
            <p style="color: var(--admin-text-muted); font-size: 13.5px; margin: 0;">
                Kontrol penuh atas penayangan promo Flash Sale seluruh toko, atur timer hitung mundur, dan tentukan produk diskon di halaman Lumina Deals.
            </p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="<?= BASEURL ?>collection" target="_blank" class="btn-admin btn-secondary-admin" style="display: inline-flex; align-items: center; gap: 6px;" title="Buka Halaman Koleksi & Deals">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                <span>Lihat di Halaman Deals &#8599;</span>
            </a>
        </div>
    </div>

    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 13px 18px; border-radius: 8px; margin-bottom: 22px; font-size: 13.5px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <span><?= htmlspecialchars($_SESSION['flash_message']) ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); endif; ?>

    <form action="<?= BASEURL ?>admin/flashsale" method="POST" id="flashSaleForm">
        
        <!-- BAGIAN 1: STATUS & WAKTU HITUNG MUNDUR -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 12px; padding: 22px; margin-bottom: 26px;">
            <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0 0 16px 0; display: flex; align-items: center; gap: 10px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #0284c7; color: #fff; border-radius: 50%; font-size: 12px; font-weight: 800;">1</span>
                Status Promo & Jadwal Waktu Berakhir
            </h4>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; align-items: start;">
                <!-- Status Promo -->
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">
                        Status Penayangan Flash Sale
                    </label>
                    <div style="display: flex; gap: 12px;">
                        <label style="flex: 1; display: flex; align-items: center; gap: 10px; background: #ffffff; border: 2px solid <?= (!empty($flashActive) && $flashActive !== '0') ? '#0284c7' : '#cbd5e1' ?>; padding: 12px 16px; border-radius: 8px; cursor: pointer; transition: all 0.2s;" id="labelActive">
                            <input type="radio" name="flash_sale_active" value="1" <?= (!empty($flashActive) && $flashActive !== '0') ? 'checked' : '' ?> onchange="updateStatusBorder()">
                            <div>
                                <div style="font-weight: 700; font-size: 13.5px; color: #0f172a;">🟢 Aktifkan</div>
                                <div style="font-size: 11.5px; color: #64748b;">Tampil di Lumina Deals</div>
                            </div>
                        </label>

                        <label style="flex: 1; display: flex; align-items: center; gap: 10px; background: #ffffff; border: 2px solid <?= (empty($flashActive) || $flashActive === '0') ? '#0284c7' : '#cbd5e1' ?>; padding: 12px 16px; border-radius: 8px; cursor: pointer; transition: all 0.2s;" id="labelInactive">
                            <input type="radio" name="flash_sale_active" value="0" <?= (empty($flashActive) || $flashActive === '0') ? 'checked' : '' ?> onchange="updateStatusBorder()">
                            <div>
                                <div style="font-weight: 700; font-size: 13.5px; color: #0f172a;">⚪ Nonaktifkan</div>
                                <div style="font-size: 11.5px; color: #64748b;">Sembunyikan banner</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Judul Promo -->
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">
                        Judul Banner Flash Sale
                    </label>
                    <input type="text" name="flash_sale_title" class="form-control" required value="<?= htmlspecialchars($flashTitle ?? 'FLASH SALE') ?>" placeholder="Contoh: FLASH SALE, DISKON KILAT" style="width: 100%;">
                    <span style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: block;">
                        Teks judul yang ditampilkan di sebelah timer countdown.
                    </span>
                </div>
            </div>

            <!-- Pengaturan Waktu Berakhir & Preset Tombol Cepat -->
            <div style="margin-top: 20px; background: #ffffff; padding: 18px; border-radius: 10px; border: 1px solid #e2e8f0;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
                    <label style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        Target Waktu Berakhir (Countdown Timer)
                    </label>
                    <!-- Live indicator waktu tersisa -->
                    <span id="remainingBadge" style="font-size: 12px; background: #e0f2fe; color: #0369a1; font-weight: 700; padding: 4px 12px; border-radius: 20px;">
                        Menghitung...
                    </span>
                </div>

                <?php 
                    $formattedEndTime = !empty($flashEndTime) ? date('Y-m-d\TH:i', strtotime($flashEndTime)) : date('Y-m-d\TH:i', strtotime('+2 hours 30 minutes'));
                ?>
                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                    <input type="datetime-local" id="flashEndTimeInput" name="flash_sale_end_time" class="form-control" required value="<?= $formattedEndTime ?>" onchange="updateLiveRemaining()" style="max-width: 280px; font-weight: 700;">
                    
                    <span style="font-size: 12px; color: #64748b; font-weight: 600;">Preset Cepat:</span>
                    <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                        <button type="button" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;" onclick="addHoursToTarget(1)">+1 Jam</button>
                        <button type="button" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;" onclick="addHoursToTarget(2)">+2 Jam</button>
                        <button type="button" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;" onclick="addHoursToTarget(6)">+6 Jam</button>
                        <button type="button" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;" onclick="addHoursToTarget(24)">+24 Jam</button>
                        <button type="button" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;" onclick="setTargetTonight()">Hari Ini 23:59</button>
                        <button type="button" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;" onclick="setTargetTomorrowNight()">Besok 23:59</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- BAGIAN 2: DAFTAR PRODUK & PERSENTASE DISKON -->
        <div style="background: #ffffff; border: 1px solid var(--admin-border); border-radius: 12px; padding: 22px; margin-bottom: 26px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 18px;">
                <div>
                    <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; margin: 0 0 4px 0; display: flex; align-items: center; gap: 10px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #0284c7; color: #fff; border-radius: 50%; font-size: 12px; font-weight: 800;">2</span>
                        Pilihan Produk & Besaran Diskon Flash Sale
                    </h4>
                    <p style="color: var(--admin-text-muted); font-size: 13px; margin: 0;">
                        Centang produk yang ingin dimasukkan ke slider Flash Sale dan tentukan persentase diskonnya.
                    </p>
                </div>

                <!-- Tombol Aksi Massal -->
                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                    <button type="button" class="btn-admin btn-secondary-admin" style="font-size: 12px; padding: 7px 14px;" onclick="selectAllProducts(true)">
                        &#10003; Pilih Semua
                    </button>
                    <button type="button" class="btn-admin btn-secondary-admin" style="font-size: 12px; padding: 7px 14px;" onclick="selectAllProducts(false)">
                        &#10005; Batal Semua
                    </button>
                    
                    <div style="display: inline-flex; align-items: center; gap: 6px; background: #f8fafc; border: 1px solid #cbd5e1; padding: 4px 8px; border-radius: 6px;">
                        <span style="font-size: 12px; font-weight: 700; color: #475569;">Diskon Massal:</span>
                        <input type="number" id="bulkDiscountVal" min="1" max="99" value="50" style="width: 55px; text-align: center; padding: 4px; border: 1px solid #cbd5e1; border-radius: 4px; font-weight: 700;">
                        <span style="font-size: 12px; font-weight: 700; color: #475569;">%</span>
                        <button type="button" class="btn-admin" style="padding: 5px 12px; font-size: 12px;" onclick="applyBulkDiscount()">
                            Terapkan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel Produk -->
            <div class="admin-table-wrap" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                <table class="admin-table" style="width: 100%; border-collapse: collapse; font-size: 13.5px;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; text-align: left;">
                            <th style="padding: 12px 16px; width: 45px; text-align: center;">
                                <input type="checkbox" id="masterCheckbox" onchange="toggleMaster(this)" title="Pilih Semua">
                            </th>
                            <th style="padding: 12px 16px;">Produk</th>
                            <th style="padding: 12px 16px; width: 140px;">Harga Normal</th>
                            <th style="padding: 12px 16px; width: 140px; text-align: center;">Diskon Promo (%)</th>
                            <th style="padding: 12px 16px; width: 150px; text-align: right;">Harga Flash Sale</th>
                            <th style="padding: 12px 16px; width: 110px; text-align: center;">Pratinjau Badge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #64748b;">
                                Belum ada produk di database. Silakan tambahkan produk terlebih dahulu.
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($products as $p): 
                                $pId = (int)$p['id'];
                                $isSelected = isset($flashProductsConfig[$pId]);
                                $discountPercent = $isSelected ? (int)$flashProductsConfig[$pId] : 50;
                                $originalPrice = (int)$p['price'];
                                $flashPrice = round($originalPrice * (1 - ($discountPercent / 100)));
                                $flashPrice = round($flashPrice / 100) * 100;
                            ?>
                            <tr class="product-row <?= $isSelected ? 'row-selected' : '' ?>" id="row_<?= $pId ?>" style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;">
                                <!-- Checkbox -->
                                <td style="padding: 12px 16px; text-align: center;">
                                    <input type="checkbox" name="flash_active_items[]" value="<?= $pId ?>" class="item-checkbox" <?= $isSelected ? 'checked' : '' ?> onchange="onRowCheckChanged(<?= $pId ?>)">
                                </td>

                                <!-- Foto & Nama Produk -->
                                <td style="padding: 12px 16px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <img src="<?= BASEURL ?><?= htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" style="width: 44px; height: 44px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0; flex-shrink: 0;" onerror="this.src='<?= BASEURL ?>images/pearl-white.png'">
                                        <div>
                                            <div style="font-weight: 700; color: #0f172a; margin-bottom: 2px;">
                                                <?= htmlspecialchars($p['title']) ?>
                                            </div>
                                            <div style="font-size: 11.5px; color: #64748b;">
                                                Kategori: <?= htmlspecialchars($p['category_name'] ?? 'Lampu') ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Harga Normal -->
                                <td style="padding: 12px 16px; font-weight: 600; color: #475569;" data-price="<?= $originalPrice ?>">
                                    Rp <?= number_format($originalPrice, 0, ',', '.') ?>
                                </td>

                                <!-- Diskon Input -->
                                <td style="padding: 12px 16px; text-align: center;">
                                    <div style="display: inline-flex; align-items: center; gap: 6px;">
                                        <input type="number" name="flash_discounts[<?= $pId ?>]" id="discount_<?= $pId ?>" value="<?= $discountPercent ?>" min="1" max="99" class="form-control discount-input" style="width: 70px; text-align: center; font-weight: 800; color: #0284c7;" oninput="recalcRow(<?= $pId ?>, <?= $originalPrice ?>)">
                                        <span style="font-weight: 700; color: #64748b;">%</span>
                                    </div>
                                </td>

                                <!-- Harga Flash Sale Live -->
                                <td style="padding: 12px 16px; text-align: right; font-weight: 800; color: #0284c7; font-size: 14px;" id="flashPrice_<?= $pId ?>">
                                    Rp <?= number_format($flashPrice, 0, ',', '.') ?>
                                </td>

                                <!-- Preview Badge -->
                                <td style="padding: 12px 16px; text-align: center;">
                                    <span id="badge_<?= $pId ?>" style="display: inline-block; background: #ef4444; color: #ffffff; font-weight: 800; font-size: 11.5px; padding: 3px 8px; border-radius: 4px; box-shadow: 0 1px 3px rgba(239, 68, 68, 0.3);">
                                        -<?= $discountPercent ?>%
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 14px; display: flex; justify-content: space-between; align-items: center; font-size: 12.5px; color: #64748b;">
                <span>Total <b id="totalCheckedCount"><?= count(array_filter(array_keys($flashProductsConfig ?? []), fn($id) => in_array($id, array_column($products, 'id')))) ?></b> produk terpilih untuk Flash Sale.</span>
                <span>* Harga flash sale dibulatkan ke kelipatan seratus terdekat secara otomatis.</span>
            </div>
        </div>

        <!-- TOMBOL SIMPAN -->
        <div style="display: flex; gap: 14px; justify-content: flex-end; align-items: center; padding-top: 10px;">
            <a href="<?= BASEURL ?>admin" class="btn-admin btn-secondary-admin" style="padding: 11px 22px;">
                Batal
            </a>
            <button type="submit" class="btn-admin" style="display: inline-flex; align-items: center; gap: 8px; padding: 11px 28px; font-weight: 700; font-size: 14px; box-shadow: 0 2px 8px rgba(2, 132, 199, 0.3);">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                <span>Simpan Pengaturan Flash Sale</span>
            </button>
        </div>

    </form>
</div>

<style>
.row-selected {
    background: #f0f9ff !important;
}
.row-selected:hover {
    background: #e0f2fe !important;
}
</style>

<script>
// Format angka ke format Rupiah
function formatRupiah(number) {
    return 'Rp ' + Math.round(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Recalculate row flash price & badge
function recalcRow(id, originalPrice) {
    const input = document.getElementById('discount_' + id);
    let disc = parseInt(input.value) || 0;
    if (disc < 1) disc = 1;
    if (disc > 99) disc = 99;

    let flashPrice = Math.round(originalPrice * (1 - (disc / 100)));
    flashPrice = Math.round(flashPrice / 100) * 100;

    const priceEl = document.getElementById('flashPrice_' + id);
    const badgeEl = document.getElementById('badge_' + id);

    if (priceEl) priceEl.textContent = formatRupiah(flashPrice);
    if (badgeEl) badgeEl.textContent = '-' + disc + '%';
}

// Row Check Changed
function onRowCheckChanged(id) {
    const row = document.getElementById('row_' + id);
    const cb = row.querySelector('.item-checkbox');
    if (cb.checked) {
        row.classList.add('row-selected');
    } else {
        row.classList.remove('row-selected');
    }
    updateCheckedCount();
}

// Select All / Deselect All
function selectAllProducts(select) {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = select;
        const row = cb.closest('tr');
        if (select) {
            row.classList.add('row-selected');
        } else {
            row.classList.remove('row-selected');
        }
    });
    const master = document.getElementById('masterCheckbox');
    if (master) master.checked = select;
    updateCheckedCount();
}

function toggleMaster(master) {
    selectAllProducts(master.checked);
}

function updateCheckedCount() {
    const checked = document.querySelectorAll('.item-checkbox:checked').length;
    const countEl = document.getElementById('totalCheckedCount');
    if (countEl) countEl.textContent = checked;
}

// Apply Bulk Discount to Checked Items
function applyBulkDiscount() {
    const bulkInput = document.getElementById('bulkDiscountVal');
    let bulkVal = parseInt(bulkInput.value) || 50;
    if (bulkVal < 1) bulkVal = 1;
    if (bulkVal > 99) bulkVal = 99;

    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Silakan centang minimal satu produk terlebih dahulu untuk menerapkan diskon massal!');
        return;
    }

    checkboxes.forEach(cb => {
        const id = cb.value;
        const discInput = document.getElementById('discount_' + id);
        if (discInput) {
            discInput.value = bulkVal;
            const priceCell = cb.closest('tr').querySelector('[data-price]');
            const origPrice = parseInt(priceCell.getAttribute('data-price')) || 0;
            recalcRow(id, origPrice);
        }
    });
}

// Date Presets
function pad(n) { return n < 10 ? '0' + n : n; }

function formatDateTimeForInput(d) {
    return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()) + 'T' + pad(d.getHours()) + ':' + pad(d.getMinutes());
}

function addHoursToTarget(hours) {
    const target = new Date(Date.now() + hours * 3600 * 1000);
    document.getElementById('flashEndTimeInput').value = formatDateTimeForInput(target);
    updateLiveRemaining();
}

function setTargetTonight() {
    const target = new Date();
    target.setHours(23, 59, 0, 0);
    document.getElementById('flashEndTimeInput').value = formatDateTimeForInput(target);
    updateLiveRemaining();
}

function setTargetTomorrowNight() {
    const target = new Date(Date.now() + 24 * 3600 * 1000);
    target.setHours(23, 59, 0, 0);
    document.getElementById('flashEndTimeInput').value = formatDateTimeForInput(target);
    updateLiveRemaining();
}

// Update Remaining Badge
function updateLiveRemaining() {
    const input = document.getElementById('flashEndTimeInput');
    const badge = document.getElementById('remainingBadge');
    if (!input || !badge) return;

    const target = new Date(input.value).getTime();
    const now = Date.now();
    const diff = target - now;

    if (isNaN(target)) {
        badge.textContent = 'Format tanggal tidak valid';
        badge.style.background = '#fee2e2';
        badge.style.color = '#991b1b';
        return;
    }

    if (diff <= 0) {
        badge.textContent = '⚠️ Waktu sudah terlewat (Berakhir)';
        badge.style.background = '#fee2e2';
        badge.style.color = '#991b1b';
    } else {
        const hours = Math.floor(diff / (3600 * 1000));
        const mins = Math.floor((diff % (3600 * 1000)) / (60 * 1000));
        badge.textContent = '⏳ Sisa Waktu: ' + hours + ' Jam ' + mins + ' Menit lagi';
        badge.style.background = '#e0f2fe';
        badge.style.color = '#0369a1';
    }
}

function updateStatusBorder() {
    const activeChecked = document.querySelector('input[name="flash_sale_active"]:checked').value === '1';
    document.getElementById('labelActive').style.borderColor = activeChecked ? '#0284c7' : '#cbd5e1';
    document.getElementById('labelInactive').style.borderColor = !activeChecked ? '#0284c7' : '#cbd5e1';
}

// Run on page load
document.addEventListener('DOMContentLoaded', () => {
    updateLiveRemaining();
    updateCheckedCount();
});
</script>
