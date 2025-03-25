<?php 
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Cart.php';

class CartController {
    private $db;
    private $cartModel;
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->cartModel = new Cart($this->db);
    }

    public function showcart() {
        error_reporting(0);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])):
            header('Location: /login');
        endif;
        $user_id = $_SESSION['user_id'] ?? '';
        $products = $this->cartModel->getCart($user_id)->fetchAll(PDO::FETCH_ASSOC);
        $sum_price = $this->cartModel->getSumPrice($user_id);
        $total_price = $this->cartModel->getOrderPrice($user_id);
        $data = [
            'products' => $products,
            'sum_price' => $sum_price,
            'total_price' => $total_price
        ];
        include_once __DIR__ . '/../../views/customer/cart.php';
    }

    public function delete() {
        $product_item_id = $_POST['product_item_id'] ?? '';
        if (empty($product_item_id)) {
            header('Location: /cart?delete-fail=1');
            exit();
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])):
            header('Location: /login');
        endif;
        $user_id = $_SESSION['user_id'] ?? '';
        $this->cartModel->deleteItem($user_id, $product_item_id);
        header('Location: /cart?delete-success=1');
    }

    public function promotionApply() {
        $promotion_code = $_POST['promotion_code'] ?? '';
        if (empty($promotion_code)) {
            header('Location: /cart?promotion-apply-fail=1');
            exit();
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])):
            header('Location: /login');
        endif;
        $user_id = $_SESSION['user_id'] ?? '';
        $this->cartModel->applyPromotion($user_id, $promotion_code);
        header('Location: /cart?promotion-apply-success=1');
    }
}