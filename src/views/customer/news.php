<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Be Vietnam Pro',sans-serif;
            font-weight: normal;
        }
    </style>
    <title>Bản Tin</title>
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

<div>
    <div class="flex flex-col w-9/12 mx-auto">
            <div class="text-2xl font-bold mt-16">TIN TỨC</div>
    </div>
    <?php 
        $top2news = array_slice($data, 0, 2);
        $othernews = array_slice($data, 2); 
        foreach ($top2news as $index => $news): 
    ?>
        <div class="mt-16">
            <?php if ($index == 0): ?>
                <a href="/news/detail/<?= htmlspecialchars($news['alias']); ?>" class="flex flex-col ml-16 lg:ml-0 lg:flex-row items-start lg:items-end w-9/12 lg:w-6/12 absolute left-24 z-30">
                    <div class="flex flex-col items-start lg:items-end mr-6">
                        <p class="text-left lg:text-right font-bold mb-2"><?= htmlspecialchars($news['blog_name']); ?></p>
                        <p class="text-sm text-[#888888] text-left lg:text-right mb-2"><?= htmlspecialchars($news['summary']); ?></p>
                        <p class="mb-4"><?= htmlspecialchars((new DateTime($news['created_at']))->format('d.m.Y')); ?></p>
                    </div>
                
                    <img src="<?= htmlspecialchars($news['sub_image']); ?>" alt="<?= htmlspecialchars($news['alt_sub_img']); ?>" class="w-80 lg:w-80 h-80 lg:h-80 object-cover rounded-xl hover:scale-105 duration-300">
                </a>
            <?php else: ?>
                <a href="/news/detail/<?= htmlspecialchars($news['alias']); ?>" class="flex flex-col items-end lg:items-start lg:flex-row w-8/12 lg:w-5/12 absolute right-[5vw] mr-20 lg:mr-0 mt-16 md:mt-60 z-20">
                    <img src="<?= htmlspecialchars($news['sub_image']); ?>" alt="<?= htmlspecialchars($news['alt_sub_img']); ?>" class="lg:w-60 lg:h-60 w-60 h-60 object-cover rounded-xl hover:scale-105 duration-300">

                    <div class="flex flex-col lg:items-start items-end ml-0 md:ml-6">
                        <p class="font-bold text-right lg:text-left mb-2 lg:mt-0 mt-3"><?= htmlspecialchars($news['blog_name']); ?></p>
                        <p class="text-sm text-right lg:text-left text-[#888888] mb-2"><?= htmlspecialchars($news['summary']); ?></p>
                        <p class="mb-4 text-right lg:text-left"><?= htmlspecialchars((new DateTime($news['created_at']))->format('d.m.Y')); ?></p>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <div class="flex flex-col w-9/12 mx-auto space-y-8 mt-[800px] lg:mt-[600px]">
    <?php for ($i = 0; $i < ceil(count($othernews) / 3); $i++): ?>
        <div class="flex flex-row space-x-8 h-[350px]">
        <?php for ($j = 0; $j < 3; $j++): ?>
            <?php
                $index = $i * 3 + $j; // Tính chỉ số của mục trong mảng
                if ($index >= count($othernews)) break; // Nếu vượt quá số phần tử thì thoát
            ?>
                <a href="/news/detail/<?= htmlspecialchars($othernews[$index]['alias']); ?>" class="flex flex-col w-1/3 h-full border-2 rounded-lg hover:scale-105 duration-300">
                    <img src="<?= htmlspecialchars($othernews[$index]['sub_image']); ?>" alt="<?= htmlspecialchars($othernews[$index]['alt_sub_img']); ?>"  class="w-full h-3/4 object-cover rounded-t-lg">
                    <p class="flex my-auto ml-6 font-bold"><?= htmlspecialchars($othernews[$index]['blog_name']); ?></p>
                </a>
        <?php endfor; ?>
        </div>
    <?php endfor; ?>
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
<script src="/assets/js/header.js"></script>
</body>
</html>