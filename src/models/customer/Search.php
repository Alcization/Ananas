<?php
class Search {
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function searchProduct($search){
        $query = "SELECT * FROM products JOIN product_items ON products.product_id = product_items.product_id
        WHERE `name` LIKE :search GROUP BY `name`";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['search' => "%$search%"]);
        return $stmt;
    }

    public function searchBlogs($search){
        $query = "SELECT * FROM blogs WHERE blog_name LIKE :search";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['search' => "%$search%"]);
        return $stmt;
    }
}