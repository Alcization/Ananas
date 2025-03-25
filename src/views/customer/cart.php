<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])):
        header('Location: /login');
    endif;
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Giỏ hàng</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/assets/css/output.css" rel="stylesheet">
</head>
<body>
  <script>
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('delete-success')) {
      alert('Xóa hàng hóa khỏi giỏ hàng thành công');
    }
    if (urlParams.has('promotion-apply-success')) {
      alert('Áp dụng mã khuyến mãi thành công');
    }
    if (urlParams.has('delete-fail')) {
      alert('Xóa hàng hóa khỏi giỏ hàng thất bại');
    }
    if (urlParams.has('promotion-apply-fail')) {
      alert('Áp dụng mã khuyến mãi thất bại');
    }
  </script>

  <div class="root">
    <div class="content-wrapper font-BeVietnam text-base">
      <!-- Header -->
      <?php
        error_reporting(0);
        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }
        if (isset($_SESSION['user_id'])):
          if ($_SESSION['role'] == 'customer'):
            include 'header_da_dangnhap.php';
          else:
            header('Location: /dashboard');
          endif;
        else:
          include 'header_chua_dangnhap.php';
        endif;
      ?>
      <!-- End Header -->

      <?php 
        $products = $data['products'];
        $sum_price = $data['sum_price'];
        $total_price = $data['total_price'];
        $discount = $sum_price - $total_price;
      ?>

      <main class="flex flex-col pt-20">
        <!-- Row 1 -->
        <row1 class="flex flex-col lg:flex-row px-4 lg:px-20 flex-wrap sm:px-5">
          <!-- Column 1 -->
          <col1 class="w-full lg:w-1/2 p-2 order-1">
            <ul class="flex flex-col">
              <li class="font-bold text-2xl">GIỎ HÀNG</li>
              <?php foreach ($products as $product): ?>
                <li class="flex flex-row mt-5">
                  <ul class="flex flex-row items-center space-x-4">
                    <!-- Product Image -->
                    <li class="flex w-1/6">
                      <img class="w-full h-auto object-contain max-w-[80px]" src="<?= htmlspecialchars($product['product_image']); ?>" alt="item">
                    </li>
                    <!-- Product Details -->
                    <li class="flex flex-col w-3/6 space-y-2">
                      <ul>
                        <Name_product class="font-bold text-base">
                          <?= htmlspecialchars($product['name']); ?> - <?= htmlspecialchars($product['color_name']); ?>
                        </Name_product>
                        <div class="flex flex-row items-center space-x-6 mt-3">
                          <!-- Size Selection -->
                          <div>
                            <select class="w-24 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                                <option value="<?= htmlspecialchars($product['size_value']); ?>" label="<?= htmlspecialchars($product['size_value']); ?>"></option>
                            </select>
                          </div>
                          <!-- Quantity Controls -->
                          <div class="flex flex-row items-center space-x-2">
                            <button class="px-2 py-1 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-200" onclick="decreaseQuantity()">-</button>
                            <span id="quantity" class="text-gray-800 font-medium"><?= htmlspecialchars($product['quantity']); ?></span>
                            <button class="px-2 py-1 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-200" onclick="increaseQuantity()">+</button>
                          </div>
                        </div>
                      </ul>
                    </li>
                    <!-- Product Price and Delete Button -->
                    <li class="flex flex-col items-center w-2/6 space-y-3">
                      <span class="font-bold text-Cam_Ananas"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</span>
                      <form method="POST" action="/deleteItem/submit" class="w-full">
                        <input type="hidden" name="product_item_id" value="<?= htmlspecialchars($product['product_item_id']); ?>">
                        <button type="submit" class="flex items-center justify-center w-16 h-8 border border-black bg-black rounded-md">
                          <img src="img/gio_hang_bin.png" alt="heart" class="w-4 h-4">
                        </button>
                      </form>
                    </li>
                  </ul>
                </li>
              <?php endforeach; ?>
            </ul>
          </col1>
          <!-- End Column 1 -->

          <!-- Column 2 -->
          <col2 class="w-full lg:w-1/2 mt-10 lg:mt-0 p-2 order-2 lg:order-1">
            <ul class="flex flex-col">
              <li class="font-bold text-2xl">ĐƠN HÀNG</li>
              <li>
                <hr class="border-t border-gray-400 mt-5 w-full max-w-screen-lg mx-auto">
              </li>
              <li class="mt-5">
                <ul class="flex flex-row">
                  <li class="flex w-1/3">Đơn hàng</li>
                  <li class="flex w-1/3"></li>
                  <li class="font-bold flex ml-auto"><?= htmlspecialchars(number_format($sum_price, 0, ',', '.')); ?> VNĐ</li>
                </ul>
              </li>
              <li class="mt-2">
                <ul class="flex flex-row">
                  <li class="flex w-1/3">Giảm</li>
                  <li class="flex w-1/3"></li>
                  <li class="font-bold flex ml-auto"><?= htmlspecialchars(number_format($discount, 0, ',', '.')); ?> VNĐ</li>
                </ul>
              </li>
              <li>
                <hr class="border-t border-gray-400 mt-5 w-full max-w-screen-lg mx-auto">
              </li>
              <li class="mt-5">
                <ul class="flex flex-row">
                  <li class="flex w-1/3">Tạm tính</li>
                  <li class="flex w-1/3"></li>
                  <li class="font-bold flex ml-auto"><?= htmlspecialchars(number_format($total_price, 0, ',', '.')); ?> VNĐ</li>
                </ul>
              </li>
              <li class="font-medium mt-8">Nhập mã khuyến mãi</li>
              <li>
                <ul class="flex flex-row">
                  <form method="POST" action="/promotionApply/submit">
                    <li class="flex mr-0">
                      <input id="input-box" name="promotion_code" type="text" autocomplete="off" class="w-auto px-4 py-2 border border-gray-400 rounded">
                    </li>
                    <li class="flex ml-0 mt-2">
                      <button type="submit" class="ML_button w-28">Áp dụng</button>
                    </li>
                  </form>
                </ul>
              </li>
              <li class="mt-8">
                <button onclick="location.href='/payment_customer'" class="ML_button w-full">Tiếp tục thanh toán</button>
              </li>
            </ul>
          </col2>
          <!-- End Column 2 -->
        </row1>
        <!-- End Row 1 -->

        <!-- Additional Rows -->
        <row2></row2>
        <row3></row3>
      </main>

      <!-- Footer -->
      <?php include 'footer.php'; ?>
    </div>
  </div>
  <script src="/assets/js/header.js"></script>
</body>
</html>
