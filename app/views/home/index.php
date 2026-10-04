    <!-- =======================================================
     CAROUSEL SLIDER HERO SECTION (DATA DINAMIS MYSQL)
     ======================================================= -->
    <div class="carousel">
        <div class="list">
            <?php 
            // Ambil produk unggulan dinamis yang dipilih dari Admin / Seller Center
            $carouselItems = !empty($carouselProducts) ? $carouselProducts : [];
            if (empty($carouselItems) && !empty($products)) {
                $carouselItems = array_slice($products, 0, 4);
            }
            foreach ($carouselItems as $item):
            ?>
            <div class="item" data-id="<?= $item['id'] ?>">
                <img src="<?= BASEURL ?><?= htmlspecialchars($item['main_image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                <div class="introduce">
                    <div class="title"><?= htmlspecialchars($item['badge'] ?? 'KOLEKSI MEWAH') ?></div>
                    <div class="topic"><?= htmlspecialchars($item['title']) ?></div>
                    <div class="des">
                        <?= htmlspecialchars($item['description']) ?>
                    </div>
                    <button class="seeMore" data-product-id="<?= $item['id'] ?>">LIHAT DETAIL &#8599;</button>
                </div>
                <div class="detail">
                    <div class="title"><?= htmlspecialchars($item['title']) ?></div>
                    <div class="des">
                        <?= htmlspecialchars($item['description']) ?>
                    </div>
                    <div class="specifications">
                        <?php if (!empty($item['specs'])): ?>
                            <?php foreach (array_slice($item['specs'], 0, 5) as $spec): ?>
                            <div>
                                <p><?= htmlspecialchars($spec['label'] ?? '') ?></p>
                                <p><?= htmlspecialchars($spec['val'] ?? '') ?></p>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="checkout">
                        <button class="open-pdp-direct" data-product-id="<?= $item['id'] ?>">DETAIL LENGKAP &#8599;</button>
                        <button class="add-to-cart-action" data-product-id="<?= $item['id'] ?>">BELI SEKARANG</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="arrows">
            <button id="prev" title="Sebelumnya">&#10094;</button>
            <button id="next" title="Selanjutnya">&#10095;</button>
            <button id="back">&#8592; KEMBALI KE KATALOG</button>
        </div>
    </div>

    <!-- =======================================================
     SECTION 1: MENGAPA MEMILIH LUMINA PEARL (WHY CHOOSE US)
     ======================================================= -->
    <section class="section why-us-section" id="tentang">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Keunggulan Kami</span>
                <h2 class="section-title">Mengapa Memilih Lumina Pearl?</h2>
                <p class="section-subtitle">Dedikasi kami dalam menghadirkan keindahan samudra murni melalui seleksi
                    ketat bahan berkualitas tinggi dan pengerjaan tangan berstandar estetika tinggi.</p>
            </div>

            <div class="why-us-grid">
                <!-- Kolom Kiri -->
                <div class="why-col">
                    <div class="why-card align-right">
                        <div class="why-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                                <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
                            </svg>
                        </div>
                        <div class="why-text">
                            <h4>100% Mutiara Terpilih</h4>
                            <p>Setiap cangkang kerang dan butir mutiara dikurasi ketat demi memastikan kilau luster dan
                                proporsi bentuk yang sempurna.</p>
                        </div>
                    </div>
                    <div class="why-card align-right">
                        <div class="why-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                        </div>
                        <div class="why-text">
                            <h4>Kemasan Aman & Mewah</h4>
                            <p>Dilengkapi kotak beludru eksklusif berstandar ekspor dengan proteksi bantalan tebal aman
                                selama pengiriman ke rumah Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- Visual Tengah (Centerpiece) -->
                <div class="why-center-visual">
                    <img src="<?= BASEURL ?>images/pearl-white.png" alt="Lumina Pearl Centerpiece">
                </div>

                <!-- Kolom Kanan -->
                <div class="why-col">
                    <div class="why-card">
                        <div class="why-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 12 11 14 15 10"></polyline>
                            </svg>
                        </div>
                        <div class="why-text">
                            <h4>Garansi Keaslian</h4>
                            <p>Jaminan porselen glasir murni, resin kristal tahan panas, dan mutiara alami berkualitas
                                grade tertinggi tanpa cacat.</p>
                        </div>
                    </div>
                    <div class="why-card">
                        <div class="why-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        <div class="why-text">
                            <h4>Pengiriman Berasuransi</h4>
                            <p>Melayani pengiriman kilat ke seluruh Indonesia dengan proteksi asuransi penuh dan jaminan
                                penggantian bila rusak di jalan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =======================================================
     SECTION 2: HIGHLIGHT BANNER (GUIDE & CARE)
     ======================================================= -->
    <section class="section" id="panduan">
        <div class="container">
            <div class="guide-banner">
                <!-- Info Kiri -->
                <div class="guide-banner-info">
                    <span class="banner-tag">Panduan Estetika</span>
                    <h3>Perawatan & Kilau Abadi Mutiara</h3>
                    <p>Pelajari langkah sederhana merawat cangkang kerang dan sistem pencahayaan LED agar pendaran
                        magisnya selalu memikat setiap waktu.</p>
                    <a href="<?= BASEURL ?>collection" class="guide-btn">Eksplorasi Koleksi &rarr;</a>
                </div>

                <!-- Mini Cards Tengah -->
                <div class="guide-cards-col">
                    <div class="guide-mini-card">
                        <div class="mini-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h5>Pembersihan Halus</h5>
                            <p>Cukup bersihkan permukaan cangkang dengan kain microfiber kering atau sedikit lembab
                                tanpa zat kimia keras.</p>
                        </div>
                    </div>
                    <div class="guide-mini-card">
                        <div class="mini-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="9" y1="18" x2="15" y2="18"></line>
                                <line x1="10" y1="22" x2="14" y2="22"></line>
                                <path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5.76.76 1.23 1.52 1.41 2.5"></path>
                            </svg>
                        </div>
                        <div>
                            <h5>Pencahayaan Ambient</h5>
                            <p>Tempatkan di sudut bernuansa hangat untuk pantulan bias cahaya nacre yang dramatis dan
                                menenangkan.</p>
                        </div>
                    </div>
                </div>

                <!-- Visual Kanan -->
                <div class="guide-visual">
                    <img src="<?= BASEURL ?>images/pearl-gold.png" alt="Panduan Perawatan Mutiara">
                </div>
            </div>
        </div>
    </section>

    <!-- =======================================================
     SECTION 3: GRID KOLEKSI PRODUK (LOOPING DARI MYSQL)
     ======================================================= -->
    <section class="section collection-section" id="koleksi">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Katalog Lengkap</span>
                <h2 class="section-title">Koleksi Mahakarya Lumina</h2>
                <p class="section-subtitle">Temukan varian eksklusif lampu cangkang kerang mutiara, kreasi samudra dalam,
                    dan perhiasan organik bersertifikasi.</p>
            </div>

            <!-- Filter Kategori Tabs (Cavosh Pill Style) -->
            <div class="collection-filter-tabs">
                <button class="filter-btn active" data-filter="all">Semua (<?= count($products) ?>)</button>
                <button class="filter-btn" data-filter="lampu">Lampu Kerang</button>
                <button class="filter-btn" data-filter="samudra">Edisi Samudra</button>
                <button class="filter-btn" data-filter="alami">Kerang Alami</button>
            </div>

            <!-- Grid Card Produk -->
            <div class="products-grid">
                <?php foreach ($products as $p): 
                    // Tentukan kategori filter berdasarkan judul/badge
                    $cat = 'lampu';
                    if (stripos($p['title'], 'Sea') !== false || stripos($p['title'], 'Sapphire') !== false) {
                        $cat = 'samudra';
                    } elseif (stripos($p['title'], 'Akoya') !== false || stripos($p['title'], 'Natural') !== false || stripos($p['title'], 'South Sea') !== false) {
                        $cat = 'alami';
                    }
                ?>
                <div class="product-card" data-category="<?= $cat ?>" data-id="<?= $p['id'] ?>">
                    <div class="product-img-wrap">
                        <?php if (!empty($p['badge'])): ?>
                            <span class="badge-category"><?= htmlspecialchars($p['badge']) ?></span>
                        <?php endif; ?>
                        
                        <!-- Cavosh Heart Wishlist Button -->
                        <button class="card-wishlist-btn" onclick="event.stopPropagation(); toggleWishlist(this, <?= $p['id'] ?>)" title="Favorit" aria-label="Favorit">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>

                        <img src="<?= BASEURL ?><?= htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy">
                    </div>
                    <div class="product-info">
                        <h4><?= htmlspecialchars($p['title']) ?></h4>
                        <div style="font-size: 11.5px; color: #64748b; margin-bottom: 4px; display: flex; align-items: center; gap: 5px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span><?= htmlspecialchars($p['store_name'] ?? 'Lumina Official Store') ?></span>
                        </div>
                        <div class="product-rating">
                            <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            <span><?= number_format($p['rating'], 1) ?> (<?= $p['reviews_count'] ?> ulasan)</span>
                        </div>
                    </div>
                    <div class="product-bottom">
                        <div class="product-price"><?= $p['formatted_price'] ?></div>
                        <button class="add-cart-btn" title="Tambah ke Keranjang">
                            <svg class="cart-icon-desktop" viewBox="0 0 24 24">
                                <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                            </svg>
                            <svg class="plus-icon-mobile" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- CAVOSH: FREQUENTLY ORDERED (VISIBLE ON SMARTPHONES) -->
            <div class="cavosh-frequently-section">
                <div class="cavosh-section-header">
                    <h3 class="cavosh-section-title">Koleksi Paling Diminati</h3>
                    <a href="<?= BASEURL ?>collection" style="font-size: 11.5px; color: #0284c7; font-weight: 700; text-decoration: none;">Lihat Semua &rarr;</a>
                </div>
                <div class="cavosh-frequently-list">
                    <?php 
                    $frequentItems = array_slice($products, 0, 3);
                    foreach ($frequentItems as $item): 
                    ?>
                    <div class="cavosh-horizontal-card" onclick="window.location.href='<?= BASEURL ?>product/detail/<?= $item['id'] ?>'">
                        <div class="cavosh-horiz-img">
                            <img src="<?= BASEURL ?><?= htmlspecialchars($item['main_image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" loading="lazy">
                        </div>
                        <div class="cavosh-horiz-content">
                            <div class="cavosh-horiz-sub" style="display: flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span><?= number_format($item['rating'], 1) ?> (<?= $item['reviews_count'] ?> ulasan) &bull; <?= htmlspecialchars($item['badge'] ?? 'Terlaris') ?></span>
                            </div>
                        </div>
                        <button class="add-cart-btn" onclick="event.stopPropagation();" title="Tambah ke Keranjang" style="width: 28px; height: 28px; border-radius: 50%; background: #0284c7; color: #fff; border: none; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 6px rgba(2,132,199,0.35);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
