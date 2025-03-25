<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Kiểm tra quyền truy cập
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /'); // Chuyển hướng nếu không phải admin hoặc chưa đăng nhập
        exit(); // Dừng thực thi mã sau chuyển hướng
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/output.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
</head>
<body>
    <div class="root">
        <div class="content-wrapper font-BeVietnam max-w-screen-2xl text-base">
            <main class="flex flex-row bg-black">
                <col1 class="bg-Cam_Ananas text-white w-ful sm:w-1/4 md:w-1/5 flex flex-col pb-10">
                    <div class="px-8 py-4">
                        <ul class="flex flex-row items-center space-x-2">
                            <li><img src="/img/ananas_logo.png" alt="logo" class="h-16 w-auto"></li>
                        </ul>
                    </div>
                    <div class="flex flex-col space-y-11 pt-10 pl-8">
                        <a class="flex flex-row space-x-3" href="/dashboard">
                            <img src="/img/donhang_dashboard.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Dashboard</p>
                        </a>
                        <a href="/order" class="flex flex-row space-x-3">
                            <img src="/img/donhang_dh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Đơn hàng</p>
                        </a>
                        <a href="/products" class="flex flex-row space-x-3">
                            <img src="/img/donhang_sp.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Sản phẩm</p>
                        </a>
                        <a href="/customers" class="flex flex-row space-x-3 ">
                            <img src="/img/donhang_kh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khách hàng</p>
                        </a>
                        <a href="/promotion" class="flex flex-row space-x-3 ">
                            <img src="/img/donhang_km.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khuyến mãi</p>
                        </a>
                        <a href="/blog" class="flex flex-row space-x-3 bg-green-600 rounded-md p-2">
                            <img src="/img/donhang_blog.png" alt="dashboard_icon" class="h-6 w-6">
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
                        <button><img src="/img/donhang_notifi.png" alt="notification"></button>
                        <button><img src="/img/donhang_ava.png" alt="avarta"></button>
                    </row1><!--end row1-->
                    <row2 class="flex items-center pl-4">
                        <div class="text-2xl">Blog</div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>                              
                        </div>
                        <div class="text-gray-500">Chỉnh sửa</div>
                    </row2>
                    <row3 class="flex flex-col px-4 space-y-4 text-black">
                        <form method="POST" action="/blog/submitupdate?blog_id=<?= htmlspecialchars($data['blog_id']); ?>" enctype="multipart/form-data">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-300 mb-1">
                                    Trạng thái
                                </label>
                                <select id="status" name="status" class="rounded-md w-20 p-2 ">
                                    <option value="show" <?= $data['status'] === 'show' ? 'selected' : ''; ?>>Hiện</option>
                                    <option value="hide" <?= $data['status'] === 'hide' ? 'selected' : ''; ?>>Ẩn</option>
                                </select>
                            </div>

                            <div class="">
                                <label for="blog_cate" class="block text-sm font-medium text-gray-300 mb-1">
                                    Danh mục
                                </label>
                                <input 
                                    id="blog_cate" 
                                    name="blog_cate" 
                                    type="text" 
                                    autocomplete="off"
                                    value="<?= htmlspecialchars($data['blog_cate']); ?>"
                                    required
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                >
                            </div>
                            <div class="">
                                <label for="blog_name" class="block text-sm font-medium text-gray-300 mb-1">
                                    Tiêu đề
                                </label>
                                <input 
                                    id="blog_name" 
                                    name="blog_name"
                                    type="text" 
                                    autocomplete="off"
                                    value="<?= htmlspecialchars($data['blog_name']); ?>"
                                    required
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                >
                            </div>
                            <div class="">
                                <label for="main_image" class="block text-sm font-medium text-gray-300 mb-1">
                                Tải lên ảnh
                                </label>
                                
                                <!-- Hai input chọn ảnh -->
                                <div class="flex space-x-4">
                                <div>
                                    <input 
                                    id="main_image" 
                                    name="main_image" 
                                    type="file" 
                                    accept="image/*" 
                                    class="w-full px-4 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    onchange="previewImage(event, 'main-image-preview')">
                                </div>
                                <div>
                                    <input 
                                    id="sub_image" 
                                    name="sub_image" 
                                    type="file" 
                                    accept="image/*"
                                    class="w-full px-4 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring focus:ring-blue-400"
                                    onchange="previewImage(event, 'sub-image-preview')">
                                </div>
                                </div>
                                <!--hai alt cho ảnh-->
                                    <div class="">
                                        <label for="alt_main_img" class="block text-sm font-medium text-gray-300 mb-1">
                                            Alt cho hình 1
                                        </label>
                                        <input 
                                            id="alt_main_img" 
                                            name="alt_main_img"
                                            type="text" 
                                            autocomplete="off"
                                            value="<?= htmlspecialchars($data['alt_main_img']); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                        >
                                    </div>
                                    <div class="">
                                        <label for="alt_sub_img" class="block text-sm font-medium text-gray-300 mb-1">
                                            Alt cho hình 2
                                        </label>
                                        <input 
                                            id="alt_sub_img" 
                                            name="alt_sub_img"
                                            type="text" 
                                            autocomplete="off"
                                            value="<?= htmlspecialchars($data['alt_sub_img']); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                        >
                                    </div>
                                <!-- Khung hiển thị ảnh -->
                                <div class="flex mt-4 space-x-4 border border-gray-300 p-4 rounded-md">
                                    <img 
                                        id="main-image-preview" 
                                        src="<?= htmlspecialchars($data['main_image']); ?>" 
                                        alt="Xem trước ảnh chính" 
                                        class="w-48 h-48 object-cover rounded-md <?= empty($data['main_image']) ? 'hidden' : '' ?>">
                                    <img 
                                        id="sub-image-preview" 
                                        src="<?= htmlspecialchars($data['sub_image']); ?>" 
                                        alt="Xem trước ảnh phụ" 
                                        class="w-48 h-48 object-cover rounded-md <?= empty($data['sub_image']) ? 'hidden' : '' ?>">
                                </div>
                            </div>
                            <!--script để hiển thị hình ảnh xem trước khi đăng-->
                            <script>
                                function previewImage(event, previewId) {
                                    const file = event.target.files[0]; // Lấy file từ input
                                    if (file) {
                                        const reader = new FileReader(); // Sử dụng FileReader để đọc file
                                        reader.onload = function (e) {
                                        const img = document.getElementById(previewId);
                                        img.src = e.target.result; // Gán ảnh vào thẻ <img>
                                        img.classList.remove('hidden'); // Hiển thị ảnh
                                        };
                                        reader.readAsDataURL(file); // Đọc file dưới dạng Data URL
                                    }
                                }
                            </script>
                            
                            <div class="">
                                <label for="description" class="block text-sm font-medium text-gray-300 mb-1">
                                    Mô tả
                                </label>
                                <input 
                                    id="description" 
                                    name="description" 
                                    type="text" 
                                    autocomplete="off"
                                    value="<?= htmlspecialchars($data['description']); ?>"
                                    required
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                >
                            </div>
                            <div class="">
                                <label for="summary" class="block text-sm font-medium text-gray-300 mb-1">
                                    Summary
                                </label>
                                <input 
                                    id="summary" 
                                    name="summary" 
                                    type="text" 
                                    autocomplete="off"
                                    value="<?= htmlspecialchars($data['summary']); ?>"
                                    required
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                >
                            </div>
                            <div class="">
                                <label for="main_content" class="block text-sm font-medium text-gray-300 mb-1">
                                    Nội dung
                                </label>
                                <textarea 
                                    id="main_content" 
                                    name="main_content"
                                    rows="10"
                                    class="w-full border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                >
                                    <?= htmlspecialchars($data['main_content']); ?>
                                </textarea>
                            </div>
                            <div>
                                <label for="alias" class="block text-sm font-medium text-gray-300 mb-1">
                                    Alias
                                </label>
                                <input 
                                    id="alias" 
                                    name="alias" 
                                    type="text" 
                                    autocomplete="off"
                                    value="<?= htmlspecialchars($data['alias']); ?>"
                                    required
                                    class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                >
                            </div>
                            <!--nhập keyword-->
                            <div class="flex space-x-4">
                                <div class="">
                                    <label for="keyword_1" class="block text-sm font-medium text-gray-300 mb-1">
                                        Keyword
                                    </label>
                                    <div class="flex space-x-2">
                                        <input 
                                            id="keyword_1" 
                                            name="keyword_1"
                                            type="text" 
                                            autocomplete="off"
                                            value="<?= htmlspecialchars($data['keyword_1']); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                        >
                                        <input 
                                            id="keyword_2" 
                                            name="keyword_2"
                                            type="text" 
                                            autocomplete="off"
                                            value="<?= htmlspecialchars($data['keyword_2']); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                        >
                                        <input 
                                            id="keyword_3" 
                                            name="keyword_3"
                                            type="text" 
                                            autocomplete="off"
                                            value="<?= htmlspecialchars($data['keyword_3']); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                        >
                                        <input 
                                            id="keyword_4" 
                                            name="keyword_4"
                                            type="text" 
                                            autocomplete="off"
                                            value="<?= htmlspecialchars($data['keyword_4']); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                        >
                                        <input 
                                            id="keyword_5" 
                                            name="keyword_5"
                                            type="text" 
                                            autocomplete="off"
                                            value="<?= htmlspecialchars($data['keyword_5']); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-400 input-field"
                                        >
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($error)): ?>
                                <div style="color: red;"><?= htmlspecialchars($error); ?></div>
                            <?php endif; ?>
                            <div class="flex justify-end space-x-2 pt-4">
                                <button type="submit" id="save-button" class="ML_button w-32 cursor-not-allowed" disabled>
                                    Lưu
                                </button>
                                <a href="/blog"><button type="button" class="bg-white text-black border border-black w-32 text-center font-medium px-2 py-2 rounded focus:outline-none transition-all duration-300 ease-in-out">
                                    Hủy
                                </button></a>
                            </div>
                        </form>
                    </row3>
                </col2><!--end col2-->
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fields = document.querySelectorAll('.input-field');
            const saveButton = document.getElementById('save-button');
            const initialValues = Array.from(fields).map(field => field.value);

            ClassicEditor.create(document.getElementById('main_content'))
                .then(editor => {
                    const form = document.querySelector('form');

                    // Đồng bộ dữ liệu từ CKEditor vào textarea
                    form.addEventListener('submit', () => {
                        document.getElementById('main_content').value = editor.getData();
                    });

                    // Cập nhật initialValues cho CKEditor
                    initialValues.push(editor.getData());

                    // Kích hoạt validateFields khi CKEditor thay đổi
                    editor.model.document.on('change:data', () => {
                        validateFields();
                    });
                })
                .catch(error => {
                    console.error(error);
                });

            const validateFields = () => {
                const allFilled = Array.from(fields).every(field => field.value.trim() !== '');
                const hasChanges = Array.from(fields).some((field, i) => field.value !== initialValues[i]);
                const editorContent = document.getElementById('main_content').value.trim();

                if (allFilled && hasChanges && editorContent) {
                    saveButton.disabled = false;
                    saveButton.classList.remove('cursor-not-allowed');
                } else {
                    saveButton.disabled = true;
                    saveButton.classList.add('cursor-not-allowed');
                }
            };

            fields.forEach(field => {
                field.addEventListener('input', validateFields);
            });
        });

    </script>
</body>
</html>