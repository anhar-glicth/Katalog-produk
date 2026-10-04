<div class="seller-card">
    <div class="seller-card-header">
        <div>
            <h3>Katalog Produk Toko Saya (<?= count($products) ?> Produk)</h3>
            <p style="color: var(--seller-text-muted); font-size: 13.5px; margin: 4px 0 0 0;">
                Kelola koleksi perhiasan dan produk yang dijual khusus oleh toko <strong><?= htmlspecialchars($user['store_name'] ?? 'Toko Anda') ?></strong>.
            </p>
        </div>
        <a href="<?= BASEURL ?>seller/productAdd" class="btn-seller btn-primary-seller">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Tambah Produk Baru</span>
        </a>
    </div>

    <div class="seller-table-wrap">
        <table class="seller-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Foto</th>
                    <th>Nama Produk & Kategori</th>
                    <th>Harga Jual / Diskon</th>
                    <th>Rating & Ulasan</th>
                    <th>Varian</th>
                    <th>Banner Beranda</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 50px 20px; color: var(--seller-text-muted);">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 12px; opacity: 0.5;">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <div style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Belum Ada Produk di Toko Anda</div>
                        <p style="margin: 0 0 16px 0; font-size: 13px;">Mulai tambahkan produk pertama Anda agar pembeli dapat melihat dan memesannya di Lumina Pearl.</p>
                        <a href="<?= BASEURL ?>seller/productAdd" class="btn-seller btn-primary-seller">
                            &plus; Tambah Produk Sekarang
                        </a>
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                    <tr>
                        <td>
                            <img src="<?= BASEURL ?><?= htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" style="width: 54px; height: 54px; object-fit: cover; border-radius: 8px; border: 1px solid var(--seller-border); background: #f8fafc;">
                        </td>
                        <td>
                            <strong style="color: #0f172a; font-size: 14.5px;">
                                <?= htmlspecialchars($p['title']) ?>
                            </strong>
                            <div style="display: flex; gap: 8px; align-items: center; margin-top: 5px; flex-wrap: wrap;">
                                <span style="background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd; font-size: 11px; padding: 2px 7px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                    <?= render_category_icon($p['category_icon'] ?? 'tag', 14) ?> <?= htmlspecialchars($p['category_name'] ?? 'Kategori') ?>
                                </span>
                                <?php if (!empty($p['badge'])): ?>
                                <span style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a; font-size: 11px; padding: 2px 7px; border-radius: 4px; font-weight: 600;">
                                    <?= htmlspecialchars($p['badge']) ?>
                                </span>
                                <?php endif; ?>
                                <span style="color: var(--seller-text-muted); font-size: 11.5px;">ID: #<?= $p['id'] ?></span>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--seller-accent); font-size: 14px;"><?= $p['formatted_price'] ?></div>
                            <?php if (!empty($p['original_price'])): ?>
                            <div style="font-size: 12px; color: var(--seller-text-muted); text-decoration: line-through;">
                                <?= $p['formatted_original_price'] ?> (<?= htmlspecialchars($p['discount'] ?? '') ?>)
                            </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="color: #d97706; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 4px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="#d97706" stroke="#d97706"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> <?= number_format($p['rating'], 1) ?>
                            </div>
                            <span style="color: var(--seller-text-muted); font-size: 11.5px;"><?= $p['reviews_count'] ?> ulasan</span>
                        </td>
                        <td>
                            <span style="color: var(--seller-text-muted); font-size: 12.5px;">
                                <?= count($p['colors'] ?? []) ?> Warna &bull; <?= count($p['sizes'] ?? []) ?> Ukuran
                            </span>
                        </td>
                        <td>
                            <?php if (!empty($p['is_featured'])): ?>
                            <a href="<?= BASEURL ?>seller/toggleFeatured/<?= $p['id'] ?>" class="btn-seller" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 11.5px; padding: 4px 10px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; text-decoration: none;" title="Klik untuk melepas dari Hero Slider Beranda">
                                <span>⭐</span> Tampil di Hero
                            </a>
                            <?php else: ?>
                            <a href="<?= BASEURL ?>seller/toggleFeatured/<?= $p['id'] ?>" class="btn-seller" style="background: #f8fafc; color: #64748b; border: 1px solid #cbd5e1; font-size: 11.5px; padding: 4px 10px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 5px; text-decoration: none;" title="Klik untuk menampilkan di Hero Slider Beranda">
                                <span style="opacity: 0.6;">➕</span> Pasang di Hero
                            </a>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <a href="<?= BASEURL ?>product/detail/<?= $p['id'] ?>" target="_blank" class="btn-seller btn-secondary-seller btn-sm-seller" title="Lihat di Toko Publik">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </a>
                            <a href="<?= BASEURL ?>seller/productEdit/<?= $p['id'] ?>" class="btn-seller btn-secondary-seller btn-sm-seller">
                                Edit
                            </a>
                            <a href="<?= BASEURL ?>seller/productDelete/<?= $p['id'] ?>" class="btn-seller btn-danger-seller btn-sm-seller" onclick="return confirm('Apakah Anda yakin ingin menghapus produk \'<?= addslashes(htmlspecialchars($p['title'])) ?>\' dari toko Anda?');">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
