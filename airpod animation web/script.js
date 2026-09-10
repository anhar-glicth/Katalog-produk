// =====================================================
// DATA PRODUK LENGKAP (LUMINA PEARL)
// =====================================================
const productsData = {
    1: {
        id: 1,
        title: "Ivory Pearl Classic Shell Lamp",
        badge: "Terlaris",
        rating: 4.9,
        reviewsCount: 184,
        price: 289000,
        originalPrice: 399000,
        discount: "28% OFF",
        desc: "Lampu dekorasi cangkang tiram keramik porselen putih mutiara dengan pendaran cahaya hangat menenangkan, menghadirkan estetika mewah di ruangan Anda.",
        mainImage: "images/pearl-white.png",
        thumbnails: [
            "images/pearl-white.png",
            "images/pearl-ocean.png",
            "images/pearl-gold.png",
            "images/pearl-natural.png"
        ],
        colors: [
            { name: "Ivory White", hex: "#f8f5ee", img: "images/pearl-white.png" },
            { name: "Ocean Abyss", hex: "#1e3a5f", img: "images/pearl-ocean.png" },
            { name: "Royal Sunset", hex: "#d4af37", img: "images/pearl-gold.png" },
            { name: "Natural Oyster", hex: "#8c7853", img: "images/pearl-natural.png" }
        ],
        sizes: ["S (14 cm)", "M (17 cm)", "L (20 cm)", "XL (25 cm)"],
        bullets: [
            "Cangkang kerang porselen glasir premium",
            "Cahaya Warm LED 2700K relaksasi mata",
            "Baterai Lithium Rechargeable Type-C (8-10 Jam)",
            "Sensor sentuh cerdas dengan dimmer kecerahan",
            "Mutiara kristal padat ber-luster alami tinggi"
        ],
        materials: "Material utama menggunakan tanah liat kaolin murni yang dibakar pada suhu 1.250°C untuk menghasilkan keramik porselen glasir yang padat, halus, dan tahan lama. Mutiara terbuat dari kristal padat dengan pelapisan nacre organik yang memantulkan spektrum cahaya alami. Semua bahan bebas zat berbahaya dan ramah lingkungan.",
        specs: [
            { label: "Material Utama", val: "Fine Glazed Ceramic" },
            { label: "Sumber Cahaya", val: "Warm LED (Dimmable)" },
            { label: "Kapasitas Baterai", val: "1200 mAh Lithium" },
            { label: "Tipe Pengisian Daya", val: "USB Type-C (5V/1A)" },
            { label: "Dimensi Produk", val: "17 x 15 x 16 cm" },
            { label: "Bobot Total", val: "680 gram" }
        ],
        related: [2, 3, 4, 5]
    },
    2: {
        id: 2,
        title: "Deep Sea Mystic Pearl",
        badge: "Edisi Mistik",
        rating: 4.9,
        reviewsCount: 142,
        price: 349000,
        originalPrice: 480000,
        discount: "27% OFF",
        desc: "Mengangkat keindahan palung laut terdalam, kerang artistik resin kristal ini memancarkan alur ombak cair bergradasi biru safir dengan mutiara bercahaya cyan bioluminescent.",
        mainImage: "images/pearl-ocean.png",
        thumbnails: [
            "images/pearl-ocean.png",
            "images/pearl-white.png",
            "images/pearl-gold.png",
            "images/pearl-natural.png"
        ],
        colors: [
            { name: "Ocean Abyss", hex: "#0f2b48", img: "images/pearl-ocean.png" },
            { name: "Ivory White", hex: "#f8f5ee", img: "images/pearl-white.png" },
            { name: "Royal Sunset", hex: "#d4af37", img: "images/pearl-gold.png" },
            { name: "Natural Akoya", hex: "#8c7853", img: "images/pearl-natural.png" }
        ],
        sizes: ["S (15 cm)", "M (18 cm)", "L (22 cm)", "XL (26 cm)"],
        bullets: [
            "Alur ombak samudra artistik resin & kristal",
            "Pendaran cahaya Oceanic Cyan Bioluminescent",
            "USB-C Fast Charging dengan daya tahan 12 Jam",
            "Touch sensor kontrol dengan 3 level kecerahan",
            "Tahan kelembapan dan tidak mudah pudar"
        ],
        materials: "Dibuat dengan teknik cetak resin artistik polimer bening dan bubuk kristal laut dalam. Menghasilkan tekstur gelombang cair yang menangkap bias cahaya secara dramatis tanpa panas berlebih.",
        specs: [
            { label: "Material Utama", val: "Artisan Resin & Crystal" },
            { label: "Warna Pendaran", val: "Oceanic Cyan / Blue" },
            { label: "Kapasitas Baterai", val: "1500 mAh Lithium" },
            { label: "Tipe Pengisian Daya", val: "USB Type-C Fast Charge" },
            { label: "Dimensi Produk", val: "18 x 16 x 15 cm" },
            { label: "Bobot Total", val: "720 gram" }
        ],
        related: [1, 6, 3, 4]
    },
    3: {
        id: 3,
        title: "Imperial Golden Clam",
        badge: "Kemewahan",
        rating: 4.8,
        reviewsCount: 98,
        price: 379000,
        originalPrice: 499000,
        discount: "24% OFF",
        desc: "Lambang kemewahan istana. Cangkang kerang berdiri dengan tepian glitter emas berkilau membingkai mutiara bulat besar dengan pantulan warna sunset champagne hangat.",
        mainImage: "images/pearl-gold.png",
        thumbnails: [
            "images/pearl-gold.png",
            "images/pearl-white.png",
            "images/pearl-ocean.png",
            "images/pearl-natural.png"
        ],
        colors: [
            { name: "Royal Sunset Gold", hex: "#d4af37", img: "images/pearl-gold.png" },
            { name: "Ivory White", hex: "#f8f5ee", img: "images/pearl-white.png" },
            { name: "Ocean Abyss", hex: "#1e3a5f", img: "images/pearl-ocean.png" },
            { name: "Natural Oyster", hex: "#8c7853", img: "images/pearl-natural.png" }
        ],
        sizes: ["M (17 cm)", "L (20 cm)", "XL (25 cm)"],
        bullets: [
            "Finishing glitter emas mewah tidak mudah rontok",
            "Mutiara raksasa berdiameter 55mm warna champagne",
            "Pencahayaan Sunset Amber Glow menenangkan",
            "Dudukan kokoh anti-selip dengan lapisan beludru",
            "Sangat ideal sebagai hadiah pernikahan & kado mewah"
        ],
        materials: "Perpaduan bahan keramik stoneware berkualitas ekspor dengan aksen leburan emas sintesis dan partikel glitter kristal mikro berpelindung bening anti-gores.",
        specs: [
            { label: "Material Utama", val: "Glazed Ceramic & Gold Trim" },
            { label: "Diameter Mutiara", val: "55 mm Giant Pearl" },
            { label: "Kapasitas Baterai", val: "1200 mAh Lithium" },
            { label: "Tipe Pengisian Daya", val: "USB Type-C" },
            { label: "Dimensi Produk", val: "17 x 15 x 16 cm" },
            { label: "Bobot Total", val: "790 gram" }
        ],
        related: [7, 1, 2, 4]
    },
    4: {
        id: 4,
        title: "Natural Akoya Oyster",
        badge: "Kolektor",
        rating: 5.0,
        reviewsCount: 76,
        price: 450000,
        originalPrice: 590000,
        discount: "24% OFF",
        desc: "Cangkang tiram laut asli (Pinctada Maxima) dengan lapisan nacre multi-warna organik dan mutiara air laut murni pilihan bernilai estetika tinggi.",
        mainImage: "images/pearl-natural.png",
        thumbnails: [
            "images/pearl-natural.png",
            "images/pearl-white.png",
            "images/pearl-ocean.png",
            "images/pearl-gold.png"
        ],
        colors: [
            { name: "Natural Organic", hex: "#8c7853", img: "images/pearl-natural.png" },
            { name: "Ivory White", hex: "#f8f5ee", img: "images/pearl-white.png" },
            { name: "Royal Sunset", hex: "#d4af37", img: "images/pearl-gold.png" }
        ],
        sizes: ["Alami (15-17 cm)", "Koleksi Ekstra (18-20 cm)"],
        bullets: [
            "100% cangkang tiram laut asli perairan tropis",
            "Lapisan nacre prismatik memantulkan bias pelangi alami",
            "Mutiara air laut Grade AAA kualitas tinggi",
            "Dipoles tangan secara lembut mempertahankan tekstur asli",
            "Sangat cocok sebagai wadah cincin nikah & koleksi seni"
        ],
        materials: "Cangkang tiram laut alami dari spesies Pinctada Maxima yang dipanen secara lestari dan dipoles dengan teknik pemolesan kering alami tanpa pewarna kimia buatan.",
        specs: [
            { label: "Asal Spesies", val: "Pinctada Maxima (Laut Tropis)" },
            { label: "Grade Mutiara", val: "South Sea Pearl AAA" },
            { label: "Tipe Kerajinan", val: "100% Hand-Polished Organic" },
            { label: "Dimensi Cangkang", val: "15 x 13 x 10 cm (Alami)" },
            { label: "Bobot Total", val: "420 gram" },
            { label: "Sertifikasi", val: "Keaslian Bahan Organik" }
        ],
        related: [8, 1, 2, 3]
    },
    5: {
        id: 5,
        title: "Aurora Celestial Shell Lamp",
        badge: "Edisi Baru",
        rating: 4.9,
        reviewsCount: 53,
        price: 310000,
        originalPrice: 420000,
        discount: "26% OFF",
        desc: "Lampu cangkang porselen berona putih kristal dengan cahaya lembut bertingkat. Dirancang khusus untuk ruang istirahat yang menenangkan.",
        mainImage: "images/pearl-white.png",
        thumbnails: ["images/pearl-white.png", "images/pearl-ocean.png", "images/pearl-gold.png"],
        colors: [
            { name: "Pure White", hex: "#ffffff", img: "images/pearl-white.png" },
            { name: "Soft Cyan", hex: "#1e3a5f", img: "images/pearl-ocean.png" }
        ],
        sizes: ["M (16 cm)", "L (19 cm)"],
        bullets: [
            "Porselen glasir putih salju mutiara",
            "Mode cahaya malam anti-silau (eye-care LED)",
            "USB-C port tersembunyi di bagian bawah",
            "Daya tahan hingga 10 jam pemakaian non-stop"
        ],
        materials: "Keramik porselen kaolin putih bersuhu tinggi.",
        specs: [
            { label: "Material", val: "Porselen Glasir Putih" },
            { label: "LED", val: "Soft Warm 2700K" },
            { label: "Dimensi", val: "16 x 15 x 15 cm" }
        ],
        related: [1, 2, 3, 4]
    },
    6: {
        id: 6,
        title: "Midnight Sapphire Oyster",
        badge: "Favorit",
        rating: 4.8,
        reviewsCount: 115,
        price: 365000,
        originalPrice: 490000,
        discount: "25% OFF",
        desc: "Karya seni samudra dalam bernuansa safir malam dengan alur ombak kristal berkilau dan mutiara berpendar biru tenang.",
        mainImage: "images/pearl-ocean.png",
        thumbnails: ["images/pearl-ocean.png", "images/pearl-white.png", "images/pearl-gold.png"],
        colors: [
            { name: "Midnight Sapphire", hex: "#0a192f", img: "images/pearl-ocean.png" },
            { name: "Ivory White", hex: "#f8f5ee", img: "images/pearl-white.png" }
        ],
        sizes: ["M (17 cm)", "L (20 cm)"],
        bullets: [
            "Gradasi warna biru safir laut dalam",
            "Cahaya relaksasi biru laut menyejukkan suasana",
            "Baterai tahan lama 12 jam pemakaian",
            "Sensor sentuh responsif"
        ],
        materials: "Resin artistik polimer dan kristal nacre.",
        specs: [
            { label: "Material", val: "Resin Artistik & Kristal" },
            { label: "Baterai", val: "1500 mAh" },
            { label: "Dimensi", val: "18 x 16 x 15 cm" }
        ],
        related: [2, 1, 3, 4]
    },
    7: {
        id: 7,
        title: "Royal Sunset Glow Clam",
        badge: "Eksklusif",
        rating: 4.9,
        reviewsCount: 89,
        price: 399000,
        originalPrice: 520000,
        discount: "23% OFF",
        desc: "Cangkang kerang vertikal megah dengan kilau emas dan mutiara mawar senja bercahaya lembut untuk dekorasi ruang tamu berkelas.",
        mainImage: "images/pearl-gold.png",
        thumbnails: ["images/pearl-gold.png", "images/pearl-white.png", "images/pearl-ocean.png"],
        colors: [
            { name: "Sunset Gold", hex: "#d4af37", img: "images/pearl-gold.png" },
            { name: "Ivory White", hex: "#f8f5ee", img: "images/pearl-white.png" }
        ],
        sizes: ["M (17 cm)", "L (21 cm)"],
        bullets: [
            "Detail ukiran alur kerang simetris megah",
            "Tepian glitter emas berkilau mewah",
            "Mutiara besar berona champagne pink",
            "Baterai USB Type-C isi ulang"
        ],
        materials: "Keramik stoneware dengan glasir emas khusus.",
        specs: [
            { label: "Material", val: "Stoneware & Gold Glitter" },
            { label: "Dimensi", val: "18 x 16 x 17 cm" }
        ],
        related: [3, 1, 2, 4]
    },
    8: {
        id: 8,
        title: "South Sea Mother of Pearl",
        badge: "Organik",
        rating: 5.0,
        reviewsCount: 42,
        price: 480000,
        originalPrice: 620000,
        discount: "22% OFF",
        desc: "Koleksi cangkang tiram laut alami langka dengan mutiara South Sea berkualitas tinggi, mahakarya alam tak ternilai untuk kolektor.",
        mainImage: "images/pearl-natural.png",
        thumbnails: ["images/pearl-natural.png", "images/pearl-gold.png", "images/pearl-white.png"],
        colors: [
            { name: "Natural Mother of Pearl", hex: "#8c7853", img: "images/pearl-natural.png" }
        ],
        sizes: ["Ukuran Alami (16-18 cm)"],
        bullets: [
            "100% Cangkang tiram laut asli langka",
            "Kilau nacre prismatik warna-warni",
            "Mutiara air laut murni pilihan",
            "Wadah perhiasan elegan dan tahan selamanya"
        ],
        materials: "Cangkang tiram laut alami Pinctada Maxima murni.",
        specs: [
            { label: "Spesies", val: "Pinctada Maxima Asli" },
            { label: "Dimensi", val: "16 x 14 x 11 cm" }
        ],
        related: [4, 1, 2, 3]
    }
};

