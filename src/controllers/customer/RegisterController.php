<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Register.php';

class RegisterController {
    private $db;
    private $registerModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->registerModel = new Register($this->db);
    }

    public function show() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        include_once __DIR__ . '../../../views/customer/register.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
            $error = "Invalid CSRF token.";
            include_once __DIR__ . '/../../views/customer/register.php';
            return;
        }

        // Lấy dữ liệu từ POST request
        $fullname = trim(htmlspecialchars($_POST['fullname'] ?? ''));
        $phone_number = trim(htmlspecialchars($_POST['phone_number'] ?? ''));
        $email_address = trim(htmlspecialchars($_POST['email_address'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $birth_day = $_POST['birth_day'] ?? '';
        $gender = htmlspecialchars($_POST['gender'] ?? '');
        $province = trim(htmlspecialchars($_POST['province'] ?? ''));
        $district = trim(htmlspecialchars($_POST['district'] ?? ''));
        $ward = trim(htmlspecialchars($_POST['ward'] ?? ''));
        $detail = trim(htmlspecialchars($_POST['detail'] ?? ''));
    
        // Kiểm tra các trường thông tin
        if (empty($fullname) || empty($phone_number) || empty($email_address) || empty($password) || empty($confirm_password) ||
            empty($birth_day) || empty($gender) || empty($province) || empty($district) || empty($ward) || empty($detail)) {
            $error = "Vui lòng điền đầy đủ thông tin.";
            include_once __DIR__ . '/../../views/customer/register.php';
            return;
        }
    
        // Kiểm tra định dạng email
        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $error = "Địa chỉ email không hợp lệ.";
            include_once __DIR__ . '/../../views/customer/register.php';
            return;
        }
    
        // Kiểm tra số điện thoại (phải là số và có độ dài phù hợp)
        if (!preg_match('/^\d{10,11}$/', $phone_number)) {
            $error = "Số điện thoại không hợp lệ.";
            include_once __DIR__ . '/../../views/customer/register.php';
            return;
        }
    
        $existingUser = $this->registerModel->getUserByPhoneOrEmail($email_address, $phone_number);
        if ($existingUser && $existingUser->rowCount() > 0) {
            $error = "Số điện thoại hoặc email đã được sử dụng.";
            include_once __DIR__ . '/../../views/customer/register.php';
            return;
        }

        if (strlen($password) < 8 || !preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[#@$!%*?&])/', $password)) {
            $error = "Mật khẩu phải chứa ít nhất 8 ký tự bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
            include_once __DIR__ . '/../../views/customer/register.php';
            return;
        }
    
        // Kiểm tra mật khẩu và xác nhận mật khẩu
        if ($password !== $confirm_password) {
            $error = "Mật khẩu và mật khẩu xác nhận không khớp.";
            include_once __DIR__ . '/../../views/customer/register.php';
            return;
        }
    
        $user_name = generateUsername($fullname, $birth_day);
    
        // Gửi dữ liệu tới model để tạo người dùng
        $result = $this->registerModel->postUser($fullname, $user_name, $phone_number, $email_address, $password, $birth_day, $gender);
    
        // Xử lý phản hồi từ model
        if ($result['success']) {
            // Lấy ID người dùng vừa được thêm
            $userId = $this->db->lastInsertId();
    
            // Gửi dữ liệu địa chỉ tới model
            $addressResult = $this->registerModel->postAddress($userId, $province, $district, $ward, $detail);
    
            if ($addressResult['success']) {
                $success = $addressResult['message'];
                include_once __DIR__ . '/../../views/customer/login.php';
            } else {
                $error = $addressResult['message'];
                include_once __DIR__ . '/../../views/customer/register.php';
            }
        } else {
            // Hiển thị lỗi từ model
            $error = $result['message'];
            include_once __DIR__ . '/../../views/customer/register.php';
        }
    }
}    

function generateUsername($fullname, $birth_day) {
    // Chuyển fullname sang không dấu
    $fullname = removeAccents($fullname);
    
    // Loại bỏ ký tự không hợp lệ
    $fullname = preg_replace('/[^a-zA-Z0-9\s]/u', '', $fullname);

    // Tách các phần trong fullname
    $nameParts = explode(' ', $fullname);

    // Xử lý trường hợp có 1 hoặc 2 chữ
    if (count($nameParts) === 1) {
        // Nếu chỉ có một chữ, lấy toàn bộ tên
        $namePart = strtolower($nameParts[0]);
    } elseif (count($nameParts) === 2) {
        // Nếu có hai chữ, lấy cả hai
        $namePart = strtolower($nameParts[1]); // Lấy chữ cuối
    } else {
        // Nếu có nhiều hơn hai chữ, lấy tên đệm và tên chính
        $namePart = strtolower($nameParts[count($nameParts) - 2] . $nameParts[count($nameParts) - 1]);
    }

    // Lấy ngày và tháng sinh từ birth_day
    $dayMonth = date('dm', strtotime($birth_day)); // Định dạng "ddmm"

    // Kết hợp phần tên và ngày tháng sinh
    return $namePart . $dayMonth;
}

// Hàm chuyển đổi chuỗi sang không dấu
function removeAccents($string) {
    $transliterationTable = [
        'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
        'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
        'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
        'è' => 'e', 'é' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
        'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
        'ì' => 'i', 'í' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
        'ò' => 'o', 'ó' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
        'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
        'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
        'ù' => 'u', 'ú' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
        'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
        'ỳ' => 'y', 'ý' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
        'đ' => 'd',
        'À' => 'A', 'Á' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A',
        'Ă' => 'A', 'Ắ' => 'A', 'Ằ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A',
        'Â' => 'A', 'Ấ' => 'A', 'Ầ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A',
        'È' => 'E', 'É' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E',
        'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E',
        'Ì' => 'I', 'Í' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I',
        'Ò' => 'O', 'Ó' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O',
        'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O',
        'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O',
        'Ù' => 'U', 'Ú' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U',
        'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U',
        'Ỳ' => 'Y', 'Ý' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y',
        'Đ' => 'D',
    ];
    return strtr($string, $transliterationTable);
}

?>
