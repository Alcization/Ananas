USE ananas_db;

CREATE TABLE IF NOT EXISTS users (
  user_id SMALLINT NOT NULL AUTO_INCREMENT,
  user_name varchar(255) NOT NULL,
  email_address varchar(255),
  phone_number varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  gender ENUM('he/him', 'she/her', 'prefer not to say') NOT NULL,
  birth_date date,
  avatar varchar(255),
  role ENUM('customer', 'admin') NOT NULL,
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS address (
  address_id SMALLINT NOT NULL AUTO_INCREMENT,
  detail varchar(255) NOT NULL,
  ward varchar(255) NOT NULL,
  district varchar(255) NOT NULL,
  province varchar(255) NOT NULL,
  user_id SMALLINT,
  PRIMARY KEY (address_id),
  CONSTRAINT fk_address_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS blogs (
  blog_id SMALLINT NOT NULL AUTO_INCREMENT,
  admin_id SMALLINT,
  blog_cate VARCHAR(255),
  blog_name varchar(255) NOT NULL,
  main_image VARCHAR(255) NOT NULL,
  sub_image VARCHAR(255) NOT NULL,
  main_content text NOT NULL,
  summary text NOT NULL,
  description text NOT NULL,
  alias varchar(255) NOT NULL UNIQUE,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('show', 'hide') NOT NULL DEFAULT 'show',
  PRIMARY KEY (blog_id),
  CONSTRAINT fk_blog_admin FOREIGN KEY (admin_id) REFERENCES users(user_id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS user_cards (
  card_id SMALLINT NOT NULL AUTO_INCREMENT,
  user_id SMALLINT NOT NULL,
  card_holder_name VARCHAR(255) NOT NULL,
  card_type ENUM('Credit', 'Debit') NOT NULL,
  card_branch ENUM('Visa', 'MasterCard') NOT NULL,
  last_4_digits CHAR(4) NOT NULL,
  encrypted_card_number VARCHAR(255) NOT NULL,
  expired_date DATE NOT NULL,
  status BOOLEAN DEFAULT FALSE,
  is_default BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (card_id),
  CONSTRAINT fk_usercard_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS user_bank_accounts (
  bank_id SMALLINT NOT NULL AUTO_INCREMENT,
  user_id SMALLINT NOT NULL,
  card_holder_name varchar(255) NOT NULL,
  bank_name varchar(255) NOT NULL,
  bank_code int(10) NOT NULL,
  last_4_digits char(4) NOT NULL,
  encrypted_bank_account_number varchar(255) NOT NULL,
  status BOOLEAN DEFAULT FALSE,
  is_default BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (bank_id),
  CONSTRAINT fk_bankaccount_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS products (
  product_id SMALLINT NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (product_id)
);

CREATE TABLE IF NOT EXISTS colors (
  color_id SMALLINT NOT NULL AUTO_INCREMENT,
  color_name varchar(255) NOT NULL,
  color_code VARCHAR(255) NOT NULL,
  PRIMARY KEY (color_id)
);

CREATE TABLE IF NOT EXISTS sizes (
  size_id SMALLINT NOT NULL AUTO_INCREMENT,
  size_value varchar(255) NOT NULL,
  PRIMARY KEY (size_id)
);

CREATE TABLE IF NOT EXISTS promotions (
  promotion_id SMALLINT NOT NULL AUTO_INCREMENT,
  promotion_name varchar(255) NOT NULL,
  description text NOT NULL,
  discount_percent SMALLINT NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  PRIMARY KEY (promotion_id)
);

CREATE TABLE IF NOT EXISTS product_items (
  product_item_id SMALLINT NOT NULL AUTO_INCREMENT,
  product_id SMALLINT NOT NULL,
  color_id SMALLINT NOT NULL,
  size_id SMALLINT NOT NULL,
  promotion_id SMALLINT,
  SKU varchar(255) NOT NULL,
  quantity_in_stock MEDIUMINT DEFAULT 0,
  product_image varchar(255) NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY (product_item_id),
  CONSTRAINT fk_productitem_product FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
  CONSTRAINT fk_productitem_color FOREIGN KEY (color_id) REFERENCES colors(color_id) ON DELETE RESTRICT,
  CONSTRAINT fk_productitem_size FOREIGN KEY (size_id) REFERENCES sizes(size_id) ON DELETE RESTRICT,
  CONSTRAINT fk_productitem_promotion FOREIGN KEY (promotion_id) REFERENCES promotions(promotion_id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS categories (
  category_id SMALLINT NOT NULL AUTO_INCREMENT,
  category_name varchar(255) NOT NULL,
  parent_category_id SMALLINT,
  PRIMARY KEY (category_id),
  CONSTRAINT fk_category_self FOREIGN KEY (parent_category_id) REFERENCES categories(category_id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS product_category (
  product__id SMALLINT NOT NULL,
  category_id SMALLINT NOT NULL,
  PRIMARY KEY (product_id, category_id),
  CONSTRAINT fk_productcategory_product FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE NO ACTION,
  CONSTRAINT fk_productcategory_category FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS outstanding (
  os_id SMALLINT NOT NULL AUTO_INCREMENT,
  os_name VARCHAR(255) NOT NULL,         
  os_tag_line VARCHAR(255) NOT NULL,              
  os_image VARCHAR(255) NOT NULL,
  PRIMARY KEY (os_id)            
);


CREATE TABLE IF NOT EXISTS warehouse (
  wh_id SMALLINT NOT NULL AUTO_INCREMENT,
  product_item_id SMALLINT NOT NULL,
  add_value MEDIUMINT NOT NULL,
  created_at datetime NOT NULL,
  total_in_stock MEDIUMINT NOT NULL,
  PRIMARY KEY (wh_id),
  CONSTRAINT fk_warehouse_productitem FOREIGN KEY (product_item_id) REFERENCES product_items(product_item_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cart_items (
  user_id SMALLINT NOT NULL,
  product_item_id SMALLINT NOT NULL,
  quantity SMALLINT NOT NULL,
  PRIMARY KEY (user_id, product_item_id),
  CONSTRAINT fk_cartitem_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  CONSTRAINT fk_cartitem_productitem FOREIGN KEY (product_item_id) REFERENCES product_items(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS love_items (
  user_id SMALLINT NOT NULL,
  product_item_id SMALLINT NOT NULL,
  PRIMARY KEY (user_id, product_item_id),
  CONSTRAINT fk_loveitem_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  CONSTRAINT fk_loveitem_productitem FOREIGN KEY (product_item_id) REFERENCES product_items(product_item_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS payment_types (
  pt_id SMALLINT NOT NULL AUTO_INCREMENT,
  payment_type_name varchar(255) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (pt_id)
);

CREATE TABLE IF NOT EXISTS orders (
  order_id SMALLINT NOT NULL AUTO_INCREMENT,
  user_id SMALLINT,
  shipping_address_id SMALLINT DEFAULT NULL,
  payment_type_id SMALLINT,
  order_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (order_id),
  CONSTRAINT fk_order_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
  CONSTRAINT fk_order_paymenttype FOREIGN KEY (payment_type_id) REFERENCES payment_types(pt_id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS order_items (
  order_item_id SMALLINT NOT NULL AUTO_INCREMENT,
  order_id SMALLINT NOT NULL,
  product_item_id SMALLINT NOT NULL,
  quantity SMALLINT NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY (order_item_id),
  CONSTRAINT fk_orderitem_order FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
  CONSTRAINT fk_orderitem_productitem FOREIGN KEY (product_item_id) REFERENCES product_items(product_item_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS order_status (
  order_status_id SMALLINT NOT NULL AUTO_INCREMENT,
  order_id SMALLINT NOT NULL,
  status ENUM('chờ xác nhận', 'đang chuẩn bị', 'đang giao hàng', 'đã giao', 'đã hủy') NOT NULL,
  created_at datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (order_status_id),
  CONSTRAINT fk_orderstatus_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS payment_status (
  payment_status_id SMALLINT NOT NULL AUTO_INCREMENT,
  order_id SMALLINT NOT NULL,
  status ENUM('chưa thanh toán', 'đã thanh toán') NOT NULL,
  created_at datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (payment_status_id),
  CONSTRAINT fk_paymentstatus_order FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS user_reviews (
  user_review_id SMALLINT NOT NULL AUTO_INCREMENT,
  user_id SMALLINT NOT NULL,
  ordered_item_id SMALLINT NOT NULL,
  rating ENUM('1', '2', '3', '4', '5') NOT NULL,
  content text NOT NULL,
  created_at datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_review_id),
  CONSTRAINT fk_userreview_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  CONSTRAINT fk_userreview_orderitem FOREIGN KEY (ordered_item_id) REFERENCES order_items(order_item_id) ON DELETE CASCADE
);

CREATE TABLE visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visit_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    user_agent TEXT
);
