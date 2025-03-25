<head>
    <link href="/assets/css/output.css" rel="stylesheet">
</head>
<!-- <<<<<<<<<<<<<<<<Navigation Bar starts>>>>>>>>>>>>>>>> -->
<nav id="navBar" class="bg-white/30 flex flex-row items-center text-sm
            w-full border-white fixed backdrop-blur z-30">
    <div class="w-3/12">
        <a href="/">
            <img src="/assets/logo-black.png" alt="Logo" class="md:h-16 md:ml-7 ml-4 h-12"/>
        </a>
    </div>

    <div class="w-6/12 align-middle">
        <ul class="md:flex flex-row justify-center lg:space-x-12 space-x-8 hidden">
            <li class="ML_hover_header" id="product" onclick="openOverlay()">SẢN PHẨM</li>
            <li><a href="/sale_off" class="ML_hover_header">SALE-OFF</a></li>
            <li><a href="/news" class="ML_hover_header">TIN TỨC</a></li>
            <li><a href="/introduce" class="ML_hover_header">GIỚI THIỆU</a></li>
        </ul>
    </div>

    <div class="w-3/12 flex justify-end">
        <a href="/search" class="flex justify-center">
            <button type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" class="hidden md:block my-auto scale-75 mr-5">
                    <path d="M17.5 17.5L22 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                </svg>
            </button>
        </a>
        <a href="/register" class="flex my-auto"><button type="button" class="text-[13px] mr-5 lg:block hidden hover:text-[#F15E2C] duration-300">Đăng ký</button></a>
        <a href="/login"><button type="button" class="MT_button_header">Đăng nhập</button></a>
        <button class="mr-4 md:hidden block" onclick="mobileOverlay()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" class="scale-75">
                <path d="M4 5L20 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 12L20 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 19L20 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</nav>

<div id="myNav" class="bg-white/30 fixed invisible md:visible md:hidden flex-col backdrop-blur w-full h-[350px] z-50 top-16">
    <a class="absolute right-8 top-8 cursor-pointer" onclick="closeOverlay()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
            <path d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <div class="flex my-auto mx-auto">
        <div class="mx-8 flex flex-row space-x-[2vw]">
            <a href="/product_list" class="flex flex-col rounded-lg w-auto h-auto items-center shadow-md bg-white hover:bg-Cam_Ananas hover:text-white hover:shadow-lg hover:scale-105 duration-300">
                <img src="/assets/navbar/formen.jpg" class="w-52 aspect-square rounded-t-lg object-cover">
                <div class="flex content-between py-4 ">CHO NAM</div>
            </a>

            <a href="/product_list" class="flex flex-col bg-white hover:bg-Cam_Ananas hover:text-white rounded-lg w-auto h-auto items-center shadow-md hover:shadow-lg hover:scale-105 duration-300">
                <img src="/assets/navbar/forwomen.jpg" class="w-52 aspect-square rounded-t-lg object-cover">
                <div class="flex content-between py-4">CHO NỮ</div>
            </a>

            <a href="/product_list" class="flex flex-col bg-white hover:bg-Cam_Ananas hover:text-white rounded-lg w-auto h-auto items-center shadow-md hover:shadow-lg hover:scale-105 duration-300">
                <img src="/assets/navbar/shirt.jpg" class="w-52 aspect-square rounded-t-lg object-cover">
                <div class="flex content-between py-4">ÁO</div>
            </a>

            <a href="/product_list" class="flex flex-col bg-white hover:bg-Cam_Ananas hover:text-white rounded-lg w-auto h-auto items-center shadow-md hover:shadow-lg hover:scale-105 duration-300">
                <img src="/assets/navbar/acc.jpg" class="w-52 aspect-square rounded-t-lg object-cover">
                <div class="flex content-between py-4">PHỤ KIỆN</div>
            </a>
        </div>
    </div>
</div>

<div id="mobileNav" class="md:invisible hidden w-full h-[calc(100%-48px)] fixed z-30 top-12 bg-white/30 backdrop-blur">
    <div class="flex flex-col my-16 space-y-9 w-9/12 mx-auto">
        <a href="#" class="font-bold text-lg">SẢN PHẨM</a>
        <a href="/sale_off" class="font-bold text-lg">SALE-OFF</a>
        <a href="/news" class="font-bold text-lg">TIN TỨC</a>
        <a href="/introduce" class="font-bold text-lg">GIỚI THIỆU</a>
        <div class="flex space-x-5">
            <button class="w-1/2 bg-white h-14 rounded-lg shadow-md"><a href="/register">Đăng ký</a></button>
            <button class="w-1/2 bg-[#F15E2C] h-14 rounded-lg shadow-md text-white"><a href="/login">Đăng nhập</a></button>
        </div>

        <div class="flex flex-col justify-end h-full">
            <button>
                <a href="search.php">
                    <div class="flex bg-white h-14 rounded-lg shadow-md w-full items-center px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" class="flex my-auto scale-75 mr-2">
                            <path d="M17.5 17.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                        Tìm kiếm
                    </div>
                </a>
            </button>
        </div>

    </div>
</div>
</nav>
<!-- <<<<<<<<<<<<<<<<Navigation Bar ends>>>>>>>>>>>>>>>> -->