function formatRupiah(num) {
    return 'Rp ' + num.toLocaleString('id-ID');
}

// =====================================================
// =====================================================
// CART STATE & CHECKOUT DRAWER SYSTEM (LUXURY NO-EMOJI)
// =====================================================
const COURIER_OPTIONS = [
    { id: 'jne', name: 'JNE Regular', est: '2 - 3 Hari', price: 18000 },
    { id: 'sicepat', name: 'SiCepat BEST', est: '1 - 2 Hari', price: 22000 },
    { id: 'jnt', name: 'J&T Express', est: '2 - 3 Hari', price: 19000 },
    { id: 'gosend', name: 'GoSend Instant', est: '3 Jam Tiba', price: 35000 }
];

const PAYMENT_OPTIONS = [
    {
        id: 'qris',
        name: 'QRIS Instant',
        desc: 'BCA, GoPay, OVO, Dana, ShopeePay',
        badge: 'Otomatis',
        icon: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>`
    },
    {
        id: 'va_bca',
        name: 'BCA Virtual Account',
        desc: 'Verifikasi otomatis 24 Jam',
        badge: 'Otomatis',
        icon: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>`
    },
    {
        id: 'va_mandiri',
        name: 'Mandiri Virtual Account',
        desc: 'Verifikasi instan via Livin/ATM',
        badge: 'Otomatis',
        icon: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"></path><path d="M5 21V9"></path><path d="M19 21V9"></path><path d="M9 21V9"></path><path d="M15 21V9"></path><polygon points="12 2 2 7 22 7"></polygon></svg>`
    },
    {
        id: 'cc',
        name: 'Kartu Kredit / Debit',
        desc: 'Visa, Mastercard, JCB (3D Secure)',
        badge: 'Aman',
        icon: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>`
    },
    {
        id: 'cod',
        name: 'COD (Bayar di Tempat)',
        desc: 'Bayar tunai kepada kurir saat tiba',
        badge: 'Tunai',
        icon: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"></rect><circle cx="12" cy="12" r="2"></circle><path d="M6 12h.01M18 12h.01"></path></svg>`
    }
];

