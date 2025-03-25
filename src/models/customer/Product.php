<?php

class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProduct() {
        $query = "  SELECT 
                        product_items.product_item_id, 
                        products.name, 
                        colors.color_name, 
                        colors.color_code,
                        product_items.price, 
                        product_items.product_image 
                    FROM 
                        (products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN colors ON product_items.color_id = colors.color_id
                    GROUP BY colors.color_code, products.product_id
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function getAllLoveProduct($user_id) {
        $query = "  SELECT 
                        product_items.product_item_id, 
                        products.name, 
                        colors.color_name, 
                        product_items.price, 
                        product_items.product_image 
                    FROM 
                        ((products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN colors ON product_items.color_id = colors.color_id)
                        JOIN love_items ON love_items.product_item_id = product_items.product_item_id
                    WHERE love_items.user_id = :user_id
                    GROUP BY colors.color_code, products.product_id
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt;
    }

    public function addLoveItem($user_id, $product_item_id) {
        try {
            $query = "  INSERT INTO love_items (user_id, product_item_id)
                        VALUES (:user_id, :product_item_id)
                        ON DUPLICATE KEY UPDATE product_item_id = :product_item_id
                        ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id, 'product_item_id' => $product_item_id]);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteLoveItem($user_id, $product_item_id) {
        try {
            $query = "  DELETE FROM love_items
                        WHERE user_id = :user_id AND product_item_id = :product_item_id
                        ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id, 'product_item_id' => $product_item_id]);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllSaleProduct() {
        $query = "  SELECT 
                        product_items.product_item_id, 
                        products.name, 
                        colors.color_name, 
                        product_items.price, 
                        product_items.product_image,
                        categories.category_name
                    FROM 
                        (((products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN colors ON product_items.color_id = colors.color_id)
                        JOIN product_category ON product_category.product_id = products.product_id)
                        JOIN categories ON product_category.category_id = categories.category_id
                    WHERE categories.category_name = 'Saleoff'
                    GROUP BY colors.color_code, products.product_id
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getDetail($product_item_id) {
        $query = "  SELECT 
                        products.name, 
                        colors.color_name,
                        product_items.product_item_id, 
                        product_items.price, 
                        product_items.product_image, 
                        product_items.quantity_in_stock, 
                        products.product_id
                    FROM 
                        (((products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN colors ON product_items.color_id = colors.color_id)
                        JOIN product_category ON product_category.product_id = products.product_id)
                        JOIN categories ON product_category.category_id = categories.category_id
                    WHERE product_items.product_item_id = :product_item_id
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_item_id' => $product_item_id]);
        return $stmt;
    }

    public function getColor($product_item_id) {
        // Get product_id from product_item_id
        $query = "SELECT product_id FROM product_items WHERE product_item_id = :product_item_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_item_id' => $product_item_id]);
        $product_id = $stmt->fetch(PDO::FETCH_ASSOC)['product_id'];
        // Get all color_name and color_id of products with the same product_id
        $query = "  SELECT 
                        colors.color_name, 
                        colors.color_id
                    FROM 
                        (products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN colors ON product_items.color_id = colors.color_id
                    WHERE products.product_id = :product_id
                    GROUP BY colors.color_code
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_id' => $product_id]);
        return $stmt;
    }

    public function getSize($product_item_id) {
        // Get product_id from product_item_id
        $query = "SELECT product_id FROM product_items WHERE product_item_id = :product_item_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_item_id' => $product_item_id]);
        $product_id = $stmt->fetch(PDO::FETCH_ASSOC)['product_id'];
        // Get all size_value and size_id of products with the same product_id
        $query = "  SELECT 
                        sizes.size_value, 
                        sizes.size_id
                    FROM 
                        (products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN sizes ON product_items.size_id = sizes.size_id
                    WHERE products.product_id = :product_id
                    GROUP BY sizes.size_value
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_id' => $product_id]);
        return $stmt;
    }

    public function getDescription($product_item_id) {
        // Get product_id from product_item_id
        $query = "SELECT product_id FROM product_items WHERE product_item_id = :product_item_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_item_id' => $product_item_id]);
        $product_id = $stmt->fetch(PDO::FETCH_ASSOC)['product_id'];
        // Get the description of product from product_id
        $query = "  SELECT `description`
                    FROM products
                    WHERE product_id = :product_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_id' => $product_id]);
        return $stmt;
    }

    public function getReview($product_item_id) {
        // Get user_name, rating, content, creat_at from user_reviews of product_item_id
        $query = "  SELECT 
                        users.user_name, 
                        user_reviews.rating, 
                        user_reviews.content, 
                        user_reviews.created_at
                    FROM 
                        (users 
                        JOIN user_reviews ON users.user_id = user_reviews.user_id)
                    WHERE user_reviews.product_item_id = :product_item_id
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_item_id' => $product_item_id]);
        return $stmt;
    }

    public function writeReviewshow($product_item_id) {
        // Get product_item_id, product_image, name, color_name, price from product_items, colors and products
        $query = "  SELECT 
                        product_items.product_item_id, 
                        product_items.product_image, 
                        products.name, 
                        colors.color_name, 
                        product_items.price
                    FROM 
                        (products 
                        JOIN product_items ON products.product_id = product_items.product_id) 
                        JOIN colors ON product_items.color_id = colors.color_id
                    WHERE product_item_id = :product_item_id
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_item_id' => $product_item_id]);
        return $stmt;
    }

    public function writeReview($user_id, $product_item_id, $rating, $content) {
        try {
            $query = "  INSERT INTO user_reviews (user_id, product_item_id, rating, content)
                        VALUES (:user_id, :product_item_id, :rating, :content)
                        ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id, 'product_item_id' => $product_item_id, 'rating' => $rating, 'content' => $content]);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addToCart($user_id, $product_id, $color_id, $size_id, $quantity) {
        try {
            // Get product_item_id from product_id, color_id, size_id
            $query = "  SELECT product_item_id
                        FROM product_items
                        WHERE product_id = :product_id AND color_id = :color_id AND size_id = :size_id
                        ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['product_id' => $product_id, 'color_id' => $color_id, 'size_id' => $size_id]);
            $product_item_id = $stmt->fetch(PDO::FETCH_ASSOC)['product_item_id'];
            
            // Check if the product_item_id exists
            if (!$product_item_id) {
                return 0;
            }
            // Get price from product_item_id
            $query = "SELECT price FROM product_items WHERE product_item_id = :product_item_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['product_item_id' => $product_item_id]);
            $price = $stmt->fetch(PDO::FETCH_ASSOC)['price'];

            // Get the order_id for the user, if the user has no order, create a new order
            $query = "  SELECT orders.order_id
                        FROM orders
                        JOIN order_status ON orders.order_id = order_status.order_id
                        WHERE user_id = :user_id AND order_status.status = 'Chờ xác nhận'
                        ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            $order_id = $stmt->fetch(PDO::FETCH_ASSOC)['order_id'];
            if (!$order_id) {
                $query = "  INSERT INTO orders (user_id)
                            VALUES (:user_id)
                            ";
                $stmt = $this->db->prepare($query);
                $stmt->execute(['user_id' => $user_id]);
                $order_id = $this->db->lastInsertId();
                // Set the order_status to 'Chờ xác nhận'
                $query = "  INSERT INTO order_status (order_id, `status`)
                            VALUES (:order_id, 'Chờ xác nhận')
                            ";
                $stmt = $this->db->prepare($query);
                $stmt->execute(['order_id' => $order_id]);
            }

            // Check if the product_item_id is already in the order
            $query = "  SELECT order_item_id
                        FROM order_items
                        WHERE order_id = :order_id AND product_item_id = :product_item_id
                        ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['order_id' => $order_id, 'product_item_id' => $product_item_id]);
            $order_item_id = $stmt->fetch(PDO::FETCH_ASSOC)['order_item_id'];
            if ($order_item_id) {
                // Update the quantity of the product_item_id and the price equal $price*quantity in the order
                $query = "  UPDATE order_items
                            SET quantity = quantity + :quantity, price = price + (:price * :quantity)
                            WHERE order_item_id = :order_item_id
                            ";
                $stmt = $this->db->prepare($query);
                $stmt->execute(['quantity' => $quantity, 'price' => $price, 'order_item_id' => $order_item_id]);
            } else {
                // Add the product_item_id to the order
                $query = "  INSERT INTO order_items (order_id, product_item_id, quantity, price)
                            VALUES (:order_id, :product_item_id, :quantity, (:price * :quantity))
                            ";
                $stmt = $this->db->prepare($query);
                $stmt->execute(['order_id' => $order_id, 'product_item_id' => $product_item_id, 'quantity' => $quantity, 'price' => $price]);
            }
            // Update the total_price of the order
            $query = "  UPDATE orders
                        SET total_price = total_price + (:price * :quantity)
                        WHERE order_id = :order_id
                        ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['price' => $price, 'quantity' => $quantity, 'order_id' => $order_id]);
            return $product_item_id;
        }
        catch (Exception $e) {
            return 0;
        }
    }
}