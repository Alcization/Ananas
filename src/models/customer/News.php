<?php

class News {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllNews() {
        $query = "SELECT * FROM blogs WHERE status = 'show' ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getDetail($alias) {
        $query = "SELECT * FROM blogs WHERE alias = :alias";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['alias' => $alias]);
        return $stmt;
    }
    
}
?>