<?php
// ========================================================
// LUMINA PEARL - PRODUCT MODEL (MYSQL PDO)
// ========================================================

class ProductModel {
    private $db;
    private $table = 'products';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Mengambil semua produk dari database beserta info toko penjual & kategori
     * @param int|null $categoryId Filter kategori opsional
     * @return array List produk dengan kolom JSON didecode
     */
    public function getAll($categoryId = null) {
        $sql = "SELECT p.*, u.store_name, u.name as seller_name, c.name as category_name, c.icon as category_icon 
                FROM {$this->table} p 
                LEFT JOIN `users` u ON p.seller_id = u.id 
                LEFT JOIN `categories` c ON p.category_id = c.id";
        
        if (!empty($categoryId)) {
            $sql .= " WHERE p.category_id = :cat_id";
        }
        
        $sql .= " ORDER BY p.id ASC";

        $this->db->query($sql);
        if (!empty($categoryId)) {
            $this->db->bind(':cat_id', (int)$categoryId, PDO::PARAM_INT);
        }
        $rows = $this->db->resultSet();

        return array_map([$this, 'formatProduct'], $rows);
    }

    /**
     * Mengambil produk khusus milik penjual tertentu (Seller Center)
     * @param int $sellerId
     * @return array
     */
    public function getBySellerId($sellerId) {
        $sql = "SELECT p.*, u.store_name, c.name as category_name, c.icon as category_icon 
                FROM {$this->table} p 
                LEFT JOIN `users` u ON p.seller_id = u.id 
                LEFT JOIN `categories` c ON p.category_id = c.id 
                WHERE p.seller_id = :seller_id 
                ORDER BY p.id DESC";
        $this->db->query($sql);
        $this->db->bind(':seller_id', (int)$sellerId, PDO::PARAM_INT);
        $rows = $this->db->resultSet();

        return array_map([$this, 'formatProduct'], $rows);
    }

