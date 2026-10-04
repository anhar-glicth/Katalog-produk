    <!-- BREADCRUMBS BAR -->
    <div class="pdp-breadcrumbs-bar" style="background: #111e2e; border-bottom: 1px solid #1e3a5f; padding: 14px 0;">
        <div class="container" style="display: flex; align-items: center; gap: 8px; font-size: 0.88em; color: #94a3b8;">
            <a href="<?= BASEURL ?>" style="color: #94a3b8; text-decoration: none;">Beranda</a>
            <span>&rsaquo;</span>
            <a href="<?= BASEURL ?>#koleksi" style="color: #94a3b8; text-decoration: none;">Koleksi</a>
            <span>&rsaquo;</span>
            <span style="color: #38bdf8; font-weight: 500;" id="pdpBreadcrumbTitle"><?= htmlspecialchars($product['title']) ?></span>
        </div>
    </div>

    <!-- MAIN PRODUCT SHOWCASE SECTION -->
    <main class="pdp-main-section">
        <div class="container">
            <div class="pdp-hero-grid">
                <!-- Left: Gallery & Stage -->
                <div class="pdp-gallery">
                    <div class="pdp-thumbnails" id="pdpThumbnailsList">
                        <?php foreach ($product['thumbnails'] as $idx => $thumb): ?>
                        <div class="pdp-thumb <?= $idx === 0 ? 'active' : '' ?>" onclick="switchPdpThumb(this, '<?= BASEURL ?><?= htmlspecialchars($thumb) ?>')">
                            <img src="<?= BASEURL ?><?= htmlspecialchars($thumb) ?>" alt="Thumbnail <?= $idx + 1 ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pdp-main-image">
                        <!-- Floating Mobile Actions (Back & Wishlist) -->
                        <a href="javascript:history.back()" class="pdp-mobile-back-btn" title="Kembali" aria-label="Kembali">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </a>
                        <button class="pdp-mobile-wish-btn" onclick="toggleWishlist(this, <?= $product['id'] ?>)" title="Favorit" aria-label="Favorit">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>

                        <img id="pdpMainImg" src="<?= BASEURL ?><?= htmlspecialchars($product['main_image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" title="Klik untuk memperbesar">
                        <button class="pdp-zoom-btn" id="pdpZoomBtn" title="Perbesar Gambar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                <line x1="11" y1="8" x2="11" y2="14"></line>
                                <line x1="8" y1="11" x2="14" y2="11"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Right: Product Information & Purchase Controls -->
                <div class="pdp-info">
                    <?php if (!empty($product['badge'])): ?>
                    <span class="pdp-badge" id="pdpBadge"><?= htmlspecialchars($product['badge']) ?></span>
                    <?php endif; ?>
                    
                    <h1 class="pdp-title" id="pdpTitle"><?= htmlspecialchars($product['title']) ?></h1>

                    <div class="pdp-reviews-row">
                        <span class="pdp-stars">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </span>
                        <span class="pdp-reviews-text" id="pdpRatingText"><?= number_format($product['rating'], 1) ?> (<?= $product['reviews_count'] ?> ulasan pembeli)</span>
                    </div>

                    <!-- VENDOR STORE BADGE -->
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; padding: 6px 12px; margin-bottom: 16px; font-size: 13px;">
                        <span style="color: #059669; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Penjual:
                        </span>
                        <strong style="color: #065f46; font-weight: 700;"><?= htmlspecialchars($product['store_name'] ?? 'Lumina Official Store') ?></strong>
                        <span style="font-size: 10.5px; background: #e0f2fe; color: #0284c7; padding: 2px 7px; border-radius: 4px; font-weight: 700;">Mitra Resmi</span>
                    </div>

                    <div class="pdp-price-row">
                        <span class="pdp-price" id="pdpPrice"><?= $product['formatted_price'] ?></span>
                        <?php if (!empty($product['original_price'])): ?>
                        <span class="pdp-old-price" id="pdpOldPrice"><?= $product['formatted_original_price'] ?></span>
                        <?php endif; ?>
                        <?php if (!empty($product['discount'])): ?>
                        <span class="pdp-discount-tag" id="pdpDiscount"><?= htmlspecialchars($product['discount']) ?></span>
                        <?php endif; ?>
                    </div>

                    <p class="pdp-desc" id="pdpDesc">
                        <?= htmlspecialchars($product['description']) ?>
                    </p>

                    <!-- Color / Variant Swatches -->
                    <?php if (!empty($product['colors'])): ?>
                    <div class="pdp-option-group">
                        <div class="pdp-option-label">
                            <strong>Pilihan Varian: <span id="pdpSelectedColorName" style="color: #38bdf8; font-weight: 600;"><?= htmlspecialchars($product['colors'][0]['name']) ?></span></strong>
                        </div>
                        <div class="pdp-color-swatches" id="pdpColorSwatches">
                            <?php foreach ($product['colors'] as $cIdx => $col): ?>
                            <div class="pdp-swatch <?= $cIdx === 0 ? 'active' : '' ?>" 
                                 style="background-color: <?= htmlspecialchars($col['hex']) ?>;" 
                                 title="<?= htmlspecialchars($col['name']) ?>"
                                 data-name="<?= htmlspecialchars($col['name']) ?>"
                                 data-img="<?= BASEURL ?><?= htmlspecialchars($col['img'] ?? $product['main_image']) ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Size / Dimension Chips -->
                    <?php if (!empty($product['sizes'])): ?>
                    <div class="pdp-option-group">
                        <div class="pdp-option-label">
                            <strong>Dimensi / Ukuran: <span id="pdpSelectedSizeName" style="color: #38bdf8; font-weight: 600;"><?= htmlspecialchars($product['sizes'][0]) ?></span></strong>
                            <a href="<?= BASEURL ?>#panduan" class="pdp-guide-link">Panduan Ukuran</a>
                        </div>
                        <div class="pdp-size-chips" id="pdpSizeChips">
                            <?php foreach ($product['sizes'] as $sIdx => $sz): 
                                $short = explode(' ', $sz)[0];
                            ?>
                            <button class="pdp-size-btn <?= $sIdx === 0 ? 'active' : '' ?>" 
                                    title="<?= htmlspecialchars($sz) ?>"
                                    data-size="<?= htmlspecialchars($sz) ?>">
                                <?= htmlspecialchars(strlen($short) <= 5 ? $short : $sz) ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Actions: Quantity, Add to Cart, Wishlist -->
                    <div class="pdp-actions">
                        <div class="pdp-qty-picker">
                            <button class="pdp-qty-btn" id="pdpQtyMinus" title="Kurangi Jumlah">&minus;</button>
                            <span class="pdp-qty-val" id="pdpQtyVal">1</span>
                            <button class="pdp-qty-btn" id="pdpQtyPlus" title="Tambah Jumlah">&plus;</button>
                        </div>
                        <button class="pdp-add-btn" id="pdpAddToCartBtn" data-product-id="<?= $product['id'] ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <span>Tambah ke Keranjang</span>
                        </button>
                        <button class="pdp-wish-btn" id="pdpWishlistBtn" title="Simpan ke Wishlist">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Trust Badges (Clean SVGs, No Emojis) -->
                    <div class="pdp-trust-row">
                        <div class="pdp-trust-item">
                            <div class="pdp-trust-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                            </div>
                            <div class="pdp-trust-text">
                                <h6>Gratis Ongkir</h6>
                                <p>Pesanan di atas 300rb</p>
                            </div>
                        </div>

                        <div class="pdp-trust-item">
                            <div class="pdp-trust-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                            <div class="pdp-trust-text">
                                <h6>100% Original</h6>
                                <p>Cangkang Porselen Asli</p>
                            </div>
                        </div>

                        <div class="pdp-trust-item">
                            <div class="pdp-trust-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <div class="pdp-trust-text">
                                <h6>Garansi 1 Tahun</h6>
                                <p>Proteksi Kerusakan LED</p>
                            </div>
                        </div>

                        <div class="pdp-trust-item">
                            <div class="pdp-trust-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="1 4 1 10 7 10"></polyline>
                                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                </svg>
                            </div>
                            <div class="pdp-trust-text">
                                <h6>Tukar Mudah</h6>
                                <p>30 Hari Pengembalian</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- TABBED CONTENT & PRODUCT SPECS -->
    <section class="pdp-tabs-section">
        <div class="container">
            <div class="pdp-tabs-nav">
                <button class="pdp-tab-btn active" data-tab="tabDesc">Deskripsi Lengkap</button>
                <button class="pdp-tab-btn" data-tab="tabSpecs">Spesifikasi Teknis</button>
                <button class="pdp-tab-btn" data-tab="tabMaterials">Material & Keaslian</button>
                <button class="pdp-tab-btn" data-tab="tabShipping">Pengiriman & Garansi</button>
            </div>

            <!-- Tab 1: Description -->
            <div class="pdp-tab-content active" id="tabDesc">
                <div class="pdp-detail-grid">
                    <div>
                        <h3 style="font-size: 1.35em; color: #0f172a; margin-top: 0; margin-bottom: 16px;">
                            Keindahan Alami Dalam Sentuhan Elegan
                        </h3>
                        <p style="color: #475569; line-height: 1.8; margin-bottom: 24px; font-size: 0.96em;" id="pdpTabDescText">
                            <?= htmlspecialchars($product['description']) ?>
                        </p>
                        <ul class="pdp-bullets-list" id="pdpBulletsList">
                            <?php foreach ($product['bullets'] as $bullet): ?>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b3c5d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span><?= htmlspecialchars($bullet) ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="pdp-detail-banner">
                        <img id="pdpBannerImg" src="<?= BASEURL ?><?= htmlspecialchars($product['main_image']) ?>" alt="Lumina Authentic Quality">
                        <h4>LUMINA AUTHENTIC QUALITY</h4>
                        <p>Setiap produk melewati uji kualitas ketat untuk menjamin kilau nacre, kehalusan tekstur, dan keamanan elektrikal standar internasional.</p>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Specs -->
            <div class="pdp-tab-content" id="tabSpecs">
                <div id="pdpTabSpecsContent" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <?php foreach ($product['specs'] as $spec): ?>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 18px;">
                        <span style="display: block; font-size: 0.85em; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;"><?= htmlspecialchars($spec['label'] ?? '') ?></span>
                        <strong style="color: #0f172a; font-size: 1.05em;"><?= htmlspecialchars($spec['val'] ?? '') ?></strong>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tab 3: Materials -->
            <div class="pdp-tab-content" id="tabMaterials">
                <p id="pdpTabMaterialsText" style="color: #475569; line-height: 1.8; font-size: 0.96em;">
                    <?= nl2br(htmlspecialchars($product['materials'] ?? '')) ?>
                </p>
            </div>

            <!-- Tab 4: Shipping -->
            <div class="pdp-tab-content" id="tabShipping">
                <div style="color: #475569; line-height: 1.8; font-size: 0.96em;">
                    <p style="margin-bottom: 14px;">
                        <strong>Pengemasan Khusus Lumina Vault:</strong> Setiap pesanan dikemas menggunakan hardbox beludru mewah dengan
                        bantalan cetak busa tebal (custom-molded protective foam) serta double bubble wrap untuk menjamin keamanan 100% sampai di tangan Anda.
                    </p>
                    <p style="margin-bottom: 14px;">
                        <strong>Estimasi Waktu Pengiriman:</strong>
                        <br>&bull; Jabodetabek: 1 - 2 hari kerja
                        <br>&bull; Pulau Jawa & Bali: 2 - 3 hari kerja
                        <br>&bull; Luar Pulau Jawa: 3 - 5 hari kerja
                    </p>
                    <p style="margin-bottom: 0;">
                        <strong>Jaminan Garansi 30 Hari:</strong> Jika produk diterima dalam kondisi cacat fisik atau kendala fungsi lampu LED, kami ganti baru tanpa dipungut biaya tambahan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- RELATED PRODUCTS SECTION -->
    <?php if (!empty($related)): ?>
    <section class="pdp-related-section">
        <div class="container">
            <div class="pdp-related-header">
                <h3>Anda Mungkin Juga Suka</h3>
                <a href="<?= BASEURL ?>#koleksi" id="pdpSeeAllRel">Lihat Semua Koleksi &rarr;</a>
            </div>
            <div class="pdp-related-grid" id="pdpRelatedGrid">
                <?php foreach ($related as $rel): ?>
                <div class="product-card" data-id="<?= $rel['id'] ?>" onclick="window.location.href='<?= BASEURL ?>product/detail/<?= $rel['id'] ?>'" style="cursor: pointer;">
                    <div class="product-img-wrap">
                        <?php if (!empty($rel['badge'])): ?>
                            <span class="badge-category"><?= htmlspecialchars($rel['badge']) ?></span>
                        <?php endif; ?>
                        <img src="<?= BASEURL ?><?= htmlspecialchars($rel['main_image']) ?>" alt="<?= htmlspecialchars($rel['title']) ?>">
                    </div>
                    <div class="product-info">
                        <h4><?= htmlspecialchars($rel['title']) ?></h4>
                        <div class="product-rating">
                            <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            <span><?= number_format($rel['rating'], 1) ?> (<?= $rel['reviews_count'] ?> ulasan)</span>
                        </div>
                    </div>
                    <div class="product-bottom">
                        <div class="product-price"><?= $rel['formatted_price'] ?></div>
                        <button class="add-cart-btn" title="Tambah ke Keranjang" onclick="event.stopPropagation();">
                            <svg viewBox="0 0 24 24">
                                <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- LIGHTBOX IMAGE ZOOM MODAL -->
    <div class="pdp-lightbox" id="pdpLightbox" title="Klik di luar gambar untuk menutup">
        <button class="pdp-lightbox-close" id="pdpLightboxClose" title="Tutup Preview">&times;</button>
        <img id="pdpLightboxImg" src="" alt="Perbesar Gambar Produk">
    </div>

    <!-- SCRIPT KHUSUS INTERAKTIVITAS HALAMAN DETAIL -->
    <script>
        function switchPdpThumb(el, src) {
            document.querySelectorAll('.pdp-thumb').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            const mainImg = document.getElementById('pdpMainImg');
            if (mainImg) mainImg.src = src;
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Tab switching
            const tabBtns = document.querySelectorAll('.pdp-tab-btn');
            const tabContents = document.querySelectorAll('.pdp-tab-content');
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    tabBtns.forEach(b => b.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    btn.classList.add('active');
                    const targetId = btn.getAttribute('data-tab');
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) targetContent.classList.add('active');
                });
            });

            // Swatch switching
            const swatches = document.querySelectorAll('.pdp-swatch');
            const colorLabel = document.getElementById('pdpSelectedColorName');
            const mainImg = document.getElementById('pdpMainImg');
            swatches.forEach(swatch => {
                swatch.addEventListener('click', () => {
                    swatches.forEach(s => s.classList.remove('active'));
                    swatch.classList.add('active');
                    const name = swatch.getAttribute('data-name');
                    const img = swatch.getAttribute('data-img');
                    if (colorLabel) colorLabel.innerText = name;
                    if (mainImg && img) mainImg.src = img;
                });
            });

            // Size selection
            const sizeBtns = document.querySelectorAll('.pdp-size-btn');
            const sizeLabel = document.getElementById('pdpSelectedSizeName');
            sizeBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    sizeBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const sz = btn.getAttribute('data-size');
                    if (sizeLabel) sizeLabel.innerText = sz;
                });
            });

            // Quantity picker
            let qty = 1;
            const qtyVal = document.getElementById('pdpQtyVal');
            const qtyPlus = document.getElementById('pdpQtyPlus');
            const qtyMinus = document.getElementById('pdpQtyMinus');

            if (qtyPlus) {
                qtyPlus.addEventListener('click', () => {
                    qty++;
                    if (qtyVal) qtyVal.innerText = qty;
                });
            }

            if (qtyMinus) {
                qtyMinus.addEventListener('click', () => {
                    if (qty > 1) {
                        qty--;
                        if (qtyVal) qtyVal.innerText = qty;
                    }
                });
            }

            // Add to Cart
            const addBtn = document.getElementById('pdpAddToCartBtn');
            if (addBtn) {
                addBtn.addEventListener('click', () => {
                    const activeColor = document.querySelector('.pdp-swatch.active')?.getAttribute('data-name') || 'Standard';
                    const activeSize = document.querySelector('.pdp-size-btn.active')?.getAttribute('data-size') || 'Standard';
                    const cur = window.CURRENT_PRODUCT;

                    if (typeof addToCart === 'function') {
                        addToCart({
                            id: cur ? cur.id : <?= (int)$product['id'] ?>,
                            title: cur ? cur.title : "<?= addslashes($product['title']) ?>",
                            price: cur ? cur.price : <?= (int)$product['price'] ?>,
                            image: cur ? cur.main_image : "<?= addslashes($product['main_image']) ?>",
                            variant: activeColor,
                            size: activeSize,
                            qty: qty
                        });
                        if (typeof openCartDrawer === 'function') {
                            openCartDrawer();
                        }
                    }
                });
            }

            // Lightbox Zoom
            const zoomBtn = document.getElementById('pdpZoomBtn');
            const lightbox = document.getElementById('pdpLightbox');
            const lightboxImg = document.getElementById('pdpLightboxImg');
            const lightboxClose = document.getElementById('pdpLightboxClose');

            if (zoomBtn && lightbox && lightboxImg) {
                zoomBtn.addEventListener('click', () => {
                    if (mainImg) {
                        lightboxImg.src = mainImg.src;
                        lightbox.classList.add('active');
                    }
                });

                lightbox.addEventListener('click', (e) => {
                    if (e.target === lightbox || e.target === lightboxClose) {
                        lightbox.classList.remove('active');
                    }
                });
            }
        });
    </script>
