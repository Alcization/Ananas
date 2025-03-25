-- Thêm dữ liệu vào bảng colors
INSERT INTO colors (color_name, color_code)
VALUES 
    ('OffWhite/Gum', '#efece1');

-- Thêm dữ liệu vào bảng sizes
INSERT INTO sizes (size_value)
VALUES 
    ('37'),
    ('38'),
    ('39'),
    ('40'),
    ('41'),
    ('42'),
    ('43'),
    ('44');

INSERT INTO products (name, description)
VALUES 
    ('Track 6 OG', 'test'),
    ('Track 6 OG', 'test'),
    ('Track 6 OG', 'test'),
    ('Track 6 OG', 'test'),
    ('Track 6 OG', 'test'),
    ('Basas Bumper Gum NE', 'test');

INSERT INTO product_items (product_id, color_id, size_id, promotion_id, SKU, quantity_in_stock, product_image, price)
VALUES 
    (1, 1, 1, NULL, 'SKU001', 0, '/assets/index/pro_track6_A6T001_1.jpg', 990000),
    (2, 1, 1, NULL, 'SKU002', 0, '/assets/index/pro_track6_A6T001_1.jpg', 990000),
    (3, 1, 1, NULL, 'SKU003', 0, '/assets/index/pro_track6_A6T001_1.jpg', 990000),
    (4, 1, 1, NULL, 'SKU004', 0, '/assets/index/pro_track6_A6T001_1.jpg', 990000),
    (5, 1, 1, NULL, 'SKU005', 0, '/assets/index/pro_track6_A6T001_1.jpg', 990000),
    (6, 1, 1, NULL, 'SKU006', 0, '/assets/account/pro_AV00114_1.jpg', 650000),
    (6, 1, 2, NULL, 'SKU007', 0, '/assets/account/pro_AV00114_1.jpg', 650000),
    (6, 1, 3, NULL, 'SKU007', 0, '/assets/account/pro_AV00114_1.jpg', 650000),
    (6, 1, 4, NULL, 'SKU008', 0, '/assets/account/pro_AV00114_1.jpg', 650000),
    (6, 1, 5, NULL, 'SKU009', 0, '/assets/account/pro_AV00114_1.jpg', 650000),
    (6, 1, 5, NULL, 'SKU0010', 0, '/assets/account/pro_AV00114_1.jpg', 650000);

INSERT INTO categories (category_name, parent_category_id)
VALUES 
    ('discovery', NULL),
    ('Track 6', 1),
    ('High Top', NULL);

INSERT INTO product_category (product_id, category_id)
VALUES 
    (1, 2),    
    (2, 2),    
    (3, 2),   
    (4, 2),
    (5, 2),
    (6, 3),
    (7, 3),
    (8, 3),
    (9, 3),
    (10, 3),
    (11, 3);

INSERT INTO users (user_name, email_address, phone_number, password, gender, birth_date, avatar, role)
VALUES
    ('Admin User', 'admin@example.com', '0123456789', 'hashed_password_4', 'prefer not to say', '1990-01-01', NULL, 'admin');

INSERT INTO payment_types (payment_type_name, description)
VALUES
    ('Credit Card', 'Payment via credit card'),
    ('Cash on Delivery', 'Payment upon receiving the goods'),
    ('Banking', 'Payment through Banking');

INSERT INTO outstanding (os_name, os_tag_line, os_image)
VALUES 
    ('URBAS SC - CORN SILK', 'Your daily drive', '/assets/index/urbas_sc.jpg'),
    ('ANANAS x DORAEMON', 'Chong chóng tre nè Nobita!', '/assets/index/ananas_dora.jpg'),
    ('TRACK 6 I.S.E.E', "I.S.E.E that I'm icy", '/assets/index/isee.png'),
    ('TRACK 6 I.S.E.E', "I.S.E.E that I'm icy", '/assets/index/isee.png');

