<div class="seller-card">
    <div class="seller-card-header">
        <div>
            <h3>Kurir List / Ekspedisi (<?= count($couriers ?? []) ?> Kurir)</h3>
            <p style="color: var(--seller-text-muted); font-size: 13.5px; margin: 4px 0 0 0;">
                Kelola mitra logistik, tarif dasar ongkos kirim, dan status pengiriman yang tersedia untuk pembeli.
            </p>
        </div>
        <button type="button" class="btn-seller btn-primary-seller" onclick="openAddCourierModal()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Tambah Kurir</span>
        </button>
    </div>

    <div class="seller-table-wrap">
        <table class="seller-table">
            <thead>
                <tr>
                    <th>Nama Ekspedisi & Kode</th>
                    <th>Jenis Layanan</th>
                    <th>Tarif Dasar</th>
                    <th>Estimasi Waktu</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($couriers)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--seller-text-muted);">
                        Belum ada data kurir pengiriman. Klik tombol "Tambah Kurir" untuk menambahkan mitra logistik.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($couriers as $c): ?>
                    <tr>
                        <td>
                            <strong style="color: #0f172a; font-size: 14px;">
                                <?= htmlspecialchars($c['name']) ?>
                            </strong>
                            <div style="margin-top: 3px;">
                                <span style="background: #f1f5f9; color: #475569; font-size: 11px; padding: 2px 7px; border-radius: 4px; font-weight: 700; border: 1px solid #e2e8f0; font-family: monospace;">
                                    <?= htmlspecialchars($c['code']) ?>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b; font-size: 13.5px;">
                                <?= htmlspecialchars($c['service_type']) ?>
                            </div>
                            <small style="color: var(--seller-text-muted); font-size: 11.5px;">
                                <?= htmlspecialchars($c['description'] ?? '') ?>
                            </small>
                        </td>
                        <td>
                            <strong style="color: #059669; font-size: 14px;">
                                Rp <?= number_format($c['base_rate'], 0, ',', '.') ?>
                            </strong>
                        </td>
                        <td>
                            <span style="display: inline-flex; align-items: center; gap: 5px; background: #f8fafc; padding: 4px 10px; border-radius: 6px; font-size: 12.5px; color: #475569; border: 1px solid #e2e8f0; font-weight: 500;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #64748b; flex-shrink: 0;">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span><?= htmlspecialchars($c['estimated_days']) ?></span>
                            </span>
                        </td>
                        <td>
                            <?php if ($c['status'] === 'active'): ?>
                            <a href="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/courierToggle/<?= $c['id'] ?>" class="status-badge badge-active" title="Klik untuk nonaktifkan">
                                <span class="status-dot dot-active"></span>
                                <span>Aktif</span>
                            </a>
                            <?php else: ?>
                            <a href="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/courierToggle/<?= $c['id'] ?>" class="status-badge badge-inactive" title="Klik untuk aktifkan">
                                <span class="status-dot dot-inactive"></span>
                                <span>Nonaktif</span>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <button type="button" class="btn-seller btn-secondary-seller btn-sm-seller" onclick='openEditCourierModal(<?= json_encode($c) ?>)' style="margin-right: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <a href="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/courierDelete/<?= $c['id'] ?>" class="btn-seller btn-danger-seller btn-sm-seller" onclick="return confirm('Hapus kurir <?= addslashes(htmlspecialchars($c['name'])) ?>?');">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH KURIR -->
