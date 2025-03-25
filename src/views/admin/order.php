<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../../output.css" rel="stylesheet">
</head>
<body>
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
                            <img src="img/donhang_dashboard.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Dashboard</p>
                        </a>
                        <a href="/order" class="flex flex-row space-x-3 bg-green-600 rounded-md p-2">
                            <img src="img/donhang_dh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Đơn hàng</p>
                        </a>
                        <a href="products" class="flex flex-row space-x-3">
                            <img src="img/donhang_sp.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Sản phẩm</p>
                        </a>
                        <a href="/customers" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_kh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khách hàng</p>
                        </a>
                        <a href="/promotion" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_km.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khuyến mãi</p>
                        </a>
                        <a href="/blog" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_blog.png" alt="dashboard_icon" class="h-6 w-6">
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
                <col2 class="bg-back_admin text-white w-4/5 space-y-8 flex flex-col">
                    <row1 class="flex justify-end pr-4 pt-4 space-x-3">

                    </row1><!--end row1-->
                    <row2 class="font-bold text-2xl pl-8">
                        Đơn hàng
                    </row2><!--end row2-->
                    <row3 class="bg-white">
                        <div class="p-4">
                            <!-- search and filter -->
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center space-x-2">
                                    <input type="text" placeholder="Tìm kiếm đơn hàng" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-300 text-black" />
                                </div>
                            </div>
                        
                            <!-- table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full border-collapse border border-gray-300 text-black">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="border border-gray-300 px-4 py-2">Đơn hàng</th>
                                            <th class="border border-gray-300 px-4 py-2">Khách hàng</th>
                                            <th class="border border-gray-300 px-4 py-2">Ngày đặt</th>
                                            <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                                            <th class="border border-gray-300 px-4 py-2">Thanh toán</th>
                                            <th class="border border-gray-300 px-4 py-2">Tổng tiền</th>
                                            <th class="border border-gray-300 px-4 py-2">Xem thêm</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                            $orders_all = $data;
                                            $order_per_page = 8;
                                            $start_index = 0;
                                            $total_products = count($orders_all);
                                            $total_pages = ceil($total_products / $order_per_page);
                                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                            $start = ($page - 1) * $order_per_page;
                                            $orders= array_slice($orders_all, $start, $order_per_page);
                                
                                            foreach ($orders as $index => $order): 
                                        ?>
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($order['order_id']); ?></td>
                                                <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($order['user_name']); ?></td>
                                                <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars((new DateTime($order['order_at']))->format('d.m.Y')); ?></td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php if ($order['order_status'] == 'Chờ xác nhận'): ?>
                                                        <span class="px-3 py-1 rounded-full bg-gray-200 w-40 inline-block"><?= htmlspecialchars($order['order_status']); ?></span>
                                                    <?php elseif ($order['order_status'] == 'Đang giao'): ?>
                                                        <span class="px-3 py-1 rounded-full bg-yellow-200 w-40 inline-block"><?= htmlspecialchars($order['order_status']); ?></span>
                                                    <?php elseif ($order['order_status'] == 'Đã giao'): ?>
                                                        <span class="px-3 py-1 rounded-full bg-green-200 w-40 inline-block"><?= htmlspecialchars($order['order_status']); ?></span>
                                                    <?php else: ?>
                                                        <span class="px-3 py-1 rounded-full bg-red-200 w-40 inline-block"><?= htmlspecialchars($order['order_status']); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php if ($order['payment_status'] == 'Chưa thanh toán'): ?>
                                                        <span class="px-3 py-1 rounded-full bg-red-200 w-40 inline-block"><?= htmlspecialchars($order['payment_status']); ?></span>
                                                    <?php else: ?>
                                                        <span class="px-3 py-1 rounded-full bg-green-200 w-40 inline-block"><?= htmlspecialchars($order['payment_status']); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars(number_format($order['total_price'], 0, ',', '.')); ?> VNĐ</td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <button type="button" onclick="location.href='/order/detail/<?= htmlspecialchars($order['order_id']); ?>'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /> <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /> </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>  

                                    </tbody>
                                </table>
                            </div>
                        
                            <!-- pagination -->
                            <div class="flex items-center justify-end mt-4 text-black space-x-2">
                                <div class="text-sm"><?php echo $page; ?> of <?php echo $total_pages; ?></div>
                                <div>
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?php echo $page - 1; ?>">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                                </svg> 
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if ($page < $total_pages): ?>
                                        <a href="?page=<?php echo $page + 1; ?>">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                                </svg> 
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                    </row3><!--end row3-->
                </col2><!--end col2-->
            </main>
        </div>
    </div>
</body>
</html>