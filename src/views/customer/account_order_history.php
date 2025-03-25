<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Kiểm tra quyền truy cập
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
        header('Location: /');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <title>Title</title>
    <style>
        body {
            font-family: 'Be Vietnam Pro',sans-serif;
            font-weight: normal;
        }
    </style>
    <link href="/assets/css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen">
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


<div class="flex flex-col flex-grow min-h-full">
    <div class="flex md:flex-row flex-col w-10/12 lg:w-9/12 mx-auto">
        <div class="mt-16">

        </div>
        <div class="md:flex flex-col items-start mr-6 hidden md:min-w-fit mt-20">
            <div class="text-2xl font-bold">TÀI KHOẢN</div>

            <a href="/info" class="px-4 mt-8">Thông tin <br class="hidden md:inline-block lg:hidden">tài khoản</a>
            <a href="/accountpayment" class="px-4 mt-8">Phương thức <br class="hidden md:inline-block lg:hidden">thanh toán</a>
            <div class="mt-8 bg-[#F15E2C] text-white font-semibold py-2 px-4 rounded-lg"><a>Đơn hàng <br class="hidden md:inline-block lg:hidden">của tôi</a></div>
            <a class="px-4 mt-8">Đổi mật khẩu</a>

            <a href="/logout"><button type="button" class="mt-32 bg-[#FF4141] text-white font-semibold py-2 px-4 rounded-lg">Đăng xuất</button></a>
        </div>

        <!--Mobile Account navigation-->
        <div class="md:hidden flex mb-8" id="account">
            <svg xmlns="http://www.w3.org/2000/svg" class="my-auto mr-3" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" id="arrow">
                <path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div>
                <p class="font-bold text-xl mb-2">THÔNG TIN TÀI KHOẢN</p>
                <p>Đơn hàng của tôi</p>
            </div>
        </div>

        <div id="account_nav" class="border-2 border-gray-300 rounded-xl hidden flex-col duration-300 md:invisible bg-white shadow-md py-5 space-y-2 text-center absolute w-10/12 top-44 z-20">
        <a class="py-3" href="#">Thông tin cá nhân</a>
            <a class="py-3" href="/orderhistory">Đơn hàng của tôi</a>
            <a class="py-3" href="/accountpayment">Phương thức thanh toán</a>
            <a class="py-3" href="#">Đổi mật khẩu</a>
            <button type="button" class="bg-[#FF4141] text-white w-11/12 mx-auto mt-3 py-3 rounded-md">Đăng xuất</button>
        </div>

        <div class="w-10/12 md:w-9/12 mx-auto">
            <div class="mt-0 md:mt-16">

            </div>
            <?php 
                $orders = $data['order'];
                $order_items = $data['order_item'];
                foreach ($orders as $index => $order):
            ?>
                <div class="border-2 rounded-2xl <?= $index != 0 ? 'mt-5' : ''; ?>">
                    <div class="m-5">Mã đơn hàng: <?= htmlspecialchars($order['order_id']); ?></div>
                    <!-- <<<<<<<<<<<< A product starts >>>>>>>>>>>>>> -->
                    <?php
                        $filtered_order_items = array_filter($order_items, function($order_item) use ($order) {
                            return $order_item['order_id'] === $order['order_id'];
                        });
                        foreach ($filtered_order_items as $order_item):
                    ?>
                        <div class="flex flex-row mx-5 my-5 w-auto space-x-5">
                            <img src="<?= htmlspecialchars($order_item['product_image']); ?>" alt="<?= htmlspecialchars($order_item['name']); ?>" class="h-24 sm:h-28 w-auto rounded-lg">

                            <div class="flex flex-col md:flex-row w-full">
                                <div class="flex flex-col">
                                    <p class="font-bold text-sm md:text-base"><?= htmlspecialchars($order_item['name']); ?> - <?= htmlspecialchars($order_item['category_name']); ?> - <?= htmlspecialchars($order_item['color_name']); ?></p>
                                    <div class="flex-grow"></div>
                                    <div class="flex flex-col sm:flex-row md:flex-col sm:space-x-3 mt-1 md:mt-0 space-x-0 md:space-x-0">
                                        <p class="text-[#888888] text-sm">Kích cỡ: <?= htmlspecialchars($order_item['size_value']); ?></p>
                                        <p class="text-[#888888] text-sm">Số lượng: <?= htmlspecialchars($order_item['quantity']); ?></p>
                                    </div>
                                </div>

                                <div class="flex-grow">

                                </div>

                                <p class="font-bold mt-1 md:mt-0 text-[#F15E2C] flex items-center ml-0 md:ml-5 min-w-fit text-sm md:text-base"><?= htmlspecialchars(number_format($order_item['price'], 0, ',', '.')); ?> VNĐ</p>
                            </div>
                            <!-- end foreach -->
                        </div>
                        <!-- <<<<<<<<<<<< A product ends >>>>>>>>>>>>>> -->
                    <?php endforeach; ?>
                        <div class="mx-5 flex flex-row border-t-2 pt-4">
                            <div class="flex-grow"></div>
                            <p class="text-sm md:text-base">Tổng cộng:</p>
                            <p class="font-bold ml-2 text-[#F15E2C] flex md:ml-5 min-w-fit text-sm md:text-base"><?= htmlspecialchars(number_format($order['total_price'], 0, ',', '.')); ?> VNĐ</p>
                        </div>
                        <div class="m-5 flex flex-row">
                            <div class="my-auto text-sm md:text-base">Trạng thái: <?= htmlspecialchars($order['status']); ?></div>
                            <div class="flex-grow"></div>
                            <?php if ($order['status'] === 'Chờ xác nhận'): ?>
                                <a href="/orderhistory/cancel?order_id=<?= htmlspecialchars($order['order_id']); ?>">
                                    <button 
                                        type="button" 
                                        class="bg-[#FF4141] px-4 py-2 rounded-lg text-white text-sm md:text-base"
                                    >
                                        Hủy đơn
                                    </button>
                                </a>
                            <?php else: ?>
                                <button 
                                    type="button" 
                                    class="bg-[#FF4141] px-4 py-2 rounded-lg text-white text-sm md:text-base cursor-not-allowed opacity-50" 
                                    disabled
                                >
                                    Hủy đơn
                                </button>
                            <?php endif; ?>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="flex-grow"></div>
<?php include 'footer.php'; ?>
<script>
    let accountNav = document.querySelector("#account_nav");
    let account = document.querySelector("#account");
    let arrow = document.querySelector("#arrow");
    let x = document.getElementById("arrow");

    account.addEventListener('click',accountNavToggle);

    function accountNavToggle() {
        if (accountNav.classList.contains('hidden')) {
            accountNav.classList.remove('hidden');
            accountNav.classList.add('flex');

            arrow.classList.add('rotate-90');
            arrow.classList.add('duration-300');
        } else {
            accountNav.classList.remove('flex');
            accountNav.classList.add('hidden');

            arrow.classList.remove('rotate-90');
            arrow.classList.add('duration-300');

        }
    }
</script>
<script src="/assets/js/header.js"></script>

</body>
</html>