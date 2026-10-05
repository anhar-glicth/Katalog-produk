    <!-- =======================================================
     FOOTER RESMI & ELEGAN (GLOBAL FOOTER)
     ======================================================= -->
    <footer class="site-footer" id="kontak">
        <div class="container">
            <div class="footer-grid">
                <!-- Kolom 1: Profil Brand -->
                <div class="footer-col">
                    <div class="footer-logo">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 6px;">
                            <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                            <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
                        </svg>
                        YENI MUTIARA <span>LOMBOK</span>
                    </div>
                    <p class="footer-about">
                        Pusat aneka kerajinan perhiasan mutiara asli Pulau Lombok. Menyediakan kalung, cincin, gelang, bros mutiara air laut dan air tawar bersertifikat mutu dan berkualitas terbaik.
                    </p>
                    <div class="footer-socials">
                        <a href="https://instagram.com/yeni_mutiara_lombok" target="_blank" class="social-icon" title="Instagram">IG</a>
                        <a href="javascript:void(0)" class="social-icon" title="TikTok">TT</a>
                        <a href="javascript:void(0)" class="social-icon" title="WhatsApp">WA</a>
                        <a href="javascript:void(0)" class="social-icon" title="Facebook">FB</a>
                    </div>
                </div>

                <!-- Kolom 2: Kategori Produk -->
                <div class="footer-col">
                    <h4>Kategori Produk</h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASEURL ?>collection">Kalung Mutiara Lombok</a></li>
                        <li><a href="<?= BASEURL ?>collection">Cincin Mutiara Asli</a></li>
                        <li><a href="<?= BASEURL ?>collection">Gelang Mutiara Air Laut</a></li>
                        <li><a href="<?= BASEURL ?>collection">Bros Kerajinan Mutiara</a></li>
                        <li><a href="<?= BASEURL ?>collection">Lampu Kerang & Mahar</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Layanan Pelanggan -->
                <div class="footer-col">
                    <h4>Layanan & Bantuan</h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASEURL ?>#panduan">Panduan Perawatan</a></li>
                        <li><a href="<?= BASEURL ?>database/setup.php" title="Sinkronisasi Database MySQL">Status Database</a></li>
                        <li><a href="javascript:void(0)">Cek Resi & Pengiriman</a></li>
                        <li><a href="javascript:void(0)">Garansi Produk & Retur</a></li>
                        <li><a href="javascript:void(0)">Konfirmasi Pembayaran</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Newsletter & Kontak -->
                <div class="footer-col">
                    <h4>Berlangganan Promo</h4>
                    <p style="color: #94a3b8; font-size: 0.9em; margin-bottom: 12px;">
                        Dapatkan voucher potongan harga dan info koleksi mutiara lombok terbaru langsung di email Anda.
                    </p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Alamat email Anda..." class="newsletter-input" required>
                        <button type="submit" class="newsletter-btn">Daftar</button>
                    </form>
                    <div class="footer-contact-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span>Customer Service: +62 812-3456-7890</span>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div>
                    &copy; <?= date('Y') ?> <?= htmlspecialchars(site_setting('app_name', 'Yeni Mutiara Lombok')) ?>. Hak Cipta Dilindungi Undang-Undang.
                </div>
                <div class="footer-bottom-links">
                    <a href="javascript:void(0)">Kebijakan Privasi</a>
                    <a href="javascript:void(0)">Syarat & Ketentuan</a>
                    <a href="javascript:void(0)">Kebijakan Pengembalian</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- SPACER AGAR KONTEN TERBAWAH TIDAK TERHALANG BOTTOM NAV ANDROID -->
    <div class="mobile-bottom-spacer"></div>

    <!-- ANDROID MOBILE BOTTOM NAVIGATION BAR (CAVOSH DESIGN: 5 ICONS) -->
    <nav class="android-bottom-nav">
        <!-- 1: Beranda -->
        <a href="<?= BASEURL ?>" class="android-nav-item <?= empty($page) || $page === 'home' ? 'active' : '' ?>">
            <div class="android-nav-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
            <span>Beranda</span>
        </a>

        <!-- 2: Koleksi / Deals -->
        <a href="<?= BASEURL ?>collection" class="android-nav-item <?= ($page ?? '') === 'collection' ? 'active' : '' ?>" id="androidNavKoleksi">
            <div class="android-nav-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                </svg>
            </div>
            <span>Deals</span>
        </a>

        <!-- 3: Favorit (Wishlist) -->
        <a href="javascript:void(0)" class="android-nav-item <?= ($page ?? '') === 'wishlist' ? 'active' : '' ?>" onclick="handleWishlistNav()">
            <div class="android-nav-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
                <span class="android-badge" id="wishlistCountBadge" style="display:none;">0</span>
            </div>
            <span>Favorit</span>
        </a>

        <!-- 4: Pesanan / Akun -->
        <?php if (!empty($_SESSION['user']) && ($_SESSION['user']['role'] ?? '') === 'seller'): ?>
        <a href="<?= BASEURL ?>seller" class="android-nav-item <?= ($page ?? '') === 'seller' ? 'active' : '' ?>">
            <div class="android-nav-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
            <span>Toko</span>
        </a>
        <?php elseif (!empty($_SESSION['user'])): ?>
        <a href="<?= BASEURL ?>user/orders" class="android-nav-item <?= ($page ?? '') === 'orders' ? 'active' : '' ?>">
            <div class="android-nav-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
            </div>
            <span>Pesanan</span>
        </a>
        <?php else: ?>
        <a href="javascript:void(0)" onclick="openAuthModal('login')" class="android-nav-item">
            <div class="android-nav-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <span>Masuk</span>
        </a>
        <?php endif; ?>

        <!-- 5: Keranjang -->
        <a href="javascript:void(0)" class="android-nav-item android-nav-cart" onclick="<?= !empty($_SESSION['user']) ? 'openCartDrawer()' : 'openAuthModal(\'login\')' ?>">
            <div class="android-nav-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <span class="android-badge cart-badge">0</span>
            </div>
            <span>Keranjang</span>
        </a>
    </nav>

    <!-- GLOBAL AUTH POP-UP MODAL (LOGIN & REGISTER) -->
    <?php require_once dirname(__DIR__) . '/layouts/auth_modal.php'; ?>

    <script src="<?= BASEURL ?>script.js?v=<?= time() ?>"></script>
</body>

</html>
