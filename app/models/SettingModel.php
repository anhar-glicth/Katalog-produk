<?php
// ========================================================
// LUMINA PEARL - SETTING MODEL (MYSQL PDO)
// ========================================================

class SettingModel {
    private $db;
    private $table = 'site_settings';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Mengambil semua pengaturan sebagai key-value associative array
     * @return array
     */
    public function getAll() {
        $this->db->query("SELECT setting_key, setting_value FROM {$this->table}");
        $rows = $this->db->resultSet();
        $settings = [];
        foreach ($rows as $r) {
            $settings[$r['setting_key']] = $r['setting_value'];
        }
        return $settings;
    }

    /**
     * Mengambil satu nilai pengaturan dengan fallback default
     * @param string $key
     * @param string $default
     * @return string
     */
    public function get($key, $default = '') {
        $this->db->query("SELECT setting_value FROM {$this->table} WHERE setting_key = :k LIMIT 1");
        $this->db->bind(':k', $key);
        $row = $this->db->single();
        return $row ? ($row['setting_value'] ?? $default) : $default;
    }

    /**
     * Menyimpan / memperbarui satu nilai pengaturan
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value) {
        $sql = "INSERT INTO {$this->table} (setting_key, setting_value) 
                VALUES (:k, :v) 
                ON DUPLICATE KEY UPDATE setting_value = :v";
        $this->db->query($sql);
        $this->db->bind(':k', $key);
        $this->db->bind(':v', $value);
        return $this->db->execute();
    }

    /**
     * Menyimpan banyak pengaturan sekaligus
     * @param array $settings
     * @return bool
     */
    public function setMany($settings) {
        foreach ($settings as $k => $v) {
            $this->set($k, $v);
        }
        return true;
    }

    /**
     * Helper unggah logo gambar dari perangkat
     * @param array $file $_FILES['logo_file']
     * @return string|null Path relatif gambar baru atau null jika gagal
     */
    public function handleLogoUpload($file) {
        if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Batasi ukuran logo maksimal 5 MB
        if (!empty($file['size']) && $file['size'] > 5 * 1024 * 1024) {
            return null;
        }

        $allowedExts = ['png', 'jpg', 'jpeg', 'webp', 'svg'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            return null;
        }

        // Verifikasi keaslian biner gambar (kecuali SVG)
        if ($ext !== 'svg') {
            $info = @getimagesize($file['tmp_name']);
            if ($info === false) {
                return null;
            }
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($info['mime'], $allowedMimes)) {
                return null;
            }
        }

        $uploadDir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $newFileName = 'logo_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        $targetPath = $uploadDir . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return 'images/uploads/' . $newFileName;
        }

        return null;
    }
}
