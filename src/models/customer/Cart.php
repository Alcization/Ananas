<?php

class Cart {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getCart($user_id) {
        $query = "  SELECT 
                        product_items.product_image, 
                        products.name, 
                        colors.color_name AS color_name, 
                        sizes.size_value,
                        order_items.quantity,
                        order_items.price,
                        product_items.product_item_id
                    FROM 
                        (((((products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN colors ON product_items.color_id = colors.color_id)
                        JOIN sizes ON product_items.size_id = sizes.size_id)
                        JOIN order_items ON product_items.product_item_id = order_items.product_item_id)
                        JOIN orders ON order_items.order_id = orders.order_id)
                        JOIN order_status ON orders.order_id = order_status.order_id
                    WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt;
    }

    public function getSumPrice($user_id) {
        $query = "  SELECT SUM(order_items.price) AS sum_price
                    FROM
                        (order_items
                        JOIN orders ON order_items.order_id = orders.order_id)
                        JOIN order_status ON orders.order_id = order_status.order_id
                    WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['sum_price'];
    }

    public function getOrderPrice($user_id) {
        $query = "  SELECT orders.total_price
                    FROM orders
                    JOIN order_status ON orders.order_id = order_status.order_id
                    WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_price'];
    }

    public function deleteItem($user_id, $product_item_id) {
        try {
            // Get the order_id of the user
            $query = "  SELECT orders.order_id
                        FROM orders
                        JOIN order_status ON orders.order_id = order_status.order_id
                        WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            $order_id = $stmt->fetch(PDO::FETCH_ASSOC)['order_id'];
            // Get the price of item in order_items
            $query = "SELECT price FROM order_items WHERE order_id = :order_id AND product_item_id = :product_item_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['order_id' => $order_id, 'product_item_id' => $product_item_id]);
            $price = $stmt->fetch(PDO::FETCH_ASSOC)['price'];
            // Delete the item in order_items
            $query = "DELETE FROM order_items WHERE order_id = :order_id AND product_item_id = :product_item_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['order_id' => $order_id, 'product_item_id' => $product_item_id]);
            // Update the total_price in orders
            $query = "  UPDATE orders
                        SET total_price = total_price - :price
                        WHERE order_id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['price' => $price, 'order_id' => $order_id]);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }  
    }

    public function applyPromotion($user_id, $promotion_code) {
        try {
            // Validate the promotion_code
            $query = "SELECT discount_percent FROM promotions WHERE promotion_code = :promotion_code AND remain_quantity > 0 AND NOW() BETWEEN `start_date` AND end_date";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['promotion_code' => $promotion_code]);
            $discount_percent = $stmt->fetch(PDO::FETCH_ASSOC)['discount_percent'];
            if (!$discount_percent) {
                return;
            }
            // Get the promotion_id
            $query = "SELECT promotion_id FROM promotions WHERE promotion_code = :promotion_code";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['promotion_code' => $promotion_code]);
            $promotion_id = $stmt->fetch(PDO::FETCH_ASSOC)['promotion_id'];
            // Get the order_id of the user
            $query = "  SELECT orders.order_id
                        FROM orders
                        JOIN order_status ON orders.order_id = order_status.order_id
                        WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            $order_id = $stmt->fetch(PDO::FETCH_ASSOC)['order_id'];
            // Get the sum_price of the order
            $query = "  SELECT SUM(order_items.price) AS sum_price
                        FROM (order_items
                        JOIN orders ON order_items.order_id = orders.order_id)
                        JOIN order_status ON orders.order_id = order_status.order_id
                        WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            $sum_price = $stmt->fetch(PDO::FETCH_ASSOC)['sum_price'];
            // Calculate the discount_price, round to 3 decimal places
            $discount_price = round($sum_price * $discount_percent / 100, -3);
            // Update the total_price in orders
            $query = "  UPDATE orders
                        SET total_price = $sum_price - :discount_price
                        WHERE order_id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['discount_price' => $discount_price, 'order_id' => $order_id]); 
            // Insert the promotion_id into orders promotion_id
            $query = "UPDATE orders SET promotion_id = :promotion_id WHERE order_id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['promotion_id' => $promotion_id, 'order_id' => $order_id]);
            // Decrease the remain_quantity of the promotion
            $query = "UPDATE promotions SET remain_quantity = remain_quantity - 1 WHERE promotion_id = :promotion_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['promotion_id' => $promotion_id]);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}