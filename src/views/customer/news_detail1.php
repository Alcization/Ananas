<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?= htmlspecialchars($data[0]['description']); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($data[0]['keyword_1']); ?>,
                                <?= htmlspecialchars($data[0]['keyword_2']); ?>,
                                <?= htmlspecialchars($data[0]['keyword_3']); ?>,
                                <?= htmlspecialchars($data[0]['keyword_4']); ?>,
                                <?= htmlspecialchars($data[0]['keyword_5']); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Be Vietnam Pro',sans-serif;
            font-weight: normal;
        }
    </style>
    <title><?= htmlspecialchars($data[0]['blog_name']); ?></title>
</head>
<body>
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

<div class="w-9/12 mx-auto space-y-6">
    <a href="/news" class="flex flex-row">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" class="mt-16">
            <path d="M3.99982 11.9998L19.9998 11.9998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M8.99963 17C8.99963 17 3.99968 13.3176 3.99966 12C3.99965 10.6824 8.99966 7 8.99966 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="ml-1 mt-16">Trở về</p>
    </a>
    <img src="<?= htmlspecialchars($data[0]['main_image']); ?>" alt="<?= htmlspecialchars($data[0]['alt_main_img']); ?>" class="w-full h-[500px] object-cover rounded-lg">
    <p class="text-[#888888] text-sm"><?= htmlspecialchars($data[0]['blog_cate']); ?></p>
    <div class="flex w-full">
        <p class="font-bold text-xl"><?= htmlspecialchars($data[0]['blog_name']); ?></p>
        <p class="flex-grow"></p>
        <p><?= htmlspecialchars((new DateTime($data[0]['created_at']))->format('d.m.Y')); ?></p>
    </div>
    <?php 
        require_once __DIR__ . '/../../../vendor/autoload.php'; // Đường dẫn tới autoload của Composer

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($data[0]['main_content']);        
        
    ?>
    <div class="flex flex-col mx-auto w-8/12 space-y-6">
        <?= $clean_html; ?>
    </div>
</div>

<footer class="bottom-0 mb-0">
    <div class="flex w-full bg-white h-[400px] mb-0 bottom-0">
        <div class="my-auto top-0 bottom-0 w-full">
            <div class="flex flex-row w-9/12 mx-auto align-middle">
                <img src="/assets/Logo_Ananas.png" class="h-7 flex my-auto top-0 bottom-0 mr-2" alt="logo">
                <img src="/assets/logo-black.png" class="flex h-10 w-24 object-cover my-auto top-0 bottom-0" alt="logo">
            </div>

            <div class="flex flex-row w-9/12 mx-auto mt-5">
                <div class="w-1/5 space-y-3">
                    <p><strong>SẢN PHẨM</strong></p>
                    <p class="text-sm text-[#888888]">Giày nam</p>
                    <p class="text-sm text-[#888888]">Giày nữ</p>
                    <p class="text-sm text-[#888888]">Thời trang & phụ kiện</p>
                    <p class="text-sm text-[#888888]">Sale-off</p>
                </div>

                <div class="w-1/5 space-y-3">
                    <p><strong>VỀ ANANAS</strong></p>
                    <p class="text-sm text-[#888888]">Tuyển dụng</p>
                    <p class="text-sm text-[#888888]">Giới thiệu</p>
                </div>

                <div class="w-1/5 space-y-3">
                    <p><strong>HỖ TRỢ</strong></p>
                    <p class="text-sm text-[#888888]">FAQs</p>
                    <p class="text-sm text-[#888888]">Bảo mật thông tin</p>
                    <p class="text-sm text-[#888888]">Chính sách chung</p>
                    <p class="text-sm text-[#888888]">Tra cứu đơn hàng</p>
                </div>

                <div class="w-2/5">
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

    <div class="h-10 w-full bg-[#F15E2C]"></div>
</footer>
</body>
</html>