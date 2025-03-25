<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/admin/Visit.php';
class VisitController {
    private $db;
    private $visitModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->visitModel = new Visit($this->db);
    }

    public function recordVisit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['has_visited'])) {
            $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            $this->visitModel->recordVisit($ip_address, $user_agent);
    
            // Đánh dấu đã ghi nhận trong session
            $_SESSION['has_visited'] = true;
        }
    }    
}
?>