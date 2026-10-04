<?php
// ========================================================
// LUMINA PEARL - AUTH CONTROLLER (MULTI-VENDOR)
// ========================================================

class AuthController extends Controller {

    /**
     * Halaman / Handler Login Terpadu (Pembeli & Penjual)
     * Mendukung modal pop-up via AJAX JSON & redirect otomatis
     */
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
                  || (isset($_POST['ajax']) && $_POST['ajax'] == '1')
                  || (isset($_GET['ajax']) && $_GET['ajax'] == '1');

        // Jika sudah login, alihkan sesuai perannya
        if (!empty($_SESSION['user'])) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'Anda sudah masuk sebagai ' . htmlspecialchars($_SESSION['user']['name']),
                    'user' => $_SESSION['user'],
                    'redirect' => $_SESSION['user']['role'] === 'seller' ? BASEURL . 'seller' : ''
                ]);
                exit;
            }
            $this->redirectByRole($_SESSION['user']['role']);
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $userModel = $this->model('UserModel');
            $user = $userModel->login($email, $password);

            if ($user) {
                session_regenerate_id(true);
                $_SESSION['user'] = $user;
                $_SESSION['flash_message'] = "Selamat datang, " . htmlspecialchars($user['name']) . "!";
                
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'message' => "Selamat datang, " . htmlspecialchars($user['name']) . "!",
                        'user' => [
                            'id' => $user['id'],
                            'name' => $user['name'],
                            'role' => $user['role']
                        ],
                        'redirect' => $user['role'] === 'seller' ? BASEURL . 'seller' : ($user['role'] === 'admin' ? BASEURL . 'admin' : '')
                    ]);
                    exit;
                }

                $this->redirectByRole($user['role']);
                return;
            } else {
                $error = "Email atau kata sandi tidak cocok. Silakan coba lagi.";
                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'message' => $error
                    ]);
                    exit;
                }
            }
        }

        // Jika diakses langsung via browser URL bar (GET), arahkan ke Beranda dengan membuka Pop-up Login
        if (!$isAjax) {
            $this->redirect('?auth=login');
            return;
        }

        $this->view('auth/login', [
            'title' => 'Masuk Akun | ' . APP_NAME,
            'error' => $error
        ]);
    }

    /**
     * Halaman / Handler Registrasi Akun (Pembeli atau Buka Toko Penjual)
     * Mendukung modal pop-up via AJAX JSON & redirect otomatis
     */
    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
                  || (isset($_POST['ajax']) && $_POST['ajax'] == '1')
                  || (isset($_GET['ajax']) && $_GET['ajax'] == '1');

        if (!empty($_SESSION['user'])) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'Anda sudah terdaftar dan masuk.',
                    'user' => $_SESSION['user'],
                    'redirect' => $_SESSION['user']['role'] === 'seller' ? BASEURL . 'seller' : ''
                ]);
                exit;
            }
            $this->redirectByRole($_SESSION['user']['role']);
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = ($_POST['role'] ?? '') === 'seller' ? 'seller' : 'buyer';
            $name = trim($_POST['name'] ?? '');
            $email = trim(strtolower($_POST['email'] ?? ''));
            $phone = trim($_POST['phone'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $storeName = trim($_POST['store_name'] ?? '');
            $storeDesc = trim($_POST['store_description'] ?? '');
            $address = trim($_POST['address'] ?? '');

            $userModel = $this->model('UserModel');

            // Validasi input
            if (empty($name) || empty($email) || empty($password)) {
                $error = "Nama lengkap, email, dan kata sandi wajib diisi!";
            } elseif (strlen($password) < 6) {
                $error = "Kata sandi minimal 6 karakter!";
            } elseif ($role === 'seller' && empty($storeName)) {
                $error = "Nama toko wajib diisi untuk pendaftaran penjual!";
            } elseif ($userModel->getByEmail($email)) {
                $error = "Email sudah terdaftar. Silakan masuk ke akun Anda.";
            } else {
                // Simpan user baru
                $newUserId = $userModel->register([
                    'name'              => $name,
                    'email'             => $email,
                    'phone'             => $phone,
                    'password'          => $password,
                    'role'              => $role,
                    'store_name'        => $role === 'seller' ? $storeName : null,
                    'store_description' => $role === 'seller' ? $storeDesc : null,
                    'address'           => $address
                ]);

                $user = $userModel->getById($newUserId);
                session_regenerate_id(true);
                $_SESSION['user'] = $user;
                $_SESSION['flash_message'] = "Pendaftaran berhasil! Selamat bergabung di " . APP_NAME . ".";

                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'message' => "Pendaftaran berhasil! Selamat bergabung, " . htmlspecialchars($user['name']) . ".",
                        'user' => [
                            'id' => $user['id'],
                            'name' => $user['name'],
                            'role' => $role
                        ],
                        'redirect' => $role === 'seller' ? BASEURL . 'seller' : ''
                    ]);
                    exit;
                }

                $this->redirectByRole($role);
                return;
            }

            if ($isAjax && $error) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => $error
                ]);
                exit;
            }
        }

        // Jika diakses langsung via browser URL bar (GET), arahkan ke Beranda dengan membuka Pop-up Daftar
        if (!$isAjax) {
            $roleParam = ($_GET['role'] ?? '') === 'seller' ? '&role=seller' : '';
            $this->redirect('?auth=register' . $roleParam);
            return;
        }

        $this->view('auth/register', [
            'title' => 'Daftar Akun Baru | ' . APP_NAME,
            'error' => $error,
            'defaultRole' => $_GET['role'] ?? 'buyer'
        ]);
    }

    /**
     * Logout
     */
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        $this->redirect('');
    }

    /**
     * Helper redirect berdasarkan role
     */
    private function redirectByRole($role) {
        if ($role === 'seller') {
            $this->redirect('seller');
        } elseif ($role === 'admin') {
            // Sinkronisasi dengan admin session jika perlu
            $_SESSION['admin_user'] = $_SESSION['user'];
            $this->redirect('admin');
        } else {
            $this->redirect('user/orders');
        }
    }
}
