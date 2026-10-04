<?php
// ========================================================
// LUMINA PEARL - PRODUCT CONTROLLER
// ========================================================

class ProductController extends Controller {

    /**
     * Menampilkan halaman detail produk dinamis berdasarkan ID
     * @param int $id
     */
    public function detail($id = 1) {
        $id = (int)$id;
        $productModel = $this->model('ProductModel');
        $product = $productModel->getById($id);

        if (!$product) {
            // Fallback ke produk id 1 jika id tidak valid
            $product = $productModel->getById(1);
            if (!$product) {
                $this->redirect('');
                return;
            }
        }

        // Ambil produk rekomendasi terkait
        $relatedProducts = $productModel->getRelated($product['related_ids'] ?? '');
        $allProducts = $productModel->getAll();

        $data = [
            'title' => $product['title'] . ' | ' . APP_NAME,
            'product' => $product,
            'related' => $relatedProducts,
            'products' => $allProducts
        ];

        $this->view('layouts/header', $data);
        $this->view('product/detail', $data);
        $this->view('layouts/footer', $data);
    }

    /**
     * Endpoint API JSON untuk data produk
     */
    public function api($id = null) {
        $productModel = $this->model('ProductModel');

        if ($id !== null) {
            $product = $productModel->getById((int)$id);
            if ($product) {
                $this->json(['status' => 'success', 'data' => $product]);
            } else {
                $this->json(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
            }
        } else {
            $products = $productModel->getAll();
            $this->json(['status' => 'success', 'data' => $products]);
        }
    }
}
