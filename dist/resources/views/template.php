<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php switch ($page):
        case 'news': ?>
            <link rel="stylesheet" href="css/news.css">
        <?php
        case 'symptons': ?>
            <link rel="stylesheet" href="css/symptons.css">
        <?php
        case 'precaution': ?>
            <link rel="stylesheet" href="css/precaution.css">
    <?php endswitch; ?>
</head>

<body>
    <header class="header">
        <div class="header__logo">
            <span>Việt Nam </span> <svg xmlns="http://www.w3.org/2000/svg" width="42.997" height="43" viewBox="0 0 42.997 43">
                <path id="Path_1" data-name="Path 1" d="M21.235,1.869A.944.944,0,1,0,21.5,3.739h.935V5.667a17.667,17.667,0,0,0-4.995.964L17.087,5.7l.409-.175a.935.935,0,0,0-.526-1.782.9.9,0,0,0-.234.088L14.2,4.936a.942.942,0,0,0,.759,1.723l.409-.175.351.876a17.911,17.911,0,0,0-4.206,2.833L10.165,8.821l.672-.672A.94.94,0,1,0,9.522,6.806L6.806,9.522a.94.94,0,1,0,1.344,1.314l.672-.672,1.373,1.344a17.911,17.911,0,0,0-2.833,4.206l-.876-.351.175-.409a.933.933,0,0,0-.935-1.344,1.091,1.091,0,0,0-.117.029.933.933,0,0,0-.672.555l-1.11,2.541a.935.935,0,1,0,1.694.759l.175-.409.935.351a17.668,17.668,0,0,0-.964,4.995H3.739V21.5a.936.936,0,0,0-1.022-.964,1.094,1.094,0,0,0-.117.029.937.937,0,0,0-.73.935v3.739a.935.935,0,1,0,1.869,0V24.3H5.667A17.668,17.668,0,0,0,6.63,29.3l-.935.351-.175-.409A.928.928,0,1,0,3.826,30l1.11,2.541a.942.942,0,0,0,1.723-.76l-.175-.409.876-.351a17.918,17.918,0,0,0,2.8,4.206L8.821,36.57,8.149,35.9a.94.94,0,1,0-1.344,1.315l2.716,2.716a.94.94,0,0,0,1.314-1.344l-.672-.672,1.344-1.344a17.915,17.915,0,0,0,4.206,2.8l-.351.876-.409-.175a.908.908,0,0,0-.438-.088A.935.935,0,0,0,14.2,41.8l2.541,1.11a.935.935,0,1,0,.759-1.694l-.409-.175.351-.935a17.668,17.668,0,0,0,4.995.964V43h-1.11a.939.939,0,1,0,.175,1.869h3.739a.935.935,0,1,0,0-1.869H24.3V41.068A17.669,17.669,0,0,0,29.3,40.1l.351.935-.409.175A.935.935,0,1,0,30,42.908l2.541-1.11a.935.935,0,0,0-.438-1.811.979.979,0,0,0-.321.088l-.409.175-.351-.876a17.914,17.914,0,0,0,4.206-2.833l1.344,1.373-.672.672a.94.94,0,0,0,1.314,1.344l2.717-2.716a.935.935,0,0,0-.789-1.607.94.94,0,0,0-.555.292l-.672.672-1.373-1.344a17.914,17.914,0,0,0,2.833-4.206l.876.351-.175.409a.942.942,0,0,0,1.723.76L42.908,30a.936.936,0,0,0-.935-1.314h-.088a.932.932,0,0,0-.672.555l-.175.409L40.1,29.3a17.661,17.661,0,0,0,.964-4.995H43v.935a.935.935,0,1,0,1.869,0V21.5a.936.936,0,0,0-1.022-.964,1.1,1.1,0,0,0-.117.029A.936.936,0,0,0,43,21.5v.935H41.068a17.66,17.66,0,0,0-.964-4.995l.935-.351.175.409a.935.935,0,1,0,1.694-.759L41.8,14.2a.942.942,0,1,0-1.723.759l.175.409-.876.351a17.914,17.914,0,0,0-2.8-4.206l1.344-1.344.672.672a.94.94,0,0,0,1.344-1.314L37.212,6.806a.934.934,0,0,0-.672-.292.978.978,0,0,0-.175.029.929.929,0,0,0-.73.657.939.939,0,0,0,.263.949l.672.672-1.344,1.344a17.909,17.909,0,0,0-4.206-2.8l.351-.876.409.175a.942.942,0,1,0,.759-1.723L30,3.826a.928.928,0,1,0-.76,1.694l.409.175L29.3,6.63A17.668,17.668,0,0,0,24.3,5.667V3.739h.935a.935.935,0,1,0,0-1.869h-4m2.1,9.318a1.869,1.869,0,1,1-1.869,1.869,1.868,1.868,0,0,1,1.869-1.869h0m6.631,3.651A1.869,1.869,0,1,1,28.1,16.708a1.868,1.868,0,0,1,1.869-1.869m-13.232.029a1.869,1.869,0,1,1-1.869,1.869,1.868,1.868,0,0,1,1.869-1.869m-3.68,6.6a1.869,1.869,0,1,1-1.869,1.869,1.868,1.868,0,0,1,1.869-1.869m10.282,0a1.869,1.869,0,1,1-1.869,1.869,1.868,1.868,0,0,1,1.869-1.869m10.311.029a1.869,1.869,0,1,1-1.869,1.869A1.868,1.868,0,0,1,33.649,21.5M16.708,28.1a1.869,1.869,0,1,1-1.869,1.869A1.868,1.868,0,0,1,16.708,28.1m13.261,0A1.869,1.869,0,1,1,28.1,29.969,1.868,1.868,0,0,1,29.969,28.1M23.338,31.75a1.869,1.869,0,1,1-1.869,1.869,1.868,1.868,0,0,1,1.869-1.869" transform="translate(-1.869 -1.869)" fill="#B77086" /> </svg> <span>Coronavirus</span>
        </div>
        <div class="header__menu">
            <svg class="header__icon-bar" onclick="hienThi()" fill="#003560" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" /></svg>
            <ul class="header__menu-content" id="menu">

                <svg class="header__close-menu" id="close-menu" onclick="closeMenu()" xmlns="http://www.w3.org/2000/svg" fill="red" width="26" height="26" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" /></svg>
                <li class="header__menu-list <?= $page == 'home' ? 'header__menu-list--active' : '' ?>"><a class="header__menu-text" href="trang-chu">Trang chủ</a></li>
                <li class="header__menu-list <?= $page == 'news' ? 'header__menu-list--active' : '' ?>"><a class="header__menu-text" href="tin-tuc">Tin Tức</a></li>
                <li class="header__menu-list <?= $page == 'symptons' ? 'header__menu-list--active' : '' ?>"><a class="header__menu-text" href="bieu-hien-benh">Biểu hiện bệnh</a></li>
                <li class="header__menu-list <?= $page == 'precaution' ? 'header__menu-list--active' : '' ?>"><a class="header__menu-text" href="cach-phong-tranh">Cách phòng tránh</a></li>
                <li class="header__menu-list"><a class="header__menu-text" href="">Trắc nghiệm</a></li>
            </ul>
        </div>
    </header>

    <?= $content; ?>

    <footer class="footer">
        <p>A project by 59Th2 | Thuy Loi University</p>
    </footer>

    <script src="js/common.js" type="module"></script>
    <?php switch ($page):
        case 'home': ?>
            <script src="js/statistics.js" type="module"></script>
        <?php
        case 'news': ?>
            <script src="js/news.js" type="module"></script>
    <?php endswitch; ?>
    <div class="main__contact">
        <span class="main__contact-title">HotLine</span>
        <div class="main__contact-phone"><svg onclick="nameHospital()" id="icon-phone" fill="white" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                <path d="M20 22.621l-3.521-6.795c-.008.004-1.974.97-2.064 1.011-2.24 1.086-6.799-7.82-4.609-8.994l2.083-1.026-3.493-6.817-2.106 1.039c-7.202 3.755 4.233 25.982 11.6 22.615.121-.055 2.102-1.029 2.11-1.033z" /></svg></div>
    </div>
    <div class="main__content-hotline" id="content-hotline">

        <svg class="main__close-hotline" id="close-hotline" onclick="closeHospital()" fill="red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" /></svg>

        <p class="main__hotline-title">Đường dây nóng (miễn phí)</p>
        <p class="main__hotline-free">1900 9095 và 1900 3228</p>
        <p class="main__hotline-21">21 đường dây nóng của các bệnh viện</p>
        <form action="" class="main__hotline-search">
            <button type="submit">
                <svg width="20" height="20" fill="#7975E1" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z" /></svg>
            </button>
            <input type="text" name="search-hospital" placeholder="Nhập tên bệnh viện" required>
        </form>
        <div class="main__hotline-list">
            <div class="main__icon-loading">
                <div class="main__loading"></div>
                <span class="main__text-loading">Đang tải...</span>
            </div>
        </div>
    </div>
</body>

</html>