<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/admin/Product.php';

class ProductController {
    private $db;
    private $productModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->productModel = new Product($this->db);
    }

    public function products() {
        $data = $this->productModel->getAllProduct()->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/admin/products.php';
    }  

    public function show() {
        include_once __DIR__ . '/../../views/admin/addproduct.php';
    }
    
    public function addproduct() {
        $product_name = $_POST['product_name'] ?? '';
        $product_image = $_POST['product_image'] ?? '';
        $product_description = $_POST['product_description'] ?? '';
        $product_price = $_POST['product_price'] ?? '';
        $smallest_size = $_POST['smallest_size'] ?? '';
        $biggest_size = $_POST['biggest_size'] ?? '';
        $color_white = $_POST['color_white'] ?? '';
        $color_black = $_POST['color_black'] ?? '';
        $color_beige = $_POST['color_beige'] ?? '';
        $color_brown = $_POST['color_brown'] ?? '';
        $color_blue = $_POST['color_blue'] ?? '';

        if (empty($product_name) || empty($product_image) || empty($product_description) || empty($product_price) || empty($color_white)) {
            $error = "Vui lòng nhập đầy đủ thông tin.";
            include_once __DIR__ . '/../../views/admin/addproduct.php';
            return;
        }

        if (!is_numeric($product_price)) {
            $error = "Giá sản phẩm phải là số.";
            include_once __DIR__ . '/../../views/admin/addproduct.php';
            return;
        }

        if (!is_numeric($smallest_size) || !is_numeric($biggest_size)) {
            $error = "Kích thước phải là số.";
            include_once __DIR__ . '/../../views/admin/addproduct.php';
            return;
        }

        if ($smallest_size > $biggest_size) {
            $error = "Kích thước nhỏ nhất phải nhỏ hơn kích thuoc lớn nhất.";
            include_once __DIR__ . '/../../views/admin/addproduct.php';
            return;
        }

        $result = $this->productModel->addProduct($product_name, $product_image, $product_description, $product_price, $smallest_size, $biggest_size, $color_white, $color_black, $color_beige, $color_brown, $color_blue);

        header('Location: /addproduct?success=true');
    }

    public function showupdate($product_item_id = null) {
        if (!$product_item_id) {
            echo "Sản phẩm không tồn tại.";
            return;
        }
        $data = $this->productModel->getProductById($product_item_id)->fetch(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/admin/updateproduct.php';
    }

    public function updateproduct() {
        $product_item_id = $_POST['product_item_id'] ?? '';
        $product_image = $_POST['product_image'] ?? '';
        $product_description = $_POST['product_description'] ?? '';
        $product_price = $_POST['product_price'] ?? '';
        $size = $_POST['size'] ?? '';
        $color = $_POST['color'] ?? ''; 

        if (empty($product_item_id) || empty($product_image) || empty($product_description) || empty($product_price) || empty($size) || empty($color)) {
            $error = "Vui lòng nhập đầy đủ thông tin.";
            include_once __DIR__ . '/../../views/admin/updateproduct.php';
            return;
        }

        if (!is_numeric($product_price)) {
            $error = "Giá sản phẩm phải là số.";
            include_once __DIR__ . '/../../views/admin/updateproduct.php';
            return;
        }

        if (!is_numeric($size)) {
            $error = "Kích thước phải là số.";
            include_once __DIR__ . '/../../views/admin/updateproduct.php';
            return;
        }

        if ($size < 39 || $size > 44) {
            $error = "Kích thước phải từ 39 đến 44.";
            include_once __DIR__ . '/../../views/admin/updateproduct.php';
            return;
        }
        
        $result = $this->productModel->updateProduct($product_item_id, $product_image, $product_description, $product_price, $size, $color);

        if ($result['success']) {
            header('Location: /products');
        } else {
            $error = $result['message'];
            include_once __DIR__ . '/../../views/admin/updateproduct.php';
        }

    }

    public function showdelete ($product_item_id) {
        if (!$product_item_id) {
            echo "Sản phẩm không tồn tại.";
            return;
        }
        $data = $this->productModel->getProductById($product_item_id)->fetch(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/admin/deleteproduct.php';
    }

    public function deleteproduct() {
        $product_item_id = $_POST['product_item_id'] ?? '';

        $result = $this->productModel->deleteProduct($product_item_id);

        if ($result['success']) {
            header('Location: /products');
        } else {
            echo $result['message'];
        }
    }
}