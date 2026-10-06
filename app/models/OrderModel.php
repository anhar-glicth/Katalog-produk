<?php
// ========================================================
// LUMINA PEARL - ORDER MODEL (TRANSAKSI CHECKOUT)
// ========================================================

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Menyimpan transaksi pesanan dan item yang dibeli ke MySQL
     * 
     * @param array $order
     * @param array $items
     * @return array Status dan info pesanan baru
     */
    public function createOrder($order, $items) {
        $orderCode = 'LP-' . date('ymd') . '-' . strtoupper(substr(uniqid(), -4));

        // 1. Verifikasi harga resmi dari database untuk mencegah manipulasi harga dari client
        $calculatedSubtotal = 0;
        $verifiedItems = [];

        if (!empty($items) && is_array($items)) {
            foreach ($items as $item) {
                $pid = (int)($item['id'] ?? 0);
                $qty = max(1, (int)($item['qty'] ?? 1));
                $sellerId = 1;
                $realPrice = 0;
                $title = $item['title'] ?? 'Lumina Pearl';

                if ($pid > 0) {
                    $this->db->query("SELECT title, price, seller_id FROM `products` WHERE id = :pid LIMIT 1");
                    $this->db->bind(':pid', $pid);
                    $pRow = $this->db->single();
                    if ($pRow) {
                        $sellerId = !empty($pRow['seller_id']) ? (int)$pRow['seller_id'] : 1;
                        $realPrice = (int)$pRow['price'];
                        $title = $pRow['title'];
                    }
                }

                if ($realPrice <= 0) {
                    $realPrice = (int)($item['price'] ?? 0);
                }

                $calculatedSubtotal += ($realPrice * $qty);

                $verifiedItems[] = [
                    'product_id' => $pid,
                    'seller_id' => $sellerId,
                    'title' => $title,
                    'price' => $realPrice,
                    'variant' => $item['variant'] ?? 'Standard',
                    'size' => $item['size'] ?? 'Standard',
                    'qty' => $qty
                ];
            }
        }

        $subtotal = $calculatedSubtotal > 0 ? $calculatedSubtotal : (int)($order['subtotal'] ?? 0);
        $shippingFee = (int)($order['shipping_fee'] ?? 0);
        $adminFee = (int)($order['admin_fee'] ?? 2000);
        $totalAmount = $subtotal + $shippingFee + $adminFee;

        // 2. Simpan header order
        $sql = "INSERT INTO `orders` (
            `user_id`, `order_code`, `customer_name`, `customer_phone`, `customer_address`, 
            `courier`, `payment_method`, `subtotal`, `shipping_fee`, `admin_fee`, `total_amount`, `status`
        ) VALUES (
            :user_id, :order_code, :customer_name, :customer_phone, :customer_address, 
            :courier, :payment_method, :subtotal, :shipping_fee, :admin_fee, :total_amount, :status
        )";

        $userId = !empty($order['user_id']) ? (int)$order['user_id'] : null;

        $this->db->query($sql);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':order_code', $orderCode);
        $this->db->bind(':customer_name', $order['customer_name'] ?? 'Pelanggan Lumina');
        $this->db->bind(':customer_phone', $order['customer_phone'] ?? '-');
        $this->db->bind(':customer_address', $order['customer_address'] ?? 'Alamat Pengiriman');
        $this->db->bind(':courier', $order['courier'] ?? 'JNE Regular');
        $this->db->bind(':payment_method', $order['payment_method'] ?? 'Transfer Bank Manual');
        $this->db->bind(':subtotal', $subtotal);
        $this->db->bind(':shipping_fee', $shippingFee);
        $this->db->bind(':admin_fee', $adminFee);
        $this->db->bind(':total_amount', $totalAmount);
        $this->db->bind(':status', 'Menunggu Pembayaran');
        $this->db->execute();

        $orderId = $this->db->lastInsertId();

        // 3. Simpan masing-masing item produk yang telah divalidasi ke order_items
        foreach ($verifiedItems as $vItem) {
            $itemSql = "INSERT INTO `order_items` (
                `order_id`, `product_id`, `seller_id`, `product_title`, `price`, `variant`, `size`, `qty`
            ) VALUES (
                :order_id, :product_id, :seller_id, :product_title, :price, :variant, :size, :qty
            )";
            $this->db->query($itemSql);
            $this->db->bind(':order_id', $orderId);
            $this->db->bind(':product_id', $vItem['product_id']);
            $this->db->bind(':seller_id', $vItem['seller_id']);
            $this->db->bind(':product_title', $vItem['title']);
            $this->db->bind(':price', $vItem['price']);
            $this->db->bind(':variant', $vItem['variant']);
            $this->db->bind(':size', $vItem['size']);
            $this->db->bind(':qty', $vItem['qty']);
            $this->db->execute();
        }

        return [
            'id' => $orderId,
            'order_code' => $orderCode,
            'total_amount' => $totalAmount
        ];
    }

    /**
     * Mengambil data pesanan dan rincian item berdasarkan kode order
     * @param string $orderCode
     * @return array|null
     */
    public function getByOrderCode($orderCode) {
        $this->db->query("SELECT * FROM `orders` WHERE order_code = :code LIMIT 1");
        $this->db->bind(':code', $orderCode);
        $order = $this->db->single();

        if (!$order) return null;

        // Ambil item
        $this->db->query("SELECT * FROM `order_items` WHERE order_id = :order_id");
        $this->db->bind(':order_id', $order['id']);
        $order['items'] = $this->db->resultSet();

        return $order;
    }

    /**
     * Mengambil data pesanan dan rincian item berdasarkan ID
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        $this->db->query("SELECT * FROM `orders` WHERE id = :id LIMIT 1");
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        $order = $this->db->single();

        if (!$order) return null;

        $this->db->query("SELECT * FROM `order_items` WHERE order_id = :order_id");
        $this->db->bind(':order_id', $order['id']);
        $order['items'] = $this->db->resultSet();

        return $order;
    }

    /**
     * Mengambil seluruh pesanan untuk admin
     * @return array
     */
    public function getAllOrders() {
        $this->db->query("SELECT * FROM `orders` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    /**
     * Menghitung total transaksi pesanan
     */
    public function getOrderCount() {
        $this->db->query("SELECT COUNT(*) as total FROM `orders`");
        $row = $this->db->single();
        return (int)($row['total'] ?? 0);
    }

    /**
     * Menghitung total estimasi omset/pendapatan
     */
    public function getTotalRevenue() {
        $this->db->query("SELECT SUM(total_amount) as revenue FROM `orders` WHERE status != 'Dibatalkan'");
        $row = $this->db->single();
        return (int)($row['revenue'] ?? 0);
    }

    /**
     * Mengambil N pesanan terbaru untuk dashboard
     */
    public function getRecentOrders($limit = 5) {
        $this->db->query("SELECT * FROM `orders` ORDER BY id DESC LIMIT :limit");
        $this->db->bind(':limit', (int)$limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    /**
     * Mengubah status pesanan
     * @param int $id
     * @param string $status
     * @return bool
     */
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE `orders` SET `status` = :status WHERE `id` = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    /**
     * Menyimpan path bukti transfer pembayaran yang diunggah pembeli
     * @param string $orderCode
     * @param string $proofPath
     * @return bool
     */
    public function updatePaymentProof($orderCode, $proofPath) {
        $this->db->query("UPDATE `orders` SET `payment_proof` = :proof, `payment_proof_time` = CURRENT_TIMESTAMP, `status` = 'Menunggu Konfirmasi Penjual' WHERE `order_code` = :code");
        $this->db->bind(':proof', $proofPath);
        $this->db->bind(':code', $orderCode);
        return $this->db->execute();
    }

    /**
     * Mengambil seluruh pesanan milik akun pembeli tertentu
     * @param int $userId
     * @return array
     */
    public function getOrdersByUserId($userId) {
        $this->db->query("SELECT * FROM `orders` WHERE `user_id` = :uid ORDER BY id DESC");
        $this->db->bind(':uid', (int)$userId, PDO::PARAM_INT);
        $orders = $this->db->resultSet();

        foreach ($orders as &$ord) {
            $this->db->query("SELECT * FROM `order_items` WHERE `order_id` = :oid");
            $this->db->bind(':oid', (int)$ord['id'], PDO::PARAM_INT);
            $ord['items'] = $this->db->resultSet();
        }

        return $orders;
    }

    /**
     * Mengambil pesanan yang mengandung produk milik penjual tertentu (Seller Center)
     * @param int $sellerId
     * @return array
     */
    public function getOrdersBySellerId($sellerId) {
        $sql = "SELECT DISTINCT o.* 
                FROM `orders` o 
                JOIN `order_items` oi ON o.id = oi.order_id 
                WHERE oi.seller_id = :sid 
                ORDER BY o.id DESC";
        $this->db->query($sql);
        $this->db->bind(':sid', (int)$sellerId, PDO::PARAM_INT);
        $orders = $this->db->resultSet();

        foreach ($orders as &$ord) {
            $this->db->query("SELECT * FROM `order_items` WHERE `order_id` = :oid AND `seller_id` = :sid");
            $this->db->bind(':oid', (int)$ord['id'], PDO::PARAM_INT);
            $this->db->bind(':sid', (int)$sellerId, PDO::PARAM_INT);
            $ord['seller_items'] = $this->db->resultSet();
        }

        return $orders;
    }

    /**
     * Mengambil statistik penjualan toko penjual
     * @param int $sellerId
     * @return array
     */
    public function getSellerStats($sellerId) {
        // Total omset produk toko ini
        $this->db->query("SELECT SUM(price * qty) as revenue, COUNT(DISTINCT order_id) as total_orders, SUM(qty) as items_sold 
                          FROM `order_items` 
                          WHERE `seller_id` = :sid");
        $this->db->bind(':sid', (int)$sellerId, PDO::PARAM_INT);
        $res = $this->db->single();

        return [
            'revenue' => (int)($res['revenue'] ?? 0),
            'total_orders' => (int)($res['total_orders'] ?? 0),
            'items_sold' => (int)($res['items_sold'] ?? 0)
        ];
    }
}

