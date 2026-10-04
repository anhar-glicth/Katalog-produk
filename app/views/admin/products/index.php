<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3>Katalog Produk (<?= count($products) ?> Produk)</h3>
            <p style="color: var(--admin-text-muted); font-size: 13px; margin: 4px 0 0 0;">
                Kelola informasi produk, harga, varian, dan spesifikasi yang tampil di toko online.
            </p>
        </div>
        <a href="<?= BASEURL ?>admin/productAdd" class="btn-admin btn-primary-admin">
            <span>&plus;</span> Tambah Produk Baru
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 60px;">Foto</th>
                    <th>Nama & Badge</th>
                    <th>Harga Normal / Diskon</th>
                    <th>Rating</th>
                    <th>Varian</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                <tr>
                    <td>
                        <img src="<?= BASEURL ?><?= htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid var(--admin-border); background: #f8fafc;">
                    </td>
                    <td>
                        <strong style="color: var(--admin-text-main); font-size: 14px;">
                            <?= htmlspecialchars($p['title']) ?>
                        </strong>
                        <div style="display: flex; gap: 6px; align-items: center; margin-top: 4px; flex-wrap: wrap;">
                            <span style="background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd; font-size: 11px; padding: 2px 6px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                <?= render_category_icon($p['category_icon'] ?? 'tag', 14) ?> <?= htmlspecialchars($p['category_name'] ?? 'Kategori') ?>
                            </span>
                            <?php if (!empty($p['badge'])): ?>
                            <span style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a; font-size: 11px; padding: 2px 6px; border-radius: 4px; font-weight: 600;">
                                <?= htmlspecialchars($p['badge']) ?>
                            </span>
                            <?php endif; ?>
                            <span style="color: var(--admin-text-muted); font-size: 11px;">ID: #<?= $p['id'] ?></span>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: var(--admin-accent);"><?= $p['formatted_price'] ?></div>
                        <?php if (!empty($p['original_price'])): ?>
                        <div style="font-size: 12px; color: var(--admin-text-muted); text-decoration: line-through;">
                            <?= $p['formatted_original_price'] ?> (<?= htmlspecialchars($p['discount'] ?? '') ?>)
                        </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="color: #d97706; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 4px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="#d97706" stroke="#d97706"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> <?= number_format($p['rating'], 1) ?>
                        </div>
                        <span style="color: var(--admin-text-muted); font-size: 11px;"><?= $p['reviews_count'] ?> ulasan</span>
                    </td>
                    <td>
                        <span style="color: var(--admin-text-muted); font-size: 12px;">
                            <?= count($p['colors'] ?? []) ?> Warna &bull; <?= count($p['sizes'] ?? []) ?> Ukuran
                        </span>
                    </td>
                    <td style="text-align: right; white-space: nowrap;">
                        <a href="<?= BASEURL ?>product/detail/<?= $p['id'] ?>" target="_blank" class="btn-admin btn-secondary-admin" style="padding: 6px 10px; font-size: 12px; display: inline-flex; align-items: center;" title="Lihat Tampilan Pembeli">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                        <a href="<?= BASEURL ?>admin/productEdit/<?= $p['id'] ?>" class="btn-admin btn-secondary-admin" style="padding: 6px 12px; font-size: 12px;">
                            Edit
                        </a>
                        <a href="<?= BASEURL ?>admin/productDelete/<?= $p['id'] ?>" class="btn-admin btn-danger-admin" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Apakah Anda yakin ingin menghapus produk \'<?= addslashes(htmlspecialchars($p['title'])) ?>\'?');">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