const ADMIN_FEE = 2000;
const FREE_SHIPPING_MIN = 300000;

let selectedCourierId = localStorage.getItem('lumina_selected_courier') || 'jne';
let selectedPaymentId = localStorage.getItem('lumina_selected_payment') || 'qris';

// Fetch Cart from LocalStorage
function getCart() {
    const raw = localStorage.getItem('lumina_cart_items');
    if (raw !== null) {
        try {
            const parsed = JSON.parse(raw);
            if (Array.isArray(parsed)) return parsed;
        } catch (e) {
            console.error('Failed to parse cart items', e);
        }
    }

    // Default seed if completely uninitialized
    const seed = [
        {
            id: 1,
            title: productsData[1] ? productsData[1].title : "Ivory Pearl Classic Shell Lamp",
            price: productsData[1] ? productsData[1].price : 289000,
            image: "images/pearl-white.png",
            variant: "Ivory White",
            size: "M (17 cm)",
            qty: 2
        },
        {
            id: 2,
            title: productsData[2] ? productsData[2].title : "Deep Sea Mystic Pearl",
            price: productsData[2] ? productsData[2].price : 349000,
            image: "images/pearl-ocean.png",
            variant: "Ocean Abyss",
            size: "M (18 cm)",
            qty: 1
        }
    ];
    localStorage.setItem('lumina_cart_items', JSON.stringify(seed));
    return seed;
}

