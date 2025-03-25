<?php 

class Payment {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getPayment($user_id) {
        try {
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
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getSumPrice($user_id) {
        try {
            $query = "  SELECT SUM(order_items.price) AS sum_price
                        FROM
                            (order_items
                            JOIN orders ON order_items.order_id = orders.order_id)
                            JOIN order_status ON orders.order_id = order_status.order_id
                        WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC)['sum_price'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOrderPrice($user_id) {
        try {
            $query = "  SELECT orders.total_price
                        FROM orders
                        JOIN order_status ON orders.order_id = order_status.order_id
                        WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC)['total_price'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function executePayment($user_id, $province, $district, $ward, $detail) {
        try {
            // Get the order_id of the user
            $query = "  SELECT orders.order_id
                        FROM orders
                        JOIN order_status ON orders.order_id = order_status.order_id
                        WHERE orders.user_id = :user_id AND order_status.status = 'Chờ xác nhận'";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            $order_id = $stmt->fetch(PDO::FETCH_ASSOC)['order_id'];

            // Insert the address of shipping if not exists
            $query = "  SELECT address_id
                        FROM `address`
                        WHERE province = :province AND district = :district AND ward = :ward AND detail = :detail";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'province' => $province,
                'district' => $district,
                'ward' => $ward,
                'detail' => $detail
            ]);
            $address_id = $stmt->fetch(PDO::FETCH_ASSOC)['address_id'];
            if (!$address_id) {
                $query = "  INSERT INTO `address` (province, district, ward, detail)
                            VALUES (:province, :district, :ward, :detail)";
                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    'province' => $province,
                    'district' => $district,
                    'ward' => $ward,
                    'detail' => $detail
                ]);
                $address_id = $this->db->lastInsertId();
            }
            // Update the shipping_address_id in orders
            $query = "  UPDATE orders
                        SET shipping_address_id = :address_id
                        WHERE order_id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['address_id' => $address_id, 'order_id' => $order_id]);
            // Update the status in order_status
            $query = "  UPDATE order_status
                        SET status = 'Đang giao'
                        WHERE order_id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['order_id' => $order_id]);
            // Update the payment_type in orders
            $query = "  UPDATE orders
                        SET payment_type_id  = 2
                        WHERE order_id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['order_id' => $order_id]);
            // Insert payment_status with order_id
            $query = "  INSERT INTO payment_status (order_id, `status`)
                        VALUES (:order_id, 'Đã thanh toán')";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['order_id' => $order_id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}