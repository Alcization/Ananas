<?php

class Promotion {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM promotions";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getPromotionByID($promotion_id) {
        $query = "SELECT * FROM promotions WHERE promotion_id= :promotion_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':promotion_id' => $promotion_id]);
        return $stmt;
    }

    public function createPromotion($promotion_code, $description, $discount_percent, $start_date, $end_date, $quantity, $remain_quantity) {
        $query = "INSERT INTO promotions (promotion_code, description, discount_percent, start_date, end_date, quantity, remain_quantity)
                  VALUES (:promotion_code, :description, :discount_percent, :start_date, :end_date, :quantity, :remain_quantity)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':promotion_code' => $promotion_code, 
            ':description' => $description,
            ':discount_percent' => $discount_percent,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':quantity' => $quantity,
            ':remain_quantity' => $remain_quantity
        ]);
        return $stmt;
    }

    public function updatePromotion($promotion_id, $promotion_code, $description, $discount_percent, $start_date, $end_date, $quantity, $remain_quantity) {
        $query = "UPDATE promotions 
                  SET promotion_code = :promotion_code,
                      description = :description,
                      discount_percent = :discount_percent,
                      start_date = :start_date,
                      end_date = :end_date,
                      quantity = :quantity,
                      remain_quantity = :remain_quantity
                  WHERE promotion_id = :promotion_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':promotion_id' => $promotion_id,
            ':promotion_code' => $promotion_code, 
            ':description' => $description,
            ':discount_percent' => $discount_percent,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':quantity' => $quantity,
            ':remain_quantity' => $remain_quantity
        ]);
        return $stmt;
    }

    public function deletePromotion($promotion_id) {
        $query = "DELETE FROM promotions WHERE promotion_id = :promotion_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':promotion_id' => $promotion_id]);
        return $stmt;
    }
}
?>