function saveCart(cart) {
    localStorage.setItem('lumina_cart_items', JSON.stringify(cart));
    const totalCount = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
    localStorage.setItem('lumina_cart_count', totalCount);
    updateCartBadges(totalCount);
    renderCartDrawer();
}

function updateCartBadges(count = null) {
    if (count === null) {
        const cart = getCart();
        count = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
    }
    const badges = document.querySelectorAll('.cart-badge');
    badges.forEach(badge => {
        badge.innerText = count;
        badge.style.transform = 'scale(1.25)';
        setTimeout(() => { badge.style.transform = 'scale(1)'; }, 200);
    });
}

function addToCart(newItem) {
    const cart = getCart();
    const existingIndex = cart.findIndex(it => 
        it.id === newItem.id && 
        it.variant === newItem.variant && 
        it.size === newItem.size
    );

    if (existingIndex > -1) {
        cart[existingIndex].qty += (newItem.qty || 1);
    } else {
        cart.push({
            id: newItem.id,
            title: newItem.title || 'Lumina Pearl',
            price: newItem.price || 289000,
            image: newItem.image || 'images/pearl-white.png',
            variant: newItem.variant || 'Standard',
            size: newItem.size || 'Standard',
            qty: newItem.qty || 1
        });
    }

    saveCart(cart);
    showToast(`${newItem.title} · ${newItem.qty || 1} item`, 'Ditambahkan ke Keranjang');
}

function updateCartItemQty(index, delta) {
    const cart = getCart();
    if (!cart[index]) return;

    cart[index].qty += delta;
    if (cart[index].qty <= 0) {
        cart.splice(index, 1);
        showToast('Produk dihapus dari keranjang', 'Keranjang Diperbarui');
    }
    saveCart(cart);
}

function removeCartItem(index) {
    const cart = getCart();
    if (!cart[index]) return;
    const itemTitle = cart[index].title;
    cart.splice(index, 1);
    saveCart(cart);
    showToast(`${itemTitle} telah dihapus`, 'Produk Dihapus');
}

function clearCart() {
    saveCart([]);
    showToast('Semua produk dalam keranjang telah dikosongkan', 'Keranjang Kosong');
}

// Calculate Cart Totals
function calculateCartTotals() {
    const cart = getCart();
    const subtotal = cart.reduce((sum, it) => sum + ((it.price || 0) * (it.qty || 1)), 0);
    const totalQty = cart.reduce((sum, it) => sum + (it.qty || 1), 0);

    const courier = COURIER_OPTIONS.find(c => c.id === selectedCourierId) || COURIER_OPTIONS[0];
    const isFreeShipping = subtotal >= FREE_SHIPPING_MIN;
    const courierFee = totalQty > 0 ? (isFreeShipping ? 0 : courier.price) : 0;
    const courierDiscount = totalQty > 0 && isFreeShipping ? courier.price : 0;
    const adminFee = totalQty > 0 ? ADMIN_FEE : 0;
    const grandTotal = subtotal + courierFee + adminFee;

    return {
        subtotal,
        totalQty,
        courier,
        isFreeShipping,
        courierFee,
        courierDiscount,
        adminFee,
        grandTotal
    };
}

