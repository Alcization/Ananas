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
  <title>Title</title>
  <meta charset="UTF-8">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="/assets/css/output.css" rel="stylesheet">
</head>
<body>
<div class="flex flex-row font-BeVietnam">
  <!-- <div class="w-1/5 bg-Cam_Ananas">
    <div class="flex mx-auto">
      <img src="assets/logo-white.png" alt="Logo" class="h-20 flex mx-auto">
    </div>

    <div class="flex flex-col">
      <a href="/dashboard" class="flex flex-row bg-green-600 px-6 py-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
          <path d="M2 6C2 4.11438 2 3.17157 2.58579 2.58579C3.17157 2 4.11438 2 6 2C7.88562 2 8.82843 2 9.41421 2.58579C10 3.17157 10 4.11438 10 6V8C10 9.88562 10 10.8284 9.41421 11.4142C8.82843 12 7.88562 12 6 12C4.11438 12 3.17157 12 2.58579 11.4142C2 10.8284 2 9.88562 2 8V6Z" stroke="currentColor" stroke-width="1.5" />
          <path d="M2 19C2 18.0681 2 17.6022 2.15224 17.2346C2.35523 16.7446 2.74458 16.3552 3.23463 16.1522C3.60218 16 4.06812 16 5 16H7C7.93188 16 8.39782 16 8.76537 16.1522C9.25542 16.3552 9.64477 16.7446 9.84776 17.2346C10 17.6022 10 18.0681 10 19C10 19.9319 10 20.3978 9.84776 20.7654C9.64477 21.2554 9.25542 21.6448 8.76537 21.8478C8.39782 22 7.93188 22 7 22H5C4.06812 22 3.60218 22 3.23463 21.8478C2.74458 21.6448 2.35523 21.2554 2.15224 20.7654C2 20.3978 2 19.9319 2 19Z" stroke="currentColor" stroke-width="1.5" />
          <path d="M14 16C14 14.1144 14 13.1716 14.5858 12.5858C15.1716 12 16.1144 12 18 12C19.8856 12 20.8284 12 21.4142 12.5858C22 13.1716 22 14.1144 22 16V18C22 19.8856 22 20.8284 21.4142 21.4142C20.8284 22 19.8856 22 18 22C16.1144 22 15.1716 22 14.5858 21.4142C14 20.8284 14 19.8856 14 18V16Z" stroke="currentColor" stroke-width="1.5" />
          <path d="M14 5C14 4.06812 14 3.60218 14.1522 3.23463C14.3552 2.74458 14.7446 2.35523 15.2346 2.15224C15.6022 2 16.0681 2 17 2H19C19.9319 2 20.3978 2 20.7654 2.15224C21.2554 2.35523 21.6448 2.74458 21.8478 3.23463C22 3.60218 22 4.06812 22 5C22 5.93188 22 6.39782 21.8478 6.76537C21.6448 7.25542 21.2554 7.64477 20.7654 7.84776C20.3978 8 19.9319 8 19 8H17C16.0681 8 15.6022 8 15.2346 7.84776C14.7446 7.64477 14.3552 7.25542 14.1522 6.76537C14 6.39782 14 5.93188 14 5Z" stroke="currentColor" stroke-width="1.5" />
        </svg>
        <p class="text-white ml-5">Dashboard</p>
      </a>

      <a href="/order" class="flex flex-row px-6 py-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
          <path d="M8 16L16.7201 15.2733C19.4486 15.046 20.0611 14.45 20.3635 11.7289L21 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          <path d="M6 6H22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          <circle cx="6" cy="20" r="2" stroke="currentColor" stroke-width="1.5" />
          <circle cx="17" cy="20" r="2" stroke="currentColor" stroke-width="1.5" />
          <path d="M8 20L15 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          <path d="M2 2H2.966C3.91068 2 4.73414 2.62459 4.96326 3.51493L7.93852 15.0765C8.08887 15.6608 7.9602 16.2797 7.58824 16.7616L6.63213 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
        </svg>
        <p class="text-white ml-5">Đơn hàng</p>
      </a>

      <a href="/products" class="flex flex-row px-6 py-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
          <path d="M12 22C11.1818 22 10.4002 21.6698 8.83693 21.0095C4.94564 19.3657 3 18.5438 3 17.1613C3 16.7742 3 10.0645 3 7M12 22C12.8182 22 13.5998 21.6698 15.1631 21.0095C19.0544 19.3657 21 18.5438 21 17.1613V7M12 22L12 11.3548" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8.32592 9.69138L5.40472 8.27785C3.80157 7.5021 3 7.11423 3 6.5C3 5.88577 3.80157 5.4979 5.40472 4.72215L8.32592 3.30862C10.1288 2.43621 11.0303 2 12 2C12.9697 2 13.8712 2.4362 15.6741 3.30862L18.5953 4.72215C20.1984 5.4979 21 5.88577 21 6.5C21 7.11423 20.1984 7.5021 18.5953 8.27785L15.6741 9.69138C13.8712 10.5638 12.9697 11 12 11C11.0303 11 10.1288 10.5638 8.32592 9.69138Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6 12L8 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M17 4L7 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="text-white ml-5">Sản phẩm</p>
      </a>

      <a href="/customers" class="flex flex-row px-6 py-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
          <path d="M7.5 17C9.8317 14.5578 14.1432 14.4428 16.5 17M14.4951 9.5C14.4951 10.8807 13.3742 12 11.9915 12C10.6089 12 9.48797 10.8807 9.48797 9.5C9.48797 8.11929 10.6089 7 11.9915 7C13.3742 7 14.4951 8.11929 14.4951 9.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
        </svg>
        <p class="text-white ml-5">Khách hàng</p>
      </a>

      <a href="/promotion" class="flex flex-row px-6 py-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
          <path d="M2 10C2 7.17157 2 5.75736 2.87868 4.87868C3.75736 4 5.17157 4 8 4H16C18.8284 4 20.2426 4 21.1213 4.87868C22 5.75736 22 7.17157 22 10V14C22 16.8284 22 18.2426 21.1213 19.1213C20.2426 20 18.8284 20 16 20H8C5.17157 20 3.75736 20 2.87868 19.1213C2 18.2426 2 16.8284 2 14V10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6 9.90429C6 5.35988 12 9.99015 12 13H8.5C6.7632 13 6 11.4699 6 9.90429Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M18 9.90429C18 5.35988 12 9.99015 12 13H15.5C17.2368 13 18 11.4699 18 9.90429Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M2 13H22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M15 16L12 13L9 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="text-white ml-5">Khuyến mãi</p>
      </a>

      <a href="/blog" class="flex flex-row px-6 py-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
          <path d="M18 15V9C18 6.17157 18 4.75736 17.1213 3.87868C16.2426 3 14.8284 3 12 3H8C5.17157 3 3.75736 3 2.87868 3.87868C2 4.75736 2 6.17157 2 9V15C2 17.8284 2 19.2426 2.87868 20.1213C3.75736 21 5.17157 21 8 21H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6 8L14 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6 12L14 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6 16L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M18 8H19C20.4142 8 21.1213 8 21.5607 8.43934C22 8.87868 22 9.58579 22 11V19C22 20.1046 21.1046 21 20 21C18.8954 21 18 20.1046 18 19V8Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="text-white ml-5">Blog</p>
      </a>
      <a href="\logout" class="flex justify-center">
                            <button class="border rounded-md bg-white text-black p-2">Đăng xuất</button>
                        </a>
    </div>
  </div> -->
  <col1 class="bg-Cam_Ananas text-white w-ful sm:w-1/4 md:w-1/5 flex flex-col pb-10">
                    <div class="px-8 py-4">
                        <ul class="flex flex-row items-center space-x-2">
                            <li><img src="img/ananas_logo.png" alt="logo" class="h-16 w-auto"></li>
                        </ul>
                    </div>
                    <div class="flex flex-col space-y-11  pt-10 pl-8">
                        <a class="flex flex-row space-x-3 bg-green-600 rounded-md p-2" href="/dashboard">
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
                        <a href="/promotion" class="flex flex-row space-x-3 ">
                            <img src="img/donhang_km.png" alt="dashboard_icon" class="h-6 w-6">
                            <p>Khuyến mãi</p>
                        </a>
                        <a href="/blog" class="flex flex-row space-x-3  ">
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
    <?php 
      $visitbydate= $data['visitbydate'];
      $visitbyweek= $data['visitbyweek'];
      $visitbymonth= $data['visitbymonth'];
      $solditemsbydate= $data['solditemsbydate'];
      $solditemsbyweek= $data['solditemsbyweek'];
      $solditemsbymonth= $data['solditemsbymonth'];
      $incomebydate= $data['incomebydate'];
      $incomebyweek= $data['incomebyweek'];
      $incomebymonth= $data['incomebymonth'];
      $orderstatusbydate= $data['orderstatusbydate'];
      $orderstatusbyweek= $data['orderstatusbyweek'];
      $orderstatusbymonth= $data['orderstatusbymonth'];
      $reviewbydate = $data['reviewbydate'];
      $reviewbyweek = $data['reviewbyweek'];
      $reviewbymonth = $data['reviewbymonth'];
    ?>
    <div class="w-11/12 mx-auto mt-8">
      <p class="font-bold text-3xl">DASHBOARD</p>
      <p>Ngày <?= htmlspecialchars($visitbydate['day']); ?>, tháng <?= htmlspecialchars($visitbydate['month']); ?> năm <?= htmlspecialchars($visitbydate['year']); ?></p>
    </div>

    <div class="w-11/12 mx-auto mt-8">
      <p>Báo cáo ngày <?= htmlspecialchars($visitbydate['day']); ?>, tháng <?= htmlspecialchars($visitbydate['month']); ?> năm <?= htmlspecialchars($visitbydate['year']); ?></p>
      <div class="flex flex-row space-x-5 my-5">
        <div class="flex-col flex w-1/3 space-y-5">
          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Tổng lượt truy cập</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($visitbydate['visit_count']); ?></p>
          </div>

          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Doanh thu</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars(number_format($incomebydate['income'] ?? 0, 0, ',', '.')); ?></p>
          </div>
        </div>

        <div class="flex-col flex w-1/3 space-y-5">
          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Tổng số hàng bán ra</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($solditemsbydate['quantity'] ?? 0); ?></p>
          </div>

          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Số bình luận</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($reviewbydate['count']); ?></p>
          </div>
        </div>

        <div class="flex bg-white text-black w-1/3 rounded-lg px-5">
          <div class="my-auto space-y-5">
            <?php foreach ($orderstatusbydate as $status => $count): ?>
              <p><span class="font-bold text-Cam_Ananas"><?= htmlspecialchars($count); ?></span> Đơn hàng <?= htmlspecialchars($status); ?></p>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="w-11/12 mx-auto mt-8">
      <p>Báo cáo tuần <?= htmlspecialchars($visitbyweek['week']); ?>, năm <?= htmlspecialchars($visitbyweek['year']); ?></p>
      <div class="flex flex-row space-x-5 my-5">
        <div class="flex-col flex w-1/3 space-y-5">
          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Tổng lượt truy cập</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($visitbyweek['visit_count']); ?></p>
          </div>

          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Doanh thu</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars(number_format($incomebyweek['income'] ?? 0, 0, ',', '.')); ?></p>
          </div>
        </div>

        <div class="flex-col flex w-1/3 space-y-5">
          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Tổng số hàng bán ra</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($solditemsbyweek['quantity'] ?? 0); ?></p>
          </div>

          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Số bình luận</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($reviewbyweek['count']); ?></p>
          </div>
        </div>

        <div class="flex bg-white text-black w-1/3 rounded-lg px-5">
          <div class="my-auto space-y-5">
            <?php foreach ($orderstatusbyweek as $status => $count): ?>
              <p><span class="font-bold text-Cam_Ananas"><?= htmlspecialchars($count); ?></span> Đơn hàng <?= htmlspecialchars($status); ?></p>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="w-11/12 mx-auto mt-8">
      <p>Báo cáo tháng <?= htmlspecialchars($visitbymonth['month']); ?>, năm <?= htmlspecialchars($visitbymonth['year']); ?></p>
      <div class="flex flex-row space-x-5 my-5">
        <div class="flex-col flex w-1/3 space-y-5">
          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Tổng lượt truy cập</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($visitbymonth['visit_count']); ?></p>
          </div>

          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Doanh thu</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars(number_format($incomebymonth['income'] ?? 0, 0, ',', '.')); ?></p>
          </div>
        </div>

        <div class="flex-col flex w-1/3 space-y-5">
          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Tổng số hàng bán ra</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($solditemsbymonth['quantity'] ?? 0); ?></p>
          </div>

          <div class="bg-white text-black py-5 px-5 rounded-lg">
            <p>Số bình luận</p>
            <p class="text-3xl font-bold"><?= htmlspecialchars($reviewbymonth['count']); ?></p>
          </div>
        </div>

        <div class="flex bg-white text-black w-1/3 rounded-lg px-5">
          <div class="my-auto space-y-5">
            <?php foreach ($orderstatusbymonth as $status => $count): ?>
              <p><span class="font-bold text-Cam_Ananas"><?= htmlspecialchars($count); ?></span> Đơn hàng <?= htmlspecialchars($status); ?></p>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>