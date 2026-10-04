<!-- ========================================================
     LUMINA PEARL - COLLECTION / DEALS PAGE (DESKTOP & MOBILE DEALS)
     ======================================================== -->

<!-- 1. MOBILE SMARTPHONE VIEW: SHOPEE DEALS / FLASH SALE PATTERN -->
<div class="mobile-deals-page">

    <!-- Top Blue Deals Header -->
    <div class="shopee-deals-header">
        <div class="deals-header-top">
            <div class="deals-brand-title">
                Lumina <span>Deals</span>
            </div>
            <div class="deals-header-actions">
                <button class="deals-icon-btn" onclick="const s = document.getElementById('dealsSearchBox'); if(s) { s.style.display = s.style.display === 'none' ? 'block' : 'none'; s.focus(); }" title="Cari Promo" aria-label="Cari">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
                <button class="deals-icon-btn" onclick="<?= !empty($_SESSION['user']) ? 'openCartDrawer()' : 'openAuthModal(\'login\')' ?>" title="Keranjang" aria-label="Keranjang">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="deals-cart-badge cart-badge">0</span>
                </button>
            </div>
        </div>

        <!-- Deals Subtitle Ribbon -->
        <div class="deals-ribbon">
            <span class="ribbon-leaf"></span>
            <span>Diskon Eksklusif &bull; Promo Terbaik 14 Hari Terakhir</span>
            <span class="ribbon-leaf"></span>
        </div>

        <!-- Optional Collapsible Search Input -->
        <div id="dealsSearchBox" style="display: none; margin-top: 10px;">
            <input type="text" id="dealsFilterInput" placeholder="Cari penawaran spesial..." onkeyup="filterDealsSearch(this.value)" style="width: 100%; padding: 8px 14px; border-radius: 20px; border: none; font-size: 13px; outline: none; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
        </div>
    </div>

    <!-- Main Deals Container -->
    <div class="deals-container">

        <!-- SECTION 1: FLASH SALE -->
        <div class="deals-flash-sale-card">
            <div class="flash-sale-header">
                <div class="flash-sale-title-group">
                    <span class="flash-badge-icon"></span>
                    <h3 class="flash-title">FLASH SALE</h3>
                    <!-- Live Countdown Timer -->
                    <div class="flash-timer">
                        <span class="timer-box" id="timerHours">01</span>
                        <span class="timer-sep">:</span>
                        <span class="timer-box" id="timerMinutes">28</span>
                        <span class="timer-sep">:</span>
                        <span class="timer-box" id="timerSeconds">19</span>
                    </div>
                </div>
                <a href="javascript:void(0)" onclick="filterDealsCategory('all', this)" class="flash-see-all">
                    Lihat Semua &rsaquo;
                </a>
            </div>

            <!-- Flash Sale Horizontal Scrolling Products -->
            <div class="flash-sale-scroll">
                <?php foreach (array_slice($flashSales, 0, 6) as $fs): ?>
                <div class="flash-item-card" onclick="window.location.href='<?= BASEURL ?>product/detail/<?= $fs['id'] ?>'">
                    <div class="flash-img-wrap">
                        <span class="flash-discount-tag">-<?= $fs['discount_percent'] ?>%</span>
                        <img src="<?= BASEURL ?><?= htmlspecialchars($fs['main_image']) ?>" alt="<?= htmlspecialchars($fs['title']) ?>" loading="lazy">
                    </div>
                    <div class="flash-item-name"><?= htmlspecialchars($fs['title']) ?></div>
                    <div class="flash-item-price"><?= $fs['formatted_flash_price'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- SECTION 2: CATEGORY TABS (HORIZONTAL STICKY) -->
        <div class="deals-tabs-nav">
            <button class="deals-tab-btn active" data-cat="all" onclick="filterDealsCategory('all', this)">
                <span class="tab-icon"></span>
                <span>Rekomendasi</span>
            </button>
            <button class="deals-tab-btn" data-cat="lampu" onclick="filterDealsCategory('lampu', this)">
                <span>Lampu Kerang</span>
            </button>
            <button class="deals-tab-btn" data-cat="samudra" onclick="filterDealsCategory('samudra', this)">
                <span>Edisi Samudra</span>
            </button>
            <button class="deals-tab-btn" data-cat="alami" onclick="filterDealsCategory('alami', this)">
                <span>Kerang Alami</span>
            </button>
        </div>

        <!-- SECTION 3: PRODUCT DEALS FEED (HORIZONTAL CARD STYLE) -->
        <div class="deals-feed-list" id="dealsFeedList">
            <?php foreach ($flashSales as $item): ?>
            <div class="deals-feed-card" data-category="<?= $item['category_key'] ?>" data-title="<?= strtolower(htmlspecialchars($item['title'])) ?>" onclick="window.location.href='<?= BASEURL ?>product/detail/<?= $item['id'] ?>'">
                <!-- Left: Square Photo -->
                <div class="deals-card-media">
                    <img src="<?= BASEURL ?><?= htmlspecialchars($item['main_image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" loading="lazy">
                    <button class="deals-media-play-btn" title="Pratinjau">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="#ffffff">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </button>
                </div>

                <!-- Right: Product Info & Actions -->
                <div class="deals-card-content">
                    <div class="deals-card-title-row">
                        <span class="badge-star">Star+</span>
                        <h4 class="deals-card-title"><?= htmlspecialchars($item['title']) ?></h4>
                    </div>

                    <div class="deals-card-meta">
                        <span class="deals-rating-badge" style="display: inline-flex; align-items: center; gap: 4px;">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            <span><?= number_format($item['rating'], 1) ?></span>
                        </span>
                        <span class="deals-sold-count"><?= $item['sold_count'] ?> terjual</span>
                    </div>

                    <div class="deals-benefit-row">
                        <span class="benefit-badge">
                            <span class="benefit-icon"></span> Garansi Harga Terbaik
                        </span>
                    </div>

                    <div class="deals-card-bottom">
                        <div class="deals-price-wrap">
                            <div class="deals-price-main"><?= $item['formatted_flash_price'] ?></div>
                            <div class="deals-price-original"><?= $item['formatted_price'] ?></div>
                        </div>
                        <button class="deals-buy-btn" onclick="event.stopPropagation(); buyDealsItem(<?= $item['id'] ?>)">
                            Beli
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>

<!-- 2. DESKTOP VIEW: CLEAN LUXURY LUMINA PEARL COLLECTION CATALOG -->
<div class="desktop-collection-page">
    <div class="container" style="padding-top: 40px; padding-bottom: 60px;">
        <div class="section-header" style="text-align: center; margin-bottom: 35px;">
            <span class="section-badge">Katalog Lengkap</span>
            <h1 class="section-title">Koleksi Mahakarya Lumina Pearl</h1>
            <p class="section-subtitle">Jelajahi karya seni lampu porselen cangkang kerang murni dan ornamen samudra berstandar ekspor.</p>
        </div>

        <div class="filter-tabs" style="display: flex; justify-content: center; gap: 12px; margin-bottom: 35px;">
            <button class="filter-btn active" onclick="filterDesktopCollection('all', this)">Semua Koleksi (<?= count($products) ?>)</button>
            <button class="filter-btn" onclick="filterDesktopCollection('lampu', this)">Lampu Kerang</button>
            <button class="filter-btn" onclick="filterDesktopCollection('samudra', this)">Edisi Samudra</button>
            <button class="filter-btn" onclick="filterDesktopCollection('alami', this)">Kerang Alami</button>
        </div>

        <div class="products-grid">
            <?php foreach ($products as $p): 
                $cat = 'lampu';
                if (stripos($p['title'], 'Sea') !== false || stripos($p['title'], 'Sapphire') !== false) {
                    $cat = 'samudra';
                } elseif (stripos($p['title'], 'Akoya') !== false || stripos($p['title'], 'Natural') !== false || stripos($p['title'], 'South Sea') !== false) {
                    $cat = 'alami';
                }
            ?>
            <div class="product-card desktop-card" data-category="<?= $cat ?>" data-id="<?= $p['id'] ?>" onclick="window.location.href='<?= BASEURL ?>product/detail/<?= $p['id'] ?>'">
                <div class="product-img-wrap">
                    <?php if (!empty($p['badge'])): ?>
                    <span class="badge-category"><?= htmlspecialchars($p['badge']) ?></span>
                    <?php endif; ?>
                    <img src="<?= BASEURL ?><?= htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy">
                </div>
                <div class="product-info">
                    <h4><?= htmlspecialchars($p['title']) ?></h4>
                    <div style="font-size: 12px; color: #64748b; margin-bottom: 6px; display: flex; align-items: center; gap: 4px;">
                        <span></span>
                        <span><?= htmlspecialchars($p['store_name'] ?? 'Lumina Official Store') ?></span>
                    </div>
                    <div class="product-rating">
                        <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                        <span><?= number_format($p['rating'], 1) ?> (<?= $p['reviews_count'] ?> ulasan)</span>
                    </div>
                </div>
                <div class="product-bottom">
                    <div class="product-price"><?= $p['formatted_price'] ?></div>
                    <button class="add-cart-btn" title="Tambah ke Keranjang" onclick="event.stopPropagation(); addToCart({id: <?= $p['id'] ?>, title: '<?= addslashes($p['title']) ?>', price: <?= $p['price'] ?>, image: '<?= addslashes($p['main_image']) ?>', variant: 'Standard', size: 'Standard', qty: 1}); openCartDrawer();">
                        <svg class="cart-icon-desktop" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                        </svg>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- ========================================================
     STYLE KHUSUS SHOPEE DEALS MOBILE vs DESKTOP
     ======================================================== -->
<style>
/* Desktop baseline: Sembunyikan tampilan mobile */
@media screen and (min-width: 769px) {
    .mobile-deals-page {
        display: none !important;
    }
    .desktop-collection-page {
        display: block !important;
    }
}

/* SMARTPHONE VIEW: SHOPEE DEALS LAYOUT (<= 768px) */
@media screen and (max-width: 768px) {
    .desktop-collection-page {
        display: none !important;
    }

    .mobile-deals-page {
        display: block !important;
        background-color: #f5f5f5 !important;
        min-height: 100vh !important;
        padding-bottom: 74px !important;
    }

    /* TOP BLUE DEALS HEADER */
    .shopee-deals-header {
        background: linear-gradient(135deg, #0b3c5d 0%, #0284c7 100%) !important;
        padding: 14px 16px 16px 16px !important;
        color: #ffffff !important;
        position: relative !important;
        box-shadow: 0 4px 16px rgba(2, 132, 199, 0.25) !important;
    }

    .deals-header-top {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 8px !important;
    }

    .deals-brand-title {
        font-size: 22px !important;
        font-weight: 900 !important;
        letter-spacing: -0.3px !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px !important;
    }

    .deals-brand-title span {
        font-weight: 800 !important;
        color: #e0f2fe !important;
    }

    .deals-header-actions {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .deals-icon-btn {
        background: none !important;
        border: none !important;
        padding: 4px !important;
        cursor: pointer !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .deals-cart-badge {
        position: absolute !important;
        top: -3px !important;
        right: -6px !important;
        background: #ffffff !important;
        color: #0284c7 !important;
        font-size: 9px !important;
        font-weight: 800 !important;
        min-width: 16px !important;
        height: 16px !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: 1 !important;
    }

    .deals-ribbon {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        font-size: 11.5px !important;
        font-weight: 600 !important;
        color: #ffffff !important;
        opacity: 0.95 !important;
    }

    .ribbon-leaf {
        font-size: 10px !important;
    }

    /* DEALS CONTAINER */
    .deals-container {
        padding: 10px 10px 20px 10px !important;
    }

    /* FLASH SALE SECTION */
    .deals-flash-sale-card {
        background: #ffffff !important;
        border-radius: 14px !important;
        padding: 12px 10px !important;
        margin-bottom: 12px !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04) !important;
    }

    .flash-sale-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 12px !important;
        padding: 0 4px !important;
    }

    .flash-sale-title-group {
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .flash-badge-icon {
        font-size: 15px !important;
    }

    .flash-title {
        font-size: 14px !important;
        font-weight: 900 !important;
        color: #0284c7 !important;
        letter-spacing: 0.3px !important;
        margin: 0 !important;
        font-style: italic !important;
    }

    .flash-timer {
        display: flex !important;
        align-items: center !important;
        gap: 3px !important;
        margin-left: 4px !important;
    }

    .timer-box {
        background: #0b3c5d !important;
        color: #ffffff !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        padding: 2px 4px !important;
        border-radius: 4px !important;
        min-width: 18px !important;
        text-align: center !important;
        font-family: monospace !important;
    }

    .timer-sep {
        font-weight: 800 !important;
        font-size: 11px !important;
        color: #0b3c5d !important;
    }

    .flash-see-all {
        font-size: 12px !important;
        color: #64748b !important;
        text-decoration: none !important;
        font-weight: 600 !important;
    }

    /* FLASH SALE HORIZONTAL SCROLL */
    .flash-sale-scroll {
        display: flex !important;
        gap: 10px !important;
        overflow-x: auto !important;
        white-space: nowrap !important;
        padding-bottom: 4px !important;
        -webkit-overflow-scrolling: touch !important;
        scrollbar-width: none !important;
    }

    .flash-sale-scroll::-webkit-scrollbar {
        display: none !important;
    }

    .flash-item-card {
        width: 102px !important;
        flex-shrink: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        cursor: pointer !important;
    }

    .flash-img-wrap {
        width: 100px !important;
        height: 100px !important;
        background: #f8fafc !important;
        border-radius: 10px !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: 1px solid #e2e8f0 !important;
        margin-bottom: 6px !important;
        overflow: hidden !important;
    }

    .flash-img-wrap img {
        max-width: 86% !important;
        max-height: 86% !important;
        object-fit: contain !important;
    }

    .flash-discount-tag {
        position: absolute !important;
        top: 0 !important;
        right: 0 !important;
        background: #e0f2fe !important;
        color: #0284c7 !important;
        font-size: 10px !important;
        font-weight: 800 !important;
        padding: 1px 5px !important;
        border-radius: 0 0 0 6px !important;
    }

    .flash-item-name {
        font-size: 11px !important;
        color: #333333 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        width: 100% !important;
        text-align: center !important;
        margin-bottom: 2px !important;
    }

    .flash-item-price {
        font-size: 12.5px !important;
        font-weight: 800 !important;
        color: #0284c7 !important;
        text-align: center !important;
    }

    /* CATEGORY TABS */
    .deals-tabs-nav {
        display: flex !important;
        overflow-x: auto !important;
        background: #ffffff !important;
        border-radius: 12px 12px 0 0 !important;
        border-bottom: 1px solid #f0f0f0 !important;
        white-space: nowrap !important;
        scrollbar-width: none !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 50 !important;
    }

    .deals-tabs-nav::-webkit-scrollbar {
        display: none !important;
    }

    .deals-tab-btn {
        background: none !important;
        border: none !important;
        padding: 12px 16px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #555555 !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px !important;
        position: relative !important;
        flex-shrink: 0 !important;
    }

    .deals-tab-btn.active {
        color: #0284c7 !important;
        font-weight: 700 !important;
    }

    .deals-tab-btn.active::after {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 14px !important;
        right: 14px !important;
        height: 2.5px !important;
        background: #0284c7 !important;
        border-radius: 2px !important;
    }

    /* DEALS PRODUCT FEED (HORIZONTAL FULL CARD) */
    .deals-feed-list {
        background: #ffffff !important;
        border-radius: 0 0 12px 12px !important;
        padding: 8px 10px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
    }

    .deals-feed-card {
        display: flex !important;
        gap: 12px !important;
        padding: 8px 0 !important;
        border-bottom: 1px solid #f3f3f3 !important;
        cursor: pointer !important;
    }

    .deals-feed-card:last-child {
        border-bottom: none !important;
    }

    .deals-card-media {
        width: 105px !important;
        height: 105px !important;
        background: #fafafa !important;
        border-radius: 10px !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        border: 1px solid #f0f0f0 !important;
    }

    .deals-card-media img {
        max-width: 88% !important;
        max-height: 88% !important;
        object-fit: contain !important;
    }

    .deals-media-play-btn {
        position: absolute !important;
        bottom: 6px !important;
        right: 6px !important;
        width: 22px !important;
        height: 22px !important;
        border-radius: 50% !important;
        background: rgba(0, 0, 0, 0.45) !important;
        border: none !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding-left: 2px !important;
    }

    .deals-card-content {
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        min-width: 0 !important;
    }

    .deals-card-title-row {
        display: flex !important;
        align-items: flex-start !important;
        gap: 5px !important;
        margin-bottom: 4px !important;
    }

    .badge-star {
        background: #0284c7 !important;
        color: #ffffff !important;
        font-size: 9.5px !important;
        font-weight: 800 !important;
        padding: 1px 4px !important;
        border-radius: 3px !important;
        flex-shrink: 0 !important;
        margin-top: 2px !important;
    }

    .deals-card-title {
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #222222 !important;
        margin: 0 !important;
        line-height: 1.35 !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    .deals-card-meta {
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-size: 11px !important;
        color: #777777 !important;
        margin-bottom: 4px !important;
    }

    .deals-rating-badge {
        background: #fff8e1 !important;
        color: #f59e0b !important;
        font-weight: 700 !important;
        padding: 1px 5px !important;
        border-radius: 4px !important;
        border: 1px solid #fed7aa !important;
    }

    .deals-benefit-row {
        margin-bottom: 6px !important;
    }

    .benefit-badge {
        font-size: 11px !important;
        color: #0284c7 !important;
        font-weight: 600 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
    }

    .deals-card-bottom {
        display: flex !important;
        align-items: flex-end !important;
        justify-content: space-between !important;
        margin-top: 4px !important;
    }

    .deals-price-wrap {
        display: flex !important;
        flex-direction: column !important;
    }

    .deals-price-main {
        font-size: 15px !important;
        font-weight: 900 !important;
        color: #0284c7 !important;
        letter-spacing: -0.2px !important;
    }

    .deals-price-original {
        font-size: 11px !important;
        color: #aaaaaa !important;
        text-decoration: line-through !important;
    }

    .deals-buy-btn {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
        color: #ffffff !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        border: none !important;
        padding: 6px 18px !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.35) !important;
        transition: transform 0.15s !important;
    }

    .deals-buy-btn:active {
        transform: scale(0.93) !important;
    }
}
</style>

<!-- ========================================================
     JAVASCRIPT: FLASH SALE COUNTDOWN & FILTER
     ======================================================== -->
<script>
// Live Flash Sale Countdown Timer
(function startFlashCountdown() {
    let totalSeconds = 1 * 3600 + 28 * 60 + 19; // 01:28:19
    const hoursEl = document.getElementById('timerHours');
    const minutesEl = document.getElementById('timerMinutes');
    const secondsEl = document.getElementById('timerSeconds');

    setInterval(() => {
        if (totalSeconds <= 0) {
            totalSeconds = 2 * 3600; // Reset loop
        } else {
            totalSeconds--;
        }

        const h = Math.floor(totalSeconds / 3600);
        const m = Math.floor((totalSeconds % 3600) / 60);
        const s = totalSeconds % 60;

        if (hoursEl) hoursEl.textContent = String(h).padStart(2, '0');
        if (minutesEl) minutesEl.textContent = String(m).padStart(2, '0');
        if (secondsEl) secondsEl.textContent = String(s).padStart(2, '0');
    }, 1000);
})();

// Filter Deals Category Tabs
function filterDealsCategory(cat, btn) {
    const tabs = document.querySelectorAll('.deals-tab-btn');
    tabs.forEach(t => t.classList.remove('active'));
    if (btn) btn.classList.add('active');

    const cards = document.querySelectorAll('.deals-feed-card');
    cards.forEach(card => {
        const itemCat = card.getAttribute('data-category');
        if (cat === 'all' || itemCat === cat) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Search Filter
function filterDealsSearch(query) {
    query = query.toLowerCase().trim();
    const cards = document.querySelectorAll('.deals-feed-card');
    cards.forEach(card => {
        const title = card.getAttribute('data-title') || '';
        if (!query || title.includes(query)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Quick Buy Deals Item
function buyDealsItem(productId) {
    const products = <?= json_encode($flashSales) ?>;
    const item = products.find(p => p.id == productId);
    if (!item) return;

    if (typeof addToCart === 'function') {
        addToCart({
            id: item.id,
            title: item.title,
            price: item.flash_price || item.price,
            image: item.main_image,
            variant: 'Promo Flash Sale',
            size: 'Standard',
            qty: 1
        });
        if (typeof openCartDrawer === 'function') {
            openCartDrawer();
        }
    }
}

// Desktop Collection Filter
function filterDesktopCollection(cat, btn) {
    const btns = document.querySelectorAll('.filter-btn');
    btns.forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    const cards = document.querySelectorAll('.desktop-card');
    cards.forEach(c => {
        const itemCat = c.getAttribute('data-category');
        if (cat === 'all' || itemCat === cat) {
            c.style.display = 'flex';
        } else {
            c.style.display = 'none';
        }
    });
}
</script>