// Create Drawer DOM if not present
function ensureCartDrawerDOM() {
    if (document.getElementById('cartDrawerOverlay')) return;

    const overlay = document.createElement('div');
    overlay.id = 'cartDrawerOverlay';
    overlay.className = 'cart-drawer-overlay';
    overlay.innerHTML = `
        <div class="cart-drawer" id="cartDrawer">
            <!-- Header -->
            <div class="cart-drawer-header">
                <div class="cart-drawer-header-left">
                    <div class="cart-drawer-header-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </div>
                    <div>
                        <h3>Keranjang Belanja</h3>
                        <div class="cart-drawer-header-sub" id="drawerHeaderSub">0 Produk Terpilih</div>
                    </div>
                </div>
                <button class="cart-drawer-close-btn" id="drawerCloseBtn" aria-label="Tutup Keranjang" title="Tutup">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Scrollable Body -->
            <div class="cart-drawer-body" id="cartDrawerBody">
                <!-- Section 1: Product List -->
                <div class="cart-card-section">
                    <div class="cart-card-header">
                        <h4>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b3c5d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            Daftar Pesanan
                        </h4>
                        <button class="cart-clear-btn" id="drawerClearBtn">Kosongkan</button>
                    </div>
                    <div class="cart-items-list" id="drawerItemsList">
                        <!-- Items dynamically injected -->
                    </div>
                </div>

                <!-- Section 2: Courier Selection -->
                <div class="cart-card-section">
                    <div class="cart-card-header">
                        <h4>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b3c5d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                            Pilih Kurir & Ekspedisi
                        </h4>
                        <span class="cart-card-tag">Berasuransi</span>
                    </div>
                    <div class="courier-options" id="drawerCouriersList">
                        <!-- Couriers dynamically injected -->
                    </div>
                </div>

                <!-- Section 3: Payment Gateway Selection -->
                <div class="cart-card-section">
                    <div class="cart-card-header">
                        <h4>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b3c5d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                            Metode Pembayaran
                        </h4>
                        <span class="cart-card-tag">Terverifikasi</span>
                    </div>
                    <div class="payment-options" id="drawerPaymentsList">
                        <!-- Payments dynamically injected -->
                    </div>
                </div>

                <!-- Section 4: Price Breakdown -->
                <div class="cart-card-section">
                    <div class="cart-card-header">
                        <h4>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0f172a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            Rincian Pembayaran
                        </h4>
                    </div>
                    <div class="cart-summary-line">
                        <span>Subtotal Produk (<span id="summaryItemCount">0</span> item)</span>
                        <span id="summarySubtotalVal">Rp 0</span>
                    </div>
                    <div class="cart-summary-line">
                        <span>Biaya Kurir (<span id="summaryCourierTitle">JNE Regular</span>)</span>
                        <span id="summaryCourierVal">Rp 0</span>
                    </div>
                    <div class="cart-summary-line" id="summaryDiscountRow" style="display: none;">
                        <span style="color: #0f172a; font-weight: 600;">Diskon Promo Bebas Ongkir</span>
                        <span style="color: #0f172a; font-weight: 700;" id="summaryDiscountVal">-Rp 0</span>
                    </div>
                    <div class="cart-summary-line">
                        <span>Biaya Layanan Admin</span>
                        <span id="summaryAdminVal">Rp 2.000</span>
                    </div>
                    <div class="cart-summary-divider"></div>
                    <div class="cart-summary-total">
                        <div>
                            <span class="cart-summary-total-label">Total Pembayaran</span>
                            <span class="cart-summary-total-sub">Termasuk PPN & Asuransi Pengiriman</span>
                        </div>
                        <span class="cart-summary-total-val" id="summaryGrandTotalVal">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Sticky Footer CTA -->
            <div class="cart-drawer-footer">
                <div class="drawer-footer-trust">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>Jaminan Keamanan Enkripsi 256-Bit SSL</span>
                </div>
                <button class="cart-checkout-btn" id="drawerCheckoutBtn">
                    <span class="checkout-btn-label">
                        <span>Bayar Sekarang</span>
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                    <span class="checkout-btn-total" id="drawerBtnTotalVal">Rp 0</span>
                </button>
            </div>
        </div>
    `;

    document.body.appendChild(overlay);

    // Wire close triggers
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            closeCartDrawer();
        }
    });

    const closeBtn = overlay.querySelector('#drawerCloseBtn');
    if (closeBtn) closeBtn.onclick = closeCartDrawer;

    const clearBtn = overlay.querySelector('#drawerClearBtn');
    if (clearBtn) clearBtn.onclick = clearCart;

    const checkoutBtn = overlay.querySelector('#drawerCheckoutBtn');
    if (checkoutBtn) checkoutBtn.onclick = handleCheckout;

    // ESC key listener
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCartDrawer();
            closeCheckoutModal();
        }
    });
}

