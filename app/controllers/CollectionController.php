<?php
// ========================================================
// LUMINA PEARL - COLLECTION / DEALS CONTROLLER
// ========================================================

class CollectionController extends Controller {

    public function index() {
        $productModel = $this->model('ProductModel');
        $products = $productModel->getAll();

        // Siapkan data flash sale khusus promo berbatas waktu
        $flashSales = [];
        $discounts = [74, 45, 63, 50, 40, 68];
        $soldCounts = [286, 31, 142, 89, 520, 194];

        foreach ($products as $idx => $p) {
            $disc = $discounts[$idx % count($discounts)];
            $flashPrice = round($p['price'] * (1 - ($disc / 100)));
            // Bulatkan ke kelipatan seratus terdekat
            $flashPrice = round($flashPrice / 100) * 100;

            $item = $p;
            $item['discount_percent'] = $disc;
            $item['flash_price'] = $flashPrice;
            $item['formatted_flash_price'] = 'Rp ' . number_format($flashPrice, 0, ',', '.');
            $item['sold_count'] = $soldCounts[$idx % count($soldCounts)];
            
            // Kategori internal
            $cat = 'lampu';
            if (stripos($p['title'], 'Sea') !== false || stripos($p['title'], 'Sapphire') !== false) {
                $cat = 'samudra';
            } elseif (stripos($p['title'], 'Akoya') !== false || stripos($p['title'], 'Natural') !== false || stripos($p['title'], 'South Sea') !== false) {
                $cat = 'alami';
            }
            $item['category_key'] = $cat;

            $flashSales[] = $item;
        }

        $data = [
            'title' => 'Lumina Deals & Koleksi Mahakarya | ' . APP_NAME,
            'page' => 'collection',
            'products' => $products,
            'flashSales' => $flashSales
        ];

        $this->view('layouts/header', $data);
        $this->view('collection/index', $data);
        $this->view('layouts/footer', $data);
    }
}
