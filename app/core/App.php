<?php
// ========================================================
// LUMINA PEARL - APPLICATION ROUTER (APP)
// ========================================================

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Cek Parameter Backward Compatibility (misal: ?id=1)
        if (empty($url) && isset($_GET['id']) && is_numeric($_GET['id'])) {
            $this->controller = 'ProductController';
            $this->method = 'detail';
            $this->params = [(int)$_GET['id']];
            $this->dispatch();
            return;
        }

        // 2. Evaluasi Controller dari URL
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists(__DIR__ . '/../controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 3. Evaluasi Method / Action dari URL
        if (isset($url[1])) {
            // Shortcut: Jika url formatnya /product/1 langsung dialihkan ke detail(1)
            if (is_numeric($url[1]) && method_exists($this->controller, 'detail')) {
                $this->method = 'detail';
                $this->params = [(int)$url[1]];
                unset($url[1]);
            } else if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 4. Parameter sisa
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        $this->dispatch();
    }

    protected function dispatch() {
        if (!is_object($this->controller)) {
            require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        // Cek pathinfo jika mod_rewrite tidak menyertakan ?url=
        $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $baseDir = dirname($scriptName);

        if ($baseDir !== '/' && strpos($requestUri, $baseDir) === 0) {
            $path = substr($requestUri, strlen($baseDir));
        } else {
            $path = $requestUri;
        }

        $path = trim($path, '/');
        // Hilangkan 'index.php' jika ada di URL
        $path = preg_replace('#^index\.php/?#', '', $path);

        if (!empty($path)) {
            return explode('/', filter_var($path, FILTER_SANITIZE_URL));
        }

        return [];
    }
}
