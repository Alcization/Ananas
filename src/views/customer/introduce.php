<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/assets/css/output.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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
            
            <main class="flex flex-col pt-20">
                <!-- Big Image -->
                <div>
                    <img src="/assets/introduce.jpg" alt="Big Image" class="w-full h-auto">
                </div>
                
                <!-- Store Information -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS D2</p>
                        <p>157/6 Nguyễn Gia Trí, Quận Bình Thạnh</p>
                        <p>028.6272.5294</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Standard</p>
                    </div>
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS ĐẶNG THỊ NHU</p>
                        <p>Lầu 1 - 41 Đặng Thị Nhu, Quận 1</p>
                        <p>028.6657.9962</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Standard</p>
                    </div>
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS FLAGSHIP</p>
                        <p>87 Nguyễn Trãi, Quận 1</p>
                        <p>028.6674.9928</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Flagship</p>
                    </div>
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS LÊ VĂN SỸ</p>
                        <p>386/4 Lê Văn Sỹ, Quận 3</p>
                        <p>028.6658.0727</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Standard</p>
                    </div>
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS MAI HẮC ĐẾ</p>
                        <p>123B Mai Hắc Đế, Quận Hai Bà Trưng</p>
                        <p>024.6689.9825</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Standard</p>
                    </div>
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS PHẠM VĂN ĐỒNG</p>
                        <p>992 Phạm Văn Đồng, Thành phố Thủ Đức</p>
                        <p>028.6271.5711</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Special</p>
                    </div>
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS SƯ VẠN HẠNH</p>
                        <p>427 Sư Vạn Hạnh, Quận 10</p>
                        <p>028.6681.0010</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Special</p>
                    </div>
                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                        <p class="font-bold">ANANAS VÕ VĂN TẦN</p>
                        <p>Lầu 1 - 418 Võ Văn Tần, Quận 3</p>
                        <p>028.6682.8975</p>
                        <p>9:00 am - 10:00 pm</p>
                        <p class="text-sm text-gray-500">Special</p>
                    </div>
                </div>
            </main>


            <?php
                include 'footer.php';
            ?>
        </div><!-- end content -->
    </div><!-- end root -->
    <script src="/assets/js/header.js"></script>
</body>
</html>