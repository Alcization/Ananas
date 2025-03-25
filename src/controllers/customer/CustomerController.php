<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/admin/Customer.php';

class CustomerController {
    private $db;
    private $customerModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->customerModel = new Customer($this->db);
    }

    public function customers() {
        $data = $this->customerModel->getAllCustomer()->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/admin/customers.php';
    }    
}