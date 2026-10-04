<?php
// ========================================================
// LUMINA PEARL - USER CONTROLLER (DASHBOARD PEMBELI)
// ========================================================

class UserController extends Controller {

    /**
     * Memeriksa autentikasi login pembeli
     */
    private function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user'])) {
            $_SESSION['flash_error'] = "Silakan masuk ke akun Anda terlebih dahulu.";
            $this->redirect('auth/login');
            exit;
        }
    }

    /**
     * Halaman Riwayat Pesanan Saya
     */
    public function orders() {
        $this->checkAuth();

        $userId = (int)$_SESSION['user']['id'];
        $orderModel = $this->model('OrderModel');
        $orders = $orderModel->getOrdersByUserId($userId);

        $data = [
            'title' => 'Pesanan Saya | ' . APP_NAME,
            'page' => 'orders',
            'user' => $_SESSION['user'],
            'orders' => $orders
        ];

        $this->view('layouts/header', $data);
        $this->view('user/orders', $data);
        $this->view('layouts/footer', $data);
    }

    /**
     * Halaman Profil & Alamat Pengiriman
     */
    public function profile() {
        $this->checkAuth();

        $userId = (int)$_SESSION['user']['id'];
        $userModel = $this->model('UserModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');

            if (!empty($name)) {
                $userModel->updateProfile($userId, [
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'store_name' => $_SESSION['user']['store_name'] ?? null,
                    'store_description' => $_SESSION['user']['store_description'] ?? null
                ]);

                // Perbarui sesi
                $_SESSION['user'] = $userModel->getById($userId);
                $_SESSION['flash_message'] = 'Profil berhasil diperbarui!';
            }
        }

        $data = [
            'title' => 'Profil Saya | ' . APP_NAME,
            'page' => 'profile',
            'user' => $_SESSION['user']
        ];

        $this->view('layouts/header', $data);
        $this->view('user/profile', $data);
        $this->view('layouts/footer', $data);
    }
}