// Render Drawer Contents
function renderCartDrawer() {
    ensureCartDrawerDOM();
    const cart = getCart();
    const totals = calculateCartTotals();

    // Subtitle & Counters
    const headerSub = document.getElementById('drawerHeaderSub');
    if (headerSub) headerSub.innerText = `${totals.totalQty} Produk Terpilih`;

    const summaryItemCount = document.getElementById('summaryItemCount');
    if (summaryItemCount) summaryItemCount.innerText = totals.totalQty;

    // Items List
    const itemsList = document.getElementById('drawerItemsList');
    const clearBtn = document.getElementById('drawerClearBtn');

    if (itemsList) {
        if (cart.length === 0) {
            if (clearBtn) clearBtn.style.display = 'none';
            itemsList.innerHTML = `
                <div class="cart-empty-state">
                    <div class="cart-empty-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </div>
                    <h5>Keranjang Belanja Kosong</h5>
                    <p>Pilih dan temukan koleksi lampu kerang mutiara terbaik kami untuk hunian Anda.</p>
                    <button class="cart-empty-btn" id="emptyBrowseBtn">Jelajahi Koleksi</button>
                </div>
            `;
            const browseBtn = itemsList.querySelector('#emptyBrowseBtn');
            if (browseBtn) {
                browseBtn.onclick = () => {
                    closeCartDrawer();
                    const coll = document.getElementById('koleksi');
                    if (coll) coll.scrollIntoView({ behavior: 'smooth' });
                    else window.location.href = 'index.html#koleksi';
                };
            }
        } else {
            if (clearBtn) clearBtn.style.display = 'block';
            itemsList.innerHTML = cart.map((item, index) => `
                <div class="cart-item-row" data-index="${index}">
                    <div class="cart-item-img">
                        <img src="${item.image}" alt="${item.title}">
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-title" title="${item.title}">${item.title}</div>
                        <div class="cart-item-meta">${item.variant} · ${item.size}</div>
                        <div class="cart-item-price-qty">
                            <span class="cart-item-unit-price">${formatRupiah(item.price * item.qty)}</span>
                            <div class="cart-stepper">
                                <button class="cart-stepper-btn" onclick="updateCartItemQty(${index}, -1)" title="Kurangi">&minus;</button>
                                <span class="cart-stepper-val">${item.qty}</span>
                                <button class="cart-stepper-btn" onclick="updateCartItemQty(${index}, 1)" title="Tambah">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <button class="cart-item-del" onclick="removeCartItem(${index})" title="Hapus Produk" aria-label="Hapus">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                    </button>
                </div>
            `).join('');
        }
    }

    // Courier List
    const couriersList = document.getElementById('drawerCouriersList');
    if (couriersList) {
        couriersList.innerHTML = COURIER_OPTIONS.map(c => {
            const isSelected = c.id === selectedCourierId;
            const costFormatted = totals.isFreeShipping && cart.length > 0
                ? `<span style="text-decoration: line-through; color: #94a3b8; font-size: 0.9em;">${formatRupiah(c.price)}</span> <span class="courier-free-tag">GRATIS</span>`
                : formatRupiah(c.price);

            return `
                <div class="courier-card ${isSelected ? 'selected' : ''}" onclick="selectCourier('${c.id}')">
                    <div class="courier-card-left">
                        <div class="courier-radio">
                            <div class="courier-radio-dot"></div>
                        </div>
                        <div>
                            <span class="courier-name">${c.name}</span>
                            <span class="courier-est">Estimasi ${c.est}</span>
                        </div>
                    </div>
                    <div class="courier-cost">${costFormatted}</div>
                </div>
            `;
        }).join('');
    }

    // Payments List
    const paymentsList = document.getElementById('drawerPaymentsList');
    if (paymentsList) {
        paymentsList.innerHTML = PAYMENT_OPTIONS.map(p => {
            const isSelected = p.id === selectedPaymentId;
            return `
                <div class="payment-card ${isSelected ? 'selected' : ''}" onclick="selectPayment('${p.id}')">
                    <div class="payment-card-left">
                        <div class="payment-icon">${p.icon}</div>
                        <div>
                            <span class="payment-name">${p.name}</span>
                            <span class="payment-desc">${p.desc}</span>
                        </div>
                    </div>
                    <span class="payment-badge">${p.badge}</span>
                </div>
            `;
        }).join('');
    }

    // Summary Breakdown
    const subtotalEl = document.getElementById('summarySubtotalVal');
    if (subtotalEl) subtotalEl.innerText = formatRupiah(totals.subtotal);

    const courierTitleEl = document.getElementById('summaryCourierTitle');
    if (courierTitleEl) courierTitleEl.innerText = totals.courier.name;

    const courierValEl = document.getElementById('summaryCourierVal');
    if (courierValEl) courierValEl.innerText = totals.courierFee === 0 && totals.subtotal >= FREE_SHIPPING_MIN
        ? 'Rp 0 (Bebas Ongkir)'
        : formatRupiah(totals.courierFee);

    const discountRow = document.getElementById('summaryDiscountRow');
    const discountValEl = document.getElementById('summaryDiscountVal');
    if (discountRow && discountValEl) {
        if (totals.courierDiscount > 0) {
            discountRow.style.display = 'flex';
            discountValEl.innerText = `-${formatRupiah(totals.courierDiscount)}`;
        } else {
            discountRow.style.display = 'none';
        }
    }

    const adminValEl = document.getElementById('summaryAdminVal');
    if (adminValEl) adminValEl.innerText = formatRupiah(totals.adminFee);

    const grandTotalValEl = document.getElementById('summaryGrandTotalVal');
    if (grandTotalValEl) grandTotalValEl.innerText = formatRupiah(totals.grandTotal);

    const btnTotalVal = document.getElementById('drawerBtnTotalVal');
    if (btnTotalVal) btnTotalVal.innerText = formatRupiah(totals.grandTotal);

    const checkoutBtn = document.getElementById('drawerCheckoutBtn');
    if (checkoutBtn) {
        checkoutBtn.disabled = cart.length === 0;
    }
}

function selectCourier(courierId) {
    selectedCourierId = courierId;
    localStorage.setItem('lumina_selected_courier', courierId);
    renderCartDrawer();
}

function selectPayment(paymentId) {
    selectedPaymentId = paymentId;
    localStorage.setItem('lumina_selected_payment', paymentId);
    renderCartDrawer();
}

