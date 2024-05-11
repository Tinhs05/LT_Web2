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
                <span><i class="fa-solid fa-shop"></i> Trang chủ</span>
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
<div id="advertise"></div>
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

    function advertise({
        title = 'Success',
        message = 'Tạo tài khoản thành công',
        type = 'success',
        duration = 1000
    }) {
        const main = $('#advertise');
        if (main.length) {
            const advertise = $('<div class="advertise"></div>');
            //Auto remove advertise
            const autoRemove = setTimeout(function() {
                advertise.remove();
            }, duration + 1000);
            //Remove advertise when click btn close
            advertise.on('click', function(e) {
                if ($(e.target).closest('.fa-regular').length) {
                    advertise.remove();
                    clearTimeout(autoRemove);
                }
            });
            const colors = {
                success: '#47d864',
                info: '#2f86eb',
                warning: '#ffc021',
                error: '#ff6243'
            }
            const icons = {
                success: 'fa-light fa-check',
                info: 'fa-solid fa-circle-info',
                warning: 'fa-solid fa-triangle-exclamation',
                error: 'fa-solid fa-bug'
            };
            const color = colors[type];
            const icon = icons[type];
            const delay = (duration / 1000).toFixed(2);
            advertise.addClass(`advertise--${type}`).css('animation', `slideInTop ease 0.3s, fadeOut linear 1s ${delay}s forwards`)
                .html(`<div class="advertise__private" >
          <div class="advertise__icon">
              <i class="${icon}"></i>
          </div>
          <div class="advertise__body">
              <h3 class="advertise__title" >${title}</h3>
              <p class="advertise__msg">
                  ${message}
              </p>
          </div>
      </div>
      <div class="advertise__background"style="background-color: ${color};">
      </div>`);
            main.append(advertise);
        }
    }
</script>