<?php
// ========================================================
// LUMINA PEARL - SELLER CONTROLLER (SELLER CENTER MULTI-VENDOR)
// ========================================================

class SellerController extends Controller {

    /**
     * Memeriksa autentikasi khusus role 'seller' atau 'admin'
     */
    private function checkSellerAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['seller', 'admin'])) {
            $_SESSION['flash_error'] = "Akses khusus pengelola toko / admin. Silakan masuk terlebih dahulu.";
            $this->redirect('auth/login');
            exit;
        }
    }

    /**
     * Memeriksa autentikasi khusus role 'admin'
     */
    private function checkAdminOnly() {
        $this->checkSellerAuth();
        if (($_SESSION['user']['role'] ?? '') !== 'admin') {
            $_SESSION['flash_error'] = "Akses ditolak: Menu ini hanya dapat dikelola oleh Super Administrator.";
            $this->redirect('seller');
            exit;
        }
    }

    /**
     * 1. DASHBOARD
     */
    public function index() {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $productModel = $this->model('ProductModel');
        $orderModel = $this->model('OrderModel');
        $categoryModel = $this->model('CategoryModel');
        $courierModel = $this->model('CourierModel');
        $userModel = $this->model('UserModel');

        $stats = $orderModel->getSellerStats($sellerId);
        $totalProducts = $productModel->countBySellerId($sellerId);
        $totalCategories = $categoryModel->count();
        $totalCouriers = $courierModel->count();
        $totalUsers = $userModel->count();
        $recentOrders = array_slice($orderModel->getOrdersBySellerId($sellerId), 0, 5);

        $data = [
            'title' => 'Dashboard | ' . APP_NAME,
            'page' => 'dashboard',
            'user' => $_SESSION['user'],
            'stats' => $stats,
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalCouriers' => $totalCouriers,
            'totalUsers' => $totalUsers,
            'recentOrders' => $recentOrders
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/dashboard', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * 2. PRODUK LIST
     */
    public function products() {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $productModel = $this->model('ProductModel');
        $categoryModel = $this->model('CategoryModel');

        $products = $productModel->getBySellerId($sellerId);
        $categories = $categoryModel->getAll();

        $data = [
            'title' => 'Produk List | ' . APP_NAME,
            'page' => 'products',
            'user' => $_SESSION['user'],
            'products' => $products,
            'categories' => $categories
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/products/index', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Tambah Produk
     */
    public function productAdd() {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $productModel = $this->model('ProductModel');
        $categoryModel = $this->model('CategoryModel');
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extractProductPostData();
            $data['seller_id'] = $sellerId;

            if (empty($data['title']) || empty($data['price'])) {
                $error = 'Judul produk dan harga wajib diisi!';
            } else {
                $newId = $productModel->create($data);
                $_SESSION['flash_message'] = "Produk berhasil ditambahkan ke daftar produk Anda (ID: #$newId)!";
                $this->redirect('seller/products');
                return;
            }
        }

        $data = [
            'title' => 'Tambah Produk Baru | ' . APP_NAME,
            'page' => 'products',
            'user' => $_SESSION['user'],
            'product' => null,
            'categories' => $categoryModel->getAll(),
            'error' => $error,
            'formAction' => BASEURL . 'seller/productAdd'
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/products/form', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Edit Produk
     */
    public function productEdit($id = null) {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $id = (int)$id;
        $productModel = $this->model('ProductModel');
        $categoryModel = $this->model('CategoryModel');
        $product = $productModel->getById($id);

        if (!$product) {
            $_SESSION['flash_error'] = 'Produk tidak ditemukan!';
            $this->redirect('seller/products');
            return;
        }

        // Proteksi IDOR: Penjual hanya boleh mengedit produk miliknya sendiri
        if ($_SESSION['user']['role'] !== 'admin' && (int)$product['seller_id'] !== $sellerId) {
            $_SESSION['flash_error'] = 'Akses ditolak: Anda tidak memiliki izin untuk mengedit produk toko lain!';
            $this->redirect('seller/products');
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extractProductPostData();
            $data['seller_id'] = $sellerId;

            if (empty($data['title']) || empty($data['price'])) {
                $error = 'Judul produk dan harga wajib diisi!';
            } else {
                $productModel->update($id, $data);
                $_SESSION['flash_message'] = "Produk '{$data['title']}' berhasil diperbarui!";
                $this->redirect('seller/products');
                return;
            }
        }

        $data = [
            'title' => 'Edit Produk: ' . $product['title'] . ' | ' . APP_NAME,
            'page' => 'products',
            'user' => $_SESSION['user'],
            'product' => $product,
            'categories' => $categoryModel->getAll(),
            'error' => $error,
            'formAction' => BASEURL . 'seller/productEdit/' . $id
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/products/form', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Hapus Produk
     */
    public function productDelete($id = null) {
        $this->checkSellerAuth();

        $id = (int)$id;
        $sellerId = (int)$_SESSION['user']['id'];
        $productModel = $this->model('ProductModel');
        $product = $productModel->getById($id);

        if ($product) {
            // Proteksi IDOR: Penjual hanya boleh menghapus produk miliknya sendiri
            if ($_SESSION['user']['role'] !== 'admin' && (int)$product['seller_id'] !== $sellerId) {
                $_SESSION['flash_error'] = 'Akses ditolak: Anda tidak dapat menghapus produk milik toko lain!';
                $this->redirect('seller/products');
                return;
            }
            $productModel->delete($id);
            $_SESSION['flash_message'] = "Produk '{$product['title']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = 'Produk tidak ditemukan.';
        }

        $this->redirect('seller/products');
    }

    /**
     * Toggle Produk Unggulan (Tampil di Hero Slider Halaman Depan)
     */
    public function toggleFeatured($id = null) {
        $this->checkSellerAuth();

        $id = (int)$id;
        $sellerId = (int)$_SESSION['user']['id'];
        $productModel = $this->model('ProductModel');
        $product = $productModel->getById($id);

        if ($product) {
            // Proteksi IDOR: Penjual hanya boleh mengatur produk miliknya sendiri
            if ($_SESSION['user']['role'] !== 'admin' && (int)$product['seller_id'] !== $sellerId) {
                $_SESSION['flash_error'] = 'Akses ditolak: Anda tidak dapat mengubah produk milik toko lain!';
            } else {
                $productModel->toggleFeatured($id, $_SESSION['user']['role'] === 'admin' ? null : $sellerId);
                $newStatus = empty($product['is_featured']) ? 'ditampilkan di Hero Carousel Beranda' : 'dilepas dari Hero Carousel';
                $_SESSION['flash_message'] = "Status hero untuk '{$product['title']}' berhasil diubah ($newStatus)!";
            }
        } else {
            $_SESSION['flash_error'] = 'Produk tidak ditemukan.';
        }

        $this->redirect('seller/products');
    }

    /**
     * 3. PRODUK KATEGORI
     */
    public function categories() {
        $this->checkSellerAuth();

        $categoryModel = $this->model('CategoryModel');
        $categories = $categoryModel->getAll();

        $data = [
            'title' => 'Produk Kategori | ' . APP_NAME,
            'page' => 'categories',
            'user' => $_SESSION['user'],
            'categories' => $categories
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/categories/index', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Tambah Kategori
     */
    public function categoryAdd() {
        $this->checkSellerAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $icon = trim($_POST['icon'] ?? 'sparkles');
            $desc = trim($_POST['description'] ?? '');

            if (!empty($name)) {
                $categoryModel = $this->model('CategoryModel');
                $newId = $categoryModel->create([
                    'name' => $name,
                    'icon' => $icon,
                    'description' => $desc
                ]);
                $_SESSION['flash_message'] = "Kategori '$name' berhasil ditambahkan!";
            } else {
                $_SESSION['flash_error'] = "Nama kategori tidak boleh kosong!";
            }
        }

        $this->redirect('seller/categories');
    }

    /**
     * Edit Kategori
     */
    public function categoryEdit($id = null) {
        $this->checkSellerAuth();

        $id = (int)$id;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $icon = trim($_POST['icon'] ?? 'sparkles');
            $desc = trim($_POST['description'] ?? '');

            if (!empty($name)) {
                $categoryModel = $this->model('CategoryModel');
                $categoryModel->update($id, [
                    'name' => $name,
                    'icon' => $icon,
                    'description' => $desc
                ]);
                $_SESSION['flash_message'] = "Kategori '$name' berhasil diperbarui!";
            } else {
                $_SESSION['flash_error'] = "Nama kategori tidak boleh kosong!";
            }
        }

        $this->redirect('seller/categories');
    }

    /**
     * Hapus Kategori
     */
    public function categoryDelete($id = null) {
        $this->checkSellerAuth();

        $id = (int)$id;
        $categoryModel = $this->model('CategoryModel');
        $cat = $categoryModel->getById($id);

        if ($cat) {
            $categoryModel->delete($id);
            $_SESSION['flash_message'] = "Kategori '{$cat['name']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = "Kategori tidak ditemukan.";
        }

        $this->redirect('seller/categories');
    }

    /**
     * 4. KURIR LIST
     */
    public function couriers() {
        $this->checkAdminOnly();

        $courierModel = $this->model('CourierModel');
        $couriers = $courierModel->getAll();

        $data = [
            'title' => 'Kurir List / Ekspedisi | ' . APP_NAME,
            'page' => 'couriers',
            'user' => $_SESSION['user'],
            'couriers' => $couriers
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/couriers/index', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Tambah Kurir
     */
    public function courierAdd() {
        $this->checkAdminOnly();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $code = trim($_POST['code'] ?? '');
            $service = trim($_POST['service_type'] ?? 'Reguler');
            $rate = (int)str_replace(['.', ',', ' '], '', $_POST['base_rate'] ?? 15000);
            $days = trim($_POST['estimated_days'] ?? '2-3 Hari');
            $status = $_POST['status'] ?? 'active';
            $desc = trim($_POST['description'] ?? '');

            if (!empty($name) && !empty($code)) {
                $courierModel = $this->model('CourierModel');
                $courierModel->create([
                    'name' => $name,
                    'code' => $code,
                    'service_type' => $service,
                    'base_rate' => $rate,
                    'estimated_days' => $days,
                    'status' => $status,
                    'description' => $desc
                ]);
                $_SESSION['flash_message'] = "Kurir '$name' ($code) berhasil ditambahkan!";
            } else {
                $_SESSION['flash_error'] = "Nama dan kode kurir wajib diisi!";
            }
        }

        $this->redirect('seller/couriers');
    }

    /**
     * Edit Kurir
     */
    public function courierEdit($id = null) {
        $this->checkAdminOnly();

        $id = (int)$id;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $code = trim($_POST['code'] ?? '');
            $service = trim($_POST['service_type'] ?? 'Reguler');
            $rate = (int)str_replace(['.', ',', ' '], '', $_POST['base_rate'] ?? 15000);
            $days = trim($_POST['estimated_days'] ?? '2-3 Hari');
            $status = $_POST['status'] ?? 'active';
            $desc = trim($_POST['description'] ?? '');

            if (!empty($name) && !empty($code)) {
                $courierModel = $this->model('CourierModel');
                $courierModel->update($id, [
                    'name' => $name,
                    'code' => $code,
                    'service_type' => $service,
                    'base_rate' => $rate,
                    'estimated_days' => $days,
                    'status' => $status,
                    'description' => $desc
                ]);
                $_SESSION['flash_message'] = "Kurir '$name' berhasil diperbarui!";
            } else {
                $_SESSION['flash_error'] = "Nama dan kode kurir wajib diisi!";
            }
        }

        $this->redirect('seller/couriers');
    }

    /**
     * Toggle Status Kurir (Aktif / Nonaktif)
     */
    public function courierToggle($id = null) {
        $this->checkAdminOnly();

        $id = (int)$id;
        $courierModel = $this->model('CourierModel');
        $c = $courierModel->getById($id);

        if ($c) {
            $courierModel->toggleStatus($id);
            $newStatus = ($c['status'] === 'active') ? 'Nonaktif' : 'Aktif';
            $_SESSION['flash_message'] = "Status kurir '{$c['name']}' diubah menjadi $newStatus.";
        }

        $this->redirect('seller/couriers');
    }

    /**
     * Hapus Kurir
     */
    public function courierDelete($id = null) {
        $this->checkAdminOnly();

        $id = (int)$id;
        $courierModel = $this->model('CourierModel');
        $c = $courierModel->getById($id);

        if ($c) {
            $courierModel->delete($id);
            $_SESSION['flash_message'] = "Kurir '{$c['name']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = "Kurir tidak ditemukan.";
        }

        $this->redirect('seller/couriers');
    }

    /**
     * 5. USER MANAGEMENT
     */
    public function users() {
        $this->checkAdminOnly();

        $role = trim($_GET['role'] ?? '');
        $search = trim($_GET['search'] ?? '');

        $userModel = $this->model('UserModel');
        $users = $userModel->getAll($role ?: null, $search ?: null);

        $data = [
            'title' => 'User Management | ' . APP_NAME,
            'page' => 'users',
            'user' => $_SESSION['user'],
            'users' => $users,
            'currentRole' => $role,
            'searchKeyword' => $search
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/users/index', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Tambah Pengguna
     */
    public function userAdd() {
        $this->checkAdminOnly();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim(strtolower($_POST['email'] ?? ''));
            $phone = trim($_POST['phone'] ?? '');
            $role = $_POST['role'] ?? 'buyer';
            $password = trim($_POST['password'] ?? '');
            $storeName = trim($_POST['store_name'] ?? '');
            $address = trim($_POST['address'] ?? '');

            if (empty($name) || empty($email) || empty($password)) {
                $_SESSION['flash_error'] = "Nama, email, dan kata sandi wajib diisi!";
            } else {
                $userModel = $this->model('UserModel');
                if ($userModel->getByEmail($email)) {
                    $_SESSION['flash_error'] = "Email '$email' sudah digunakan oleh pengguna lain!";
                } else {
                    $newId = $userModel->createUser([
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'role' => $role,
                        'password' => $password,
                        'store_name' => ($role === 'seller') ? $storeName : null,
                        'store_description' => null,
                        'address' => $address
                    ]);
                    $_SESSION['flash_message'] = "Pengguna baru '$name' ($role) berhasil didaftarkan (ID: #$newId)!";
                }
            }
        }

        $this->redirect('seller/users');
    }

    /**
     * Edit Pengguna
     */
    public function userEdit($id = null) {
        $this->checkAdminOnly();

        $id = (int)$id;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim(strtolower($_POST['email'] ?? ''));
            $phone = trim($_POST['phone'] ?? '');
            $role = $_POST['role'] ?? 'buyer';
            $password = trim($_POST['password'] ?? '');
            $storeName = trim($_POST['store_name'] ?? '');
            $address = trim($_POST['address'] ?? '');

            if (empty($name) || empty($email)) {
                $_SESSION['flash_error'] = "Nama dan email wajib diisi!";
            } else {
                $userModel = $this->model('UserModel');
                $existing = $userModel->getByEmail($email);
                if ($existing && (int)$existing['id'] !== $id) {
                    $_SESSION['flash_error'] = "Email '$email' sudah terdaftar pada pengguna lain!";
                } else {
                    $userModel->updateUser($id, [
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'role' => $role,
                        'password' => !empty($password) ? $password : null,
                        'store_name' => ($role === 'seller') ? $storeName : null,
                        'store_description' => null,
                        'address' => $address
                    ]);

                    // Jika mengedit akun sendiri, update sesi
                    if ((int)$id === (int)$_SESSION['user']['id']) {
                        $_SESSION['user'] = $userModel->getById($id);
                    }

                    $_SESSION['flash_message'] = "Data pengguna '$name' berhasil diperbarui!";
                }
            }
        }

        $this->redirect('seller/users');
    }

    /**
     * Hapus Pengguna
     */
    public function userDelete($id = null) {
        $this->checkAdminOnly();

        $id = (int)$id;
        if ((int)$id === (int)$_SESSION['user']['id']) {
            $_SESSION['flash_error'] = "Anda tidak dapat menghapus akun Anda sendiri!";
            $this->redirect('seller/users');
            return;
        }

        $userModel = $this->model('UserModel');
        $u = $userModel->getById($id);

        if ($u) {
            $userModel->deleteUser($id);
            $_SESSION['flash_message'] = "Pengguna '{$u['name']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = "Pengguna tidak ditemukan.";
        }

        $this->redirect('seller/users');
    }

    /**
     * Pesanan Toko Penjual
     */
    public function orders() {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $orderModel = $this->model('OrderModel');
        $orders = $orderModel->getOrdersBySellerId($sellerId);

        $data = [
            'title' => 'Pesanan Masuk | ' . APP_NAME,
            'page' => 'orders',
            'user' => $_SESSION['user'],
            'orders' => $orders
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/orders/index', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Detail Pesanan
     */
    public function orderDetail($id = null) {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $id = (int)$id;
        $orderModel = $this->model('OrderModel');
        $order = $orderModel->getById($id);

        if (!$order) {
            $_SESSION['flash_error'] = 'Pesanan tidak ditemukan!';
            $this->redirect('seller/orders');
            return;
        }

        // Proteksi IDOR: Pastikan pesanan berisi produk milik toko penjual ini
        if ($_SESSION['user']['role'] !== 'admin') {
            $hasSellerItem = false;
            if (!empty($order['items'])) {
                foreach ($order['items'] as $it) {
                    if ((int)($it['seller_id'] ?? 0) === $sellerId) {
                        $hasSellerItem = true;
                        break;
                    }
                }
            }
            if (!$hasSellerItem) {
                $_SESSION['flash_error'] = 'Akses ditolak: Pesanan ini tidak termasuk dalam toko Anda.';
                $this->redirect('seller/orders');
                return;
            }
        }

        $sellerItems = [];
        if (!empty($order['items'])) {
            foreach ($order['items'] as $item) {
                if ($_SESSION['user']['role'] === 'admin' || (int)($item['seller_id'] ?? 0) === $sellerId) {
                    $sellerItems[] = $item;
                }
            }
        }

        $data = [
            'title' => 'Detail Pesanan: #' . $order['order_code'] . ' | ' . APP_NAME,
            'page' => 'orders',
            'user' => $_SESSION['user'],
            'order' => $order,
            'sellerItems' => $sellerItems
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/orders/detail', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Update Status Pesanan
     */
    public function orderUpdateStatus($id = null) {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $id = (int)$id;
        $status = trim($_POST['status'] ?? '');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($status)) {
            $orderModel = $this->model('OrderModel');

            // Proteksi IDOR: Pastikan penjual memiliki hak atas pesanan ini
            if ($_SESSION['user']['role'] !== 'admin') {
                $order = $orderModel->getById($id);
                $hasSellerItem = false;
                if ($order && !empty($order['items'])) {
                    foreach ($order['items'] as $it) {
                        if ((int)($it['seller_id'] ?? 0) === $sellerId) {
                            $hasSellerItem = true;
                            break;
                        }
                    }
                }
                if (!$hasSellerItem) {
                    $_SESSION['flash_error'] = 'Akses ditolak: Anda tidak memiliki izin memperbarui status pesanan ini.';
                    $this->redirect('seller/orders');
                    return;
                }
            }

            $updated = $orderModel->updateStatus($id, $status);
            if ($updated) {
                $_SESSION['flash_message'] = "Status pesanan berhasil diperbarui menjadi '$status'.";
            }
            $this->redirect('seller/orderDetail/' . $id);
            return;
        }

        $this->redirect('seller/orders');
    }

    /**
     * Verifikasi & ACC Pembayaran Pesanan (Ubah ke Diproses / Siap Diantar)
     */
    public function orderApprovePayment($id = null) {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $id = (int)$id;

        $orderModel = $this->model('OrderModel');
        $order = $orderModel->getById($id);

        if (!$order) {
            $_SESSION['flash_error'] = 'Pesanan tidak ditemukan!';
            $this->redirect('seller/orders');
            return;
        }

        // Proteksi IDOR
        if ($_SESSION['user']['role'] !== 'admin') {
            $hasSellerItem = false;
            if (!empty($order['items'])) {
                foreach ($order['items'] as $it) {
                    if ((int)($it['seller_id'] ?? 0) === $sellerId) {
                        $hasSellerItem = true;
                        break;
                    }
                }
            }
            if (!$hasSellerItem) {
                $_SESSION['flash_error'] = 'Akses ditolak: Anda tidak memiliki izin untuk pesanan ini.';
                $this->redirect('seller/orders');
                return;
            }
        }

        $orderModel->updateStatus($id, 'Diproses');
        $_SESSION['flash_message'] = "Pembayaran pesanan #{$order['order_code']} berhasil di-ACC! Status pesanan kini 'Diproses' (Sedang Disiapkan & Siap Diantarkan).";

        $this->redirect('seller/orderDetail/' . $id);
    }

    /**
     * Pengaturan Toko Penjual, Branding Web & Teks Dashboard
     */
    public function settings() {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $userModel = $this->model('UserModel');
        $settingModel = $this->model('SettingModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Profil Toko Mitra
            $storeName = trim($_POST['store_name'] ?? '');
            $storeDesc = trim($_POST['store_description'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');

            if (!empty($storeName)) {
                $userModel->updateProfile($sellerId, [
                    'name' => $_SESSION['user']['name'],
                    'phone' => $phone,
                    'address' => $address,
                    'store_name' => $storeName,
                    'store_description' => $storeDesc
                ]);

                $_SESSION['user'] = $userModel->getById($sellerId);
            }

            // 2. Pengaturan Branding & Logo Web
            $appName = trim($_POST['app_name'] ?? '');
            $appDesc = trim($_POST['app_desc'] ?? '');
            $dashboardBadge = trim($_POST['dashboard_badge'] ?? '');
            $dashboardWelcome = trim($_POST['dashboard_welcome'] ?? '');
            $dashboardDesc = trim($_POST['dashboard_desc'] ?? '');
            $dashboardAnnouncement = trim($_POST['dashboard_announcement'] ?? '');
            $currentLogo = trim($_POST['app_logo'] ?? '');

            // Upload Logo baru jika ada file yang diunggah
            if (!empty($_FILES['logo_file']['name']) && $_FILES['logo_file']['error'] === UPLOAD_ERR_OK) {
                $uploadedLogo = $settingModel->handleLogoUpload($_FILES['logo_file']);
                if ($uploadedLogo) {
                    $currentLogo = $uploadedLogo;
                }
            }

            $siteSettings = [
                'app_name'               => !empty($appName) ? $appName : 'Lumina Pearl',
                'app_desc'               => $appDesc,
                'app_logo'               => $currentLogo,
                'dashboard_badge'        => $dashboardBadge,
                'dashboard_welcome'      => $dashboardWelcome,
                'dashboard_desc'         => $dashboardDesc,
                'dashboard_announcement' => $dashboardAnnouncement,
                'wa_phone'               => trim($_POST['wa_phone'] ?? '081234567891')
            ];

            // Rekening Bank Kustom Dinamis
            $bankAccounts = [];
            if (!empty($_POST['bank_name']) && is_array($_POST['bank_name'])) {
                foreach ($_POST['bank_name'] as $idx => $bName) {
                    $bName = trim($bName);
                    $bNum = trim($_POST['bank_number'][$idx] ?? '');
                    $bHolder = trim($_POST['bank_holder'][$idx] ?? '');
                    if (!empty($bName) && !empty($bNum)) {
                        $bankAccounts[] = [
                            'bank_name'      => $bName,
                            'account_number' => $bNum,
                            'account_holder' => $bHolder
                        ];
                    }
                }
            }

            if (empty($bankAccounts)) {
                if (!empty($_POST['bank_account_number'])) {
                    $bankAccounts[] = [
                        'bank_name'      => 'BCA',
                        'account_number' => trim($_POST['bank_account_number']),
                        'account_holder' => trim($_POST['bank_account_holder'] ?? 'PT Lumina Mutiara Samudra')
                    ];
                }
                if (!empty($_POST['bank_account_number_2'])) {
                    $bankAccounts[] = [
                        'bank_name'      => 'Mandiri',
                        'account_number' => trim($_POST['bank_account_number_2']),
                        'account_holder' => trim($_POST['bank_account_holder_2'] ?? 'PT Lumina Mutiara Samudra')
                    ];
                }
                if (!empty($_POST['bank_account_number_3'])) {
                    $bankAccounts[] = [
                        'bank_name'      => 'BRI',
                        'account_number' => trim($_POST['bank_account_number_3']),
                        'account_holder' => trim($_POST['bank_account_holder_3'] ?? 'PT Lumina Mutiara Samudra')
                    ];
                }
            }

            $siteSettings['bank_accounts']         = json_encode($bankAccounts);
            $siteSettings['bank_account_number']   = $bankAccounts[0]['account_number'] ?? '';
            $siteSettings['bank_account_holder']   = $bankAccounts[0]['account_holder'] ?? '';
            $siteSettings['bank_account_number_2'] = $bankAccounts[1]['account_number'] ?? '';
            $siteSettings['bank_account_holder_2'] = $bankAccounts[1]['account_holder'] ?? '';
            $siteSettings['bank_account_number_3'] = $bankAccounts[2]['account_number'] ?? '';
            $siteSettings['bank_account_holder_3'] = $bankAccounts[2]['account_holder'] ?? '';

            $settingModel->setMany($siteSettings);

            $_SESSION['flash_message'] = 'Pengaturan branding, logo, teks dashboard, dan profil toko berhasil disimpan!';
            $this->redirect('seller/settings');
            return;
        }

        $data = [
            'title' => 'Pengaturan Toko & Branding | ' . site_setting('app_name', APP_NAME),
            'page' => 'settings',
            'user' => $_SESSION['user'],
            'settings' => $settingModel->getAll()
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/settings', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Pengaturan Flash Sale Promo Berbatas Waktu
     */
    public function flashsale() {
        $this->checkSellerAuth();

        $sellerId = (int)$_SESSION['user']['id'];
        $userRole = $_SESSION['user']['role'] ?? '';
        $settingModel = $this->model('SettingModel');
        $productModel = $this->model('ProductModel');

        // Admin melihat semua produk, seller melihat produk miliknya (atau fallback ke semua produk jika kosong)
        $products = ($userRole === 'admin') ? $productModel->getAll() : $productModel->getBySellerId($sellerId);
        if (empty($products)) {
            $products = $productModel->getAll();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $flashActive = trim($_POST['flash_sale_active'] ?? '0');
            $flashTitle = trim($_POST['flash_sale_title'] ?? 'FLASH SALE');
            $flashEndTime = trim($_POST['flash_sale_end_time'] ?? '');

            // Normalisasi format datetime
            if (!empty($flashEndTime)) {
                $flashEndTime = str_replace('T', ' ', $flashEndTime);
                if (strlen($flashEndTime) === 16) {
                    $flashEndTime .= ':00';
                }
            }

            $activeItemIds = $_POST['flash_active_items'] ?? [];
            $discounts = $_POST['flash_discounts'] ?? [];

            $flashProducts = [];
            if (is_array($activeItemIds)) {
                foreach ($activeItemIds as $id) {
                    $id = (int)$id;
                    $disc = isset($discounts[$id]) ? (int)$discounts[$id] : 50;
                    if ($disc < 1) $disc = 1;
                    if ($disc > 99) $disc = 99;
                    $flashProducts[$id] = $disc;
                }
            }

            $settingModel->set('flash_sale_active', $flashActive);
            $settingModel->set('flash_sale_title', !empty($flashTitle) ? $flashTitle : 'FLASH SALE');
            $settingModel->set('flash_sale_end_time', $flashEndTime);
            $settingModel->set('flash_sale_products', json_encode($flashProducts));

            $_SESSION['flash_message'] = 'Pengaturan Flash Sale Promo berhasil disimpan!';
            $this->redirect('seller/flashsale');
            return;
        }

        $flashActive = site_setting('flash_sale_active', '1');
        $flashTitle = site_setting('flash_sale_title', 'FLASH SALE');
        $flashEndTime = site_setting('flash_sale_end_time', '');
        if (empty($flashEndTime)) {
            $flashEndTime = date('Y-m-d H:i:s', strtotime('+2 hours 30 minutes'));
        }

        $savedProducts = site_setting('flash_sale_products', '');
        $flashProductsConfig = json_decode($savedProducts, true);
        if (!is_array($flashProductsConfig)) {
            $flashProductsConfig = [1 => 74, 2 => 45, 3 => 63, 4 => 50, 5 => 40, 6 => 68];
        }

        $data = [
            'title' => 'Pengaturan Flash Sale | ' . site_setting('app_name', APP_NAME),
            'page' => 'flashsale',
            'user' => $_SESSION['user'],
            'products' => $products,
            'flashActive' => $flashActive,
            'flashTitle' => $flashTitle,
            'flashEndTime' => $flashEndTime,
            'flashProductsConfig' => $flashProductsConfig
        ];

        $this->view('seller/layout/header', $data);
        $this->view('seller/flashsale', $data);
        $this->view('seller/layout/footer', $data);
    }

    /**
     * Helper parsing data form produk dengan dukungan upload file
     */
    private function extractProductPostData() {
        // 1. Gambar Utama: Prioritaskan file upload jika ada
        $mainImage = trim($_POST['main_image'] ?? 'images/pearl-white.png');
        if (!empty($_FILES['image_file']['name']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $uploadedPath = $this->handleUploadedFile($_FILES['image_file']);
            if ($uploadedPath) {
                $mainImage = $uploadedPath;
            }
        }

        // 2. Thumbnails Galeri
        $thumbs = array_filter(array_map('trim', explode("\n", $_POST['thumbnails'] ?? '')));

        // Unggah Tambahan Foto Galeri (Multiple Upload)
        if (!empty($_FILES['extra_images']['name']) && is_array($_FILES['extra_images']['name'])) {
            foreach ($_FILES['extra_images']['name'] as $idx => $fname) {
                if (!empty($fname) && $_FILES['extra_images']['error'][$idx] === UPLOAD_ERR_OK) {
                    $itemFile = [
                        'name'     => $_FILES['extra_images']['name'][$idx],
                        'type'     => $_FILES['extra_images']['type'][$idx],
                        'tmp_name' => $_FILES['extra_images']['tmp_name'][$idx],
                        'error'    => $_FILES['extra_images']['error'][$idx],
                        'size'     => $_FILES['extra_images']['size'][$idx]
                    ];
                    $upExtra = $this->handleUploadedFile($itemFile);
                    if ($upExtra) {
                        $thumbs[] = $upExtra;
                    }
                }
            }
        }

        if (empty($thumbs)) {
            $thumbs = [$mainImage];
        } elseif (!in_array($mainImage, $thumbs)) {
            array_unshift($thumbs, $mainImage);
        }

        // 3. Bullets / Poin Keunggulan
        $bullets = [];
        if (!empty($_POST['bullet_item']) && is_array($_POST['bullet_item'])) {
            $bullets = array_filter(array_map('trim', $_POST['bullet_item']));
        } elseif (!empty($_POST['bullets'])) {
            $bullets = array_filter(array_map('trim', explode("\n", $_POST['bullets'])));
        }

        // 4. Pilihan Ukuran
        $sizes = [];
        if (!empty($_POST['sizes'])) {
            if (is_array($_POST['sizes'])) {
                $sizes = array_filter(array_map('trim', $_POST['sizes']));
            } else {
                $sizes = array_filter(array_map('trim', explode(',', $_POST['sizes'])));
            }
        }

        // 5. Pilihan Varian Warna (Dukungan form interaktif & fallback)
        $colors = [];
        if (!empty($_POST['color_name']) && is_array($_POST['color_name'])) {
            foreach ($_POST['color_name'] as $idx => $cName) {
                $cName = trim($cName);
                if (!empty($cName)) {
                    $colors[] = [
                        'name' => $cName,
                        'hex'  => trim($_POST['color_hex'][$idx] ?? '#f8f5ee'),
                        'img'  => $mainImage
                    ];
                }
            }
        } elseif (!empty($_POST['colors'])) {
            $colorsRaw = array_filter(array_map('trim', explode("\n", $_POST['colors'])));
            foreach ($colorsRaw as $cLine) {
                $parts = explode('|', $cLine);
                if (!empty($parts[0])) {
                    $colors[] = [
                        'name' => trim($parts[0]),
                        'hex'  => trim($parts[1] ?? '#f8f5ee'),
                        'img'  => trim($parts[2] ?? $mainImage)
                    ];
                }
            }
        }

        // 6. Spesifikasi Teknis (Dukungan form interaktif & fallback)
        $specs = [];
        if (!empty($_POST['spec_label']) && is_array($_POST['spec_label'])) {
            foreach ($_POST['spec_label'] as $idx => $sLabel) {
                $sLabel = trim($sLabel);
                $sVal = trim($_POST['spec_val'][$idx] ?? '');
                if (!empty($sLabel) || !empty($sVal)) {
                    $specs[] = [
                        'label' => $sLabel,
                        'val'   => $sVal
                    ];
                }
            }
        } elseif (!empty($_POST['specs'])) {
            $specsRaw = array_filter(array_map('trim', explode("\n", $_POST['specs'])));
            foreach ($specsRaw as $sLine) {
                $parts = explode('|', $sLine);
                if (!empty($parts[0])) {
                    $specs[] = [
                        'label' => trim($parts[0]),
                        'val'   => trim($parts[1] ?? '')
                    ];
                }
            }
        }

        return [
            'category_id'    => !empty($_POST['category_id']) ? (int)$_POST['category_id'] : 1,
            'title'          => trim($_POST['title'] ?? ''),
            'badge'          => trim($_POST['badge'] ?? ''),
            'is_featured'    => !empty($_POST['is_featured']) ? 1 : 0,
            'rating'         => (float)($_POST['rating'] ?? 5.0),
            'reviews_count'  => (int)($_POST['reviews_count'] ?? 0),
            'price'          => (int)str_replace(['.', ',', ' '], '', $_POST['price'] ?? 0),
            'original_price' => (int)str_replace(['.', ',', ' '], '', $_POST['original_price'] ?? 0),
            'discount'       => trim($_POST['discount'] ?? ''),
            'description'    => trim($_POST['description'] ?? ''),
            'main_image'     => $mainImage,
            'thumbnails'     => array_values($thumbs),
            'colors'         => array_values($colors),
            'sizes'          => array_values($sizes),
            'bullets'        => array_values($bullets),
            'materials'      => trim($_POST['materials'] ?? ''),
            'specs'          => array_values($specs),
            'related_ids'    => trim($_POST['related_ids'] ?? '1,2,3,4')
        ];
    }

    /**
     * Helper simpan file gambar yang diunggah ke images/uploads/ (Dengan validasi MIME & ukuran)
     */
    private function handleUploadedFile($file) {
        if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return null;
        }

        // Batasi ukuran file maksimal 5 MB
        if (!empty($file['size']) && $file['size'] > 5 * 1024 * 1024) {
            return null;
        }

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            return null;
        }

        // Verifikasi bahwa isi file benar-benar file gambar biner asli
        $imageInfo = @getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            return null;
        }

        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($imageInfo['mime'], $allowedMimes)) {
            return null;
        }

        $uploadDir = __DIR__ . '/../../images/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = 'prod_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return 'images/uploads/' . $filename;
        }

        return null;
    }
}
