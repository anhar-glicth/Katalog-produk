<div class="seller-card">
    <div class="seller-card-header">
        <div>
            <h3>Produk Kategori (<?= count($categories ?? []) ?> Kategori)</h3>
            <p style="color: var(--seller-text-muted); font-size: 13.5px; margin: 4px 0 0 0;">
                Kelola kelompok dan segmentasi produk untuk memudahkan pembeli menavigasi katalog toko.
            </p>
        </div>
        <button type="button" class="btn-seller btn-primary-seller" onclick="openAddCategoryModal()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Tambah Kategori</span>
        </button>
    </div>

    <div class="seller-table-wrap">
        <table class="seller-table">
            <thead>
                <tr>
                    <th style="width: 50px;">Ikon</th>
                    <th>Nama Kategori</th>
                    <th>Slug URL</th>
                    <th>Deskripsi</th>
                    <th style="text-align: center;">Jumlah Produk</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--seller-text-muted);">
                        Belum ada kategori produk. Klik tombol "Tambah Kategori" untuk membuat kategori pertama.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td style="text-align: center;">
                            <div class="cat-icon-box">
                                <?= render_category_icon($cat['icon'] ?? $cat['slug'] ?? 'sparkles', 20) ?>
                            </div>
                        </td>
                        <td>
                            <strong style="color: #0f172a; font-size: 14px;">
                                <?= htmlspecialchars($cat['name']) ?>
                            </strong>
                            <div style="color: #64748b; font-size: 11px;">ID: #<?= $cat['id'] ?></div>
                        </td>
                        <td>
                            <code style="background: #f1f5f9; padding: 3px 8px; border-radius: 4px; color: #0284c7; border: 1px solid #e2e8f0; font-size: 12px;">
                                <?= htmlspecialchars($cat['slug']) ?>
                            </code>
                        </td>
                        <td style="color: #64748b; font-size: 13px; max-width: 300px;">
                            <?= htmlspecialchars($cat['description'] ?? '-') ?>
                        </td>
                        <td style="text-align: center;">
                            <span style="display: inline-block; background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd; font-weight: 700; padding: 3px 10px; border-radius: 20px; font-size: 12px;">
                                <?= (int)($cat['total_products'] ?? 0) ?> Produk
                            </span>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <button type="button" class="btn-seller btn-secondary-seller btn-sm-seller" onclick='openEditCategoryModal(<?= json_encode($cat) ?>)' style="margin-right: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <a href="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/categoryDelete/<?= $cat['id'] ?>" class="btn-seller btn-danger-seller btn-sm-seller" onclick="return confirm('Hapus kategori <?= addslashes(htmlspecialchars($cat['name'])) ?>? Produk dalam kategori ini tidak akan terhapus.');">
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

<!-- MODAL TAMBAH KATEGORI -->
<div id="addCategoryModal" class="custom-modal-backdrop" style="display: none;">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h4>Tambah Kategori Produk</h4>
            <button type="button" class="close-modal-btn" onclick="closeAddCategoryModal()">&times;</button>
        </div>
        <form action="<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/categoryAdd" method="POST">
            <div class="custom-modal-body">
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Kategori *</label>
                    <input type="text" name="name" required placeholder="Contoh: Lampu Keramik Samudra" class="form-control">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Pilihan Ikon Vektor</label>
                    <select name="icon" class="form-control">
                        <option value="sparkles">Sparkles (Mutiara & Kilau)</option>
                        <option value="lamp">Lamp (Lampu & Pencahayaan)</option>
                        <option value="shell">Shell (Cangkang Kerang Alami)</option>
                        <option value="crown">Crown (Koleksi Mewah / Royal)</option>
                        <option value="gem">Gem (Permata & Mutiara Air Laut)</option>
                        <option value="box">Box (Aksesoris & Nampan Tray)</option>
                        <option value="tag">Tag (Kategori Umum)</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" placeholder="Jelaskan jenis perhiasan atau produk dalam kategori ini..." class="form-control"></textarea>
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-seller btn-secondary-seller" onclick="closeAddCategoryModal()">Batal</button>
                <button type="submit" class="btn-seller btn-primary-seller">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT KATEGORI -->
<div id="editCategoryModal" class="custom-modal-backdrop" style="display: none;">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h4>Edit Kategori Produk</h4>
            <button type="button" class="close-modal-btn" onclick="closeEditCategoryModal()">&times;</button>
        </div>
        <form id="editCategoryForm" action="" method="POST">
            <div class="custom-modal-body">
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Kategori *</label>
                    <input type="text" name="name" id="editCatName" required class="form-control">
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Pilihan Ikon Vektor</label>
                    <select name="icon" id="editCatIcon" class="form-control">
                        <option value="sparkles">Sparkles (Mutiara & Kilau)</option>
                        <option value="lamp">Lamp (Lampu & Pencahayaan)</option>
                        <option value="shell">Shell (Cangkang Kerang Alami)</option>
                        <option value="crown">Crown (Koleksi Mewah / Royal)</option>
                        <option value="gem">Gem (Permata & Mutiara Air Laut)</option>
                        <option value="box">Box (Aksesoris & Nampan Tray)</option>
                        <option value="tag">Tag (Kategori Umum)</option>
                    </select>
                </div>
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Deskripsi Singkat</label>
                    <textarea name="description" id="editCatDesc" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-seller btn-secondary-seller" onclick="closeEditCategoryModal()">Batal</button>
                <button type="submit" class="btn-seller btn-primary-seller">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<style>
.form-input-dark {
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
.form-input-dark:focus {
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
    max-width: 480px;
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
function openAddCategoryModal() {
    document.getElementById('addCategoryModal').style.display = 'flex';
}
function closeAddCategoryModal() {
    document.getElementById('addCategoryModal').style.display = 'none';
}
function openEditCategoryModal(cat) {
    document.getElementById('editCategoryForm').action = '<?= BASEURL ?><?= !empty($isAdminView) ? 'admin' : 'seller' ?>/categoryEdit/' + cat.id;
    document.getElementById('editCatName').value = cat.name || '';
    document.getElementById('editCatIcon').value = cat.icon || 'sparkles';
    document.getElementById('editCatDesc').value = cat.description || '';
    document.getElementById('editCategoryModal').style.display = 'flex';
}
function closeEditCategoryModal() {
    document.getElementById('editCategoryModal').style.display = 'none';
}
</script>
