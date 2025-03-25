<?php

class Visit {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function recordVisit($ip_address, $user_agent) {
        $query = "INSERT INTO visits (ip_address, user_agent) VALUES (:ip_address, :user_agent)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':ip_address' => $ip_address,
            ':user_agent' => $user_agent
        ]);
    }

}
?>