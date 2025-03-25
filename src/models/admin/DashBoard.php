<?php

class DashBoard {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getVisitCountByDay() {
        $query = "SELECT COUNT(*) AS visit_count, DAY(CURDATE()) AS day, MONTH(CURDATE()) AS month, YEAR(CURDATE()) AS year FROM visits WHERE DATE(visit_date) = CURDATE()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lượt truy cập trong tuần
    public function getVisitCountByWeek() {
        $query = "SELECT COUNT(*) AS visit_count, WEEK(CURDATE(), 1) AS week, YEAR(CURDATE()) AS year FROM visits WHERE YEARWEEK(visit_date, 1) = YEARWEEK(CURDATE(), 1)";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lượt truy cập trong tháng
    public function getVisitCountByMonth() {
        $query = "SELECT 
                    COUNT(*) AS visit_count, 
                    MONTH(CURDATE()) AS month, 
                    YEAR(CURDATE()) AS year
                FROM visits
                WHERE YEAR(visit_date) = YEAR(CURDATE()) AND MONTH(visit_date) = MONTH(CURDATE())";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getSoldItemsByDate() {
        $query = "SELECT SUM(oi.quantity) AS quantity, DAY(CURDATE()) AS day, MONTH(CURDATE()) AS month, YEAR(CURDATE()) AS year 
                FROM order_items oi
                JOIN orders o ON oi.order_id = o.order_id
                WHERE DATE(order_at) = CURDATE()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getSoldItemsByWeek() {
        $query = "SELECT SUM(oi.quantity) AS quantity, WEEK(CURDATE(), 1) AS week, YEAR(CURDATE()) AS year 
                FROM order_items oi
                JOIN orders o ON oi.order_id = o.order_id
                WHERE YEARWEEK(order_at, 1) = YEARWEEK(CURDATE(), 1)";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getSoldItemsByMonth() {
        $query = "SELECT SUM(oi.quantity) AS quantity, MONTH(CURDATE()) AS month, YEAR(CURDATE()) AS year 
                FROM order_items oi
                JOIN orders o ON oi.order_id = o.order_id
                WHERE YEAR(order_at) = YEAR(CURDATE()) AND MONTH(order_at) = MONTH(CURDATE())";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getIncomeByDate() {
        $query = "SELECT SUM(total_price) AS income, DAY(CURDATE()) AS day, MONTH(CURDATE()) AS month, YEAR(CURDATE()) AS year
                FROM orders o JOIN payment_status ps ON o.order_id = ps.order_id
                WHERE DATE(o.order_at) = CURDATE() AND ps.status = 'Đã thanh toán'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getIncomeByWeek() {
        $query = "SELECT SUM(total_price) AS income, WEEK(CURDATE(), 1) AS week, YEAR(CURDATE()) AS year 
                FROM orders o JOIN payment_status ps ON o.order_id = ps.order_id
                WHERE YEARWEEK(o.order_at, 1) = YEARWEEK(CURDATE(), 1) AND ps.status = 'Đã thanh toán'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getIncomeByMonth() {
        $query = "SELECT SUM(total_price) AS income, MONTH(CURDATE()) AS month, YEAR(CURDATE()) AS year 
                FROM orders o JOIN payment_status ps ON o.order_id = ps.order_id
                WHERE YEAR(o.order_at) = YEAR(CURDATE()) AND MONTH(o.order_at) = MONTH(CURDATE()) AND ps.status = 'Đã thanh toán'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getOderStatusByDate() {
        $query ="SELECT 
                    os.status, 
                    COUNT(o.order_id) AS order_count
                FROM 
                    orders o
                JOIN 
                    order_status os ON o.order_id = os.order_id
                WHERE 
                    DATE(o.order_at) = CURDATE()
                GROUP BY 
                    os.status";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getOderStatusByWeek() {
        $query ="SELECT 
                    os.status, 
                    COUNT(o.order_id) AS order_count
                FROM 
                    orders o
                JOIN 
                    order_status os ON o.order_id = os.order_id
                WHERE 
                    YEARWEEK(o.order_at, 1) = YEARWEEK(CURDATE(), 1)
                GROUP BY 
                    os.status";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getOderStatusByMonth() {
        $query ="SELECT 
                    os.status, 
                    COUNT(o.order_id) AS order_count
                FROM 
                    orders o
                JOIN 
                    order_status os ON o.order_id = os.order_id
                WHERE 
                    YEAR(o.order_at) = YEAR(CURDATE()) AND MONTH(o.order_at) = MONTH(CURDATE())
                GROUP BY 
                    os.status";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function getReviewByDate() {
        $query = "SELECT COUNT(user_review_id) AS count, DAY(CURDATE()) AS day, MONTH(CURDATE()) AS month, YEAR(CURDATE()) AS year 
                FROM user_reviews 
                WHERE DATE(created_at) = CURDATE()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getReviewByWeek() {
        $query = "SELECT COUNT(user_review_id) AS count, WEEK(CURDATE(), 1) AS week, YEAR(CURDATE()) AS year 
                FROM user_reviews
                WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getReviewByMonth() {
        $query = "SELECT  COUNT(user_review_id) AS count, MONTH(CURDATE()) AS month, YEAR(CURDATE()) AS year 
                FROM user_reviews
                WHERE YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE())";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }


}
?>