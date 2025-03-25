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

<div class="flex-grow">
    <div class="flex md:flex-row flex-col w-10/12 lg:w-9/12 mx-auto">
        <div class="mt-16">

        </div>
        <div class="md:flex flex-col items-start mr-6 hidden md:min-w-fit mt-20">
            <div class="text-2xl font-bold">TÀI KHOẢN</div>

            <a href="/info" class="px-4 mt-8">Thông tin <br class="hidden md:inline-block lg:hidden">tài khoản</a>

            <div class="mt-8 bg-[#F15E2C] text-white font-semibold py-2 px-4 rounded-lg"><a>Phương thức <br class="hidden md:inline-block lg:hidden">thanh toán</a></div>
            <a href="/orderhistory" class="px-4 mt-8">Đơn hàng <br class="hidden md:inline-block lg:hidden">của tôi</a>
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
                <p>Phương thức thanh toán</p>
            </div>
        </div>

        <div id="account_nav" class="border-2 border-gray-300 rounded-xl hidden flex-col duration-300 md:invisible bg-white shadow-md py-5 space-y-2 text-center absolute w-10/12 top-44 z-20">
        <a class="py-3" href="#">Thông tin cá nhân</a>
            <a class="py-3" href="/orderhistory">Đơn hàng của tôi</a>
            <a class="py-3" href="/accountpayment">Phương thức thanh toán</a>
            <a class="py-3" href="#">Đổi mật khẩu</a>
            <button type="button" class="bg-[#FF4141] text-white w-11/12 mx-auto mt-3 py-3 rounded-md">Đăng xuất</button>
        </div>

        <!--End mobile account navigation-->

        <div class="w-full" style="margin-top: 5rem;">
            <?php 
                $cards = $data['card'];
                $banks = $data['bank'];
            ?>
            <div class="flex flex-row w-full">
                <p class="flex font-bold w-10/12">Thẻ tín dụng & thẻ ghi nợ</p>
                <div class="flex justify-end ml-auto w-3/12"><button class="px-4 py-1 bg-[#F15E2C] text-white text-[13px] rounded-md">Thêm</button></div>
            </div>
            <?php
                foreach($cards as $card):
            ?>

            <div class="flex flex-col lg:flex-row justify-center mt-5 space-y-5">
                <div class="flex flex-row lg:w-10/12 w-full">
                    <div class="flex w-1/3 my-auto">
                        <!--<img src="/assets/account/Visa.png" class="flex h-4 mr-3 object-cover my-auto">-->
                        <p><?= htmlspecialchars($card['card_branch']); ?></p>
                    </div>

                    <div class="flex-grow"> <!--Để trống để đặt tên trong TKNH-->

                    </div>

                    <div class="flex w-full my-auto justify-end mr-2">
                        <p>**** <?= htmlspecialchars($card['last_4_digits']); ?></p>
                        <?php if($card['is_default']): ?>
                            <p class="ml-2 px-2 py-1 bg-[#35A16F] hidden md:block text-white text-[13px] rounded-md">Mặc định</p>
                            <div class="flex my-auto w-2 h-2 bg-[#35A16F] rounded-full md:hidden ml-2"></div> <!--Chấm xanh biểu thị mặc định-->
                        <?php  endif;?>
                    </div>
                </div>

                <div class="lg:flex hidden md:w-3/12 w-full justify-end align-middle">
                    <div>
                        <a href="/accountpayment/deletecard?card_id=<?= htmlspecialchars($card['card_id']); ?>">
                            <button class="text-sm mr-3 text-[#FF4141] underline">Xóa</button>
                        </a>
                        <a href="/accountpayment/updatedefaultcard?card_id=<?= htmlspecialchars($card['card_id']); ?>">
                            <button class="text-sm underline">Làm mặc định</button>
                        </a>
                    </div>
                </div>

                <div class="flex lg:hidden justify-center space-x-2 mt-3"> <!--Mobile button-->
                    <button class="px-4 py-1 bg-[#FF4141] text-white text-sm rounded">Xóa</button>
                    <button class="px-4 py-1 bg-[#35A16F] text-white text-sm rounded opacity-55">Mặc định</button>
                </div>
            </div>
            <?php endforeach; ?>

            <!--TKNH-->
            <div class="flex flex-row w-full mt-16">
                <p class="flex font-bold w-9/12">Liên kết ngân hàng</p>
                <div class="flex justify-end ml-auto w-3/12"><button class="px-4 py-1 bg-[#F15E2C] text-white text-[13px] rounded-md">Thêm</button></div>
            </div>

            <?php foreach($banks as $bank): ?>
                <div class="flex flex-col lg:flex-row justify-center mt-5 space-y-5">
                    <div class="flex flex-row lg:w-10/12 w-full">
                        <div class="flex w-1/3 my-auto">
                            <!---<img src="/assets/account/Techcombank.png" class="flex h-4 mr-3 object-cover my-auto">--->
                            <div>
                                <?= htmlspecialchars($bank['card_holder_name']); ?>
                                <p><?= htmlspecialchars($bank['bank_name']); ?></p>
                            </div>
                        </div>

                        <div class="flex-grow"> <!--Để trống-->

                        </div>

                        <div class="flex w-full my-auto justify-end mr-2">
                            <p>**** <?= htmlspecialchars($bank['last_4_digits']); ?></p>
                            <?php if($bank['is_default']): ?>
                                <p class="ml-2 px-2 py-1 bg-[#35A16F] hidden md:block text-white text-[13px] rounded-md">Mặc định</p>
                                <div class="flex my-auto w-2 h-2 bg-[#35A16F] rounded-full md:hidden ml-2"></div> <!--Chấm xanh biểu thị mặc định-->
                            <?php  endif;?>
                        </div>
                    </div>

                    <div class="lg:flex hidden md:w-3/12 w-full justify-end align-middle">
                        <div>
                            <a href="/accountpayment/deletebank?bank_id=<?= htmlspecialchars($bank['bank_id']); ?>">
                                <button class="text-sm mr-3 text-[#FF4141] underline">Xóa</button>
                            </a>
                            <a href="/accountpayment/updatedefaultbank?bank_id=<?= htmlspecialchars($bank['bank_id']); ?>">
                                <button class="text-sm underline">Làm mặc định</button>
                            </a>
                        </div>
                    </div>

                    <div class="flex lg:hidden justify-center space-x-2 mt-3"> <!--Mobile button-->
                        <button class="px-4 py-1 bg-[#FF4141] text-white text-sm rounded">Xóa</button>
                        <button class="px-4 py-1 bg-[#35A16F] text-white text-sm rounded">Mặc định</button>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

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