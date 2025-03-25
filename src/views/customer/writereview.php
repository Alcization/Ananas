<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../output.css" rel="stylesheet">
</head>
<body> <!--nhớ là responsive cho tablet và phone-->
    <script>
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('success')) {
        alert('Bình luận thành công');
      }
    </script>
    <?php
      $product = $data['product']; 
    ?>
    <div class="root">
        <div class="content-wrapper font-BeVietnam max-w-screen-2xl text-base items-center justify-center mt-20">
          <form action="/writereview/submit" method="POST">
            <input type="hidden" name="product_item_id" value="<?= htmlspecialchars($product['product_item_id']); ?>">
              <row1 class="flex flex-row px-16">
                  <ul class="flex flex-row items-center space-x-3">
                      <li><img class="w-32 h-32" src="<?= htmlspecialchars($product['product_image']); ?>" alt="sản phẩm"></li>
                      <li class="space-y-3">
                          <p class="font-bold"><?= htmlspecialchars($product['name']); ?> - <?= htmlspecialchars($product['color_name']); ?></p>
                          <p class="text-Cam_Ananas"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</p>
                      </li>
                  </ul>
              </row1><!--end row1-->
              <row2>
                  <ul class="flex flex-col">
                      <li>
                          <div class="mt-4 items-center justify-center flex flex-row space-x-3">
                              <div id="stars-container" class="flex justify-center">
                                  <!-- 5 ngôi sao -->
                                  <span data-value="1" class="star text-gray-400 text-5xl hover:text-orange-500 cursor-pointer">★</span>
                                  <span data-value="2" class="star text-gray-400 text-5xl hover:text-orange-500 cursor-pointer">★</span>
                                  <span data-value="3" class="star text-gray-400 text-5xl hover:text-orange-500 cursor-pointer">★</span>
                                  <span data-value="4" class="star text-gray-400 text-5xl hover:text-orange-500 cursor-pointer">★</span>
                                  <span data-value="5" class="star text-gray-400 text-5xl hover:text-orange-500 cursor-pointer">★</span>
                              </div>
                              <p id="rating-text" class="mt-2 text-base font-BeVietnam text-gray-600">0 / 5</p>
                          </div>
                          <input type="hidden" name="rating" id="rating-input" value="0">
                          <script>
                              // Lấy các ngôi sao và phần hiển thị đánh giá
                              const stars = document.querySelectorAll('.star');
                              const ratingText = document.getElementById('rating-text');
                              const ratingInput = document.getElementById('rating-input');
                            
                              // Biến để theo dõi số sao đã chọn
                              let currentRating = 0;
                            
                              // Thêm sự kiện click vào từng ngôi sao
                              stars.forEach((star, index) => {
                                star.addEventListener('click', () => {
                                  const rating = index + 1; // Số sao được chọn
                            
                                  // Nếu người dùng click vào sao chưa chọn thì chọn sao đó
                                  if (currentRating !== rating) {
                                    currentRating = rating; // Chọn sao
                                    updateStars(currentRating); // Cập nhật giao diện sao
                                    ratingText.textContent = `${currentRating} / 5`; // Cập nhật số sao
                                    ratingInput.value = currentRating; // Cập nhật giá trị input ẩn
                                  }
                                });
                              });
                            
                              // Cập nhật giao diện ngôi sao
                              function updateStars(rating) {
                                stars.forEach((star, index) => {
                                  if (index < rating) {
                                    // Sao được chọn, màu cam
                                    star.classList.remove('text-gray-400');
                                    star.classList.add('text-orange-500');
                                  } else {
                                    // Sao chưa chọn, màu xám
                                    star.classList.remove('text-orange-500');
                                    star.classList.add('text-gray-400');
                                  }
                                });
                              }
                          </script>
                      </li><!--end li 1-->
                      <li class="mt-5 px-56">
                          <label class="block">
                              <span class="block">Nội dung:</span>
                              <textarea name="content" class="w-full h-40 mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-gray-600 focus:ring-gray-700 block rounded-md sm:text-sm focus:ring-1"></textarea>
                          </label>
                      </li><!--end li 2-->
                  </ul>
              </row2><!--end row2-->
              <row3>
                  <ul>
                      <li class=" flex flex-row justify-center mt-24 space-x-2">
                          <!-- Nút Hủy: Nền trắng, viền đen, không có hiệu ứng hover -->
                          <button type="button" onclick="location.href='/product_list/detail/<?= htmlspecialchars($product['product_item_id']); ?>'" class="bg-white text-black border border-black w-32 text-center font-medium px-2 py-2 rounded focus:outline-none transition-all duration-300 ease-in-out">
                              Hủy
                          </button>
                          <!-- Nút Đăng: Nền cam, chữ trắng và hiệu ứng hover -->
                          <button type="submit" class="ML_button w-32">Đăng</button>
                      </li><!--end li 4-->
                  </ul>
              </row3><!--end row3-->
          </form>
        </div><!-- end content -->
    </div><!-- end root -->
</body>
</html>