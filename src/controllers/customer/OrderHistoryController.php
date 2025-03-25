<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/OrderHistory.php';

class OrderHistoryController {
    private $db;
    private $orderHistoryModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->orderHistoryModel = new OrderHistory($this->db);
    }

    public function order_history() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        $order = $this->orderHistoryModel->getUserOrder($user_id)->fetchAll(PDO::FETCH_ASSOC);
        $order_item = $this->orderHistoryModel->getUserOrderItem($user_id)->fetchAll(PDO::FETCH_ASSOC);
    
        $data = [
            'order' => $order,
            'order_item' => $order_item
        ];
    
        // Gửi dữ liệu đến view
        include_once __DIR__ . '../../../views/customer/account_order_history.php';
    }
    
    public function cancel_order() {
        $order_id = $_GET['order_id'] ?? null;
        $this->orderHistoryModel->cancelUserOrder($order_id);
        header('Location: /orderhistory');
    }
}
?>