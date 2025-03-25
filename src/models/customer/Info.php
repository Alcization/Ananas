<?php

class Info {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserInfo($user_id) {
        $query = "SELECT * FROM users 
                JOIN address ON users.user_id = address.user_id WHERE users.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt;
    }

    public function updateUser($user_id, $birth_date, $email_address, $phone_number, $province, $district, $ward, $detail) {
        try {
            // Cập nhật bảng users
            $queryUser = "UPDATE users SET birth_date = :birth_date, email_address = :email_address, phone_number = :phone_number WHERE user_id = :user_id";
            $stmtUser = $this->db->prepare($queryUser);
            $stmtUser->execute([
                ':user_id' => $user_id,
                ':birth_date' => $birth_date,
                ':email_address' => $email_address,
                ':phone_number' => $phone_number,
            ]);
    
            // Cập nhật bảng address
            $queryAddress = "UPDATE address SET province = :province, district = :district, ward = :ward, detail = :detail WHERE user_id = :user_id";
            $stmtAddress = $this->db->prepare($queryAddress);
            $stmtAddress->execute([
                ':user_id' => $user_id,
                ':province' => $province,
                ':district' => $district,
                ':ward' => $ward,
                ':detail' => $detail,
            ]);
    
            return ['success' => true, 'message' => 'Cập nhật thông tin thành công.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }
    
    
    
}
        
?>