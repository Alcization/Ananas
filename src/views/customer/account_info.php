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
    <div class="flex md:flex-row flex-col w-9/12 mx-auto mt-16">
        <div class="md:flex flex-col items-start mr-6 hidden lg:w-1/3 md:w-2/3">
            <div class="text-2xl font-bold">TÀI KHOẢN</div>

            <div class="mt-8 bg-[#F15E2C] text-white font-semibold py-2 px-4 rounded-lg"><a>Thông tin tài khoản</a></div>
            <a class="px-4 mt-8" href="/accountpayment">Phương thức thanh toán</a>
            <a class="px-4 mt-8" href="/orderhistory">Đơn hàng của tôi</a>
            <a class="px-4 mt-8">Đổi mật khẩu</a>

            <a href="/logout"><button type="button" class="mt-32 bg-[#FF4141] text-white font-semibold py-2 px-4 rounded-lg">Đăng xuất</button></a>
        </div>

        <!--Mobile Account navigation-->
        <div class="md:hidden flex mb-8" id="account">
            <svg xmlns="http://www.w3.org/2000/svg" class="my-auto mr-3" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" id="arrow">
                <path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div>
                <p class="font-bold text-2xl mb-2">THÔNG TIN TÀI KHOẢN</p>
                <p>Thông tin cá nhân</p>
            </div>
        </div>

        <div id="account_nav" class="border-2 border-gray-300 rounded-xl hidden flex-col duration-300 md:invisible bg-white shadow-md py-5 space-y-2 text-center absolute w-9/12 top-44">
            <a class="py-3" href="#">Thông tin cá nhân</a>
            <a class="py-3" href="/orderhistory">Đơn hàng của tôi</a>
            <a class="py-3" href="/accountpayment">Phương thức thanh toán</a>
            <a class="py-3" href="#">Đổi mật khẩu</a>
            <button type="button" class="bg-[#FF4141] text-white w-11/12 mx-auto mt-3 py-3 rounded-md">Đăng xuất</button>
        </div>
        <!--End mobile account navigation-->

        <div class="flex lg:flex-row flex-col w-full">
            <img src="/assets/account/Sequoia-Sunrise.png" alt="Account Image" class="lg:h-28 lg:w-28 lg:mr-6 my-auto aspect-square object-cover rounded-full
            h-32 mx-auto w-32">
            <div class="w-5/12 mx-auto text-center mt-5 mb-5 md:my-auto md:text-left">
                <p class="text-2xl font-semibold"><?= htmlspecialchars($data[0]['fullname']); ?></p>
                <p class="text-[#888888]"><?= htmlspecialchars($data[0]['user_name']); ?></p>
            </div>
            <div class="my-auto">
                <form method="POST" action="/info/submit" class="space-y-5">
                    <input type="date" placeholder="Ngày sinh" class="border-2 w-full text-sm h-14 rounded-lg px-4 input-field" value="<?= htmlspecialchars($data[0]['birth_date']); ?>" name="birth_date">
                    <input type="text" placeholder="Email" class="border-2 w-full text-sm h-14 rounded-lg pl-4 input-field" value="<?= htmlspecialchars($data[0]['email_address']); ?>" name="email_address">
                    <input type="text" placeholder="Số điện thoại" class="border-2 w-full text-sm h-14 rounded-lg pl-4 input-field" value="<?= htmlspecialchars($data[0]['phone_number']); ?>" name="phone_number">
                    <div class="space-x-5 md:space-x-0 md:space-y-5 flex flex-row md:flex-col">
                        <input type="text" placeholder="Tỉnh/thành phố" class="border-2 text-sm h-14 rounded-lg pl-4 w-1/3 md:w-full input-field" value="<?= htmlspecialchars($data[0]['province']); ?>" name="province">
                        <input type="text" placeholder="Quận/huyện" class="border-2 text-sm h-14 rounded-lg pl-4 w-1/3 md:w-full input-field" value="<?= htmlspecialchars($data[0]['district']); ?>" name="district">
                        <input type="text" placeholder="Phường/xã" class="border-2 text-sm h-14 rounded-lg pl-4 w-1/3 md:w-full input-field" value="<?= htmlspecialchars($data[0]['ward']); ?>" name="ward">
                    </div>
                    <input type="text" placeholder="Địa chỉ" class="border-2 w-full text-sm h-14 rounded-lg pl-4 input-field" value="<?= htmlspecialchars($data[0]['detail']); ?>" name="detail">
                    <?php if (isset($error)): ?>
                        <div style="color: red;"><?= htmlspecialchars($error); ?></div>
                    <?php endif; ?>  
                    <button type="submit" id="save-button" class="flex justify-end bg-gray-500 py-2 my-auto text-white font-semibold px-8 rounded-lg mx-auto md:mx-0 cursor-not-allowed" disabled>
                        Lưu
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>


