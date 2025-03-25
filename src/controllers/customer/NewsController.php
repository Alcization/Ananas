<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/News.php';

class NewsController {
    private $db;
    private $newsModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->newsModel = new News($this->db);
    }

    public function news() {
        $data = $this->newsModel->getAllNews()->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '../../../views/customer/news.php';
    }

    public function detail($alias = null) {
        if (!$alias) {
            echo "Bài viết không tồn tại.";
            return;
        }
    
        $data = $this->newsModel->getDetail($alias)->fetchAll(PDO::FETCH_ASSOC);
    
        include_once __DIR__ . '../../../views/customer/news_detail1.php';
    }
    
    
}
?>