    /**
     * Menghitung total produk milik penjual tertentu
     */
    public function countBySellerId($sellerId) {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE seller_id = :seller_id");
        $this->db->bind(':seller_id', (int)$sellerId, PDO::PARAM_INT);
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    /**
     * Mengambil 1 produk berdasarkan ID beserta info toko penjual & kategori
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        $sql = "SELECT p.*, u.store_name, u.store_description, u.name as seller_name, u.phone as seller_phone, 
                       c.name as category_name, c.icon as category_icon 
                FROM {$this->table} p 
                LEFT JOIN `users` u ON p.seller_id = u.id 
                LEFT JOIN `categories` c ON p.category_id = c.id 
                WHERE p.id = :id LIMIT 1";
        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $row = $this->db->single();

        return $row ? $this->formatProduct($row) : null;
    }

    /**
     * Mengambil produk rekomendasi terkait
     * @param string $relatedIds Misal: "2,3,4,5"
     * @return array
     */
    public function getRelated($relatedIds) {
        if (empty($relatedIds)) return [];

        $ids = array_filter(array_map('intval', explode(',', $relatedIds)));
        if (empty($ids)) return [];

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT p.*, u.store_name, c.name as category_name, c.icon as category_icon 
                FROM {$this->table} p 
                LEFT JOIN `users` u ON p.seller_id = u.id 
                LEFT JOIN `categories` c ON p.category_id = c.id 
                WHERE p.id IN ($placeholders)";
        $this->db->query($sql);

        // Bind posisional
        foreach ($ids as $idx => $id) {
            $this->db->bind($idx + 1, $id, PDO::PARAM_INT);
        }

        $rows = $this->db->resultSet();
        return array_map([$this, 'formatProduct'], $rows);
    }

    /**
     * Menghitung total produk
     */
    public function count() {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    /**
     * Menambah produk baru
     * @param array $data
     * @return int ID produk baru
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (
            `seller_id`, `category_id`, `title`, `badge`, `rating`, `reviews_count`, `price`, `original_price`, `discount`, 
            `description`, `main_image`, `thumbnails`, `colors`, `sizes`, `bullets`, `materials`, `specs`, `related_ids`
        ) VALUES (
            :seller_id, :category_id, :title, :badge, :rating, :reviews_count, :price, :original_price, :discount, 
            :description, :main_image, :thumbnails, :colors, :sizes, :bullets, :materials, :specs, :related_ids
        )";

        $this->db->query($sql);
        $this->db->bind(':seller_id', (int)($data['seller_id'] ?? 1), PDO::PARAM_INT);
        $this->db->bind(':category_id', !empty($data['category_id']) ? (int)$data['category_id'] : 1, PDO::PARAM_INT);
        $this->bindProductParams($data);
        $this->db->execute();

        return (int)$this->db->lastInsertId();
    }

    /**
     * Memperbarui produk yang sudah ada
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
            `category_id` = :category_id, 
            `title` = :title, 
            `badge` = :badge, 
            `rating` = :rating, 
            `reviews_count` = :reviews_count, 
            `price` = :price, 
            `original_price` = :original_price, 
            `discount` = :discount, 
            `description` = :description, 
            `main_image` = :main_image, 
            `thumbnails` = :thumbnails, 
            `colors` = :colors, 
            `sizes` = :sizes, 
            `bullets` = :bullets, 
            `materials` = :materials, 
            `specs` = :specs, 
            `related_ids` = :related_ids
        WHERE `id` = :id";

        $this->db->query($sql);
        $this->db->bind(':category_id', !empty($data['category_id']) ? (int)$data['category_id'] : 1, PDO::PARAM_INT);
        $this->bindProductParams($data);
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    /**
     * Menghapus produk
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE `id` = :id");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    /**
     * Helper bind parameter produk
     */
    private function bindProductParams($data) {
        $this->db->bind(':title', $data['title'] ?? 'Produk Baru');
        $this->db->bind(':badge', $data['badge'] ?? null);
        $this->db->bind(':rating', (float)($data['rating'] ?? 5.0));
        $this->db->bind(':reviews_count', (int)($data['reviews_count'] ?? 0));
        $this->db->bind(':price', (int)($data['price'] ?? 0));
        $this->db->bind(':original_price', (int)($data['original_price'] ?? 0));
        $this->db->bind(':discount', $data['discount'] ?? null);
        $this->db->bind(':description', $data['description'] ?? '');
        $this->db->bind(':main_image', $data['main_image'] ?? 'images/pearl-white.png');
        $this->db->bind(':thumbnails', is_array($data['thumbnails'] ?? null) ? json_encode($data['thumbnails']) : ($data['thumbnails'] ?? '[]'));
        $this->db->bind(':colors', is_array($data['colors'] ?? null) ? json_encode($data['colors']) : ($data['colors'] ?? '[]'));
        $this->db->bind(':sizes', is_array($data['sizes'] ?? null) ? json_encode($data['sizes']) : ($data['sizes'] ?? '[]'));
        $this->db->bind(':bullets', is_array($data['bullets'] ?? null) ? json_encode($data['bullets']) : ($data['bullets'] ?? '[]'));
        $this->db->bind(':materials', $data['materials'] ?? '');
        $this->db->bind(':specs', is_array($data['specs'] ?? null) ? json_encode($data['specs']) : ($data['specs'] ?? '[]'));
        $this->db->bind(':related_ids', $data['related_ids'] ?? '1,2,3,4');
    }

    /**
     * Format kolom JSON dan tipe data agar siap digunakan di View / JS
     */
    private function formatProduct($item) {
        if (!$item) return null;

        $item['thumbnails'] = json_decode($item['thumbnails'], true) ?: [];
        $item['colors']     = json_decode($item['colors'], true) ?: [];
        $item['sizes']      = json_decode($item['sizes'], true) ?: [];
        $item['bullets']    = json_decode($item['bullets'], true) ?: [];
        $item['specs']      = json_decode($item['specs'], true) ?: [];
        $item['price']      = (int)$item['price'];
        $item['original_price'] = (int)$item['original_price'];
        $item['rating']     = (float)$item['rating'];
        $item['reviews_count']  = (int)$item['reviews_count'];
        $item['category_name'] = $item['category_name'] ?? 'Lampu Cangkang Keramik';
        $item['category_icon'] = $item['category_icon'] ?? 'lamp';

        // Format Rupiah untuk kemudahan tampilan di PHP
        $item['formatted_price'] = 'Rp ' . number_format($item['price'], 0, ',', '.');
        $item['formatted_original_price'] = 'Rp ' . number_format($item['original_price'], 0, ',', '.');

        return $item;
    }
}
