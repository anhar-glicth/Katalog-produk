<div class="seller-card">
    <div class="seller-card-header" style="flex-wrap: wrap; gap: 16px;">
        <div>
            <h3>User Management (<?= count($users ?? []) ?> Pengguna)</h3>
            <p style="color: var(--seller-text-muted); font-size: 13.5px; margin: 4px 0 0 0;">
                Kelola hak akses pengguna, mitra penjual (seller), pembeli (buyer), dan administrator sistem.
            </p>
        </div>
        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <!-- Filter Role -->
            <form action="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/users" method="GET" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                <select name="role" onchange="this.form.submit()" class="form-control" style="width: auto; padding: 8px 12px; font-size: 13px;">
                    <option value="">Semua Peran (All Roles)</option>
                    <option value="admin" <?= ($currentRole ?? '') === 'admin' ? 'selected' : '' ?>>Administrator</option>
                    <option value="seller" <?= ($currentRole ?? '') === 'seller' ? 'selected' : '' ?>>Mitra Penjual</option>
                    <option value="buyer" <?= ($currentRole ?? '') === 'buyer' ? 'selected' : '' ?>>Pembeli</option>
                </select>
                <input type="text" name="search" value="<?= htmlspecialchars($searchKeyword ?? '') ?>" placeholder="Cari nama/email..." class="form-control" style="width: 170px; padding: 8px 12px; font-size: 13px;">
                <button type="submit" class="btn-seller btn-secondary-seller" style="padding: 8px 14px;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span>Cari</span>
                </button>
            </form>
            <button type="button" class="btn-seller btn-primary-seller" onclick="openAddUserModal()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Pengguna</span>
            </button>
        </div>
    </div>

    <div class="seller-table-wrap">
        <table class="seller-table">
            <thead>
                <tr>
                    <th style="width: 50px;">Profil</th>
                    <th>Nama & Kontak</th>
                    <th>Peran / Role</th>
                    <th>Nama Toko (Penjual)</th>
                    <th>Terdaftar Sejak</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--seller-text-muted);">
                        Tidak ada pengguna ditemukan.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td>
                            <div style="width: 38px; height: 38px; border-radius: 50%; background: #e0f2fe; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #0284c7; font-size: 14px; border: 1px solid #bae6fd;">
                                <?= strtoupper(substr($u['name'] ?? 'U', 0, 1)) ?>
                            </div>
                        </td>
                        <td>
                            <strong style="color: #0f172a; font-size: 14px;">
                                <?= htmlspecialchars($u['name']) ?>
                            </strong>
                            <div style="display: flex; align-items: center; gap: 6px; color: var(--seller-text-muted); font-size: 12px; margin-top: 3px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span><?= htmlspecialchars($u['email']) ?></span>
                            </div>
                            <?php if (!empty($u['phone'])): ?>
                            <div style="display: flex; align-items: center; gap: 6px; color: var(--seller-text-muted); font-size: 11.5px; margin-top: 2px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span><?= htmlspecialchars($u['phone']) ?></span>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($u['role'] === 'admin'): ?>
                                <span class="status-badge" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                    <span>Administrator</span>
                                </span>
                            <?php elseif ($u['role'] === 'seller'): ?>
                                <span class="status-badge" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0;">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                    <span>Mitra Penjual</span>
                                </span>
                            <?php else: ?>
                                <span class="status-badge" style="background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd;">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                    <span>Pembeli</span>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($u['store_name'])): ?>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" style="flex-shrink: 0;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <strong style="color: #1e293b; font-size: 13px;"><?= htmlspecialchars($u['store_name']) ?></strong>
                                </div>
                            <?php else: ?>
                                <span style="color: var(--seller-text-muted); font-size: 12px;">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span style="color: var(--seller-text-muted); font-size: 12px;">
                                <?= date('d M Y', strtotime($u['created_at'] ?? 'now')) ?>
                            </span>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <button type="button" class="btn-seller btn-secondary-seller btn-sm-seller" onclick='openEditUserModal(<?= json_encode($u) ?>)' style="margin-right: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <?php 
                            $currentUserId = $_SESSION['user']['id'] ?? 0;
                            if ((int)$u['id'] !== (int)$currentUserId): 
                            ?>
                            <a href="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/userDelete/<?= $u['id'] ?>" class="btn-seller btn-danger-seller btn-sm-seller" onclick="return confirm('Hapus akun <?= addslashes(htmlspecialchars($u['name'])) ?>?');">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                <span>Hapus</span>
                            </a>
                            <?php else: ?>
                            <span style="font-size: 11px; color: var(--seller-text-muted); margin-left: 6px;">(Akun Anda)</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH USER -->
