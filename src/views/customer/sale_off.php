<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/assets/css/output.css" rel="stylesheet">
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
                <row1 class="font-BeVietnam font-bold text-2xl  pl-5 sm:pl-10 lg:pl-40 uppercase mt-14">
                    Sale-off
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
                                <li><img src="<?= htmlspecialchars($product['product_image']); ?>" alt="sản phẩm 1"></li>
                                <li>
                                    <ul class="flex flex-row">
                                        <li><p class="font-bold h-12 mt-3"><?= htmlspecialchars($product['name']); ?></p></li>
                                    </ul>
                                </li>
                                <li class="text-gray-600"><?= htmlspecialchars($product['color_name']); ?></li>
                                <li class="text-gray-600"><p style="text-decoration: line-through;" class="font-medium justify-start"><?= htmlspecialchars(number_format($product['price']/0.9, 0, ',', '.')); ?> VNĐ</p></li>
                                <li class="flex flex-row items-center justify-between w-full">
                                    <p class="font-medium"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</p>
                                    <button type="button" onclick="location.href='/product_list/detail/<?= htmlspecialchars($product['product_item_id']); ?>'" class="ML_button pr-0">Mua ngay</button>
                                </li>
                            </ul>
                        <?php endforeach; ?>
                    </col2>
                </row2><!--end row2-->
            </main><!-- end main -->

            <?php
                include 'footer.php';
            ?>
        </div><!-- end content -->
    </div><!-- end root -->
    <script src="/assets/js/header.js"></script>
</body>
</html>