<footer class="flex flex-col justify-end w-full mt-8 md:mt-0">
    <div class="flex w-full bg-white h-[400px] mb-0 bottom-0">
        <div class="my-auto top-0 bottom-0 w-full">
            <div class="flex flex-row w-9/12 mx-auto align-middle">
                <img src="/assets/Logo_Ananas.png" class="h-7 flex my-auto top-0 bottom-0 mr-2" alt="logo">
                <img src="/assets/logo-black.png" class="flex h-10 w-24 object-cover my-auto top-0 bottom-0" alt="logo">
            </div>

            <div class="flex md:flex-row flex-col w-9/12 mx-auto mt-5">
                <div class="flex flex-row md:w-3/5 w-full">
                    <div class="w-1/3 space-y-3">
                        <p><strong>SẢN PHẨM</strong></p>
                        <p class="text-sm text-[#888888]">Giày nam</p>
                        <p class="text-sm text-[#888888]">Giày nữ</p>
                        <p class="text-sm text-[#888888]">Thời trang & phụ kiện</p>
                        <p class="text-sm text-[#888888]">Sale-off</p>
                    </div>

                    <div class="w-1/3 space-y-3">
                        <p><strong>VỀ ANANAS</strong></p>
                        <p class="text-sm text-[#888888]">Tuyển dụng</p>
                        <p class="text-sm text-[#888888]">Giới thiệu</p>
                    </div>

                    <div class="w-1/3 space-y-3">
                        <p><strong>HỖ TRỢ</strong></p>
                        <p class="text-sm text-[#888888]">FAQs</p>
                        <p class="text-sm text-[#888888]">Bảo mật thông tin</p>
                        <p class="text-sm text-[#888888]">Chính sách chung</p>
                        <p class="text-sm text-[#888888]">Tra cứu đơn hàng</p>
                    </div>
                </div>


                <div class="md:w-2/5 w-full mt-8 md:mt-0">
                    <p><strong>LIÊN HỆ</strong></p>
                    <input type="text" placeholder="Email" class="border-2 w-full text-sm h-10 rounded-md mt-2 pl-3">
                    <div class="flex flex-row space-x-4 mt-3">
                        <img src="/assets/index/fb_icon.png" alt="Facebook Icon" class="h-5 w-5 opacity-55">
                        <img src="/assets/index/yt_icon.png" alt="Youtube Icon" class="h-5 w-5 opacity-55">
                        <img src="/assets/index/ig_icon.png" alt="Instagram Icon" class="h-5 w-5 opacity-55">
                    </div>

                    <div class="flex space-x-2 flex-row mt-7">
                        <p><strong>HỆ THỐNG CỬA HÀNG</strong></p>

                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" viewBox="0 0 13 14" fill="none" class="flex my-auto top-0 bottom-0">
                            <path d="M0.467209 12.0185C0.172957 12.3101 0.172957 12.7827 0.467209 13.0742C0.761461 13.3658 1.23854 13.3658 1.53279 13.0742L0.467209 12.0185ZM12.7535 1.64824C12.7535 1.23596 12.4161 0.901737 12 0.901736L5.21868 0.901736C4.80254 0.901736 4.4652 1.23596 4.4652 1.64824C4.4652 2.06052 4.80254 2.39474 5.21868 2.39474H11.2465V8.36677C11.2465 8.77905 11.5839 9.11328 12 9.11328C12.4161 9.11328 12.7535 8.77905 12.7535 8.36677L12.7535 1.64824ZM1.53279 13.0742L12.5328 2.1761L11.4672 1.12038L0.467209 12.0185L1.53279 13.0742Z" fill="#F15E2C"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="h-10 md:mt-0 mt-16 w-full bg-[#F15E2C]"></div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fields = document.querySelectorAll('.input-field');
        const saveButton = document.getElementById('save-button');

        // Lưu trữ giá trị ban đầu của các input
        const initialValues = Array.from(fields).map(field => field.value);

        // Kiểm tra điều kiện: tất cả ô phải có giá trị và phải có thay đổi
        const validateFields = () => {
            const allFilled = Array.from(fields).every(field => field.value.trim() !== ''); // Kiểm tra tất cả ô có giá trị
            const hasChanges = Array.from(fields).some((field, i) => field.value !== initialValues[i]); // Kiểm tra có sự thay đổi

            if (allFilled && hasChanges) {
                saveButton.disabled = false;
                saveButton.classList.remove('bg-gray-500', 'cursor-not-allowed');
                saveButton.classList.add('bg-[#F15E2C]');
            } else {
                saveButton.disabled = true;
                saveButton.classList.add('bg-gray-500', 'cursor-not-allowed');
                saveButton.classList.remove('bg-[#F15E2C]');
            }
        };

        // Gắn sự kiện `input` để kiểm tra khi người dùng nhập liệu
        fields.forEach(field => {
            field.addEventListener('input', validateFields);
        });

        // Kiểm tra lần đầu khi trang tải
        validateFields();
    });
</script>
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