<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../../output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-BeVietnam">

    <button onclick="history.back()" class="flex flex-row w-9/12 mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" class="mt-16">
            <path d="M3.99982 11.9998L19.9998 11.9998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M8.99963 17C8.99963 17 3.99968 13.3176 3.99966 12C3.99965 10.6824 8.99966 7 8.99966 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="ml-1 mt-16">Trở về trang chủ</p>
    </button>
    <form action="search/submit" method="POST">
        <div class="flex w-9/12 mx-auto my-9 shadow-lg">
            <div class="my-auto w-16 h-14 border-y-2 border-l-2 rounded-l-lg flex">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" class="m-auto">
                    <path d="M14 14L16.5 16.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                    <path d="M16.4333 18.5252C15.8556 17.9475 15.8556 17.0109 16.4333 16.4333C17.0109 15.8556 17.9475 15.8556 18.5252 16.4333L21.5667 19.4748C22.1444 20.0525 22.1444 20.9891 21.5667 21.5667C20.9891 22.1444 20.0525 22.1444 19.4748 21.5667L16.4333 18.5252Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M16 9C16 5.13401 12.866 2 9 2C5.13401 2 2 5.13401 2 9C2 12.866 5.13401 16 9 16C12.866 16 16 12.866 16 9Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                </svg>
            </div>

            <input type="text" name="search" placeholder="Tìm kiếm" class="border-y-2 h-14 w-full focus:outline-none">

            <button type="submit" class="bg-Cam_Ananas w-16 rounded-r-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none" class="mx-auto">
                <path d="M20.0001 11.9998L4.00012 11.9998" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15.0003 17C15.0003 17 20.0002 13.3176 20.0002 12C20.0002 10.6824 15.0002 7 15.0002 7" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </form>

    <!-- <<<<<<<<<<< Search result >>>>>>>>>> -->
    <div class="w-8/12 mx-auto space-y-8">
        <?php if (isset($products) && isset($blogs)): ?>      
            <div>
                <p class="font-bold">Sản phẩm</p>
                <?php if (empty($products)): ?>
                    <p>Không tìm thấy sản phẩm</p>
                <?php else: ?>
                    <div class="flex flex-col ml-5 mt-3 space-y-3">
                        <?php foreach ($products as $index => $r): ?>
                            <div class="<?= $index >= 3 ? 'hidden-review' : ''; ?>">
                                <a href="/product_list/detail/<?php echo $r['product_item_id']; ?>"><?php echo $r['name']; ?></a>
                            </div>
                        <?php endforeach; ?>
                        <?php if (count($products) > 3): ?>
                            <li class="flex justify-center">
                                <button id="showMoreButton" class="ML_button flex flex-row justify-center">Hiện thêm sản phẩm</button>
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
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <p class="font-bold">Tin tức</p>
                <?php if (empty($blogs)): ?>
                    <p>Không tìm thấy tin tức</p>
                <?php else: ?>
                    <div class="flex flex-col ml-5 mt-3 space-y-3">
                        <?php foreach ($blogs as $index => $r): ?>
                            <div class="<?= $index >= 3 ? 'hidden-news' : ''; ?>">
                                <a href="/news/detail/<?php echo $r['alias']; ?>"><?php echo $r['blog_name']; ?></a>
                            </div>
                        <?php endforeach; ?>
                        <?php if (count($blogs) > 3): ?>
                            <li class="flex justify-center">
                                <button id="showMoreNewsButton" class="ML_button flex flex-row justify-center">Hiện thêm tin tức</button>
                            </li>

                            <script>
                                document.getElementById('showMoreNewsButton').addEventListener('click', function() {
                                    document.querySelectorAll('.hidden-news').forEach(function(news) {
                                        news.style.display = 'block';
                                    });
                                    this.style.display = 'none';
                                });
                            </script>

                            <style>
                                .hidden-news {
                                    display: none;
                                }
                            </style>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>
    </div>
</body>
</html>