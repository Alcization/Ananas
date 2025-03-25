<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])):
        header('Location: /login');
    endif;
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/assets/css/output.css" rel="stylesheet">
</head>
<body>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            alert('Thanh toán thành công');
        }
    </script>
    <div class="root">
        <div class="content-wrapper font-BeVietnam text-base">
            <!--header-->
            <?php
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
            <!--end header-->
            <?php 
                $products = $data['payments'];
                $sum_price = $data['sum_price'];
                $total_price = $data['total_price'];
                $discount = $sum_price - $total_price;
            ?>
            <main class="flex flex-col pt-20">
                <row1 class="flex flex-col lg:flex-row px-6 lg:px-20 gap-8 lg:gap-16">
                    <col1 class="lg:w-1/2 px-2 space-y-4">
                        <ul class="flex flex-col space-y-4">
                            <li class="font-bold text-2xl">THANH TOÁN</li>

                            <li class="flex flex-row justify-between text-gray-700">
                                <span class="font-bold">Tạm tính</span>
                                <span><?= htmlspecialchars(number_format($sum_price, 0, ',', '.')); ?> VNĐ</span>
                            </li>
                            <li class="flex flex-row justify-between text-gray-700">
                                <span class="font-bold">Phí vận chuyển</span>
                                <span>30.000 VNĐ</span>
                            </li>
                            <li class="flex flex-row justify-between text-gray-700">
                                <span class="font-bold">Giảm giá</span>
                                <span><?= htmlspecialchars(number_format($discount, 0, ',', '.')); ?> VNĐ</span>
                            </li>
                            <li><hr class="border-t border-gray-400"></li>
                            <li class="flex flex-row justify-between text-gray-900 font-bold text-lg">
                                <span>Thành tiền</span>
                                <span><?= htmlspecialchars(number_format($total_price + 30000, 0, ',', '.')); ?> VNĐ</span>
                            </li>
                            <li class="text-gray-700">Địa chỉ nhận hàng</li>
                            <form method="POST" action="/payment/submit">
                                <li class="flex space-x-4">
                                    <input 
                                        id="input-box" 
                                        name="province"
                                        type="text" 
                                        autocomplete="off"
                                        class="w-1/3 px-4 py-2 border border-gray-400 rounded focus:outline-none focus:ring focus:ring-blue-300"
                                        placeholder="Tỉnh/Thành phố">
                                    <input 
                                        id="input-box" 
                                        name="district"
                                        type="text" 
                                        autocomplete="off"
                                        class="w-1/3 px-4 py-2 border border-gray-400 rounded focus:outline-none focus:ring focus:ring-blue-300"
                                        placeholder="Quận/Huyện">
                                    <input 
                                        id="input-box" 
                                        name="ward"
                                        type="text" 
                                        autocomplete="off"
                                        class="w-1/3 px-4 py-2 border border-gray-400 rounded focus:outline-none focus:ring focus:ring-blue-300"
                                        placeholder="Phường/Xã">
                                </li>
                                <li class="mt-4">
                                    <input 
                                        id="input-box" 
                                        name="detail"
                                        type="text" 
                                        autocomplete="off"
                                        class="w-full px-4 py-2 border border-gray-400 rounded focus:outline-none focus:ring focus:ring-blue-300"
                                        placeholder="Địa chỉ cụ thể">
                                </li>
                                <div class=" flex flex-row mt-24 space-x-2 items-center justify-center">
                                    <button type="submit" class="ML_button w-32">Thanh toán</button>
                                    <button type="button" class="bg-white text-black border border-black w-32 text-center font-medium px-2 py-2 rounded focus:outline-none transition-all duration-300 ease-in-out">
                                        Hủy
                                    </button>
                                </div>
                            </form>
                        </ul>
                    </col1><!--end col1-->
                
                    <col2 class="lg:w-1/2 lg:order-first mt-6 lg:mt-0 px-2 space-y-4">
                        <ul class="flex flex-col space-y-6">
                            <li class="font-bold text-2xl">ĐƠN HÀNG</li>
                            <?php foreach ($products as $product): 
                                if ($product != null):?>
                                    <li class="flex flex-row space-x-4 items-start">
                                        <img class="w-28 h-28 rounded-md" src="<?= htmlspecialchars($product['product_image']); ?>" alt="item">
                                        <ul class="flex flex-col space-y-2">
                                            <li class="font-medium text-gray-700"><?= $product['name'] ?> - <?= htmlspecialchars($product['color_name']); ?></li>
                                            <li class="text-gray-500 text-sm">Kích cỡ: <?= $product['size_value'] ?></li>
                                            <li class="text-gray-500 text-sm">Số lượng: <?= $product['quantity'] ?></li>
                                        </ul>
                                        <span class="ml-auto font-semibold text-gray-900"><?= number_format($product['price']) ?> VNĐ</span>
                                    </li>
                                    <li><hr class="border-t border-gray-400"></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </col2>
                </row1><!--end row1-->
                
                
                <row2></row2><!--end row2-->
                <!--bổ sung đề xuất-->
                <row3>

                </row3><!--end row3-->
            </main><!-- end main -->

            <?php
                include 'footer.php';
            ?>
        </div><!-- end content -->
    </div><!-- end root -->
    <script src="/assets/js/header.js"></script>
</body>
</html>