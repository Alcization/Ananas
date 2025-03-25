<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/admin/Order.php';

class OrderController {
    private $db;
    private $orderModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->orderModel = new Order($this->db);
    }

    public function order() {
        $data = $this->orderModel->getAllOrder()->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/admin/Order.php';
    }

    public function detail($id = null) {
        if (!$id) {
            echo "Đơn hàng không tồn tại.";
            return;
        }
    
        $order_detail = $this->orderModel->getDetail($id)->fetchAll(PDO::FETCH_ASSOC);
        $order_product = $this->orderModel->getProductOrder($id)->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'order_detail' => $order_detail,
            'order_product' => $order_product
        ];
        
        include_once __DIR__ . '/../../views/admin/order_detail.php';
    }

}