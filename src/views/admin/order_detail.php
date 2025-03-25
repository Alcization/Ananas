<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../../output.css" rel="stylesheet">
</head>
<body>
    <!--
        thêm responsive
    -->
    <div class="root">
        <div class="content-wrapper font-BeVietnam max-w-screen-2xl text-base">
            <main class="flex flex-row">
                <col1 class="bg-Cam_Ananas text-white w-ful sm:w-1/4 md:w-1/5 flex flex-col pb-10">
                    <div class="px-8 py-4">
                        <ul class="flex flex-row items-center space-x-2">
                            <li><img src="/img/ananas_logo.png" alt="logo" class="h-16 w-auto"></li>
                        </ul>
                    </div>
                    <div class="flex flex-col space-y-11 pt-10 pl-8">
                        <a class="flex flex-row space-x-3" href="/dashboard">
                            <img src="/img/donhang_dashboard.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Dashboard</p>
                        </a>
                        <a href="/order" class="flex flex-row space-x-3 bg-green-600 rounded-md p-2">
                            <img src="/img/donhang_dh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Đơn hàng</p>
                        </a>
                        <a href="/products" class="flex flex-row space-x-3">
                            <img src="/img/donhang_sp.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Sản phẩm</p>
                        </a>
                        <a href="/customers" class="flex flex-row space-x-3 ">
                            <img src="/img/donhang_kh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khách hàng</p>
                        </a>
                        <a href="/promotion" class="flex flex-row space-x-3 ">
                            <img src="/img/donhang_km.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khuyến mãi</p>
                        </a>
                        <a href="/blog" class="flex flex-row space-x-3 ">
                            <img src="/img/donhang_blog.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Blog</p>
                        </a> 
                        <a href="\logout" class="flex justify-center">
                            <button class="border rounded-md bg-white text-black p-2">Đăng xuất</button>
                        </a>
                        <a href="#" class="flex flex-row space-x-3 pt-40">
                        </a> 
                    </div>
                    </ul>
                </col1><!--end col1-->
                <?php
                    $order_detail = $data['order_detail'];
                    $order_product = $data['order_product'];
                ?>
                <col2 class="bg-back_admin text-white w-4/5 space-y-8 flex flex-col px-4">
                    <row1 class="flex justify-end pt-4 space-x-3">

                    </row1><!--end row1-->
                    <row2 class="flex space-x-4 items-center">
                        <div class="text-2xl">#<?= htmlspecialchars($order_detail[0]['order_id']); ?></div><!--số thứ tự đơn hàng-->
                        <div class="text-sm text-gray-300"><?= htmlspecialchars((new DateTime($order_detail[0]['order_at']))->format('d/m/Y')); ?></div><!--ngày đặt-->
                    </row2><!--end row2-->
                    <row3 class="flex space-x-3">
                        <col1 class="bg-white flex flex-col w-2/3 text-black">
                            <div class="flex space-x-2 items-center pt-4 pl-4">
                                <div>Chi tiết đơn hàng</div>
                                
                                <?php if ($order_detail[0]['order_status'] == 'Chờ xác nhận'): ?>
                                    <div class="px-3 py-1 rounded-full bg-gray-200 w-40 inline-block text-center"><?= htmlspecialchars($order_detail[0]['order_status']); ?></div>
                                <?php elseif ($order_detail[0]['order_status'] == 'Đang giao'): ?>
                                    <div class="px-3 py-1 rounded-full bg-yellow-200 w-40 inline-block text-center"><?= htmlspecialchars($order_detail[0]['order_status']); ?></div>
                                <?php elseif ($order_detail[0]['order_status'] == 'Đã giao'): ?>
                                    <div class="px-3 py-1 rounded-full bg-green-200 w-40 inline-block text-center"><?= htmlspecialchars($order_detail[0]['order_status']); ?></div>
                                <?php else: ?>
                                    <div class="px-3 py-1 rounded-full bg-red-200 w-40 inline-block text-center"><?= htmlspecialchars($order_detail[0]['order_status']); ?></div>
                                <?php endif; ?>
                            </div>

                            <div><hr class="border-t border-black mt-5  sm:w-full"></div>
                                
                            <?php foreach ($order_product as $product): ?>
                                <div class="flex pl-4 py-4 space-x-10">
                                    <c1 class="flex space-x-2">
                                        <img class="h-20 w-20" src="<?= htmlspecialchars($product['product_image']); ?>" alt="item">
                                        <div class="flex flex-col">
                                            <p><?= htmlspecialchars($product['name']); ?></p>
                                            <p>Giá: <?= htmlspecialchars(number_format($product['product_price'], 0, ',', '.')); ?> VNĐ</p>
                                        </div>
                                    </c1>
                                    <div>Số lượng: <?= htmlspecialchars($product['quantity']); ?></div> <!--lấy dữ liệu số lượng từ trang thanh toán của kh-->
                                    <div class="pl-24">Thành tiền: <?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</div><!--lấy dữ liệu tạm tính từ trang thanh toán của kh-->
                                </div>
                            <?php endforeach; ?>


                            <div class="flex justify-between items-start space-x-6 pl-4">
                                <!-- Ghi chú -->
                                <div class="flex flex-col space-y-2 pb-4">

                                </div>
                            
                                <!-- Giá và Tổng cộng -->
                                <div class="flex flex-col space-y-4 text-right pr-4">
                                    <div class="flex justify-between space-x-10">
                                        <p class="text-gray-500">Giá</p>
                                        <?php $price_before_shipping = $order_detail[0]['total_price'] - 30000;
                                        ?>
                                        <p><?= htmlspecialchars($price_before_shipping); ?> VNĐ</p>
                                    </div>
                                    <div class="flex justify-between space-x-10">
                                        <p class=" text-gray-500">Vận chuyển</p>
                                        <p>30.000 VNĐ</p>
                                    </div>
                                    <div class="flex justify-between space-x-10">
                                        <p class="font-semibold">Tổng cộng</p>
                                        <p class="font-semibold text-black"><?= htmlspecialchars(number_format($order_detail[0]['total_price'], 0, ',', '.')); ?> VNĐ</p>
                                    </div>
                                </div>
                            </div>
                            <div><hr class="border-t border-black mt-5  sm:w-full"></div>
                            <div class="flex pl-4 space-x-2 py-4">
                                <p>Thanh toán</p>
                                <?php if ($order_detail[0]['payment_status'] == 'Chưa thanh toán'): ?>
                                    <span class="px-3 py-1 rounded-full bg-red-200 w-40 inline-block text-center"><?= htmlspecialchars($order_detail[0]['payment_status']); ?></span>
                                <?php else: ?>
                                    <span class="px-3 py-1 rounded-full bg-green-200 w-40 inline-block text-center"><?= htmlspecialchars($order_detail[0]['payment_status']); ?></span>
                                <?php endif; ?>

                            </div>
                            <div><hr class="border-t border-black mt-5  sm:w-full"></div>
                            <div class="flex flex-row py-4 space-x-2 items-center justify-center">
                                <button onclick="location.href='/order'" class="bg-white text-black border border-black w-32 text-center font-medium px-2 py-2 rounded focus:outline-none transition-all duration-300 ease-in-out">
                                    Trở lại
                                </button>
                            </div>
                        </col1>
                        <!--cột 2 trong hàng 3-->
                        <col2 class="bg-white text-black flex flex-col w-1/3 p-4 space-y-4">
                            <div class="text-gray-500">Khách hàng</div>
                            <div>Họ và tên: <?= htmlspecialchars($order_detail[0]['user_name']); ?></div><!--lấy dữ liệu từ trang thanh toán-->
                            <div><hr class="border-t border-black sm:w-full"></div>
                            <div class="text-gray-500">Liên hệ</div>
                            <div class="flex space-x-2">
                                <p>Số điện thoại: <?= htmlspecialchars($order_detail[0]['phone_number']); ?></p>
                            </div>
                            <div class="flex space-x-2">
                                <p>Email: <?= htmlspecialchars($order_detail[0]['email_address']); ?></p>
                            </div>
                            <div><hr class="border-t border-black sm:w-full"></div>
                            <div class="text-gray-500">Địa chỉ giao hàng</div>
                            <div><?= htmlspecialchars($order_detail[0]['detail']); ?>, <?= htmlspecialchars($order_detail[0]['ward']); ?>, <?= htmlspecialchars($order_detail[0]['district']); ?>, <?= htmlspecialchars($order_detail[0]['province']); ?></div>
                            <div><hr class="border-t border-black sm:w-full"></div>
                            <div class="text-gray-500">Phương thức vận chuyển</div>
                            <div>Hỏa tốc</div>
                            <div><hr class="border-t border-black sm:w-full"></div>
                            <div class="text-gray-500">Phương thức thanh toán</div>
                            <div><?= htmlspecialchars($order_detail[0]['payment_type']); ?></div>
                        </col2><!--cột 2 trong hàng 3-->
                    </row3><!--end row3-->
                </col2><!--end col2-->
            </main>
        </div>
    </div>
</body>
</html>