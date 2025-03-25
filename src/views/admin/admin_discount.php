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
  <link href="assets/css/output.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Title</title>
</head>
<body>
<div class="flex flex-row font-BeVietnam">
<col1 class="bg-Cam_Ananas text-white w-ful sm:w-1/4 md:w-1/5 flex flex-col pb-10">
                    <div class="px-8 py-4">
                        <ul class="flex flex-row items-center space-x-2">
                            <li><img src="img/ananas_logo.png" alt="logo" class="h-16 w-auto"></li>
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
                        <a href="/products" class="flex flex-row space-x-3">
                            <img src="img/donhang_sp.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Sản phẩm</p>
                        </a>
                        <a href="/customers" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_kh.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khách hàng</p>
                        </a>
                        <a href="/promotion" class="flex flex-row space-x-3 bg-green-600 rounded-md p-2">
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
                        <a href="#" class="flex flex-row space-x-3 pt-96">
                        </a>
                    </div>
                    </ul>
                </col1><!--end col1-->

  <div class="w-4/5 bg-[#333333] text-white">
    <div class="w-11/12 mx-auto mt-8">
      <p class="font-bold text-3xl">MÃ KHUYẾN MÃI</p>
    </div>

    <div class="w-11/12 flex flex-col mx-auto mt-8">
      <a href="/promotion/add" class="flex ml-auto mr-0 "><button class="px-5 py-2 bg-Cam_Ananas mb-2 rounded">Thêm</button></a>

      <table class="w-full border-collapse border border-gray-300 text-black bg-white">
        <tr class="border-2">
          <th class="border border-gray-300 w-2/12">Mã khuyến mãi</th>
          <th class="border border-gray-300 w-1/12">Số lượng</th>
          <th class="border border-gray-300 w-1/12">Số lượt dùng còn lại</th>
          <th class="border border-gray-300 w-2/12">Ngày bắt đầu</th>
          <th class="border border-gray-300 w-2/12">Ngày hết hạn</th>
          <th class="border border-gray-300 w-1/12">Giá trị (%)</th>
          <th class="border border-gray-300 w-auto">Ghi chú</th>
          <th class="border border-gray-300 w-2/12">Tùy chọn</th>
        </tr>
        <?php foreach($data as $promotion): ?>
          <tr class="border-2">
            <td class="border border-gray-300"><?= htmlspecialchars($promotion['promotion_code']); ?></td>
            <td class="border border-gray-300"><?= htmlspecialchars($promotion['quantity']); ?></td>
            <td class="border border-gray-300"><?= htmlspecialchars($promotion['remain_quantity']); ?></td>
            <td class="border border-gray-300 mx-auto"><?= htmlspecialchars((new DateTime($promotion['start_date']))->format('d.m.Y')); ?></td>
            <td class="border border-gray-300 mx-auto"><?= htmlspecialchars((new DateTime($promotion['end_date']))->format('d.m.Y')); ?></td>
            <td class="border border-gray-300"><?= htmlspecialchars($promotion['discount_percent']); ?></td>
            <td class="border border-gray-300"><?= htmlspecialchars($promotion['description']); ?></td>
            <td class="flex space-x-5 my-auto ">
              <a href="/promotion/update?promotion_id=<?= htmlspecialchars($promotion['promotion_id']); ?>"><button>Chỉnh sửa</button></a>
              <a href="/promotion/delete?promotion_id=<?= htmlspecialchars($promotion['promotion_id']); ?>"><button>Xóa</button></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>