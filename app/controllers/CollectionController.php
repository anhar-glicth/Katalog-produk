<?php
// ========================================================
// LUMINA PEARL - COLLECTION / DEALS CONTROLLER
// ========================================================

class CollectionController extends Controller {

    public function index() {
        $productModel = $this->model('ProductModel');
        $products = $productModel->getAll();

        // 1. Ambil Pengaturan Flash Sale Dinamis dari Database (site_settings)
        $flashActive = site_setting('flash_sale_active', '1');
        $flashTitle = site_setting('flash_sale_title', 'FLASH SALE');
        $flashEndTime = site_setting('flash_sale_end_time', '');
        if (empty($flashEndTime)) {
            $flashEndTime = date('Y-m-d H:i:s', strtotime('+2 hours 30 minutes'));
        }

        // Mapping produk ke diskon: ["product_id" => discount_percent]
        $savedProductsConfig = site_setting('flash_sale_products', '');
        $flashProductsConfig = json_decode($savedProductsConfig, true);

        // Fallback default bawaan jika belum pernah diatur
        if (!is_array($flashProductsConfig) || empty($flashProductsConfig)) {
            $flashProductsConfig = [
                1 => 74,
                2 => 45,
                3 => 63,
                4 => 50,
                5 => 40,
                6 => 68
            ];
        }

        $defaultSoldCounts = [286, 31, 142, 89, 520, 194];

        // 2. Siapkan data produk flash sale (untuk slider atas)
        $flashSales = [];
        $i = 0;
        foreach ($products as $p) {
            $pId = (int)$p['id'];
            if (!isset($flashProductsConfig[$pId])) {
                continue;
            }

            $disc = (int)$flashProductsConfig[$pId];
            if ($disc < 1) $disc = 1;
            if ($disc > 99) $disc = 99;

            $flashPrice = round($p['price'] * (1 - ($disc / 100)));
            $flashPrice = round($flashPrice / 100) * 100;

            $item = $p;
            $item['is_flash_sale'] = true;
            $item['discount_percent'] = $disc;
            $item['flash_price'] = $flashPrice;
            $item['formatted_flash_price'] = 'Rp ' . number_format($flashPrice, 0, ',', '.');
            $item['sold_count'] = $defaultSoldCounts[$i % count($defaultSoldCounts)];
            
            // Kategori internal untuk filter tabs
            $cat = 'lampu';
            if (stripos($p['title'], 'Sea') !== false || stripos($p['title'], 'Sapphire') !== false) {
                $cat = 'samudra';
            } elseif (stripos($p['title'], 'Akoya') !== false || stripos($p['title'], 'Natural') !== false || stripos($p['title'], 'South Sea') !== false) {
                $cat = 'alami';
            }
            $item['category_key'] = $cat;

            $flashSales[] = $item;
            $i++;
        }

        // Jika semua terfilter kosong tapi flash sale aktif, fallback aman ke 6 produk pertama
        if (empty($flashSales) && !empty($products)) {
            $discounts = [74, 45, 63, 50, 40, 68];
            foreach (array_slice($products, 0, 6) as $idx => $p) {
                $disc = $discounts[$idx % count($discounts)];
                $flashPrice = round($p['price'] * (1 - ($disc / 100)));
                $flashPrice = round($flashPrice / 100) * 100;

                $item = $p;
                $item['is_flash_sale'] = true;
                $item['discount_percent'] = $disc;
                $item['flash_price'] = $flashPrice;
                $item['formatted_flash_price'] = 'Rp ' . number_format($flashPrice, 0, ',', '.');
                $item['sold_count'] = $defaultSoldCounts[$idx % count($defaultSoldCounts)];

                $cat = 'lampu';
                if (stripos($p['title'], 'Sea') !== false || stripos($p['title'], 'Sapphire') !== false) {
                    $cat = 'samudra';
                } elseif (stripos($p['title'], 'Akoya') !== false || stripos($p['title'], 'Natural') !== false || stripos($p['title'], 'South Sea') !== false) {
                    $cat = 'alami';
                }
                $item['category_key'] = $cat;

                $flashSales[] = $item;
            }
        }

        // 3. Siapkan feed produk lengkap (untuk bagian daftar bawah)
        $feedProducts = [];
        foreach ($products as $idx => $p) {
            $pId = (int)$p['id'];
            $item = $p;

            if ($flashActive !== '0' && isset($flashProductsConfig[$pId])) {
                $disc = (int)$flashProductsConfig[$pId];
                $flashPrice = round($p['price'] * (1 - ($disc / 100)));
                $flashPrice = round($flashPrice / 100) * 100;
                $item['is_flash_sale'] = true;
                $item['discount_percent'] = $disc;
                $item['flash_price'] = $flashPrice;
                $item['formatted_flash_price'] = 'Rp ' . number_format($flashPrice, 0, ',', '.');
            } else {
                $item['is_flash_sale'] = false;
                $item['discount_percent'] = 0;
                $item['flash_price'] = $p['price'];
                $item['formatted_flash_price'] = $p['formatted_price'];
            }

            $item['sold_count'] = $defaultSoldCounts[$idx % count($defaultSoldCounts)];

            $cat = 'lampu';
            if (stripos($p['title'], 'Sea') !== false || stripos($p['title'], 'Sapphire') !== false) {
                $cat = 'samudra';
            } elseif (stripos($p['title'], 'Akoya') !== false || stripos($p['title'], 'Natural') !== false || stripos($p['title'], 'South Sea') !== false) {
                $cat = 'alami';
            }
            $item['category_key'] = $cat;

            $feedProducts[] = $item;
        }

        $data = [
            'title' => 'Lumina Deals & Koleksi Mahakarya | ' . APP_NAME,
            'page' => 'collection',
            'products' => $products,
            'flashSales' => $flashSales,
            'feedProducts' => $feedProducts,
            'flashActive' => $flashActive,
            'flashTitle' => $flashTitle,
            'flashEndTime' => $flashEndTime
        ];

        $this->view('layouts/header', $data);
        $this->view('collection/index', $data);
        $this->view('layouts/footer', $data);
    }
}
