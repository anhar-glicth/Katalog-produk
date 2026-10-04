<?php
// ========================================================
// LUMINA PEARL - COURIER MODEL
// ========================================================

class CourierModel {
    private $db;
    private $table = 'couriers';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Mengambil semua kurir
     * @return array
     */
    public function getAll() {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY id ASC");
        return $this->db->resultSet();
    }

    /**
     * Mengambil kurir yang statusnya aktif (untuk checkout & simulasi ongkir)
     * @return array
     */
    public function getActive() {
        $this->db->query("SELECT * FROM {$this->table} WHERE status = 'active' ORDER BY id ASC");
        return $this->db->resultSet();
    }

    /**
     * Mengambil kurir berdasarkan ID
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->single();
    }

    /**
     * Hitung total kurir
     * @param string|null $status
     * @return int
     */
    public function count($status = null) {
        if ($status) {
            $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE status = :status");
            $this->db->bind(':status', $status);
        } else {
            $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        }
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    /**
     * Tambah kurir baru
     * @param array $data
     * @return int
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (
            `name`, `code`, `service_type`, `base_rate`, `estimated_days`, `status`, `description`
        ) VALUES (
            :name, :code, :service_type, :base_rate, :estimated_days, :status, :description
        )";

        $this->db->query($sql);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':code', strtoupper(trim($data['code'])));
        $this->db->bind(':service_type', trim($data['service_type'] ?? 'Reguler'));
        $this->db->bind(':base_rate', (int)($data['base_rate'] ?? 15000));
        $this->db->bind(':estimated_days', trim($data['estimated_days'] ?? '2-3 Hari'));
        $this->db->bind(':status', $data['status'] ?? 'active');
        $this->db->bind(':description', trim($data['description'] ?? ''));
        $this->db->execute();

        return (int)$this->db->lastInsertId();
    }

    /**
     * Update data kurir
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
            `name` = :name, 
            `code` = :code, 
            `service_type` = :service_type, 
            `base_rate` = :base_rate, 
            `estimated_days` = :estimated_days, 
            `status` = :status, 
            `description` = :description 
        WHERE `id` = :id";

        $this->db->query($sql);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':code', strtoupper(trim($data['code'])));
        $this->db->bind(':service_type', trim($data['service_type'] ?? 'Reguler'));
        $this->db->bind(':base_rate', (int)($data['base_rate'] ?? 15000));
        $this->db->bind(':estimated_days', trim($data['estimated_days'] ?? '2-3 Hari'));
        $this->db->bind(':status', $data['status'] ?? 'active');
        $this->db->bind(':description', trim($data['description'] ?? ''));
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    /**
     * Ubah status aktif / nonaktif
     * @param int $id
     * @return bool
     */
    public function toggleStatus($id) {
        $courier = $this->getById($id);
        if (!$courier) return false;

        $newStatus = ($courier['status'] === 'active') ? 'inactive' : 'active';
        $this->db->query("UPDATE {$this->table} SET status = :status WHERE id = :id");
        $this->db->bind(':status', $newStatus);
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    /**
     * Hapus data kurir
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->execute();
    }
}