function openCartDrawer() {
    ensureCartDrawerDOM();
    renderCartDrawer();
    const overlay = document.getElementById('cartDrawerOverlay');
    if (overlay) {
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeCartDrawer() {
    const overlay = document.getElementById('cartDrawerOverlay');
    if (overlay) {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Checkout Modal Implementation
function ensureCheckoutModalDOM() {
    if (document.getElementById('checkoutModalOverlay')) return;

    const modalOverlay = document.createElement('div');
    modalOverlay.id = 'checkoutModalOverlay';
    modalOverlay.className = 'checkout-modal-overlay';
    modalOverlay.innerHTML = `
        <div class="checkout-modal">
            <div class="checkout-modal-header">
                <div class="checkout-success-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h3>Pesanan Berhasil Dibuat</h3>
                <p>Nomor Pesanan: <strong id="modalOrderNum">#LUM-2026-8819</strong></p>
            </div>
            <div class="checkout-modal-body" id="modalCheckoutBody">
                <!-- Injected based on payment -->
            </div>
            <div class="checkout-modal-footer">
                <button class="checkout-done-btn" id="modalDoneBtn">Saya Sudah Bayar / Selesai</button>
                <button class="checkout-close-modal-btn" id="modalCloseBtn">Tutup</button>
            </div>
        </div>
    `;

    document.body.appendChild(modalOverlay);

    const doneBtn = modalOverlay.querySelector('#modalDoneBtn');
    if (doneBtn) {
        doneBtn.onclick = () => {
            clearCart();
            closeCheckoutModal();
            closeCartDrawer();
            showToast('Terima kasih! Pesanan Anda sedang diproses oleh tim Lumina.', 'Pembayaran Berhasil');
        };
    }

    const closeBtn = modalOverlay.querySelector('#modalCloseBtn');
    if (closeBtn) closeBtn.onclick = closeCheckoutModal;

    modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) closeCheckoutModal();
    });
}

function handleCheckout() {
    const cart = getCart();
    if (cart.length === 0) {
        showToast('Tambahkan produk terlebih dahulu ke keranjang', 'Keranjang Kosong');
        return;
    }

    ensureCheckoutModalDOM();
    const totals = calculateCartTotals();
    const payment = PAYMENT_OPTIONS.find(p => p.id === selectedPaymentId) || PAYMENT_OPTIONS[0];
    const orderNum = `#LUM-${new Date().getFullYear()}${String(new Date().getMonth() + 1).padStart(2, '0')}-${Math.floor(1000 + Math.random() * 9000)}`;

    const orderNumEl = document.getElementById('modalOrderNum');
    if (orderNumEl) orderNumEl.innerText = orderNum;

    let paymentContentHtml = '';

    if (selectedPaymentId === 'qris') {
        paymentContentHtml = `
            <div class="payment-instruction-card">
                <h5>Pindai QRIS untuk Menyelesaikan Pembayaran</h5>
                <p style="margin: 4px 0 10px 0; font-size: 0.82em; color: #475569;">Buka aplikasi m-Banking atau e-Wallet (BCA, GoPay, OVO, ShopeePay, Dana)</p>
                <div class="qris-code-box">
                    <div class="qris-svg-wrap">
                        <svg width="130" height="130" viewBox="0 0 24 24" fill="none" stroke="#0f172a" stroke-width="1.8">
                            <rect x="2" y="2" width="8" height="8" rx="1"></rect>
                            <rect x="4" y="4" width="4" height="4" fill="#0f172a"></rect>
                            <rect x="14" y="2" width="8" height="8" rx="1"></rect>
                            <rect x="16" y="4" width="4" height="4" fill="#0f172a"></rect>
                            <rect x="2" y="14" width="8" height="8" rx="1"></rect>
                            <rect x="4" y="16" width="4" height="4" fill="#0f172a"></rect>
                            <rect x="13" y="13" width="3" height="3" fill="#0f172a"></rect>
                            <rect x="18" y="13" width="4" height="3" fill="#0f172a"></rect>
                            <rect x="13" y="18" width="8" height="4" fill="#0f172a"></rect>
                        </svg>
                    </div>
                    <span style="font-size: 0.76em; font-weight: 700; color: #0f172a; margin-top: 6px;">NMID: ID1020268491029</span>
                </div>
                <div style="font-size: 0.82em; color: #0b3c5d; font-weight: 600;">Selesaikan dalam waktu 14:59 menit</div>
            </div>
        `;
    } else if (selectedPaymentId.startsWith('va_')) {
        const vaNumber = selectedPaymentId === 'va_bca' ? '8801 2948 1029 4812' : '8902 3810 5928 1194';
        paymentContentHtml = `
            <div class="payment-instruction-card">
                <h5>Nomor Virtual Account ${payment.name}</h5>
                <p style="margin: 4px 0 10px 0; font-size: 0.82em; color: #475569;">Gunakan menu Transfer Virtual Account pada aplikasi mobile banking Anda.</p>
                <div class="va-number-box">
                    <span id="vaNumberDisplay">${vaNumber}</span>
                    <button class="copy-va-btn" onclick="copyVirtualAccount('${vaNumber}')">Salin</button>
                </div>
                <div style="font-size: 0.8em; color: #0f172a; font-weight: 600;">Verifikasi instan tanpa perlu unggah bukti transfer</div>
            </div>
        `;
    } else if (selectedPaymentId === 'cc') {
        paymentContentHtml = `
            <div class="payment-instruction-card">
                <h5>Pembayaran Kartu Kredit / Debit</h5>
                <p style="margin: 4px 0; font-size: 0.82em; color: #475569;">Transaksi dilindungi oleh enkripsi 3D Secure dan Visa/Mastercard Identity Check.</p>
                <div style="margin: 12px 0; padding: 10px; background: #ffffff; border-radius: 8px; font-size: 0.85em; font-weight: 600; color: #0b3c5d;">
                    Status: Siap Dialihkan ke Gateway 3D-Secure
                </div>
            </div>
        `;
    } else {
        paymentContentHtml = `
            <div class="payment-instruction-card">
                <h5>Bayar di Tempat (Cash on Delivery)</h5>
                <p style="margin: 4px 0; font-size: 0.82em; color: #475569;">Pesanan Anda akan langsung diproses dan dikirimkan oleh kurir pilihan.</p>
                <div style="margin: 12px 0; padding: 10px; background: #ffffff; border-radius: 8px; font-size: 0.85em; font-weight: 600; color: #0b3c5d;">
                    Siapkan uang tunai pas kepada kurir saat paket tiba di alamat Anda.
                </div>
            </div>
        `;
    }

    const modalBody = document.getElementById('modalCheckoutBody');
    if (modalBody) {
        modalBody.innerHTML = `
            ${paymentContentHtml}
            <div class="invoice-box">
                <div class="invoice-row">
                    <span>Metode Pembayaran</span>
                    <strong>${payment.name}</strong>
                </div>
                <div class="invoice-row">
                    <span>Layanan Pengiriman</span>
                    <strong>${totals.courier.name} (${totals.courier.est})</strong>
                </div>
                <div class="invoice-row">
                    <span>Jumlah Barang</span>
                    <strong>${totals.totalQty} Produk</strong>
                </div>
                <div class="invoice-row">
                    <span>Total Tagihan</span>
                    <strong style="color: #0b3c5d; font-size: 1.15em;">${formatRupiah(totals.grandTotal)}</strong>
                </div>
            </div>
        `;
    }

    const modalOverlay = document.getElementById('checkoutModalOverlay');
    if (modalOverlay) {
        modalOverlay.classList.add('active');
    }
}

function closeCheckoutModal() {
    const modalOverlay = document.getElementById('checkoutModalOverlay');
    if (modalOverlay) {
        modalOverlay.classList.remove('active');
    }
}

function copyVirtualAccount(vaNum) {
    const cleanNum = vaNum.replace(/\s+/g, '');
    navigator.clipboard.writeText(cleanNum).then(() => {
        showToast(`Nomor Virtual Account ${cleanNum} berhasil disalin`, 'Berhasil Disalin');
    }).catch(() => {
        showToast(cleanNum, 'Nomor VA');
    });
}

// Backward compatibility helper
function incrementCart(qty = 1, productName = 'Produk') {
    addToCart({
        id: 1,
        title: productName,
        price: 289000,
        image: 'images/pearl-white.png',
        variant: 'Standard',
        size: 'Standard',
        qty: qty
    });
    openCartDrawer();
}

// Initialise Badges on Page Load
document.addEventListener('DOMContentLoaded', () => {
    updateCartBadges();

    // Wire all header cart buttons across both index.html and detail.html
    document.querySelectorAll('#headerCartBtn, .header-cart').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            openCartDrawer();
        });
    });
});

