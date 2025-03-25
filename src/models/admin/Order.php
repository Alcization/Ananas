<?php

class Order {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllOrder() {
        $query = "  SELECT  orders.order_id, 
                            orders.order_at, 
                            orders.total_price, 
                            users.user_name,
                            order_status.status as order_status,
                            payment_status.status as payment_status
                    FROM ((orders
                    JOIN users ON orders.user_id = users.user_id)
                    JOIN payment_status ON orders.order_id = payment_status.order_id)
                    JOIN order_status ON orders.order_id = order_status.order_id
                    ORDER BY orders.order_at DESC
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getDetail($order_id) {
        $query = "  SELECT  orders.order_id, 
                            orders.order_at, 
                            orders.total_price, 
                            users.user_name,
                            users.phone_number,
                            users.email_address,
                            `address`.province,
                            `address`.district,
                            `address`.ward,
                            `address`.detail,
                            order_status.status as order_status,
                            payment_status.status as payment_status,
                            payment_types.payment_type_name as payment_type
                    FROM (((((((orders
                    JOIN users ON orders.user_id = users.user_id)
                    JOIN payment_status ON orders.order_id = payment_status.order_id)
                    JOIN order_status ON orders.order_id = order_status.order_id)
                    JOIN `address` ON orders.shipping_address_id = `address`.address_id)
                    JOIN order_items ON orders.order_id = order_items.order_id)
                    JOIN product_items ON order_items.product_item_id = product_items.product_item_id)
                    JOIN products ON product_items.product_id = products.product_id)
                    JOIN payment_types ON orders.payment_type_id = payment_types.pt_id
                    WHERE orders.order_id = :order_id
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt;
    }

    public function getProductOrder($order_id) {
        $query = "  SELECT  products.name,
                            product_items.price AS product_price,
                            product_items.product_image,
                            order_items.quantity,
                            order_items.price
                    FROM (((orders
                    JOIN order_items ON orders.order_id = order_items.order_id)
                    JOIN product_items ON order_items.product_item_id = product_items.product_item_id)
                    JOIN products ON product_items.product_id = products.product_id)
                    WHERE orders.order_id = :order_id
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt;
    }
}