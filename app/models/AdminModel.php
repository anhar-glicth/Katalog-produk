<?php
// ========================================================
// LUMINA PEARL - ADMIN MODEL
// ========================================================

class AdminModel {
    private $db;
    private $table = 'admins';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Memverifikasi login admin
     * @param string $username
     * @param string $password
     * @return array|null Data admin jika valid
     */
    public function login($username, $password) {
        $this->db->query("SELECT * FROM {$this->table} WHERE username = :username LIMIT 1");
        $this->db->bind(':username', trim($username));
        $admin = $this->db->single();

        if ($admin && password_verify($password, $admin['password'])) {
            unset($admin['password']); // hapus hash sebelum disimpan ke session
            return $admin;
        }

        return null;
    }

    /**
     * Mengambil data profil admin berdasarkan ID
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        $this->db->query("SELECT id, username, name, created_at FROM {$this->table} WHERE id = :id LIMIT 1");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->single();
    }
}
