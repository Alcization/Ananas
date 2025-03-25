<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="output.css" rel="stylesheet">
</head>
<body>
    <script>
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('success')) {
        alert('Thêm sản phẩm thành công');
      }
    </script>
    <div class="root">
        <div class="content-wrapper font-BeVietnam max-w-screen-2xl text-base">
            <main class="flex flex-row">
                <col1 class="bg-Cam_Ananas text-white w-ful sm:w-1/4 md:w-1/5 flex flex-col pb-10">
                    <div class="px-8 py-4">
                        <ul class="flex flex-row items-center space-x-2">
                            <li><img src="/img/ananas_logo.png" alt="logo" class="h-16 w-auto"></li>
                        </ul>
                    </div>
                    <div class="flex flex-col space-y-11 pt-10 pl-8">
                        <a class="flex flex-row space-x-3" href="/dashboard">
                            <img src="img/donhang_dashboard.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Dashboard</p>
                        </a>
                        <a href="/order" class="flex flex-row space-x-3">
                            <img src="img/donhang_dh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Đơn hàng</p>
                        </a>
                        <a href="/products" class="flex flex-row space-x-3 bg-green-600 rounded-md p-2">
                            <img src="img/donhang_sp.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Sản phẩm</p>
                        </a>
                        <a href="/customers" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_kh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khách hàng</p>
                        </a>
                        <a href="/promotion" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_km.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khuyến mãi</p>
                        </a>
                        <a href="/blog" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_blog.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Blog</p>
                        </a> 
                        <a href="\logout" class="flex justify-center">
                            <button class="border rounded-md bg-white text-black p-2">Đăng xuất</button>
                        </a>
                        <a href="#" class="flex flex-row space-x-3 pt-40">
                        </a> 
                    </div>
                    </ul>
                </col1><!--end col1-->
                <col2 class="bg-back_admin text-white w-4/5 space-y-8 flex flex-col">
                    <row1 class="flex justify-end pr-4 pt-4 space-x-3">
                    </row1><!--end row1-->
                    <row2 class="flex items-center pl-4">
                        <div class="text-2xl">Sản phẩm</div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>                              
                        </div>
                        <div class="text-gray-500">Danh sách sản phẩm</div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>                              
                        </div>
                        <div class="text-gray-500">Thêm sản phẩm</div>
                    </row2>
                    <row3 class="flex flex-col px-4 space-y-4 text-black">
                        
                        <form method="POST" action="/addproduct/submit">
                            <div class="">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Tên sản phẩm *
                                </label>
                                <input 
                                    name="product_name" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    required
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product-image" class="block text-sm font-medium text-gray-300 mb-1">
                                    Link ảnh *
                                </label>
                                <input 
                                    name="product_image" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    required
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product_description" class="block text-sm font-medium text-gray-300 mb-1">
                                    Mô tả sản phẩm *
                                </label>
                                <input
                                    name="product_description" 
                                    type="text" 
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 resize-none"
                                    required
                                ></input>
                            </div>
                            <div class="mt-2">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Giá sản phẩm *
                                </label>
                                <input 
                                    name="product_price" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    required
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product-size" class="block text-sm font-medium text-gray-300 mb-1">
                                    Size nhỏ nhất (39&lt;size&lt;44) *
                                </label>
                                <input 
                                    id="smallest_size"
                                    name="smallest_size" 
                                    type="number" 
                                    min="39"
                                    max="44"
                                    onkeydown="return false"
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    required
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product-size" class="block text-sm font-medium text-gray-300 mb-1">
                                    Size lớn nhất (39&lt;size&lt;44) *
                                </label>
                                <input 
                                    id="biggest_size"
                                    name="biggest_size" 
                                    type="number" 
                                    min="39"
                                    max="44"
                                    onkeydown="return false"
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    required
                                >
                            </div>

                            <div class="mt-2">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Tên màu sắc cho sản phẩm màu <span style="color: #efece1;">trắng</span> *
                                </label>
                                <input 
                                    name="color_white" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    required
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Tên màu sắc cho sản phẩm màu <span style="color: #808080;">đen</span>
                                </label>
                                <input 
                                    name="color_black" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Tên màu sắc cho sản phẩm màu <span style="color: #f5f5dc;">be</span>
                                </label>
                                <input 
                                    name="color_beige" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Tên màu sắc cho sản phẩm màu <span style="color: #d6ba73;">nâu</span>
                                </label>
                                <input 
                                    name="color_brown" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                >
                            </div>
                            <div class="mt-2">
                                <label for="product-name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Tên màu sắc cho sản phẩm màu <span style="color: #00ffff;">xanh dương</span>
                                </label>
                                <input 
                                    name="color_blue" 
                                    type="text" 
                                    autocomplete="off"
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                >
                            </div>

                            <?php if (isset($error)): ?>
                                <div class="error" style="color: white"><?= htmlspecialchars($error); ?></div>
                            <?php endif; ?>
                            
                            <div class="flex justify-end space-x-2 mt-6">
                                <button type="submit" class="ML_button w-32">Lưu</button>
                                <button type="button" onclick="location.href='/products'" class="bg-white text-black border border-black w-32 text-center font-medium px-2 py-2 rounded focus:outline-none transition-all duration-300 ease-in-out">
                                    Hủy
                                </button>
                            </div>
                        </form>
                    </row3>
                </col2><!--end col2-->
            </main>
        </div>
    </div>
</body>
</html>