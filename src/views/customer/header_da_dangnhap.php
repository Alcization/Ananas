<head>
    <link href="/assets/css/output.css" rel="stylesheet">
</head>
<!-- <<<<<<<<<<<<<<<<Navigation Bar starts>>>>>>>>>>>>>>>> -->
<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none" class="my-auto scale-75 mr-5">
                    <path d="M17.5 17.5L22 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                </svg>
            </button>
        </a>
        <button id="avatarButton" class="pr-3 hidden md:block"><img src="/img/prd_list_icon_ava.png" alt="avatar"></button>
        <!-- popup menu -->
        <div id="popupMenu" class="absolute right-0 mt-10 w-64 rounded-lg bg-white shadow-lg hidden">
            <div class="py-4 px-6 ">
                <div class="flex items-center gap-3 border rounded-lg  shadow-md bg-white p-2">
                    <img src="/img/prd_list_ava_popup.png" alt="avatar" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-medium"><?= htmlspecialchars($_SESSION['user_name']); ?></p>
                        <a href="/info" class="text-xs text-gray-500 hover:text-gray-700">Xem hồ sơ</a>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="space-y-3 text-gray-700">
                    <a href="/cart" class="flex items-center gap-3 p-2 bg-white hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <p href="">Giỏ hàng</p>
                    </a>
                    <a href="/love_item" class="flex items-center gap-3 p-2 bg-white hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <p href="#">Yêu thích</p>
                    </a>
                    <a href="/orderhistory" class="flex items-center gap-3 p-2 bg-white hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <p href="/orderhistory">Tra cứu đơn hàng</p>
                    </a>
                    <a href="/introduce" class="flex items-center gap-3 p-2 bg-white hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <p href="#">Hệ thống cửa hàng</p>
                    </a>
                </div>
            </div>
        </div>
        <!--end popup menu-->

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
        <a href="/product_list" class="font-bold text-lg">SẢN PHẨM</a>
        <a href="/sale_off" class="font-bold text-lg">SALE-OFF</a>
        <a href="/news" class="font-bold text-lg">TIN TỨC</a>
        <a href="/introduce" class="font-bold text-lg">GIỚI THIỆU</a>
        <div class="border rounded-md p-4 shadow-md flex space-x-4 bg-white">
            <div><img src="img/prd_list_ava_popup.png" alt="avarta"></div>
            <div>
                <p class="font-medium">HỌ VÀ TÊN</p>
                <a href="#" class=" text-gray-500 hover:text-gray-700">Xem hồ sơ</a>
            </div>
        </div>
        <div class="flex flex-col space-y-3">
            <div class="flex space-x-3">
                <a href="/cart" class="border rounded-md p-4 shadow-md flex w-1/2 bg-white hover:bg-Cam_Ananas hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <p class="pl-3">Giỏ hàng</p>
                </a>
                <a href="#" class="border rounded-md p-4 shadow-md flex w-1/2 bg-white hover:bg-Cam_Ananas hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <p class="pl-3">Yêu thích</p>                     
                </a>
            </div>
            <div class="flex space-x-3">
                <a href="#" class="border rounded-md p-4 shadow-md flex w-1/2 bg-white hover:bg-Cam_Ananas hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>                      
                    <p class="pl-3">Tra cứu đơn hàng</p>
                </a>
                <a href="#" class="border rounded-md p-4 shadow-md flex w-1/2 bg-white hover:bg-Cam_Ananas hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <p class="pl-3">Hệ thống cửa hàng</p>                    
                </a>
            </div>
        </div>

    </div>
</div>
<script src="/assets/js/header.js"></script>
<!-- <<<<<<<<<<<<<<<<Navigation Bar ends>>>>>>>>>>>>>>>> -->