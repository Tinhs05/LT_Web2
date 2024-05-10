<?php
require_once(_WEB_PATH_TEMPLATES . '/layout/header.php');
require_once("./includes/connect.php");
?>

<div class="account-centre-container">
    <div class="navbar-acc-centre">
        <div class="title-acc-centre">TÀI KHOẢN</br>CÁ NHÂN</div>
        <div class="menu-items-acc-centre active" id="btn-don-hang">
            <a href="#">
                <span><i class="fa-solid fa-moped"></i>Đơn hàng</span>
            </a>
        </div>
        <div class="menu-items-acc-centre" id="btn-tai-khoan">
            <a href="#">
                <span><i class="fa-solid fa-user-gear"></i>Tài khoản</span>
            </a>
        </div>
        <div class="menu-items-acc-centre">
            <a href="?module=user">
                <span><i class="fa-solid fa-shop"></i> Cửa hàng</span>
            </a>
        </div>
        <div class="menu-items-acc-centre">
            <a href="?module=auth&action=logout">
                <span><i class="fa-solid fa-door-open"></i>Đăng xuất</span>
            </a>
        </div>
    </div>
    <div class="content-acc-centre">
        <?php
        require_once("./modules/auth/order-status.php");
        ?>
    </div>
</div>
<!-- Script -->
<script>
    $(document).ready(function() {
        // Account Center
        $('#btn-don-hang').on('click', function() {
            $('.content-acc-centre').html("");
            $.post("?module=auth&action=order-status", {}, function(data) {
                $('.content-acc-centre').html(data);
            })
        })

        $('#btn-close-acc-center').on('click', function(e) {
            $('.modal-account').css("display", "none");
        })

        $('#btn-tai-khoan').on('click', function() {
            $('.content-acc-centre').html("");
            $.post("?module=auth&action=account-info", {}, function(data) {
                $('.content-acc-centre').html(data);
            })
        })
    });
</script>