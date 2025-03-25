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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="/assets/css/output.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Title</title>
</head>
<body>
<div class="flex flex-row font-BeVietnam w-full h-screen">
  <col1 class="bg-Cam_Ananas text-white w-ful sm:w-1/4 md:w-1/5 flex flex-col">
    <div class="py-4 mx-auto">
      <ul class="flex flex-row items-center">
        <li><img src="/img/ananas_logo.png" alt="logo" class="h-16 w-auto"></li>
      </ul>
    </div>
    <div class="flex flex-col space-y-3">
      <a href="/dashboard" class="flex flex-row space-x-3 px-7 py-4">
        <img src="/img/donhang_dashboard.png" alt="dashboard_icon" class="h-6 w-6">
        <p>Dashboard</p>
      </a>
      <a href="/order" class="flex flex-row space-x-3 py-4 px-7">
        <img src="/img/donhang_dh.png" alt="dashboard_icon" class="h-6 w-6">
        <p>Đơn hàng</p>
      </a>
      <a href="/products" class="flex flex-row space-x-3 py-4 px-7">
        <img src="/img/donhang_sp.png" alt="dashboard_icon" class="h-6 w-6">
        <p>Sản phẩm</p>
      </a>
      <a href="/customers" class="flex flex-row space-x-3 py-4 px-7">
        <img src="/img/donhang_kh.png" alt="dashboard_icon" class="h-6 w-6">
        <p>Khách hàng</p>
      </a>
      <a href="/promotion" class="flex flex-row space-x-3 py-4 px-7 bg-green-600">
        <img src="/img/donhang_km.png" alt="dashboard_icon" class="h-6 w-6">
        <p>Khuyến mãi</p>
      </a>
      <a href="/blog" class="flex flex-row space-x-3 py-4 px-7">
        <img src="/img/donhang_blog.png" alt="dashboard_icon" class="h-6 w-6">
        <p>Blog</p>
      </a>
      <a href="\logout" class="flex justify-center">
                            <button class="border rounded-md bg-white text-black p-2">Đăng xuất</button>
                        </a>
    </div>

    <div class="flex-grow">
    </div>

    <div>
      <a href="#" class="flex flex-row space-x-3 py-4 px-7">
      </a>
    </div>
  </col1><!--end col1-->

  <div class="w-4/5 bg-[#333333] text-white">
    <div class="w-11/12 mx-auto mt-8">
      <p class="font-bold text-3xl">MÃ KHUYẾN MÃI > Chỉnh sửa mã khuyến mãi</p>
    </div>

    <div class="w-11/12 flex flex-col mx-auto mt-8">
      <form method="POST" action="/promotion/submitupdate?promotion_id=<?= htmlspecialchars($data['promotion_id']); ?>" class="space-y-3">
        <!--Mã khuyến mãi và số lượng-->
        <div class="flex w-full space-x-3">
          <div class="w-1/2">
            <label for="promotion_code">Mã khuyến mãi:</label><br>
            <input type="text" id="promotion_code" name="promotion_code" value="<?= htmlspecialchars($data['promotion_code']); ?>" class="w-full text-black px-3 py-2 rounded" required><br>
          </div>
          <div class="w-1/2">
            <label for="quantity">Số lượng:</label><br>
            <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($data['quantity']); ?>" class="w-full text-black px-3 py-2 rounded" required><br>
          </div>
          <div class="w-1/2">
            <label for="remain_quantity">Số lượng còn lại:</label><br>
            <input type="number" id="remain_quantity" name="remain_quantity" value="<?= htmlspecialchars($data['remain_quantity']); ?>" class="w-full text-black px-3 py-2 rounded" required><br>
          </div>
        </div>

        <!--Ngày hết hạn và giá trị của mã-->
        <div class="flex w-full space-x-3">
          <div class="w-1/2 ">
            <label for="start_date">Ngày bắt đầu:</label><br>
            <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($data['start_date']); ?>" class="w-full text-black px-3 py-2 rounded"><br>
          </div>
          <div class="w-1/2 ">
            <label for="end_date">Ngày hết hạn:</label><br>
            <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($data['end_date']); ?>" class="w-full text-black px-3 py-2 rounded"><br>
          </div>
          <div class="w-1/2">
            <label for="discount_percent">Giá trị:</label><br>
            <input type="number" id="discount_percent" name="discount_percent" value="<?= htmlspecialchars($data['discount_percent']); ?>" class="w-full text-black px-3 py-2 rounded"><br>
          </div>
        </div>

        <div>
          <label for="description">Ghi chú:</label><br>
          <textarea type="text" id="description" name="description" class="w-full text-black px-3 py-2 rounded"><?= htmlspecialchars($data['description']); ?></textarea>
        </div>
        <?php if (isset($error)): ?>
          <div style="color: red;"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div class="flex mt-5 space-x-3">
          <a href="/promotion"><button type="button" class="py-2 px-5  bg-[#FF4141]  rounded">Hủy</button></a>
          <div class="flex-grow"></div>
          <button type="submit" class="py-2 px-5 bg-green-600 rounded">Lưu</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fields = document.querySelectorAll('.input-field');
        const saveButton = document.getElementById('save-button');

        // Lưu trữ giá trị ban đầu của các input
        const initialValues = Array.from(fields).map(field => field.value);

        // Kiểm tra điều kiện: tất cả ô phải có giá trị và phải có thay đổi
        const validateFields = () => {
            const allFilled = Array.from(fields).every(field => field.value.trim() !== ''); // Kiểm tra tất cả ô có giá trị
            const hasChanges = Array.from(fields).some((field, i) => field.value !== initialValues[i]); // Kiểm tra có sự thay đổi

            if (allFilled && hasChanges) {
                saveButton.disabled = false;
                saveButton.classList.remove('bg-gray-500', 'cursor-not-allowed');
                saveButton.classList.add('bg-[#F15E2C]');
            } else {
                saveButton.disabled = true;
                saveButton.classList.add('bg-gray-500', 'cursor-not-allowed');
                saveButton.classList.remove('bg-[#F15E2C]');
            }
        };

        // Gắn sự kiện `input` để kiểm tra khi người dùng nhập liệu
        fields.forEach(field => {
            field.addEventListener('input', validateFields);
        });

        // Kiểm tra lần đầu khi trang tải
        validateFields();
    });
</script>
</body>
</html>