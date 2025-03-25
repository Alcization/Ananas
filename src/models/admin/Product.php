<?php

class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProduct() {
        $query = "  SELECT  products.name,
                            products.description,
                            product_items.price,
                            product_items.product_item_id,
                            colors.color_name,
                            sizes.size_value
                    FROM ((products
                    JOIN product_items ON products.product_id = product_items.product_id)
                    JOIN colors ON product_items.color_id = colors.color_id)
                    JOIN sizes ON product_items.size_id = sizes.size_id
                    ORDER BY product_items.product_item_id ASC
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function addProduct($product_name, $product_image, $product_description, $product_price, $smallest_size, $biggest_size, $color_white, $color_black, $color_beige, $color_brown, $color_blue) {
        try {
            // Thêm sản phẩm mới vào bảng products nếu tên sản phẩm chưa tồn tại
            $checkProductQuery = "SELECT product_id FROM products WHERE `name` = '$product_name'";
            $checkProductStmt = $this->db->prepare($checkProductQuery);
            $checkProductStmt->execute();
            if ($checkProductStmt->rowCount() == 0) {
                $insertProductQuery = "INSERT INTO products (name, description) VALUES (:product_name, :product_description)";
                $insertProductStmt = $this->db->prepare($insertProductQuery);
                $insertProductStmt->execute(['product_name' => $product_name, 'product_description' => $product_description]);
                $product_id = $this->db->lastInsertId();
            }
            else {
                $product_id = $checkProductStmt->fetch(PDO::FETCH_ASSOC)['product_id'];
            }

            // Thêm tên các màu sắc mới vào bảng colors nếu tên đó chưa tồn tại
            $checkColorQuery = "SELECT color_id FROM colors WHERE color_name = '$color_white'";
            $checkColorStmt = $this->db->prepare($checkColorQuery);
            $checkColorStmt->execute();
            if ($checkColorStmt->rowCount() == 0) {
                $insertColorQuery = "INSERT INTO colors (color_name, color_code) VALUES (:color_name, '#efece1')";
                $insertColorStmt = $this->db->prepare($insertColorQuery);
                $insertColorStmt->execute(['color_name' => $color_white]);
                $white_color_id = $this->db->lastInsertId();
            }
            else {
                $white_color_id = $checkColorStmt->fetch(PDO::FETCH_ASSOC)['color_id'];
            }

            if ($color_black) {
                $checkColorQuery = "SELECT color_id FROM colors WHERE color_name = '$color_black'";
                $checkColorStmt = $this->db->prepare($checkColorQuery);
                $checkColorStmt->execute();
                if ($checkColorStmt->rowCount() == 0) {
                    $insertColorQuery = "INSERT INTO colors (color_name, color_code) VALUES (:color_name, '#14130f')";
                    $insertColorStmt = $this->db->prepare($insertColorQuery);
                    $insertColorStmt->execute(['color_name' => $color_black]);
                    $black_color_id = $this->db->lastInsertId();
                }
                else {
                    $black_color_id = $checkColorStmt->fetch(PDO::FETCH_ASSOC)['color_id'];
                }
            }

            if ($color_beige) {
                $checkColorQuery = "SELECT color_id FROM colors WHERE color_name = '$color_beige'";
                $checkColorStmt = $this->db->prepare($checkColorQuery);
                $checkColorStmt->execute();
                if ($checkColorStmt->rowCount() == 0) {
                    $insertColorQuery = "INSERT INTO colors (color_name, color_code) VALUES (:color_name, '#f5f5dc')";
                    $insertColorStmt = $this->db->prepare($insertColorQuery);
                    $insertColorStmt->execute(['color_name' => $color_beige]);
                    $beige_color_id = $this->db->lastInsertId();
                }
                else {
                    $beige_color_id = $checkColorStmt->fetch(PDO::FETCH_ASSOC)['color_id'];
                }
            }

            if ($color_brown) {
                $checkColorQuery = "SELECT color_id FROM colors WHERE color_name = '$color_brown'";
                $checkColorStmt = $this->db->prepare($checkColorQuery);
                $checkColorStmt->execute();
                if ($checkColorStmt->rowCount() == 0) {
                    $insertColorQuery = "INSERT INTO colors (color_name, color_code) VALUES (:color_name, '#d6ba73')";
                    $insertColorStmt = $this->db->prepare($insertColorQuery);
                    $insertColorStmt->execute(['color_name' => $color_brown]);
                    $brown_color_id = $this->db->lastInsertId();
                }
                else {
                    $brown_color_id = $checkColorStmt->fetch(PDO::FETCH_ASSOC)['color_id'];
                }
            }

            if ($color_blue) {
                $checkColorQuery = "SELECT color_id FROM colors WHERE color_name = '$color_blue'";
                $checkColorStmt = $this->db->prepare($checkColorQuery);
                $checkColorStmt->execute();
                if ($checkColorStmt->rowCount() == 0) {
                    $insertColorQuery = "INSERT INTO colors (color_name, color_code) VALUES (:color_name, '#00ffff')";
                    $insertColorStmt = $this->db->prepare($insertColorQuery);
                    $insertColorStmt->execute(['color_name' => $color_blue]);
                    $blue_color_id = $this->db->lastInsertId();
                }
                else {
                    $blue_color_id = $checkColorStmt->fetch(PDO::FETCH_ASSOC)['color_id'];
                }
            }

            // Chạy vòng lặp thêm các sản phẩm vào bảng product_items với id các màu sắc nếu có nhập giá trị màu
            // và kích thước từ smallest_size đến biggest_size, các size hiện là giá trị số nên cần lấy id từ bảng colors. 
            // Kiểm tra xem sản phẩm đã tồn tại trong bảng product_items chưa trước khi thêm
            for ($size = $smallest_size; $size <= $biggest_size; $size++) {
                // Lấy size_id từ bảng sizes với zi_value = $size
                $checkSizeQuery = "SELECT size_id FROM sizes WHERE size_value = '$size'";
                $checkSizeStmt = $this->db->prepare($checkSizeQuery);
                $checkSizeStmt->execute();
                $size_id = $checkSizeStmt->fetch(PDO::FETCH_ASSOC)['size_id'];
                
                if ($color_white) {
                    $checkProductItemQuery = "SELECT product_item_id FROM product_items WHERE product_id = '$product_id' AND color_id = $white_color_id AND size_id = $size_id";
                    $checkProductItemStmt = $this->db->prepare($checkProductItemQuery);
                    $checkProductItemStmt->execute();
                    if ($checkProductItemStmt->rowCount() == 0) {
                        $insertProductItemQuery = "INSERT INTO product_items (product_id, color_id, size_id, price, product_image) VALUES (:product_id, :color_id, :size_id, :product_price, :product_image)";
                        $insertProductItemStmt = $this->db->prepare($insertProductItemQuery);
                        $insertProductItemStmt->execute(['product_id' => $product_id, 'color_id' => $white_color_id, 'size_id' => $size_id, 'product_price' => $product_price, 'product_image' => $product_image]);
                    }
                }

                if ($color_black) {
                    $checkProductItemQuery = "SELECT product_item_id FROM product_items WHERE product_id = '$product_id' AND color_id = $black_color_id AND size_id = $size_id";
                    $checkProductItemStmt = $this->db->prepare($checkProductItemQuery);
                    $checkProductItemStmt->execute();
                    if ($checkProductItemStmt->rowCount() == 0) {
                        $insertProductItemQuery = "INSERT INTO product_items (product_id, color_id, size_id, price, product_image) VALUES (:product_id, :color_id, :size_id, :product_price, :product_image)";
                        $insertProductItemStmt = $this->db->prepare($insertProductItemQuery);
                        $insertProductItemStmt->execute(['product_id' => $product_id, 'color_id' => $black_color_id, 'size_id' => $size_id, 'product_price' => $product_price, 'product_image' => $product_image]);
                    }
                }

                if ($color_beige) {
                    $checkProductItemQuery = "SELECT product_item_id FROM product_items WHERE product_id = '$product_id' AND color_id = $beige_color_id AND size_id = $size_id";
                    $checkProductItemStmt = $this->db->prepare($checkProductItemQuery);
                    $checkProductItemStmt->execute();
                    if ($checkProductItemStmt->rowCount() == 0) {
                        $insertProductItemQuery = "INSERT INTO product_items (product_id, color_id, size_id, price, product_image) VALUES (:product_id, :color_id, :size_id, :product_price, :product_image)";
                        $insertProductItemStmt = $this->db->prepare($insertProductItemQuery);
                        $insertProductItemStmt->execute(['product_id' => $product_id, 'color_id' => $beige_color_id, 'size_id' => $size_id, 'product_price' => $product_price, 'product_image' => $product_image]);
                    }
                }
                
                if ($color_brown) {
                    $checkProductItemQuery = "SELECT product_item_id FROM product_items WHERE product_id = '$product_id' AND color_id = $brown_color_id AND size_id = $size_id";
                    $checkProductItemStmt = $this->db->prepare($checkProductItemQuery);
                    $checkProductItemStmt->execute();
                    if ($checkProductItemStmt->rowCount() == 0) {
                        $insertProductItemQuery = "INSERT INTO product_items (product_id, color_id, size_id, price, product_image) VALUES (:product_id, :color_id, :size_id, :product_price, :product_image)";
                        $insertProductItemStmt = $this->db->prepare($insertProductItemQuery);
                        $insertProductItemStmt->execute(['product_id' => $product_id, 'color_id' => $brown_color_id, 'size_id' => $size_id, 'product_price' => $product_price, 'product_image' => $product_image]);
                    }
                }

                if ($color_blue) {
                    $checkProductItemQuery = "SELECT product_item_id FROM product_items WHERE product_id = '$product_id' AND color_id = $blue_color_id AND size_id = $size_id";
                    $checkProductItemStmt = $this->db->prepare($checkProductItemQuery);
                    $checkProductItemStmt->execute();
                    if ($checkProductItemStmt->rowCount() == 0) {
                        $insertProductItemQuery = "INSERT INTO product_items (product_id, color_id, size_id, price, product_image) VALUES (:product_id, :color_id, :size_id, :product_price, :product_image)";
                        $insertProductItemStmt = $this->db->prepare($insertProductItemQuery);
                        $insertProductItemStmt->execute(['product_id' => $product_id, 'color_id' => $blue_color_id, 'size_id' => $size_id, 'product_price' => $product_price, 'product_image' => $product_image]);
                    }
                }
            }
            return ['success' => true, 'message' => 'Successfully add new product!'];
        } // Add this closing brace
        catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }

