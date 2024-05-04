<?php
echo'<div class="acc-info">
        <h1 style="margin-top: 60px;">Thông tin cá nhân</h1>
        <form action="?module=auth&action=account-centre">
            <div class="acc-center-data">
                <label for="userID" class="text">Mã tài khoản:</label>
                <input type="text" name="userID" value="1000" class="input" readonly>
            </div>
            <div class="acc-center-data">
                <label for="ho-ten" class="text">Họ tên:</label>
                <input type="text" name="ho-ten" value="Đặng Ngọc Tính" class="input" readonly>
            </div>
            <div class="acc-center-data">
                <label for="dia-chi" class="text">Địa chỉ:</label>
                <input type="text" name="dia-chi" value="42/7 Trần Hưng Đạo" class="input" readonly>
            </div>
            <div class="acc-center-data">
                <label for="sdt" class="text">Email:</label>
                <input type="text" name="sdt" value="n.tinhs0521@gmail.com" class="input" readonly>
            </div>
            <div class="acc-center-data">
                <label for="sdt" class="text">Số điện thoại:</label>
                <input type="text" name="sdt" value="0899979645" class="input" readonly>
            </div>
            <button class="btn-edit-acc-info"><i class="fa-solid fa-pencil" style="padding: 0 5px;"></i>Chỉnh sửa</button>
            <button class="btn-change-pass">Đổi mật khẩu</button>
        </form>
    </div>';
?>