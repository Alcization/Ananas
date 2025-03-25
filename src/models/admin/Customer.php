<?php

class Customer {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCustomer() {
        $query = "  SELECT  users.user_id,
                            users.fullname AS user_name,
                            users.phone_number,
                            users.email_address,
                            users.birth_date,
                            `address`.province,
                            `address`.district,
                            `address`.ward,
                            `address`.detail
                    FROM (users
                    JOIN `address` ON users.user_id = `address`.user_id)
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
