<?php
// ========================================================
// LUMINA PEARL - HOME CONTROLLER
// ========================================================

class HomeController extends Controller {

    public function index() {
        $productModel = $this->model('ProductModel');
        $products = $productModel->getAll();

        $data = [
            'title' => APP_NAME . ' - ' . APP_DESC,
            'products' => $products,
            // Produk untuk carousel slider (4 produk unggulan pertama)
            'carouselProducts' => array_slice($products, 0, 4)
        ];

        // Render template View
        $this->view('layouts/header', $data);
        $this->view('home/index', $data);
        $this->view('layouts/footer', $data);
    }
}
