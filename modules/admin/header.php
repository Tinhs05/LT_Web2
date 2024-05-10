<?php
if(!defined('_CODE')){
    die('Access denied...');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='./templates/assets/image/logo_cicle.png' rel='icon' type='image/x-icon' />
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES ?>/css/admin.css?ver=<?php echo rand(); ?>">
    <link rel="stylesheet" type="text/cs" href="<?php echo _WEB_HOST_TEMPLATES ?>/assets/image?ver=<?php echo rand(); ?>">
    <link href="./templates/css/font/font-awesome-pro-v6-6.2.0/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Quản lý cửa hàng</title>
</head>
<body>
<header class="header">
        <button class="menu-icon-btn">
            <div class="menu-icon">
                <i class="fa-regular fa-bars"></i>
            </div>
        </button>
    </header>
    <div class="container">

        <aside class="sidebar open">
            <ul>
                
            </ul>
            <div class="top-sidebar">
                <a href="#" class="channel-logo"><img src="./templates/assets/image/logo.png" alt="Channel Logo"></a>

            </div>
            <div class="middle-sidebar">
                <ul class="sidebar-list">
                    <li class="sidebar-list-item user-logout">
                        <a href="?module=admin" class="sidebar-link">
                            <div class="sidebar-icon"><i class="fa-light fa-turn-down-left"></i></div>
                            <div class="hidden-sidebar">Cửa hàng</div>
                        </a>
                    </li>
                   
                    <!-- <li class="sidebar-list-item tab-content ">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon"><i class="fa-light fa-house"></i></div>
                            <div class="hidden-sidebar">Trang tổng quan</div>
                        </a>
                    </li> -->
                    <li class="sidebar-list-item tab-content list-product">
                        <a href="?module=admin&action=homeProducts" class="sidebar-link">
                            <div class="sidebar-icon"><i class="fa-light fa-shirt"></i></div>
                            <div class="hidden-sidebar">Sản phẩm</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item tab-content list-user">
                        <a href="?module=admin&action=homeCustomers" class="sidebar-link">
                            <div class="sidebar-icon"><i class="fa-light fa-users"></i></div>
                            <div class="hidden-sidebar">Khách hàng</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item tab-content list-order">
                        <a href="?module=admin&action=homeOrders" class="sidebar-link">
                            <div class="sidebar-icon"><i class="fa-light fa-basket-shopping"></i></div>
                            <div class="hidden-sidebar">Đơn hàng</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item tab-content statistic">
                        <a href="?module=admin&action=homeStatistic" class="sidebar-link">
                            <div class="sidebar-icon"><i class="fa-light fa-chart-simple"></i></div>
                            <div class="hidden-sidebar">Thống kê</div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-list">
                   
                    <li class="sidebar-list-item user-logout">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon"><i class="fa-light fa-circle-user"></i></div>
                            <div class="hidden-sidebar" id="name-acc">Admin</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item user-logout">
                        <a href="#" class="sidebar-link" id="logout-acc">
                            <div class="sidebar-icon"><i class="fa-light fa-arrow-right-from-bracket"></i></div>
                            <div class="hidden-sidebar">Đăng xuất</div>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
<script>
    $('#logout-acc').on('click', function(e){
        e.preventDefault();
        <?php session_destroy(); ?>
        window.location.href = "?module=auth&action=login";
    })
</script>