INSERT INTO blogs (admin_id, blog_cate, blog_name, main_image, sub_image, main_content, summary, description, alias, status)
VALUES 
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-1', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-2', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-3', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-4', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-5', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-6', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-7', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-8', 'show'),
     (1, 'Thông cáo báo chí', 'Tiêu đề mẫu', 
     '/assets/news/urbas_love_23.jpg', '/assets/news/urbas_love_23.jpg', 
     'test main content', 
     'test sumary', 
     'test description', 
     'test-alias-9', 'show'),
     (1, 'Thông cáo báo chí', 'VINTAS SAIGON 1980s: CẢM HỨNG SÀI GÒN XƯA GIỮA THỜI HIỆN ĐẠI', 
     '/assets/news/Blog-1980s_1.jpg', '/assets/news/Blog-1980s_1.jpg',
     'test main content', 
     'Saigon 1980s Pack đem đến một sự lựa chọn “cũ kỹ thú vị”, phù hợp cho những người trẻ sống giữa thời hiện đại nhưng lại yêu cái nét bình dị của Sài Gòn ngày xưa.', 
     'Saigon 1980s Pack đem đến một sự lựa chọn “cũ kỹ thú vị”, phù hợp cho những người trẻ sống giữa thời hiện đại nhưng lại yêu cái nét bình dị của Sài Gòn ngày xưa.', 
     'vintas-saigon-1980s-cam-hung-sai-gon-giua-thoi-hien-dai', 'show'),
     (1, 'Thông cáo báo chí', 'HIỂU THẬT SÂU MỌI THỨ BÊN TRONG MỖI NGƯỜI VỚI URBAS LOVE+ 24',
     '/assets/news/IMG_7284.png', '/assets/news/urbas_love_24.jpg',
     '<p>
            Lấy cảm hứng từ cụm từ "Inside Out", Ananas tạo ra 2 phiên bản thiết kế cổ thấp (có dây và quai dán)
            cho bộ sưu tập Urbas Love+ 24. Trải qua một năm tương đối khó khăn, chúng tôi vẫn cố gắng "giữ" nhịp độ ra mắt
            đều đặn mỗi năm cho bộ sưu tập Love+ kể từ năm 2020. Và sẽ thật tuyệt vời nếu bạn có thể theo dõi đầy đủ những
            điều chúng tôi muốn gửi gắm đến cộng đồng LGBT+ trong ngần ấy thời gian.
        </p>

        <p>
            Với phiên bản 24, Ananas muốn truyền tải thông điệp hiểu thật sâu mọi thứ từ bên trong của mỗi con người bằng
            những mảng miếng ngẫu nhiên đầy màu sắc, khi "mọi sự" /đã đủ chín/, những cá tính này sẽ mang theo những năng
            lượng tích cực - nhiều chiều để lan toả ra bên ngoài và đến những người xung quanh.
        </p>

        <p>
            2 sản phẩm có cùng mức giá là 650.000 (đã bao gồm VAT), được quyết định phát hành với phương thức Pre-order từ hôm nay cho đến hết ngày 31/08/2024, và sẽ chính thức xuất xưởng và giao đi kể từ ngày 01/11/2024.
        </p>

        <p>
            Size run: 35 - 46 (có size lẻ)<br/>
            Chất liệu Upper: Vải Canvas/Da lộn (Suede)<br>
            Số lượng giới hạn: 500 đôi/mẫu<br>
            Không áp dụng chính sách đổi hàng do là phiên bản giới hạn, bạn có thể thử size tại các cửa hàng vật lí thật kĩ lưỡng trước khi quyết định.
        </p>

        <p>Hãy cùng khám phá hình ảnh chi tiết và đặt hàng tại link:https://ananas.vn/product-list?gender=&category=&attribute=loveplus</p>', 
     'Lấy cảm hứng từ cụm từ "Inside Out", Ananas tạo ra 2 phiên bản thiết kế cổ thấp (có dây và quai dán) cho bộ sưu tập Urbas Love+ 24.', 
     'Lấy cảm hứng từ cụm từ "Inside Out", Ananas tạo ra 2 phiên bản thiết kế cổ thấp (có dây và quai dán) cho bộ sưu tập Urbas Love+ 24.', 
     'hieu-that-sau-moi-thu-ben-trong-moi-nguoi-voi-urbas-love-24', 'show');

INSERT INTO orders (user_id, payment_type_id)
VALUES
    (2, 1),
    (2, 2),
    (2, 3);

INSERT INTO order_items (order_id, product_item_id, quantity, price)
VALUES
    (1, 6, 1, 650000),
    (2, 7, 1, 650000),
    (2, 8, 1, 650000),
    (3, 9, 1, 650000),
    (3, 10, 1, 650000),
    (3, 11, 1, 650000);
