<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Product_detail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/assets/css/output.css" rel="stylesheet">
</head>
<body>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('success')) {
    alert('Thêm hàng hóa vào giỏ hàng thành công');
  }
</script>
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

            <?php
                $product = $data['product'];
                $color = $data['color'];
                $size = $data['size'];
                $description = $data['description'];
                $review = $data['review'];
            ?>
            
            <main class="flex flex-col mx-64 pt-20">
                <row1 class="flex flex-wrap lg:flex-row space-x-2 lg:space-x-4">
                  <col1 class="w-full lg:w-auto flex items-center justify-center">
                    <img src="<?= htmlspecialchars($product['product_image']); ?>" class="w-full h-auto max-w-xs sm:max-w-sm lg:max-w-lg" alt="product">
                  </col1>
                  <col2 class="w-full lg:w-auto mt-4 lg:mt-0">
                    <div class="pt-6">
                      <form method="POST" action="/detail/submit">
                        <!-- Màu sắc -->
                        <input type="hidden" id="user_id" name="user_id" value="<?= htmlspecialchars($user_id); ?>">
                        <input type="hidden" id="product_id" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">
              
                        <div class="flex flex-col space-y-2">
                          <label class="font-semibold text-gray-800">Màu sắc</label>
                          <select name="color_id" id="color" class="w-30 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                            <?php foreach ($color as $c) { ?>
                              <option value="<?= htmlspecialchars($c['color_id']); ?>"><?= htmlspecialchars($c['color_name']); ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      
                        <!-- Kích cỡ -->
                        <div class="flex flex-col space-y-2 mt-4">
                          <label class="font-semibold text-gray-800">Kích cỡ</label>
                          <select name="size_id" id="size" class="w-30 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500">
                            <?php foreach ($size as $s) { ?>
                              <option value="<?= htmlspecialchars($s['size_id']); ?>"><?= htmlspecialchars($s['size_value']); ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      
                        <!-- Số lượng -->
                        <div class="flex flex-col space-y-2 mt-4 mb-4">
                          <label class="font-semibold text-gray-800">Số lượng</label>
                          <div class="flex items-center space-x-3">
                            <button type="button" id="decrease" class="px-2 py-1 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-200">-</button>
                            <input type="text" id="quantity" name="quantity" value="1" class="text-center w-6 text-gray-800 font-medium border border-gray-300 rounded-md" readonly>
                            <button type="button" id="increase" class="px-2 py-1 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-200">+</button>
                          </div>
                        </div>
                          
                        <script>
                          const decreaseButton = document.getElementById('decrease');
                          const increaseButton = document.getElementById('increase');
                          const quantityInput = document.getElementById('quantity');

                          let quantity = 1;

                          decreaseButton.addEventListener('click', () => {
                            if (quantity > 1) {
                              quantity--;
                              quantityInput.value = quantity;
                            }
                          });

                          increaseButton.addEventListener('click', () => {
                            quantity++;
                            quantityInput.value = quantity;
                          });
                        </script>
                      
                        <!-- Thêm vào giỏ hàng -->
                        <div class="flex items-center space-x-4 mt-6 md:mt-0">
                          <button type="submit" class="ML_button ML_button:hover">
                            Thêm vào giỏ hàng
                          </button>
                      </form>
                          <form method="POST" action="/addloveitem/submit">
                            <input type="hidden" id="product_item_id" name="product_item_id" value="<?= htmlspecialchars($product['product_item_id']); ?>">
                            <button type="submit" id="heartButton" class="w-11 h-10 flex border border-gray-300 rounded-md items-center justify-center" onclick="toggleHeart(this)">
                              <img src="/img/prd_list_heart.png" alt="heart" class="heart-icon"/>
                            </button>
                          </form>
                        </div>
                    </div>
                  </col2>
                </row1><!--end row1-->
                <row2 class="mt-4">
                    <ul>
                        <li class="font-bold text-2xl"><?= htmlspecialchars($product['name']); ?></li>
                        <li class="mt-1">Màu sắc: <?= htmlspecialchars($product['color_name']); ?></li>
                        <li class="font-bold text-Cam_Ananas text-2xl mt-3"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</li>
                    </ul>
                </row2><!--end row2-->
                <row3 class="flex flex-row mt-20 space-x-8 flex-wrap lg:flex-row lg:space-x-4">
                    <col1 class="w-full lg:w-auto">
                        <ul class="space-y-3 pt-6">
                            <li class="font-bold">MÔ TẢ SẢN PHẨM</li>
                            <li>  
                                <ul class="space-y-2 list-disc pl-5">
                                  <?php $sentences = preg_split('/(?<=[.!?])\s+/', $description['description']); 
                                        foreach ($sentences as $sentence): ?>
                                    <li><?= htmlspecialchars($sentence); ?></li>
                                  <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
                    </col1><!--end col1-->
                    <col2 class="w-full lg:w-auto mt-4 lg:mt-0">
                        <ul class="flex flex-col space-y-5 pt-6">
                            <li class="font-bold">ĐÁNH GIÁ</li>
                            <li class="flex flex-row items-center space-x-4">
                                <div id="stars-container" class="flex justify-center">
                                    <!-- Get the average rating of review and display as number of star -->
                                    <?php
                                        $totalRating = 0;
                                        $totalReview = count($review);
                                        foreach ($review as $r) {
                                            $totalRating += $r['rating'];
                                        }
                                        $averageRating = $totalReview > 0 ? round($totalRating / $totalReview) : 0;
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $averageRating) {
                                                echo '<span data-value="' . $i . '" class="star text-Cam_Ananas text-5xl">★</span>';
                                            } else {
                                                echo '<span data-value="' . $i . '" class="star text-gray-400 text-5xl">★</span>';
                                            }
                                        }
                                    ?>
                                </div>
                                <p id="rating-text" class="mt-2 text-base font-BeVietnam text-gray-600"><?= htmlspecialchars($averageRating); ?> / 5</p>
                            </li>
                            <li class="font-bold underline"><a href="/product_list/writereview/<?= htmlspecialchars($product['product_item_id']); ?>" id="write-comment">VIẾT BÌNH LUẬN</a></li>
                            

                            <?php foreach ($review as $index => $r): ?>
                              <li class="<?= $index >= 3 ? 'hidden-review' : ''; ?>">
                                <ul class="flex space-x-64">
                                  <li>
                                    <p class="font-bold text-gray-900"><?= htmlspecialchars($r['user_name']); ?></p>
                                  </li>
                                  <li class="pr-0">
                                    <div id="stars-container" class="flex justify-center">
                                      <!-- 5 ngôi sao -->
                                      <?php for ($i = 1; $i <= $r['rating']; $i++): ?>
                                        <span data-value="<?= $i; ?>" class="star text-Cam_Ananas text-xl">★</span>
                                      <?php endfor; ?>
                                    </div>
                                  </li>
                                </ul>
                                <p class="text-sm text-gray-500"><?= htmlspecialchars((new DateTime($r['created_at']))->format('d/m/Y')); ?></p>
                                <p><?= htmlspecialchars($r['content']); ?></p>
                              </li>
                            <?php endforeach; ?>
                            <li class="flex justify-center">
                              <button id="showMoreButton" class="ML_button flex flex-row justify-center">Hiện thêm</button>
                            </li>

                            <script>
                              document.getElementById('showMoreButton').addEventListener('click', function() {
                                document.querySelectorAll('.hidden-review').forEach(function(review) {
                                  review.style.display = 'block';
                                });
                                this.style.display = 'none';
                              });
                            </script>

                            <style>
                              .hidden-review {
                                display: none;
                              }
                            </style>
                        </ul>
                    </col2><!--end col2-->
                </row3><!--end row3-->
            </main><!-- end main -->

            <?php
                include 'footer.php';
            ?>
        </div><!-- end content -->
    </div><!-- end root -->
</body>

<script src="/assets/js/header.js"></script>
</html>