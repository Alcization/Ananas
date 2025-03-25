<?php

class OrderHistory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserOrder($user_id) {
        $query = "SELECT od.*, os.*
                FROM orders od
                JOIN order_status os ON od.order_id = os.order_id
                WHERE user_id = :user_id
                AND os.created_at = (
                    SELECT MAX(created_at)
                    FROM order_status
                    WHERE order_id = os.order_id
                )
                ORDER BY od.order_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt;
    }

    public function getUserOrderItem($user_id) {
        $query = "SELECT 
                    oi.order_item_id,
                    oi.order_id, 
                    oi.product_item_id,
                    oi.quantity, 
                    oi.price, 
                    pd.name,
                    pi.product_image,
                    cl.color_name,
                    sz.size_value,
                    cg.category_name
                FROM 
                    order_items oi 
                JOIN 
                    product_items pi ON oi.product_item_id = pi.product_item_id
                JOIN 
                    products pd ON pi.product_id = pd.product_id 
                JOIN 
                    orders od ON oi.order_id = od.order_id
                JOIN
                    product_category pc ON pd.product_id = pc.product_id
                JOIN
                    categories cg ON pc.category_id = cg.category_id
                JOIN
                    colors cl ON pi.color_id = cl.color_id
                JOIN
                    sizes sz ON pi.size_id = sz.size_id
                WHERE od.user_id = :user_id AND cg.category_name != 'Saleoff'
                ORDER BY od.order_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt;
    }

    public function cancelUserOrder($order_id) {
        $query = "INSERT INTO order_status(order_id, status) VALUES (:order_id, :status)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':order_id' => $order_id, ':status' => 'Đã hủy']);
        return $stmt;
    }

}
?>