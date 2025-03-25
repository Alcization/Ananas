<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Info.php';

class InfoController {
    private $db;
    private $infoModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->infoModel = new Info($this->db);
    }

    public function info() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
    
        // Lấy thông tin người dùng từ model
        $data = $this->infoModel->getUserInfo($user_id)->fetchAll(PDO::FETCH_ASSOC);
    
        // Hiển thị view
        include_once __DIR__ . '../../../views/customer/account_info.php';
    }
    

    public function updateinfo() {
        try {
            // Kiểm tra kết nối PDO
            if (!($this->db instanceof PDO)) {
                throw new Exception('Kết nối PDO không hợp lệ.');
            }
    
            // Bắt đầu giao dịch
            $this->db->beginTransaction();
    
            // Khởi động session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    
            $user_id = $_SESSION['user_id'] ?? null;
    
            // Kiểm tra xem người dùng đã đăng nhập chưa
            if (!$user_id) {
                throw new Exception('Người dùng chưa đăng nhập.');
            }
    
            // Lấy dữ liệu từ form
            $birth_date = $_POST['birth_date'] ?? '';
            $email_address = $_POST['email_address'] ?? '';
            $phone_number = $_POST['phone_number'] ?? '';
            $province = $_POST['province'] ?? '';
            $district = $_POST['district'] ?? '';
            $ward = $_POST['ward'] ?? '';
            $detail = $_POST['detail'] ?? '';
    
            // Kiểm tra dữ liệu trống
            if (empty($birth_date) || empty($email_address) || empty($phone_number) || empty($province) || empty($district) || empty($ward) || empty($detail)) {
                throw new Exception('Vui lòng điền đầy đủ thông tin.');
            }
    
            // Gửi dữ liệu tới model
            $result = $this->infoModel->updateUser($user_id, $birth_date, $email_address, $phone_number, $province, $district, $ward, $detail);
    
            if ($result['success']) {
                $this->db->commit();
                header('Location: /info?success=' . urlencode($result['message']));
                exit();
            } else {
                throw new Exception($result['message']);
            }
        } catch (PDOException $e) {
            // Rollback nếu có lỗi PDO
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            $error = "Lỗi không mong muốn: " . $e->getMessage();
            header('Location: /info?error=' . urlencode($error));
            exit();
        } catch (Exception $e) {
            // Rollback nếu có lỗi khác
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            $error = $e->getMessage();
            header('Location: /info?error=' . urlencode($error));
            exit();
        }
    }   
    
}
?>