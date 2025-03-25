<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Login.php';

class LoginController {
    private $db;
    private $loginModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->loginModel = new Login($this->db);
    }

    public function show() {
        include_once __DIR__ . '../../../views/customer/login.php';
    }

    public function login() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("CSRF token không hợp lệ.");
        }
        // Giới hạn tỉ lệ đăng nhập
        $this->throttleCheck();

        $identifier = $_POST['identifier'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($identifier) || empty($password)) {
            $error = "Vui lòng nhập đầy đủ thông tin.";
            include_once __DIR__ . '../../../views/customer/login.php';
        }

        $user = $this->loginModel->getUserByPhoneOrEmail($identifier)->fetch(PDO::FETCH_ASSOC);;
        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['role'] = $user['role'];

            header('Location: /');
        } else {
            $error = "Số điện thoại/email hoặc mật khẩu không đúng.";
            include_once __DIR__ . '../../../views/customer/login.php';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy(); 
        header('Location: /');
        exit();
    }

    private function throttleCheck() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Khởi tạo session nếu chưa tồn tại
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_login_attempt'] = time();
        }
    
        $maxAttempts = 5; // Số lần thử tối đa
        $waitTime = 60; // Thời gian chờ (giây)
    
        // Kiểm tra nếu đã đạt giới hạn
        if ($_SESSION['login_attempts'] >= $maxAttempts) {
            $timeSinceLastAttempt = time() - $_SESSION['last_login_attempt'];
    
            if ($timeSinceLastAttempt < $waitTime) {
                $remainingTime = $waitTime - $timeSinceLastAttempt;
    
                // Không tăng số lần thử, chỉ cảnh báo
                $error = "Quá nhiều lần thử. Vui lòng thử lại sau $remainingTime giây.";
                include_once __DIR__ . '../../../views/customer/login.php';
                exit; // Dừng xử lý tại đây
            } else {
                // Reset số lần thử sau khi hết thời gian chờ
                $_SESSION['login_attempts'] = 0;
            }
        }
    
        // Tăng số lần thử và cập nhật thời gian
        $_SESSION['login_attempts']++;
        $_SESSION['last_login_attempt'] = time();
    }
}    
?>