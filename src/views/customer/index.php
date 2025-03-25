<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton+SC&family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Fjalla+One&family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="/assets/css/output.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Be Vietnam Pro',sans-serif;
            font-weight: normal;
        }
        body.h1 {
            font-family: 'Bayon',sans-serif;
        }
        .track6_list::-webkit-scrollbar {
             display: none;
        }
        .raw_title {
            font-family: 'Anton SC',sans-serif;
        }
    </style>
</head>
<body class="overflow-x-clip">
    
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

<div class="text-center 2xl:h-[1000px] xl:h-[900px] lg:h-[800px] md:h-[700px] h-[600px] w-screen">
    <img src="/assets/index/IMG_7284.png" class="2xl:h-[1000px] xl:h-[900px] lg:h-[800px] md:h-[700px] h-[600px] hidden md:block w-full object-cover absolute z-0" alt="urbas 24">
    <img src="/assets/index/IMG_7284_1.png" class="md:hidden block h-[600px] w-full object-cover absolute z-0" alt="urbas 24">
    <h3 class="relative lg:top-[120px] md:top-[110px] top-[90px] text-[#F15E2C]">Mới ra mắt</h3>
    <h1 class="relative lg:text-8xl md:text-7xl text-5xl xl:top-[140px] lg:top-[120px] md:top-[120px] top-[100px] font-[Bayon]">URBAS LOVE+ 24</h1> <!-- -->
    <h3 class="relative 2xl:top-[680px] xl:top-[580px] lg:top-[500px] md:top-[400px] top-[380px] text-sm md:text-md mb-10">Giao hàng từ 15.12.2024</h3>
    <button type="button" class="relative bg-gradient-to-r from-[#F15E2C]
    hover:bg-gradient-to-r hover:from-[#fca144] hover:from-5% hover:to-[#FF6530] hover:to-30% hover:shadow-md hover:shadow-[rgba(241,94,44,0.5)] duration-300
    from-0% to-[#F15E2C] to-100% text-white rounded-md md:rounded-lg text-sm md:text-md
    md:py-3 md:px-12 px-8 py-2 2xl:top-[650px] xl:top-[550px] lg:top-[470px] md:top-[380px] top-[350px]">Đặt trước</button>
</div>

<!--Nổi bật-->
<div class="w-10/12 xl:w-9/12 mx-auto mt-16 text-2xl font-bold"><p>Nổi bật</p></div>
<div class="flex lg:flex-row flex-col w-10/12 xl:w-9/12 h-[200px] md:h-[300px] lg:h-[600px] min-h-fit left-0 right-0 mx-auto mt-5 space-y-5 lg:space-y-0">
    <?php
        $isLastItem = false;
        $outstanding = $data['outstanding'];
        foreach ($outstanding as $index => $product):
        $isLastItem = $index === count($outstanding) - 1;
    ?>
        <div class="lg:w-1/3 w-full lg:pl-4 pl-0 h-[200px] md:h-[300px] lg:h-[600px] <?= $isLastItem ? 'hidden 2xl:block' : ''; ?>">
            <img src="<?= htmlspecialchars($product['os_image']); ?>" class="h-[200px] md:h-[300px] lg:h-[600px] w-full object-cover" alt="<?= htmlspecialchars($product['os_name']); ?>">
            <img src="/assets/index/ftr_back.png" class="w-full h-[200px] md:h-[300px] relative bottom-[200px] md:bottom-[300px] z-20" alt="Featured_Background">
            <h4 class="text-white z-20 relative bottom-[330px] md:bottom-[450px] lg:ml-7 ml-4"><?= htmlspecialchars($product['os_tag_line']); ?></h4>
            <h3 class="text-lg text-white relative bottom-[320px] md:bottom-[440px] font-bold z-20 lg:ml-7 ml-4"><?= htmlspecialchars($product['os_name']); ?></h3>
            <button class="md:text-[14px] text-[13px] relative bottom-[310px] md:bottom-[430px] lg:ml-7 ml-4 z-20 bg-gradient-to-r from-[#F15E2C] from-0% to-[#F15E2C] to-100% text-white rounded-lg md:py-3 md:px-6 py-2 px-5
                hover:bg-gradient-to-r hover:from-[#fca144] hover:from-5% hover:to-[#FF6530] hover:to-30% hover:shadow-md hover:shadow-[rgba(241,94,44,0.5)] duration-300">
                Mua ngay
            </button>
        </div>
    <?php endforeach; ?>
</div>

<!--Khám phá-->
<?php $discovery = $data['discovery']; ?>
<div class="w-9/12 mx-auto mt-16 text-2xl"><p>Khám phá dòng sản phẩm <strong><?= htmlspecialchars($discovery[0]['category_name']); ?></strong> của chúng tôi</p></div>
<div class="flex flex-row w-9/12 mx-auto overflow-x-scroll mt-5 h-auto space-x-5 track6_list">
    <?php foreach ($discovery as $index => $product): ?>
        <div class="flex-none h-auto">
            <img src="<?= htmlspecialchars($product['product_image']); ?>" class="h-[350px] aspect-square" alt="<?= htmlspecialchars($product['product_name']); ?>">
            <h4 class="font-bold mt-2"><?= htmlspecialchars($product['product_name']); ?></h4>
            <h5 class="mt-2"><?= htmlspecialchars(number_format($product['price'], 0, ',', '.')); ?> VNĐ</h5>
            <button class="text-[14px] mt-2 z-30 bg-gradient-to-r from-[#F15E2C] from-0% to-[#F15E2C] to-100% text-white rounded-lg py-3 px-6
                hover:bg-gradient-to-r hover:from-[#fca144] hover:from-5% hover:to-[#FF6530] hover:to-30% hover:shadow-md hover:shadow-[rgba(241,94,44,0.5)] duration-300">Mua ngay</button>
        </div>
    <?php endforeach; ?>
</div>

<!--Vintas Vivu-->
<div class="w-full bg-[#BCA984] 2xl:h-[1000px] xl:h-[900px] lg:h-[800px] md:h-[700px] h-[600px] mt-20 flex flex-row">
    <div class="w-2/5 h-full hidden md:block">
        <img src="/assets/index/vintas_vivu1.jpg" class="h-full w-full hidden md:block object-cover">
    </div>
    
    <div class="w-full md:w-3/5 h-full flex flex-col">
        <div class="w-full h-2/3">
            <img src="/assets/index/vintas_vivu2.jpeg" class="md:h-full h-[300px] w-full object-cover">
        </div>

        <div class="w-full md:h-1/3 h-full flex flex-row">
            <div class="w-4/5 h-full flex">
                <div class=" ml-10 my-auto">
                    <img src="/assets/logo-white.png" class="w-24 h-10 object-cover">
                    <h1 class="font-[Bayon] text-white lg:text-8xl md:text-7xl text-6xl">VINTAS VIVU</h1>
                    <h3 class="text-white my-1">Giá chỉ từ 610.000 VNĐ</h3>
                    <button class="text-[14px] mt-2 z-30 bg-gradient-to-r from-[#F15E2C] from-0% to-[#F15E2C] to-100% text-white py-3
                    hover:bg-gradient-to-r hover:from-[#fca144] hover:from-5% hover:to-[#FF6530] hover:to-30% hover:shadow-md hover:shadow-[rgba(241,94,44,0.5)] duration-300
                    rounded-md md:rounded-lg text-sm md:text-md md:py-3 md:px-12 px-6">Mua ngay</button>
                </div>
            </div>

            <div class="flex-grow">

            </div>

            <div class="w-[120px] h-full flex flex-col">
                <div class="w-full h-[calc(100%-120px)] bg-[#646F84]"></div> <!--Navy rectangle-->
                <div class="w-full h-[120px] bg-[#9A845C]"></div> <!--Brown rectangle-->
            </div>
        </div>
    </div>
</div>

<!--Basas RAW-->
<div class="w-full bg-[#ECE4D7] 2xl:h-[1000px] xl:h-[900px] lg:h-[800px] md:h-[700px] h-fit flex md:flex-col flex-row">
    <div class="md:w-auto w-1/2 flex md:flex-row flex-col md:mt-[2vw] md:mx-auto m-3 md:space-y-0 space-y-3">
        <img src="/assets/index/raw1.jpg" class="md:w-[30vw] md:h-[30vw] w-full">
        <img src="/assets/index/raw2.jpg" class="md:w-[30vw] md:h-[30vw] md:mx-[2vw] w-full">
        <img src="/assets/index/raw3.jpg" class="md:w-[30vw] md:h-[30vw] w-full">
    </div>

    <div class="sm:w-auto w-1/2 flex flex-col text-center align-middle my-auto mr-2 md:mr-0">
        <div class="my-auto top-0 bottom-0">
            <h3 class="font-bold md:text-2xl text-sm">ANANAS BASAS RAW</h3>
            <h1 class="raw_title md:text-6xl text-3xl mt-8">NGUYÊN BẢN TRONG TỪNG BƯỚC CHÂN</h1>
            <h3 class="md:text-xl text-sm mt-8">Giá chỉ từ: 620.000 VNĐ</h3>
            <button class="text-[14px] mt-7 z-30 bg-gradient-to-r from-[#F15E2C] from-0% to-[#F15E2C] to-100% text-white rounded-lg py-3 px-6
               hover:bg-gradient-to-r hover:from-[#fca144] hover:from-5% hover:to-[#FF6530] hover:to-30% hover:shadow-md hover:shadow-[rgba(241,94,44,0.5)] duration-300">Mua ngay</button>
        </div>
    </div>
</div>

<?php
    include 'footer.php';
?>
<script src="/assets/js/header.js"></script>

</body>
</html>



















