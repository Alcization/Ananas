<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/customer/Payment.php';

class PaymentController {
    private $db;
    private $paymentModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->paymentModel = new Payment($this->db);
    }

    public function getall() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        $card = $this->paymentModel->getUserCard($user_id)->fetchAll(PDO::FETCH_ASSOC);
        $bank = $this->paymentModel->getUserBank($user_id)->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'card' => $card,
            'bank' => $bank
        ];

        include_once __DIR__ . '../../../views/customer/account_payment.php';
    }

    public function updatedefaultcard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        $card_id = $_GET['card_id'] ?? null;

        $this->paymentModel->updateDefaultCard($user_id, $card_id);
        header('Location: /accountpayment');
    }

    public function updatedefaultbank() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        $bank_id = $_GET['bank_id'] ?? null;

        $this->paymentModel->updateDefaultBank($user_id, $bank_id);
        header('Location: /accountpayment');
    }

    public function deleteCard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        $card_id = $_GET['card_id'] ?? null;

        $this->paymentModel->deleteUserCard($user_id, $card_id);
        header('Location: /accountpayment');
    }

    public function deleteBank() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        $bank_id = $_GET['bank_id'] ?? null;

        $this->paymentModel->deleteUserBank($user_id, $bank_id);
        header('Location: /accountpayment');
    } 
    
}
?>