<?php

class Register {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByPhoneOrEmail($email_address, $phone_number) {
        $query = "SELECT * FROM users WHERE phone_number = :phone_number OR email_address = :email_address LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['email_address' => $email_address, 'phone_number' => $phone_number]);
        return $stmt;
    }

    public function postUser($fullname, $user_name, $phone_number, $email_address, $password, $birth_day, $gender) {
        try { 
            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Thêm người dùng mới vào cơ sở dữ liệu
            $userQuery = "INSERT INTO users (fullname, user_name, phone_number, email_address, password, birth_date, gender) 
                            VALUES (:fullname, :user_name, :phone_number, :email_address, :password, :birth_day, :gender)";
            $userStmt = $this->db->prepare($userQuery);
            $userStmt->execute([
                ':fullname' => $fullname,
                ':user_name' => $user_name,
                ':phone_number' => $phone_number,
                ':email_address' => $email_address,
                ':password' => $hashedPassword,
                ':birth_day' => $birth_day,
                ':gender' => $gender
            ]);
    
            return ['success' => true, 'message' => 'Successfully add new user!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }

    public function postAddress($user_id, $province, $district, $ward, $detail) {
        try {
            $addressQuery = "INSERT INTO address (user_id, province, district, ward, detail)
                        VALUES (:user_id, :province, :district, :ward, :detail)";
            $addressStmt = $this->db->prepare($addressQuery);
            $addressStmt->execute([
                ':user_id' => $user_id,
                ':province' => $province,
                ':district' => $district,
                ':ward' => $ward,
                ':detail' => $detail
            ]);
            return ['success' => true, 'message' => 'Successfully add new address!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }
}
    
?>