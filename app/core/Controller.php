<?php
// ========================================================
// LUMINA PEARL - BASE CONTROLLER
// ========================================================

class Controller {

    /**
     * Me-render view dengan data yang diberikan
     * 
     * @param string $view Path ke file view (relatif terhadap app/views)
     * @param array $data Data asosiatif yang dikirim ke view
     */
    public function view($view, $data = []) {
        // Ekstrak array data menjadi variabel lokal di view
        extract($data);

        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View <strong>" . htmlspecialchars($view) . "</strong> tidak ditemukan!");
        }
    }

    /**
     * Memuat dan menginstansiasi class model
     * 
     * @param string $model Nama class model
     * @return object Instance dari model
     */
    public function model($model) {
        $modelFile = __DIR__ . '/../models/' . $model . '.php';

        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            die("Model <strong>" . htmlspecialchars($model) . "</strong> tidak ditemukan!");
        }
    }

    /**
     * Helper response format JSON
     * 
     * @param mixed $data Data response
     * @param int $statusCode HTTP status code
     */
    public function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    /**
     * Helper redirect URL
     * 
     * @param string $path Path relatif atau URL lengkap
     */
    public function redirect($path) {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            header('Location: ' . $path);
        } else {
            header('Location: ' . BASEURL . ltrim($path, '/'));
        }
        exit;
    }
}
