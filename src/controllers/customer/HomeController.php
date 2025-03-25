<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Home.php';

class HomeController {
    private $db;
    private $homeModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->homeModel = new Home($this->db);
    }

    public function index() {
        $outstanding = $this->homeModel->getOutstanding()->fetchAll(PDO::FETCH_ASSOC);
        $discovery = $this->homeModel->getDiscovery()->fetchAll(PDO::FETCH_ASSOC);
    
        $data = [
            'outstanding' => $outstanding,
            'discovery' => $discovery
        ];
    
        // Gửi dữ liệu đến view
        include_once __DIR__ . '../../../views/customer/index.php';
    }
    public function showIntroduce() {
    
        include_once __DIR__ . '../../../views/customer/introduce.php';
    } 
}
?>