function showToast(message, title = 'Notifikasi') {
    let toast = document.getElementById('toastMsg');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toastMsg';
        toast.className = 'toast-notification';
        document.body.appendChild(toast);
    }
    toast.innerHTML = `
        <div class="toast-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        <div class="toast-body">
            <div class="toast-status">${title}</div>
            <div class="toast-text">${message}</div>
        </div>
        <button class="toast-close" type="button" aria-label="Tutup">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    `;

    const closeBtn = toast.querySelector('.toast-close');
    if (closeBtn) {
        closeBtn.onclick = () => toast.classList.remove('show');
    }

    toast.classList.remove('show');
    void toast.offsetWidth;
    toast.classList.add('show');

    clearTimeout(toast.timer);
    toast.timer = setTimeout(() => {
        toast.classList.remove('show');
    }, 3500);
}

// =====================================================
// CAROUSEL SLIDER HERO LOGIC (FOR INDEX.HTML)
// =====================================================
let nextButton = document.getElementById('next');
let prevButton = document.getElementById('prev');
let carousel = document.querySelector('.carousel');
let listHTML = document.querySelector('.carousel .list');
let seeMoreButtons = document.querySelectorAll('.seeMore');
let backButton = document.getElementById('back');

if (nextButton && prevButton && carousel && listHTML) {
    nextButton.onclick = function(){
        showSlider('next');
    }
    prevButton.onclick = function(){
        showSlider('prev');
    }

    let unAcceppClick;
    const showSlider = (type) => {
        nextButton.style.pointerEvents = 'none';
        prevButton.style.pointerEvents = 'none';

        carousel.classList.remove('next', 'prev');
        let items = document.querySelectorAll('.carousel .list .item');
        if(type === 'next'){
            listHTML.appendChild(items[0]);
            carousel.classList.add('next');
        }else{
            listHTML.prepend(items[items.length - 1]);
            carousel.classList.add('prev');
        }
        clearTimeout(unAcceppClick);
        unAcceppClick = setTimeout(()=>{
            nextButton.style.pointerEvents = 'auto';
            prevButton.style.pointerEvents = 'auto';
        }, 2000);
    }

    // When seeMore is clicked -> Open NEW PAGE (detail.html?id=...)
    seeMoreButtons.forEach((button) => {
        button.onclick = function(e){
            e.preventDefault();
            e.stopPropagation();
            const pId = button.getAttribute('data-product-id') || 1;
            window.location.href = `detail.html?id=${pId}`;
        }
    });

    // Also wire "DETAIL LENGKAP" in carousel split view -> Open NEW PAGE
    document.querySelectorAll('.open-pdp-direct').forEach(btn => {
        btn.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            const pId = btn.getAttribute('data-product-id') || 1;
            window.location.href = `detail.html?id=${pId}`;
        }
    });

    if (backButton) {
        backButton.onclick = function(){
            carousel.classList.remove('showDetail');
        }
    }
}

// =====================================================
// CATALOG PRODUCT GRID (NAVIGATE TO DETAIL.HTML)
// =====================================================
const productCards = document.querySelectorAll('.product-card');

productCards.forEach(card => {
    card.style.cursor = 'pointer';
    card.addEventListener('click', (e) => {
        // If click was on add-to-cart button, don't navigate
        if (e.target.closest('.add-cart-btn')) return;
        const pId = card.getAttribute('data-id') || 1;
        window.location.href = `detail.html?id=${pId}`;
    });
});

// Add to Cart from catalog cards (without navigating away)
document.querySelectorAll('.add-cart-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        const card = button.closest('.product-card');
        const pId = parseInt(card?.getAttribute('data-id') || '1', 10);
        const prod = productsData[pId] || productsData[1];
        addToCart({
            id: prod.id,
            title: prod.title,
            price: prod.price,
            image: prod.mainImage,
            variant: prod.colors ? prod.colors[0].name : 'Standard',
            size: prod.sizes ? prod.sizes[0] : 'Standard',
            qty: 1
        });
        openCartDrawer();
    });
});

// Add to Cart from carousel split detail view ("BELI SEKARANG")
document.querySelectorAll('.add-to-cart-action').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        const pId = parseInt(btn.getAttribute('data-product-id') || '1', 10);
        const prod = productsData[pId] || productsData[1];
        addToCart({
            id: prod.id,
            title: prod.title,
            price: prod.price,
            image: prod.mainImage,
            variant: prod.colors ? prod.colors[0].name : 'Standard',
            size: prod.sizes ? prod.sizes[0] : 'Standard',
            qty: 1
        });
        openCartDrawer();
    });
});

// Category Filter Tabs
const filterButtons = document.querySelectorAll('.filter-btn');

filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        filterButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.getAttribute('data-filter');

        productCards.forEach(card => {
            const category = card.getAttribute('data-category');
            if (filter === 'all' || category === filter) {
                card.style.display = 'flex';
                card.style.animation = 'fadeIn 0.4s ease forwards';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Newsletter Form
const newsletterForm = document.querySelector('.newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const input = newsletterForm.querySelector('input');
        if (input && input.value) {
            showToast(`Terima kasih! Voucher diskon 10% telah dikirim ke <strong>${input.value}</strong>.`);
            input.value = '';
        }
    });
}