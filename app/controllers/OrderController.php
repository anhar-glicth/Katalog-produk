<?php
// ========================================================
// LUMINA PEARL - ORDER CONTROLLER
// ========================================================

class OrderController extends Controller {

    /**
     * Menerima pemesanan dari form atau AJAX Checkout Drawer
     */
    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('');
            return;
        }

        // Ambil data JSON jika dikirim via fetch / application/json
        $jsonInput = file_get_contents('php://input');
        $data = json_decode($jsonInput, true);

        if (!$data) {
            $data = $_POST;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderModel = $this->model('OrderModel');
        $items = $data['items'] ?? [];
        $userId = !empty($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;

        $orderData = [
            'user_id'          => $userId,
            'customer_name'    => !empty($data['customer_name']) ? $data['customer_name'] : ($_SESSION['user']['name'] ?? 'Pelanggan Lumina'),
            'customer_phone'   => !empty($data['customer_phone']) ? $data['customer_phone'] : ($_SESSION['user']['phone'] ?? '081234567890'),
            'customer_address' => !empty($data['customer_address']) ? $data['customer_address'] : ($_SESSION['user']['address'] ?? 'Indonesia'),
            'courier'          => $data['courier'] ?? 'JNE Regular',
            'payment_method'   => $data['payment_method'] ?? 'Transfer Bank Manual',
            'subtotal'         => (int)($data['subtotal'] ?? 0),
            'shipping_fee'     => (int)($data['shipping_fee'] ?? 0),
            'admin_fee'        => (int)($data['admin_fee'] ?? 2000),
            'total_amount'     => (int)($data['total_amount'] ?? 0)
        ];

        $res = $orderModel->createOrder($orderData, $items);

        // Jika request AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || isset($data['ajax'])) {
            $this->json([
                'status' => 'success',
                'order_code' => $res['order_code'],
                'redirect' => BASEURL . 'order/success/' . $res['order_code']
            ]);
            return;
        }

        // Standard redirect
        $this->redirect('order/success/' . $res['order_code']);
    }

    /**
     * Halaman bukti transaksi / invoice
     */
    public function success($orderCode = '') {
        $orderModel = $this->model('OrderModel');
        $order = $orderModel->getByOrderCode($orderCode);

        if (!$order) {
            $this->redirect('');
            return;
        }

        $productModel = $this->model('ProductModel');

        $settingModel = $this->model('SettingModel');
        $settings = $settingModel->getAll();

        $data = [
            'title' => 'Invoice Pemesanan #' . $order['order_code'] . ' | ' . APP_NAME,
            'order' => $order,
            'settings' => $settings,
            'products' => $productModel->getAll()
        ];

        $this->view('layouts/header', $data);
        $this->view('order/success', $data);
        $this->view('layouts/footer', $data);
    }

    /**
     * Menerima upload bukti pembayaran transfer dari pembeli
     */
    public function uploadProof($orderCode = '') {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($orderCode)) {
            $this->redirect('');
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderModel = $this->model('OrderModel');
        $order = $orderModel->getByOrderCode($orderCode);

        if (!$order) {
            $_SESSION['flash_error'] = 'Pesanan tidak ditemukan!';
            $this->redirect('');
            return;
        }

        if (empty($_FILES['proof_file']['name']) || $_FILES['proof_file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash_error'] = 'Silakan pilih file foto/gambar bukti transfer Anda.';
            $this->redirect('order/success/' . $orderCode);
            return;
        }

        $file = $_FILES['proof_file'];

        // Validasi ukuran maks 5MB
        if (!empty($file['size']) && $file['size'] > 5 * 1024 * 1024) {
            $_SESSION['flash_error'] = 'Ukuran file terlalu besar! Maksimal 5 MB.';
            $this->redirect('order/success/' . $orderCode);
            return;
        }

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            $_SESSION['flash_error'] = 'Format file tidak didukung! Gunakan format JPG, PNG, atau WebP.';
            $this->redirect('order/success/' . $orderCode);
            return;
        }

        // Validasi binary MIME
        $imageInfo = @getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            $_SESSION['flash_error'] = 'File yang Anda unggah bukan gambar valid!';
            $this->redirect('order/success/' . $orderCode);
            return;
        }

        $uploadDir = __DIR__ . '/../../images/proofs/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $cleanOrderCode = preg_replace('/[^a-zA-Z0-9_-]/', '', $orderCode);
        $filename = 'proof_' . $cleanOrderCode . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $relativePath = 'images/proofs/' . $filename;
            $orderModel->updatePaymentProof($orderCode, $relativePath);
            $_SESSION['flash_message'] = 'Bukti transfer pembayaran berhasil diunggah! Penjual akan segera memverifikasi dan meng-ACC pesanan Anda.';
        } else {
            $_SESSION['flash_error'] = 'Gagal menyimpan file bukti transfer. Silakan coba kembali.';
        }

        $this->redirect('order/success/' . $orderCode);
    }
}
