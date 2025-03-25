<?php
class Login {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByPhoneOrEmail($identifier) {
        $query = "SELECT * FROM users WHERE phone_number = :identifier OR email_address = :identifier LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['identifier' => htmlspecialchars($identifier)]);
        return $stmt;
    }
}
?>
