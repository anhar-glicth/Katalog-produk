<?php
// ========================================================
// LUMINA PEARL - HOME CONTROLLER
// ========================================================

class HomeController extends Controller {

    public function index() {
        $productModel = $this->model('ProductModel');
        $products = $productModel->getAll();

        // Ambil produk unggulan dinamis untuk carousel slider
        $carouselProducts = $productModel->getFeatured();

        $data = [
            'title' => APP_NAME . ' - ' . APP_DESC,
            'products' => $products,
            'carouselProducts' => $carouselProducts
        ];

        // Render template View
        $this->view('layouts/header', $data);
        $this->view('home/index', $data);
        $this->view('layouts/footer', $data);
    }
}
