<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Search.php';

class SearchController {
    private $db;
    private $searchModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->searchModel = new Search($this->db);
    }

    public function showsearch() {
        error_reporting(0);
        include_once __DIR__ . '/../../views/customer/search.php';
    }

    public function search() {
        $search = $_POST['search'] ?? '';
        if (empty($search)) {
            header('Location: /search?search=empty');
        }
        $search = trim($search);

        $products = $this->searchModel->searchProduct($search)->fetchAll(PDO::FETCH_ASSOC);
        $blogs = $this->searchModel->searchBlogs($search)->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/customer/search.php';
    }
}