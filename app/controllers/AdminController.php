<?php
// ========================================================
// LUMINA PEARL - ADMIN CONTROLLER
// ========================================================

class AdminController extends Controller {

    /**
     * Memeriksa apakah admin sudah login (kompatibel dengan admin_user atau user dengan role admin)
     */
    private function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Sinkronisasi jika login via AuthController dengan role 'admin'
        if (empty($_SESSION['admin_user']) && !empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            $_SESSION['admin_user'] = [
                'id' => $_SESSION['user']['id'],
                'username' => $_SESSION['user']['email'],
                'name' => $_SESSION['user']['name']
            ];
        }

        if (empty($_SESSION['admin_user'])) {
            $this->redirect('admin/login');
            exit;
        }
    }

    /**
     * Halaman Login Admin
     */
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['admin_user'])) {
            $this->redirect('admin');
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $adminModel = $this->model('AdminModel');
            $admin = $adminModel->login($username, $password);

            if (!$admin) {
                // Fallback cek di tabel users jika akun admin terdaftar di sana
                $userModel = $this->model('UserModel');
                $user = $userModel->login($username, $password);
                if ($user && $user['role'] === 'admin') {
                    $admin = [
                        'id' => $user['id'],
                        'username' => $user['email'],
                        'name' => $user['name']
                    ];
                    $_SESSION['user'] = $user;
                }
            }

            if ($admin) {
                $_SESSION['admin_user'] = $admin;
                $_SESSION['flash_message'] = 'Selamat datang kembali, ' . htmlspecialchars($admin['name']) . '!';
                $this->redirect('admin');
                return;
            } else {
                $error = 'Username atau kata sandi tidak sesuai!';
            }
        }

        $this->view('admin/login', [
            'title' => 'Login Admin | ' . APP_NAME,
            'error' => $error
        ]);
    }

    /**
     * Logout Admin
     */
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['admin_user']);
        $this->redirect('admin/login');
    }

    /**
     * 1. DASHBOARD UTAMA ADMIN
     */
    public function index() {
        $this->checkAuth();

        $productModel = $this->model('ProductModel');
        $orderModel = $this->model('OrderModel');
        $categoryModel = $this->model('CategoryModel');
        $courierModel = $this->model('CourierModel');
        $userModel = $this->model('UserModel');

        $data = [
            'title' => 'Dashboard Admin | ' . APP_NAME,
            'page' => 'dashboard',
            'admin' => $_SESSION['admin_user'],
            'totalProducts' => $productModel->count(),
            'totalCategories' => $categoryModel->count(),
            'totalCouriers' => $courierModel->count(),
            'totalUsers' => $userModel->count(),
            'totalOrders' => $orderModel->getOrderCount(),
            'totalRevenue' => $orderModel->getTotalRevenue(),
            'recentOrders' => $orderModel->getRecentOrders(5)
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * 2. PRODUK LIST
     */
    public function products() {
        $this->checkAuth();

        $productModel = $this->model('ProductModel');
        $categoryModel = $this->model('CategoryModel');

        $products = $productModel->getAll();
        $categories = $categoryModel->getAll();

        $data = [
            'title' => 'Kelola Produk | ' . APP_NAME,
            'page' => 'products',
            'admin' => $_SESSION['admin_user'],
            'products' => $products,
            'categories' => $categories
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/products/index', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Tambah Produk Baru
     */
    public function productAdd() {
        $this->checkAuth();

        $productModel = $this->model('ProductModel');
        $categoryModel = $this->model('CategoryModel');
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extractProductPostData();

            if (empty($data['title']) || empty($data['price'])) {
                $error = 'Judul produk dan harga wajib diisi!';
            } else {
                $newId = $productModel->create($data);
                $_SESSION['flash_message'] = "Produk berhasil ditambahkan (ID: #$newId)!";
                $this->redirect('admin/products');
                return;
            }
        }

        $data = [
            'title' => 'Tambah Produk Baru | ' . APP_NAME,
            'page' => 'products',
            'admin' => $_SESSION['admin_user'],
            'product' => null,
            'categories' => $categoryModel->getAll(),
            'error' => $error,
            'formAction' => BASEURL . 'admin/productAdd'
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/products/form', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Edit Produk
     */
    public function productEdit($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $productModel = $this->model('ProductModel');
        $categoryModel = $this->model('CategoryModel');
        $product = $productModel->getById($id);

        if (!$product) {
            $_SESSION['flash_error'] = 'Produk tidak ditemukan!';
            $this->redirect('admin/products');
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extractProductPostData();

            if (empty($data['title']) || empty($data['price'])) {
                $error = 'Judul produk dan harga wajib diisi!';
            } else {
                $productModel->update($id, $data);
                $_SESSION['flash_message'] = "Produk '{$data['title']}' berhasil diperbarui!";
                $this->redirect('admin/products');
                return;
            }
        }

        $data = [
            'title' => 'Edit Produk: ' . $product['title'] . ' | ' . APP_NAME,
            'page' => 'products',
            'admin' => $_SESSION['admin_user'],
            'product' => $product,
            'categories' => $categoryModel->getAll(),
            'error' => $error,
            'formAction' => BASEURL . 'admin/productEdit/' . $id
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/products/form', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Hapus Produk
     */
    public function productDelete($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $productModel = $this->model('ProductModel');
        $product = $productModel->getById($id);

        if ($product) {
            $productModel->delete($id);
            $_SESSION['flash_message'] = "Produk '{$product['title']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = 'Produk tidak ditemukan.';
        }

        $this->redirect('admin/products');
    }

    /**
     * 3. PRODUK KATEGORI
     */
    public function categories() {
        $this->checkAuth();

        $categoryModel = $this->model('CategoryModel');
        $categories = $categoryModel->getAll();

        $data = [
            'title' => 'Produk Kategori | ' . APP_NAME,
            'page' => 'categories',
            'admin' => $_SESSION['admin_user'],
            'categories' => $categories
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/categories/index', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Tambah Kategori
     */
    public function categoryAdd() {
        $this->checkAuth();

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

        $this->redirect('admin/categories');
    }

    /**
     * Edit Kategori
     */
    public function categoryEdit($id = null) {
        $this->checkAuth();

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

        $this->redirect('admin/categories');
    }

    /**
     * Hapus Kategori
     */
    public function categoryDelete($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $categoryModel = $this->model('CategoryModel');
        $cat = $categoryModel->getById($id);

        if ($cat) {
            $categoryModel->delete($id);
            $_SESSION['flash_message'] = "Kategori '{$cat['name']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = "Kategori tidak ditemukan.";
        }

        $this->redirect('admin/categories');
    }

    /**
     * 4. KURIR LIST
     */
    public function couriers() {
        $this->checkAuth();

        $courierModel = $this->model('CourierModel');
        $couriers = $courierModel->getAll();

        $data = [
            'title' => 'Kurir List / Ekspedisi | ' . APP_NAME,
            'page' => 'couriers',
            'admin' => $_SESSION['admin_user'],
            'couriers' => $couriers
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/couriers/index', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Tambah Kurir
     */
    public function courierAdd() {
        $this->checkAuth();

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

        $this->redirect('admin/couriers');
    }

    /**
     * Edit Kurir
     */
    public function courierEdit($id = null) {
        $this->checkAuth();

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

        $this->redirect('admin/couriers');
    }

    /**
     * Toggle Status Kurir
     */
    public function courierToggle($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $courierModel = $this->model('CourierModel');
        $c = $courierModel->getById($id);

        if ($c) {
            $courierModel->toggleStatus($id);
            $newStatus = ($c['status'] === 'active') ? 'Nonaktif' : 'Aktif';
            $_SESSION['flash_message'] = "Status kurir '{$c['name']}' diubah menjadi $newStatus.";
        }

        $this->redirect('admin/couriers');
    }

    /**
     * Hapus Kurir
     */
    public function courierDelete($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $courierModel = $this->model('CourierModel');
        $c = $courierModel->getById($id);

        if ($c) {
            $courierModel->delete($id);
            $_SESSION['flash_message'] = "Kurir '{$c['name']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = "Kurir tidak ditemukan.";
        }

        $this->redirect('admin/couriers');
    }

    /**
     * 5. USER MANAGEMENT
     */
    public function users() {
        $this->checkAuth();

        $role = trim($_GET['role'] ?? '');
        $search = trim($_GET['search'] ?? '');

        $userModel = $this->model('UserModel');
        $users = $userModel->getAll($role ?: null, $search ?: null);

        $data = [
            'title' => 'User Management | ' . APP_NAME,
            'page' => 'users',
            'admin' => $_SESSION['admin_user'],
            'users' => $users,
            'currentRole' => $role,
            'searchKeyword' => $search
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/users/index', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Tambah Pengguna
     */
    public function userAdd() {
        $this->checkAuth();

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

        $this->redirect('admin/users');
    }

    /**
     * Edit Pengguna
     */
    public function userEdit($id = null) {
        $this->checkAuth();

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

                    $_SESSION['flash_message'] = "Data pengguna '$name' berhasil diperbarui!";
                }
            }
        }

        $this->redirect('admin/users');
    }

    /**
     * Hapus Pengguna
     */
    public function userDelete($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $userModel = $this->model('UserModel');
        $u = $userModel->getById($id);

        if ($u) {
            $userModel->deleteUser($id);
            $_SESSION['flash_message'] = "Pengguna '{$u['name']}' berhasil dihapus.";
        } else {
            $_SESSION['flash_error'] = "Pengguna tidak ditemukan.";
        }

        $this->redirect('admin/users');
    }

    /**
     * Daftar Pesanan Masuk
     */
    public function orders() {
        $this->checkAuth();

        $orderModel = $this->model('OrderModel');
        $orders = $orderModel->getAllOrders();

        $data = [
            'title' => 'Kelola Pesanan | ' . APP_NAME,
            'page' => 'orders',
            'admin' => $_SESSION['admin_user'],
            'orders' => $orders
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/orders/index', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Rincian Pesanan & Status
     */
    public function orderDetail($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $orderModel = $this->model('OrderModel');
        $order = $orderModel->getById($id);

        if (!$order) {
            $_SESSION['flash_error'] = 'Pesanan tidak ditemukan!';
            $this->redirect('admin/orders');
            return;
        }

        $data = [
            'title' => 'Detail Pesanan: #' . $order['order_code'] . ' | ' . APP_NAME,
            'page' => 'orders',
            'admin' => $_SESSION['admin_user'],
            'order' => $order
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/orders/detail', $data);
        $this->view('admin/layout/footer', $data);
    }

    /**
     * Update Status Pengiriman / Pesanan
     */
    public function orderUpdateStatus($id = null) {
        $this->checkAuth();

        $id = (int)$id;
        $status = trim($_POST['status'] ?? '');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($status)) {
            $orderModel = $this->model('OrderModel');
            $updated = $orderModel->updateStatus($id, $status);
            if ($updated) {
                $_SESSION['flash_message'] = "Status pesanan berhasil diubah menjadi '$status'.";
            }
            $this->redirect('admin/orderDetail/' . $id);
            return;
        }

        $this->redirect('admin/orders');
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

    /**
     * Pengaturan Website, Logo & Branding (Admin)
     */
    public function settings() {
        $this->checkAuth();

        $settingModel = $this->model('SettingModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $appName = trim($_POST['app_name'] ?? '');
            $appDesc = trim($_POST['app_desc'] ?? '');
            $dashboardBadge = trim($_POST['dashboard_badge'] ?? '');
            $dashboardWelcome = trim($_POST['dashboard_welcome'] ?? '');
            $dashboardDesc = trim($_POST['dashboard_desc'] ?? '');
            $dashboardAnnouncement = trim($_POST['dashboard_announcement'] ?? '');
            $currentLogo = trim($_POST['app_logo'] ?? '');

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
                'dashboard_announcement' => $dashboardAnnouncement
            ];

            $settingModel->setMany($siteSettings);

            $_SESSION['flash_message'] = 'Pengaturan branding web, logo, dan teks dashboard berhasil diperbarui!';
            $this->redirect('admin/settings');
            return;
        }

        $data = [
            'title' => 'Pengaturan Web & Logo | ' . site_setting('app_name', APP_NAME),
            'page' => 'settings',
            'admin' => $_SESSION['admin_user'],
            'settings' => $settingModel->getAll()
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/settings', $data);
        $this->view('admin/layout/footer', $data);
    }
}
