<?php
// ========================================================
// LUMINA PEARL - CATEGORY MODEL
// ========================================================

class CategoryModel {
    private $db;
    private $table = 'categories';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Mengambil semua kategori beserta total produk di dalamnya
     * @return array
     */
    public function getAll() {
        $sql = "SELECT c.*, COUNT(p.id) as total_products 
                FROM {$this->table} c 
                LEFT JOIN `products` p ON c.id = p.category_id 
                GROUP BY c.id 
                ORDER BY c.id ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    /**
     * Mengambil kategori berdasarkan ID
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->single();
    }

    /**
     * Hitung total kategori
     * @return int
     */
    public function count() {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    /**
     * Menambahkan kategori baru
     * @param array $data
     * @return int ID baru
     */
    public function create($data) {
        $slug = $this->slugify($data['name']);
        
        // Pastikan slug unik
        $baseSlug = $slug;
        $counter = 1;
        while ($this->getBySlug($slug)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $sql = "INSERT INTO {$this->table} (`name`, `slug`, `icon`, `description`) 
                VALUES (:name, :slug, :icon, :description)";
        $this->db->query($sql);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':slug', $slug);
        $this->db->bind(':icon', trim($data['icon'] ?? 'sparkles'));
        $this->db->bind(':description', trim($data['description'] ?? ''));
        $this->db->execute();

        return (int)$this->db->lastInsertId();
    }

    /**
     * Update data kategori
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
                `name` = :name, 
                `icon` = :icon, 
                `description` = :description 
                WHERE `id` = :id";
        $this->db->query($sql);
        $this->db->bind(':name', trim($data['name']));
        $this->db->bind(':icon', trim($data['icon'] ?? 'sparkles'));
        $this->db->bind(':description', trim($data['description'] ?? ''));
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    /**
     * Hapus kategori
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        // Reset category_id di products agar tidak orphan
        $this->db->query("UPDATE `products` SET category_id = NULL WHERE category_id = :id");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        $this->db->execute();

        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    /**
     * Cari kategori berdasarkan slug
     */
    public function getBySlug($slug) {
        $this->db->query("SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1");
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    /**
     * Helper slug generator
     */
    private function slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return empty($text) ? 'kategori-' . time() : $text;
    }
}
