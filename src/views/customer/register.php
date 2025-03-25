<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Be Vietnam Pro',sans-serif;
            font-weight: normal;
        }
    </style>
    <link href="/assets/css/output.css" rel="stylesheet">
</head>
<body class="min-h-screen">
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

    // Tạo CSRF token nếu chưa tồn tại
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
?>

<div class="flex flex-row w-full min-h-screen">
    <div class="flex items-center bottom-0 lg:w-6/12 w-full ">
        <div class="flex-col flex w-2/3 mx-auto">
            <p class="font-bold text-2xl md:text-3xl mt-20 mb-5">ĐĂNG KÝ</p>
            <form method="POST" action="/register/submit">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                <p>Họ và tên:</p>
                <input type="text" placeholder="Họ và tên" class="border-2 w-full mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="fullname" name="fullname" required>

                <div class="flex flex-col md:flex-row space-x-0 md:space-x-5">
                    <div class="w-full md:w-4/12">
                        <p>Số điện thoại</p>
                        <input type="tel" placeholder="Số điện thoại" class="border-2 w-full mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="phone_number" name="phone_number" required>
                    </div>

                    <div class="w-full md:w-8/12">
                        <p>Email</p>
                        <input type="email" placeholder="Email" class="border-2 w-full mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="email_address" name="email_address" required>
                    </div>
                </div>

                <p>Mật khẩu:</p>
                <input type="password" placeholder="Mật khẩu" class="border-2 w-full mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="password" name="password" required>

                <p>Xác nhận mật khẩu:</p>
                <input type="password" placeholder="Xác nhận mật khẩu" class="border-2 w-full mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="confirm_password" name="confirm_password" required>

                <p>Ngày sinh:</p>
                <input type="date" class="border-2 w-full mb-5 text-sm h-14 rounded-lg mt-2 px-4" id="birth_day" name="birth_day" required>
                <!--Giới tính-->
                <div class="flex space-x-8">
                    <p>Giới tính:</p>
                    <div>
                        <input type="radio" id="he/him" name="gender" value="he/him">
                        <label for="he/him">Nam</label>
                    </div>
                    <div>
                        <input type="radio" id="she/her" name="gender" value="she/her">
                        <label for="she/her">Nữ</label>
                    </div>
                    <div>
                        <input type="radio" id="notsay" name="gender" value="prefer not to say">
                        <label for="notsay">Không đề cập</label>
                    </div>
                </div>

                    <div>
                        <p class="mt-8">Địa chỉ:</p>
                        <div class="flex flex-row space-x-3">
                            <input type="text" placeholder="Tỉnh/thành phố" class="border-2 w-1/3 mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="province" name="province" required>
                            <input type="text" placeholder="Quận/huyện" class="border-2 w-1/3 mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="district" name="district" required>
                            <input type="text" placeholder="Phường/xã" class="border-2 w-1/3 mb-5 text-sm h-14 rounded-lg mt-2 pl-4" id="ward" name="ward" required>
                        </div>
                        <div>
                            <input type="text" placeholder="Địa chỉ chi tiết" class="border-2 w-full mb-5 text-sm h-14 mt-0 rounded-lg pl-4" id="detail" name="detail" required>
                        </div>
                    </div>


                <?php if (isset($error)): ?>
                    <div style="color: red;"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>            
                <button type="submit" class="text-sm bg-gradient-to-r from-[#F15E2C] from-0% to-[#F15E2C] to-100% text-white rounded-lg mt-5 py-3 px-12 mx-auto
                    hover:bg-gradient-to-r hover:from-[#fca144] hover:from-5% hover:to-[#FF6530] hover:to-30% hover:shadow-md hover:shadow-[rgba(241,94,44,0.5)] duration-300">
                    ĐĂNG KÝ
                </button>
            </form>
            <p class="mt-8 mb-16">Đã có tài khoản?<a class="ml-1" href="/login"><strong>Đăng nhập</strong></a></p>
        </div>
    </div>

    <div class="relative w-6/12 lg:block hidden mt-[64px]">
        <img src="/assets/login_register/register_1.jpg" class="w-full h-full object-cover">
    </div>
</div>
<script src="/assets/js/header.js"></script>
</body>
</html>