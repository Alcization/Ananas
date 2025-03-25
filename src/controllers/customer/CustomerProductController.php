<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Product.php';

class CustomerProductController {
    private $db;
    
    private $productModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->productModel = new Product($this->db);
    }

    public function products() {
        $data = $this->productModel->getAllProduct()->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/customer/product_list.php';
    }

    public function detail($product_item_id) {
        $product = $this->productModel->getDetail($product_item_id)->fetch(PDO::FETCH_ASSOC);
        $color = $this->productModel->getColor($product_item_id)->fetchAll(PDO::FETCH_ASSOC);
        $size = $this->productModel->getSize($product_item_id)->fetchAll(PDO::FETCH_ASSOC);
        $description = $this->productModel->getDescription($product_item_id)->fetch(PDO::FETCH_ASSOC);
        $review = $this->productModel->getReview($product_item_id)->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'product' => $product,
            'color' => $color,
            'size' => $size,
            'description' => $description,
            'review' => $review
        ];

        include_once __DIR__ . '/../../views/customer/product_detail.php';
    }

    public function addToCart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])):
            header('Location: /login');
        endif;
        $user_id = $_SESSION['user_id'] ?? '';
        $product_id = $_POST['product_id'] ?? '';
        $color_id = $_POST['color_id'] ?? '';
        $size_id = $_POST['size_id'] ?? '';
        $quantity = $_POST['quantity'] ?? '';


        if (empty($user_id) || empty($product_id) || empty($size_id) || empty($color_id) || empty($quantity)) {
            $error = "Vui lòng nhập đầy đủ thông tin.";
            
            include_once __DIR__ . '/../../views/customer/product_detail.php';
            return;
        }

        if (!is_numeric($quantity)) {
            $error = "Số lượng phải là số.";
            include_once __DIR__ . '/../../views/customer/product_detail.php';
            return;
        }
        
        
        $result = $this->productModel->addToCart($user_id, $product_id, $color_id, $size_id, $quantity);
        if ($result) {
            header('Location: /product_list/detail/'.$result.'?success=1');
        } else {
            include_once __DIR__ . '/../../views/customer/product_detail.php';
        }
    }

    public function writeReviewshow($product_item_id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])):
            header('Location: /login');
        endif;
        $product = $this->productModel->getDetail($product_item_id)->fetch(PDO::FETCH_ASSOC);
        $data = [
            'product' => $product
        ];
        include_once __DIR__ . '/../../views/customer/writereview.php';
    }

    public function writeReview() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? '';
        if (empty($user_id)) {
            header('Location: /login');
            exit();
        }
        $product_item_id = $_POST['product_item_id'] ?? '';
        $rating = $_POST['rating'] ?? '';
        $content = $_POST['content'] ?? '';
        if (empty($product_item_id) || empty($rating) || empty($content)) {
            $error = "Vui lòng nhập đầy đủ thông tin.";
            include_once __DIR__ . '/../../views/customer/writereview.php';
            return;
        }
        $this->productModel->writeReview($user_id, $product_item_id, $rating, $content);
        header('Location: /product_list/writereview/'.$product_item_id.'?success=1');
    }

    public function getLoveItem() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? '';
        if (empty($user_id)) {
            header('Location: /login');
            exit();
        }
        $data = $this->productModel->getAllLoveProduct($user_id)->fetchAll(PDO::FETCH_ASSOC);
        include_once __DIR__ . '/../../views/customer/love_item.php';
    }

    public function addLoveItem() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? '';
        if (empty($user_id)) {
            header('Location: /login');
            exit();
        } 
        $product_item_id = $_POST['product_item_id'] ?? '';
        $this->productModel->addLoveItem($user_id, $product_item_id);
        header('Location: /love_item?success=1');
    }

    public function deleteLoveItem() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? '';
        if (empty($user_id)) {
            header('Location: /login');
            exit();
        } 
        $product_item_id = $_POST['product_item_id'] ?? '';
        $this->productModel->deleteLoveItem($user_id, $product_item_id);
        header('Location: /love_item?delete=1');
    }

    public function getSaleProduct() {
        $data = $this->productModel->getAllSaleProduct()->fetchAll(PDO::FETCH_ASSOC);
        include_once __DIR__ . '/../../views/customer/sale_off.php';
    }
}