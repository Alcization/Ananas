<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/admin/Promotion.php';

class PromotionController {
    private $db;
    private $promotionModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->promotionModel = new Promotion($this->db);
    }

    public function getall() { 
        $data = $this->promotionModel->getAll()->fetchAll(PDO::FETCH_ASSOC);
        include_once __DIR__ . '../../../views/admin/admin_discount.php';
    }
    
    public function viewaddpromotion() {
        include_once __DIR__ . '../../../views/admin/admin_discount_add.php';
    }

    public function createpromotion() {
        // Lấy dữ liệu từ POST request
        $promotion_code = $_POST['promotion_code'] ?? '';
        $description = $_POST['description'] ?? ''; 
        $discount_percent = $_POST['discount_percent'] ?? ''; 
        $start_date = $_POST['start_date'] ?? '';
        $end_date = $_POST['end_date'] ?? '';
        $quantity = $_POST['quantity'] ?? '';
        $remain_quantity = $quantity ?? '';

        // Kiểm tra dữ liệu đầu vào
        if (empty($promotion_code) || empty($description) || empty($discount_percent) || empty($start_date) || empty($end_date) || empty($quantity)) {
            $error = "Vui lòng điền đầy đủ thông tin.";
            include_once __DIR__ . '../../../views/admin/admin_discount_add.php';
            return;
        }

        // Gửi dữ liệu tới model
        $result = $this->promotionModel->createPromotion($promotion_code, $description, $discount_percent, $start_date, $end_date, $quantity, $remain_quantity);

        if ($result) {
            header('Location: /promotion'); // Chuyển hướng sau khi thêm thành công
            exit();
        } else {
            $error = "Lỗi khi thêm khuyến mãi.";
            include_once __DIR__ . '../../../views/admin/admin_discount_add.php';
        }
    }

    public function vieweditpromotion() {
        $promotion_id = $_GET['promotion_id'] ?? null;

        if ($promotion_id) {
            $data = $this->promotionModel->getPromotionByID($promotion_id)->fetch(PDO::FETCH_ASSOC);
            include_once __DIR__ . '../../../views/admin/admin_discount_edit.php';
        } else {
            header('Location: /promotion');
        }
    }

    public function updatepromotion() {
        $promotion_id = $_GET['promotion_id'] ?? null;

        // Lấy dữ liệu từ POST request
        $promotion_code = $_POST['promotion_code'] ?? '';
        $description = $_POST['description'] ?? ''; 
        $discount_percent = $_POST['discount_percent'] ?? ''; 
        $start_date = $_POST['start_date'] ?? '';
        $end_date = $_POST['end_date'] ?? '';
        $quantity = $_POST['quantity'] ?? '';
        $remain_quantity = $_POST['remain_quantity'] ?? '';

        if (!$promotion_id || empty($promotion_code) || empty($description) || empty($discount_percent) || empty($start_date) || empty($end_date)  || empty($remain_quantity)) {
            $error = "Vui lòng điền đầy đủ thông tin.";
            include_once __DIR__ . '../../../views/admin/admin_discount_edit.php';
            return;
        }

        $result = $this->promotionModel->updatePromotion($promotion_id, $promotion_code, $description, $discount_percent, $start_date, $end_date, $quantity, $remain_quantity);

        if ($result) {
            header('Location: /promotion'); // Chuyển hướng sau khi cập nhật thành công
            exit();
        } else {
            $error = "Lỗi khi cập nhật khuyến mãi.";
            include_once __DIR__ . '../../../views/admin/admin_discount_edit.php';
        }
    }

    public function deletepromotion() {
        $promotion_id = $_GET['promotion_id'] ?? null;

        if ($promotion_id) {
            $result = $this->promotionModel->deletePromotion($promotion_id);

            if ($result) {
                header('Location: /promotion'); // Chuyển hướng sau khi xóa thành công
                exit();
            } else {
                $error = "Lỗi khi xóa khuyến mãi.";
                include_once __DIR__ . '../../../views/admin/admin_discount.php';
            }
        } else {
            header('Location: /promotion');
        }
    }
}
?>