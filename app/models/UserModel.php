<?php
// ========================================================
// LUMINA PEARL - USER MODEL (MULTI-VENDOR AUTH & USER MANAGEMENT)
// ========================================================

class UserModel {
    private $db;
    private $table = 'users';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Autentikasi login pembeli / penjual / admin
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function login($email, $password) {
        $this->db->query("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $this->db->bind(':email', trim($email));
        $user = $this->db->single();

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }

        return null;
    }

    /**
     * Registrasi pengguna baru (Pembeli atau Penjual)
     * @param array $data
     * @return int ID pengguna baru
     */
    public function register($data) {
        $sql = "INSERT INTO {$this->table} (
            `name`, `email`, `phone`, `password`, `role`, `store_name`, `store_description`, `address`
        ) VALUES (
            :name, :email, :phone, :password, :role, :store_name, :store_description, :address
        )";

        $hash = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->db->query($sql);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':email', trim(strtolower($data['email'])));
        $this->db->bind(':phone', trim($data['phone'] ?? ''));
        $this->db->bind(':password', $hash);
        $this->db->bind(':role', $data['role'] ?? 'buyer');
        $this->db->bind(':store_name', $data['store_name'] ?? null);
        $this->db->bind(':store_description', $data['store_description'] ?? null);
        $this->db->bind(':address', $data['address'] ?? null);
        $this->db->execute();

        return (int)$this->db->lastInsertId();
    }

    /**
     * Cari pengguna berdasarkan email
     * @param string $email
     * @return array|null
     */
    public function getByEmail($email) {
        $this->db->query("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $this->db->bind(':email', trim(strtolower($email)));
        return $this->db->single();
    }

    /**
     * Ambil data pengguna berdasarkan ID
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        $this->db->query("SELECT id, name, email, phone, role, store_name, store_description, address, created_at FROM {$this->table} WHERE id = :id LIMIT 1");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->single();
    }

    /**
     * Update profil pengguna (atau informasi toko untuk penjual)
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateProfile($id, $data) {
        $sql = "UPDATE {$this->table} SET 
            `name` = :name, 
            `phone` = :phone, 
            `address` = :address, 
            `store_name` = :store_name, 
            `store_description` = :store_description
        WHERE `id` = :id";

        $this->db->query($sql);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':phone', trim($data['phone'] ?? ''));
        $this->db->bind(':address', trim($data['address'] ?? ''));
        $this->db->bind(':store_name', $data['store_name'] ?? null);
        $this->db->bind(':store_description', $data['store_description'] ?? null);
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    /**
     * Ambil informasi profil toko penjual
     * @param int $sellerId
     * @return array|null
     */
    public function getSellerStore($sellerId) {
        $this->db->query("SELECT id, name, store_name, store_description, phone, email, created_at FROM {$this->table} WHERE id = :id AND role = 'seller' LIMIT 1");
        $this->db->bind(':id', (int)$sellerId, PDO::PARAM_INT);
        return $this->db->single();
    }

    // ========================================================
    // USER MANAGEMENT METHODS (ADMIN / SELLER)
    // ========================================================

    /**
     * Ambil semua pengguna dengan filter opsional
     * @param string|null $role
     * @param string|null $keyword
     * @return array
     */
    public function getAll($role = null, $keyword = null) {
        $sql = "SELECT id, name, email, phone, role, store_name, store_description, address, created_at 
                FROM {$this->table} WHERE 1=1";
        
        if (!empty($role)) {
            $sql .= " AND role = :role";
        }
        if (!empty($keyword)) {
            $sql .= " AND (name LIKE :kw OR email LIKE :kw OR store_name LIKE :kw OR phone LIKE :kw)";
        }
        $sql .= " ORDER BY id DESC";

        $this->db->query($sql);
        if (!empty($role)) {
            $this->db->bind(':role', $role);
        }
        if (!empty($keyword)) {
            $this->db->bind(':kw', '%' . trim($keyword) . '%');
        }
        return $this->db->resultSet();
    }

    /**
     * Hitung total pengguna berdasarkan role atau total keseluruhan
     * @param string|null $role
     * @return int
     */
    public function count($role = null) {
        if (!empty($role)) {
            $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE role = :role");
            $this->db->bind(':role', $role);
        } else {
            $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        }
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    /**
     * Tambah user baru via User Management
     * @param array $data
     * @return int ID user baru
     */
    public function createUser($data) {
        return $this->register($data);
    }

    /**
     * Update user lengkap via User Management
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUser($id, $data) {
        $hasPassword = !empty($data['password']);

        if ($hasPassword) {
            $sql = "UPDATE {$this->table} SET 
                `name` = :name, 
                `email` = :email, 
                `phone` = :phone, 
                `role` = :role, 
                `store_name` = :store_name, 
                `store_description` = :store_description, 
                `address` = :address, 
                `password` = :password
            WHERE `id` = :id";
        } else {
            $sql = "UPDATE {$this->table} SET 
                `name` = :name, 
                `email` = :email, 
                `phone` = :phone, 
                `role` = :role, 
                `store_name` = :store_name, 
                `store_description` = :store_description, 
                `address` = :address
            WHERE `id` = :id";
        }

        $this->db->query($sql);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':email', trim(strtolower($data['email'])));
        $this->db->bind(':phone', trim($data['phone'] ?? ''));
        $this->db->bind(':role', $data['role'] ?? 'buyer');
        $this->db->bind(':store_name', !empty($data['store_name']) ? trim($data['store_name']) : null);
        $this->db->bind(':store_description', !empty($data['store_description']) ? trim($data['store_description']) : null);
        $this->db->bind(':address', !empty($data['address']) ? trim($data['address']) : null);
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);

        if ($hasPassword) {
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        }

        return $this->db->execute();
    }

    /**
     * Hapus user
     * @param int $id
     * @return bool
     */
    public function deleteUser($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->execute();
    }
}
