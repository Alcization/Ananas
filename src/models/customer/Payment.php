<?php

class Payment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserCard($user_id) {
        $query = "SELECT * FROM user_cards WHERE user_id= :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt;
    }

    public function getUserBank($user_id) {
        $query = "SELECT * FROM user_bank_accounts WHERE user_id= :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt;
    }

    public function updateDefaultCard($user_id, $card_id) {
        try {
            // Bắt đầu giao dịch
            $this->db->beginTransaction();
    
            // Unset default card
            $queryUnsetDefault = "UPDATE user_cards 
                                  SET is_default = false 
                                  WHERE user_id = :user_id AND is_default = true";
            $stmtUnsetDefault = $this->db->prepare($queryUnsetDefault);
            $stmtUnsetDefault->execute(['user_id' => $user_id]);
    
            // Set new default card
            $querySetDefault = "UPDATE user_cards 
                                SET is_default = true 
                                WHERE user_id = :user_id AND card_id = :card_id";
            $stmtSetDefault = $this->db->prepare($querySetDefault);
            $stmtSetDefault->execute(['user_id' => $user_id, 'card_id' => $card_id]);
    
            // Commit transaction
            $this->db->commit();
            return ['success' => true, 'message' => 'Thẻ mặc định đã được cập nhật.'];
        } catch (PDOException $e) {
            // Rollback nếu có lỗi
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }
    

    public function updateDefaultBank($user_id, $bank_id) {
        try {
            // Bắt đầu giao dịch
            $this->db->beginTransaction();
    
            // Unset default bank account
            $queryUnsetDefault = "UPDATE user_bank_accounts 
                                  SET is_default = false 
                                  WHERE user_id = :user_id AND is_default = true";
            $stmtUnsetDefault = $this->db->prepare($queryUnsetDefault);
            $stmtUnsetDefault->execute(['user_id' => $user_id]);
    
            // Set new default bank account
            $querySetDefault = "UPDATE user_bank_accounts 
                                SET is_default = true 
                                WHERE user_id = :user_id AND bank_id = :bank_id";
            $stmtSetDefault = $this->db->prepare($querySetDefault);
            $stmtSetDefault->execute(['user_id' => $user_id, 'bank_id' => $bank_id]);
    
            // Commit transaction
            $this->db->commit();
            return ['success' => true, 'message' => 'Tài khoản ngân hàng mặc định đã được cập nhật.'];
        } catch (PDOException $e) {
            // Rollback nếu có lỗi
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }
    

    public function deleteUserCard($user_id, $card_id) {
        try {
            $query = "DELETE FROM user_cards WHERE user_id = :user_id AND card_id = :card_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id, 'card_id' => $card_id]);
    
            // Kiểm tra nếu có dòng bị xóa
            if ($stmt->rowCount() > 0) {
                return ['success' => true, 'message' => 'Thẻ người dùng đã được xóa thành công.'];
            } else {
                return ['success' => false, 'message' => 'Không tìm thấy thẻ cần xóa hoặc thẻ không thuộc về người dùng.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi khi xóa thẻ: ' . $e->getMessage()];
        }
    }
    
    public function deleteUserBank($user_id, $bank_id) {
        try {
            $query = "DELETE FROM user_bank_accounts WHERE user_id = :user_id AND bank_id = :bank_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id, 'bank_id' => $bank_id]);
    
            // Kiểm tra nếu có dòng bị xóa
            if ($stmt->rowCount() > 0) {
                return ['success' => true, 'message' => 'Tài khoản ngân hàng đã được xóa thành công.'];
            } else {
                return ['success' => false, 'message' => 'Không tìm thấy tài khoản cần xóa hoặc tài khoản không thuộc về người dùng.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi khi xóa tài khoản ngân hàng: ' . $e->getMessage()];
        }
    }    
    
}
?>