    public function getProductById($product_item_id) {
        $query = "  SELECT  products.name,
                            products.description,
                            product_items.price,
                            product_items.product_item_id,
                            product_items.product_image,
                            colors.color_name,
                            sizes.size_value
                    FROM ((products
                    JOIN product_items ON products.product_id = product_items.product_id)
                    JOIN colors ON product_items.color_id = colors.color_id)
                    JOIN sizes ON product_items.size_id = sizes.size_id
                    WHERE product_items.product_item_id = :product_item_id
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['product_item_id' => $product_item_id]);
        return $stmt;
    }

    public function updateProduct($product_item_id, $product_image, $product_description, $product_price, $size, $color) {
        try {
            // Lấy size_id từ bảng sizes với size_value = $size
            $query = "SELECT size_id FROM sizes WHERE size_value = :size";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['size' => $size]);
            $size_id = $stmt->fetch(PDO::FETCH_ASSOC)['size_id'];

            // Lấy color_id từ bảng colors với product_item_id
            $query = "  SELECT  colors.color_id
                        FROM product_items
                        JOIN colors ON product_items.color_id = colors.color_id
                        WHERE product_items.product_item_id = :product_item_id
                    ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['product_item_id' => $product_item_id]);
            $color_id = $stmt->fetch(PDO::FETCH_ASSOC)['color_id'];

            // Update color_name trong bảng colors với giá trị mới là color
            $query = "UPDATE colors SET color_name = :color WHERE color_id = :color_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['color' => $color, 'color_id' => $color_id]);

            // Lấy product_id từ bảng product_items với product_item_id
            $query = "SELECT product_id FROM product_items WHERE product_item_id = :product_item_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['product_item_id' => $product_item_id]);
            $product_id = $stmt->fetch(PDO::FETCH_ASSOC)['product_id'];

            // Kiểm tra xem sản phẩm đã tồn tại trong bảng product_items chưa trước khi thêm
            $query = "  SELECT  product_item_id
                        FROM product_items
                        WHERE product_id = :product_id AND color_id = :color_id AND size_id = :size_id
                    ";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['product_id' => $product_id, 'color_id' => $color_id, 'size_id' => $size_id]);
            if ($stmt->rowCount() == 0) {
                $query = "UPDATE product_items SET product_image = :product_image, price = :product_price, size_id = :size_id WHERE product_item_id = :product_item_id";
                $stmt = $this->db->prepare($query);
                $stmt->execute(['product_image' => $product_image, 'product_price' => $product_price, 'size_id' => $size_id, 'product_item_id' => $product_item_id]);
            } else {
                $query = "UPDATE product_items SET product_image = :product_image, price = :product_price WHERE product_item_id = :product_item_id";
                $stmt = $this->db->prepare($query);
                $stmt->execute(['product_image' => $product_image, 'product_price' => $product_price, 'product_item_id' => $product_item_id]);
            }

            // Update product_description trong bảng products với product_id
            $query = "UPDATE products SET description = :product_description WHERE product_id = :product_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['product_description' => $product_description, 'product_id' => $product_id]);
            
            return ['success' => true, 'message' => 'Successfully update product!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }

    public function deleteProduct($product_item_id) {
        try {
            $query = "DELETE FROM product_items WHERE product_item_id = :product_item_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['product_item_id' => $product_item_id]);
            return ['success' => true, 'message' => 'Successfully delete product!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }
}
