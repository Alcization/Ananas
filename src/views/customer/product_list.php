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
            
            <main class="flex flex-col">
                <row1 class="font-BeVietnam font-bold text-2xl  pl-5 sm:pl-10 lg:pl-40 uppercase mt-20">
                    Sản phẩm
                </row1> <!--end row1-->
                <row2 class="flex flex-row mt-16">

                <div class="relative lg:hidden">
    <!-- Nút bấm cho màn hình nhỏ -->
    <button 
        id="toggle-col1" 
        class="lg:hidden ML_button">
        Bộ lọc
    </button>

    <!-- Phần tử col1 -->
    <col1 id="filter-menu" class="fixed top-0 left-0 z-50 w-full h-full bg-white p-6 space-y-5 transform -translate-x-full transition-transform duration-300 lg:transform-none lg:static lg:block">
        <!-- Close button for mobile -->
        <button 
            id="close-filter-menu" 
            class="absolute top-4 right-4 text-gray-600 bg-gray-200 p-2 rounded-full lg:hidden">
            &times;
        </button>

        <div class="font-BeVietnam font-bold ML_text_cam">
                            Dòng sản phẩm
                        </div>
                        <ul class="space-y-5 pl-6">
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Basas" class="ML_button_select">Basas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Vintas" class="ML_button_select">Vintas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Urbas" class="ML_button_select">Urbas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Pattas" class="ML_button_select">Pattas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Track 6" class="ML_button_select">Track 6</button>
                                </li>
                            </form>

                        </ul>
                        <div class="font-BeVietnam font-bold ML_text_cam">
                            Giá
                        </div>
                            <ul class="space-y-5 pl-6">
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                                <input type="hidden" name="price[]" value=">700k" class="form-checkbox h-5 w-5">
                                                <label class="font-BeVietnam">> 700k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                            <input type="hidden" name="price[]" value="500-699k" class="form-checkbox h-5 w-5">
                                            <label class="font-BeVietnam">500k - 699k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit"  class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                            <input type="hidden" name="price[]" value="300-499k" class="form-checkbox h-5 w-5">
                                            <label class="font-BeVietnam">300k - 499k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                            <input type="hidden" name="price[]" value="<300k" class="form-checkbox h-5 w-5">
                                            <label class="font-BeVietnam">< 300k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        <div class="font-BeVietnam font-bold ML_text_cam mt-1">
                            Màu sắc
                        </div>
                        <div class="flex flex-col space-y-3">

                            <ul class="space-y-5 pl-6">
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#efece1" class="bg-white text-black border shadow-sm rounded p-2 w-36 hover:scale-105" >Trắng</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#14130f" class="bg-black text-white border shadow-sm rounded p-2 w-36 hover:scale-105">Đen</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#00ffff" class="bg-blue-500 text-white border shadow-sm p-2 rounded w-36 hover:scale-105">Xanh dương</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#f5f5dc" class="bg-be p-2 border shadow-sm rounded w-36 hover:scale-105">Be</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#d6ba73" class="bg-nau text-white border shadow-sm p-2 rounded w-36 hover:scale-105">Nâu</button>
                                    </li>
                                </form>
                            </ul>

                            <div class="pl-6">
                                <button type="button" onclick="location.href='/product_list'" class="bg-red-500 text-white p-2 rounded mt-10 flex hover:shadow-md hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Loại bỏ bộ lọc
                                </button>
                            </div>
                        </div>
    </col1>
</div>

<script>
    const toggleButton = document.getElementById('toggle-col1');
    const closeButton = document.getElementById('close-filter-menu');
    const filterMenu = document.getElementById('filter-menu');

    toggleButton.addEventListener('click', () => {
        filterMenu.classList.toggle('-translate-x-full');
    });

    closeButton.addEventListener('click', () => {
        filterMenu.classList.add('-translate-x-full');
    });