<div id="addCourierModal" class="custom-modal-backdrop" style="display: none;">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h4>Tambah Mitra Kurir Pengiriman</h4>
            <button type="button" class="close-modal-btn" onclick="closeAddCourierModal()">&times;</button>
        </div>
        <form action="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/courierAdd" method="POST">
            <div class="custom-modal-body">
                <div class="courier-modal-grid" style="margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Ekspedisi *</label>
                        <input type="text" name="name" required placeholder="Contoh: JNE Express" class="form-input-white">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Kode Kurir *</label>
                        <input type="text" name="code" required placeholder="JNE-REG" class="form-input-white">
                    </div>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Jenis Layanan *</label>
                    <input type="text" name="service_type" required placeholder="Contoh: Reguler / Next Day" class="form-input-white">
                </div>
                <div class="courier-modal-grid-2" style="margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Tarif Dasar (Rp) *</label>
                        <input type="number" name="base_rate" required placeholder="18000" class="form-input-white">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Estimasi Hari *</label>
                        <input type="text" name="estimated_days" required placeholder="2-3 Hari" class="form-input-white">
                    </div>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Status Awal</label>
                    <select name="status" class="form-input-white">
                        <option value="active">Aktif (Tersedia saat checkout)</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Deskripsi Layanan</label>
                    <input type="text" name="description" placeholder="Catatan jangkauan atau syarat kirim..." class="form-input-white">
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-seller btn-secondary-seller" onclick="closeAddCourierModal()">Batal</button>
                <button type="submit" class="btn-seller btn-primary-seller">Simpan Kurir</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT KURIR -->
<div id="editCourierModal" class="custom-modal-backdrop" style="display: none;">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h4>Edit Mitra Kurir</h4>
            <button type="button" class="close-modal-btn" onclick="closeEditCourierModal()">&times;</button>
        </div>
        <form id="editCourierForm" action="" method="POST">
            <div class="custom-modal-body">
                <div class="courier-modal-grid" style="margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Ekspedisi *</label>
                        <input type="text" name="name" id="editCourierName" required class="form-input-white">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Kode Kurir *</label>
                        <input type="text" name="code" id="editCourierCode" required class="form-input-white">
                    </div>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Jenis Layanan *</label>
                    <input type="text" name="service_type" id="editCourierService" required class="form-input-white">
                </div>
                <div class="courier-modal-grid-2" style="margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Tarif Dasar (Rp) *</label>
                        <input type="number" name="base_rate" id="editCourierRate" required class="form-input-white">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Estimasi Hari *</label>
                        <input type="text" name="estimated_days" id="editCourierDays" required class="form-input-white">
                    </div>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Status</label>
                    <select name="status" id="editCourierStatus" class="form-input-white">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Deskripsi Layanan</label>
                    <input type="text" name="description" id="editCourierDesc" class="form-input-white">
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-seller btn-secondary-seller" onclick="closeEditCourierModal()">Batal</button>
                <button type="submit" class="btn-seller btn-primary-seller">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<style>
.form-input-white {
    width: 100%;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    color: #0f172a;
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
    font-family: inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-input-white:focus {
    border-color: #0284c7;
    outline: none;
    box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
}
.custom-modal-backdrop {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
}
.custom-modal-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    width: 92%;
    max-width: 520px;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}
.custom-modal-box form {
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}
.custom-modal-header {
    padding: 18px 22px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
}
.custom-modal-header h4 {
    margin: 0;
    font-size: 17px;
    color: #0f172a;
    font-weight: 700;
}
.close-modal-btn {
    background: transparent;
    border: none;
    color: #64748b;
    font-size: 22px;
    cursor: pointer;
}
.close-modal-btn:hover {
    color: #0f172a;
}
.custom-modal-body {
    padding: 22px;
    background: #ffffff;
}
.custom-modal-footer {
    padding: 16px 22px;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    background: #f8fafc;
}
</style>

<script>
function openAddCourierModal() {
    document.getElementById('addCourierModal').style.display = 'flex';
}
function closeAddCourierModal() {
    document.getElementById('addCourierModal').style.display = 'none';
}
function openEditCourierModal(c) {
    document.getElementById('editCourierForm').action = '<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/courierEdit/' + c.id;
    document.getElementById('editCourierName').value = c.name || '';
    document.getElementById('editCourierCode').value = c.code || '';
    document.getElementById('editCourierService').value = c.service_type || '';
    document.getElementById('editCourierRate').value = c.base_rate || 0;
    document.getElementById('editCourierDays').value = c.estimated_days || '';
    document.getElementById('editCourierStatus').value = c.status || 'active';
    document.getElementById('editCourierDesc').value = c.description || '';
    document.getElementById('editCourierModal').style.display = 'flex';
}
function closeEditCourierModal() {
    document.getElementById('editCourierModal').style.display = 'none';
}
</script>