<div id="addUserModal" class="custom-modal-backdrop" style="display: none;">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h4>Tambah Pengguna Baru</h4>
            <button type="button" class="close-modal-btn" onclick="closeAddUserModal()">&times;</button>
        </div>
        <form action="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/userAdd" method="POST">
            <div class="custom-modal-body">
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Lengkap *</label>
                    <input type="text" name="name" required placeholder="Contoh: Andi Wijaya" class="form-control">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email *</label>
                        <input type="email" name="email" required placeholder="andi@example.com" class="form-control">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nomor Telepon / WA</label>
                        <input type="text" name="phone" placeholder="08123456789" class="form-control">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Peran (Role) *</label>
                        <select name="role" id="newRoleSelect" onchange="toggleStoreField(this.value, 'newStoreField')" class="form-control">
                            <option value="buyer">Pembeli (Buyer)</option>
                            <option value="seller">Mitra Penjual (Seller)</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Kata Sandi *</label>
                        <input type="password" name="password" required placeholder="Minimal 6 karakter" class="form-control">
                    </div>
                </div>
                <div id="newStoreField" style="margin-bottom: 14px; display: none;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Toko (Khusus Penjual)</label>
                    <input type="text" name="store_name" placeholder="Contoh: Pearl Luxury Boutique" class="form-control">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Alamat</label>
                    <textarea name="address" rows="2" placeholder="Alamat lengkap..." class="form-control"></textarea>
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-seller btn-secondary-seller" onclick="closeAddUserModal()">Batal</button>
                <button type="submit" class="btn-seller btn-primary-seller">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT USER -->
<div id="editUserModal" class="custom-modal-backdrop" style="display: none;">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h4>Edit Pengguna</h4>
            <button type="button" class="close-modal-btn" onclick="closeEditUserModal()">&times;</button>
        </div>
        <form id="editUserForm" action="" method="POST">
            <div class="custom-modal-body">
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Lengkap *</label>
                    <input type="text" name="name" id="editUserName" required class="form-control">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email *</label>
                        <input type="email" name="email" id="editUserEmail" required class="form-control">
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nomor Telepon</label>
                        <input type="text" name="phone" id="editUserPhone" class="form-control">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Peran (Role) *</label>
                        <select name="role" id="editUserRole" onchange="toggleStoreField(this.value, 'editStoreField')" class="form-control">
                            <option value="buyer">Pembeli (Buyer)</option>
                            <option value="seller">Mitra Penjual (Seller)</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Ganti Password (Opsional)</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ubah" class="form-control">
                    </div>
                </div>
                <div id="editStoreField" style="margin-bottom: 14px; display: none;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Toko (Khusus Penjual)</label>
                    <input type="text" name="store_name" id="editUserStore" class="form-control">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Alamat</label>
                    <textarea name="address" id="editUserAddress" rows="2" class="form-control"></textarea>
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-seller btn-secondary-seller" onclick="closeEditUserModal()">Batal</button>
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
    width: 90%;
    max-width: 520px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    overflow: hidden;
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
function toggleStoreField(role, fieldId) {
    var field = document.getElementById(fieldId);
    if (field) {
        field.style.display = (role === 'seller') ? 'block' : 'none';
    }
}
function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'flex';
}
function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}
function openEditUserModal(u) {
    document.getElementById('editUserForm').action = '<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/userEdit/' + u.id;
    document.getElementById('editUserName').value = u.name || '';
    document.getElementById('editUserEmail').value = u.email || '';
    document.getElementById('editUserPhone').value = u.phone || '';
    document.getElementById('editUserRole').value = u.role || 'buyer';
    document.getElementById('editUserStore').value = u.store_name || '';
    document.getElementById('editUserAddress').value = u.address || '';
    toggleStoreField(u.role, 'editStoreField');
    document.getElementById('editUserModal').style.display = 'flex';
}
function closeEditUserModal() {
    document.getElementById('editUserModal').style.display = 'none';
}
</script>
