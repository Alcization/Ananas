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
    <div class="root">
        <script>
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                alert('Thêm sản phẩm yêu thích thành công');
            }
            if (urlParams.has('delete')) {
                alert('Xóa sản phẩm yêu thích thành công');
            }
        </script>
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
                <row1 class="font-BeVietnam font-bold text-2xl  pl-5 sm:pl-10 lg:pl-40 uppercase mt-14">
                    Yêu thích
                </row1> <!--end row1-->
                <row2 class="flex flex-row mt-16 justify-center">
                    <col2 class="w-full lg:w-4/6 grid grid-cols-2 sm:grid-cols-3 gap-7 px-16 items-center justify-center">
                        <?php 
                            $products_all = $data;
                            $product_per_page = 12;
                            $start_index = 0;
                            $total_products = count($products_all);
                            $total_pages = ceil($total_products / $product_per_page);
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start = ($page - 1) * $product_per_page;
                            $products= array_slice($products_all, $start, $product_per_page);

                            foreach ($products as $product):
                        ?>
                            <!--san pham 1-->
                            <ul class="flex flex-col text-sm">
                                <li><img src="<?= htmlspecialchars($product['product_image']); ?>" alt="sản phẩm"></li>
                                <li>
                                    <ul class="flex flex-row">
                                        <li><p class="font-bold h-10 mt-3"><?= htmlspecialchars($product['name']); ?></p></li>
                                    </ul>
                                </li>
                                <li class="flex flex-row space-x-10 items-center text-gray-600">
                                    <?= htmlspecialchars($product['color_name']); ?>
                                </li>
                                <li class="flex flex-row space-x-2 items-center">
                                    <p class="font-medium justify-start pb-2"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</p>
                                </li>
                                <li class="flex space-x-2 items-center">
                                    <form method="POST" action="/deleteloveitem/submit">
                                        <input type="hidden" id="product_item_id" name="product_item_id" value="<?= htmlspecialchars($product['product_item_id']); ?>">
                                        <button type="submit" id="heartButton" class="w-11 h-10 flex border bg-black border-gray-300 rounded-md items-center justify-center hover:scale-105" onclick="toggleHeart(this)">
                                            <img src="/img/gio_hang_bin.png" alt="heart" class="heart-icon"/>
                                        </button>
                                    </form>
                                    <button type="button" onclick="location.href='/product_list/detail/<?= htmlspecialchars($product['product_item_id']); ?>'" class="ML_button">Mua ngay</button>
                                </li>
                            </ul>
                        <?php endforeach; ?>
                    </col2>
                </row2><!--end row2-->
                <row3 class="flex flex-row items-center justify-center">
                    <col32 class="w-full lg:w-4/6 items-center justify-center">
                        <row2 class="flex flex-row items-center justify-center space-x-3 my-20">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg> 
                                    </button>
                                </a>
                            <?php endif; ?>

                            <div class="text-sm"><?php echo $page; ?> of <?php echo $total_pages; ?></div>

                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </a>
                            <?php endif; ?>
                        </row2><!--end row2-->
                    </col32>
                </row3>
            </main><!-- end main -->

            <?php
                include 'footer.php';
            ?>
        </div><!-- end content -->
    </div><!-- end root -->
    <script src="/assets/js/header.js"></script>
</body>
</html>