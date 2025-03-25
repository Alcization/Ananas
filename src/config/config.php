<?php
require_once __DIR__ . '/../../vendor/autoload.php';

try {
    // Load environment variables
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
} catch (Exception $e) {
    die("Could not load .env file: " . $e->getMessage());
}

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? null;
        $this->db_name = $_ENV['DB_NAME'] ?? null;
        $this->username = $_ENV['DB_USER'] ?? null;
        $this->password = $_ENV['DB_PASSWORD'] ?? null;

        // Validate essential environment variables
        if (!$this->host || !$this->db_name || !$this->username) {
            die("Database configuration is incomplete. Check your .env file.");
        }
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Database connection error: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