</script>


                    <col1 class="w-2/6 pl-40 space-y-5 hidden lg:block">
                        <div class="font-BeVietnam font-bold ML_text_cam">
                            Dòng sản phẩm
                        </div>
                        <ul class="space-y-5 pl-6">
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Basas" class="ML_button_select">Basas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Vintas" class="ML_button_select">Vintas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Urbas" class="ML_button_select">Urbas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Pattas" class="ML_button_select">Pattas</button>
                                </li>
                            </form>
                            <form method="GET" action="">
                                <li class="">
                                    <button type="submit" name="name" value="Track 6" class="ML_button_select">Track 6</button>
                                </li>
                            </form>

                        </ul>
                        <div class="font-BeVietnam font-bold ML_text_cam">
                            Giá
                        </div>
                            <ul class="space-y-5 pl-6">
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                                <input type="hidden" name="price[]" value=">700k" class="form-checkbox h-5 w-5">
                                                <label class="font-BeVietnam">> 700k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                            <input type="hidden" name="price[]" value="500-699k" class="form-checkbox h-5 w-5">
                                            <label class="font-BeVietnam">500k - 699k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit"  class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                            <input type="hidden" name="price[]" value="300-499k" class="form-checkbox h-5 w-5">
                                            <label class="font-BeVietnam">300k - 499k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" class="ML_button_select">
                                            <div class="flex items-center space-x-2">
                                            <input type="hidden" name="price[]" value="<300k" class="form-checkbox h-5 w-5">
                                            <label class="font-BeVietnam">< 300k</label>
                                            </div>
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        <div class="font-BeVietnam font-bold ML_text_cam mt-1">
                            Màu sắc
                        </div>
                        <div class="flex flex-col space-y-3">

                            <ul class="space-y-5 pl-6">
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#efece1" class="bg-white text-black border shadow-sm rounded p-2 w-36 hover:scale-105" >Trắng</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#14130f" class="bg-black text-white border shadow-sm rounded p-2 w-36 hover:scale-105">Đen</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#00ffff" class="bg-blue-500 text-white border shadow-sm p-2 rounded w-36 hover:scale-105">Xanh dương</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#f5f5dc" class="bg-be p-2 border shadow-sm rounded w-36 hover:scale-105">Be</button>
                                    </li>
                                </form>
                                <form method="GET" action="">
                                    <li class="">
                                        <button type="submit" name="color" value="#d6ba73" class="bg-nau text-white border shadow-sm p-2 rounded w-36 hover:scale-105">Nâu</button>
                                    </li>
                                </form>
                            </ul>

                            <div class="pl-6">
                                <button type="button" onclick="location.href='/product_list'" class="bg-red-500 text-white p-2 rounded mt-10 flex hover:shadow-md hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Loại bỏ bộ lọc
                                </button>
                            </div>
                        </div>
                    </col1>
                    <col2 class="w-full lg:w-4/6 grid grid-cols-2 sm:grid-cols-3 gap-7 px-16 items-center justify-center">
                    <?php 
                        $products_all = $data;
                        $product_per_page = 12;
                        $start_index = 0;


                        $filtered_products = [];

                        if (isset($_GET['price'])) {
                            $price_ranges = $_GET['price'];
                            foreach ($products_all as $product) {
                                $price = $product['price'];
                                foreach ($price_ranges as $range) {
                                    if ($range == '>700k' && $price > 700000) {
                                        $filtered_products[] = $product;
                                    } elseif ($range == '500-699k' && $price >= 500000 && $price <= 699999) {
                                        $filtered_products[] = $product;
                                    } elseif ($range == '300-499k' && $price >= 300000 && $price <= 499999) {
                                        $filtered_products[] = $product;
                                    } elseif ($range == '<300k' && $price < 300000) {
                                        $filtered_products[] = $product;
                                    }                             
                                }
                            }
                        } elseif (isset($_GET['name'])) {
                            $name_filter = $_GET['name'];
                            foreach ($products_all as $product) {
                                if (stripos($product['name'], $name_filter) !== false) {
                                    $filtered_products[] = $product;
                                }
                            }
                        } elseif (isset($_GET['color'])) {
                            $color_filter = $_GET['color'];
                            foreach ($products_all as $product) {
                                if ($product['color_code'] == $color_filter) {
                                    $filtered_products[] = $product;
                                }
                            }
                        } else {
                            $filtered_products =  $products_all;
                        }

                        $total_products = count($filtered_products);
                        $total_pages = ceil($total_products / $product_per_page);
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $start = ($page - 1) * $product_per_page;
                        $products= array_slice($filtered_products, $start, $product_per_page);

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
                            <li class="flex flex-row items-center justify-between w-full">
                                <p class="font-medium"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</p>
                                <button type="button" onclick="location.href='/product_list/detail/<?= htmlspecialchars($product['product_item_id']); ?>'" class="ML_button pr-0">Mua ngay</button>
                            </li>
                        </ul>
                    <?php endforeach; ?>

                    </col2>
                </row2><!--end row2-->
                <row3 class="flex flex-row">
                    <col31 class="w-2/6 hidden lg:block">
                    </col31>
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