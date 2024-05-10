<?php

$user = $_SESSION['user-id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['act'])) {
    $act = $_POST['act'];
    if ($act == 'update_user' && isset($_POST['full_name']) && isset($_POST['address']) && isset($_POST['phone'])) {
        $fullName = $_POST['full_name'];
        $phoneNumber = $_POST['phone'];
        $address = $_POST['address'];
        update_user($conn, $user, $phoneNumber, $address, $fullName);
    } elseif ($act == 'change_password' && isset($_POST['pass'])) {
        $pass = $_POST['pass'];
        change_password($conn, $user, $pass);
    }
}

function update_user($conn, $user, $phoneNumber, $adddress, $fullName)
{
    $sql = "UPDATE customer SET FullName='$fullName' ,PhoneNumber='$phoneNumber' ,Address='$adddress' WHERE CustomerID = '$user'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function change_password($conn, $user, $pass)
{
    $sql = "UPDATE customer SET PassWord= '$pass' WHERE CustomerID = '$user'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function get_info($conn, $user)
{
    $sql = "SELECT * FROM customer WHERE CustomerID = '$user'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

$user_inf = get_info($conn, $user);
?>

<div class="acc-info">
    <h1 style="margin-top: 60px;">Thông tin cá nhân</h1>
    <form action="">
        <div class="acc-center-data">
            <label for="userID" class="text">Mã tài khoản:</label>
            <input type="text" name="userID" value="<?php echo $user_inf['CustomerID']; ?>" class="input" readonly>
        </div>
        <div class="acc-center-data">
            <label for="ho-ten" class="text">Họ tên:</label>
            <input type="text" id="ho-ten" name="ho-ten" value="<?php echo $user_inf['FullName']; ?>" class="input inputedit" readonly>
            <span class="form-message"></span>
        </div>
        <div class="acc-center-data">
            <label for="dia-chi" class="text">Địa chỉ:</label>
            <input type="text" id="dia-chi" name="dia-chi" value="<?php echo $user_inf['Address']; ?>" class="input inputedit" readonly>
            <span class="form-message"></span>
        </div>
        <div class="acc-center-data">
            <label for="sdt" class="text">Email:</label>
            <input type="text" name="email" value="<?php echo $user_inf['Email']; ?>" class="input" readonly>
        </div>
        <div class="acc-center-data">
            <label for="sdt" class="text">Số điện thoại:</label>
            <input type="text" id="sdt" name="sdt" value="<?php echo $user_inf['PhoneNumber']; ?>" class="input inputedit" readonly>
            <span class="form-message"></span>
        </div>
        <button class="btn-edit-acc-info">Chỉnh sửa</button>
        <button class="btn-change-pass" id="open-form-change-pass">Đổi mật khẩu</button>

    </form>
</div>
<div class="modal-account" style="display: none;">
    <div class="change-pass">
        <div id="btn-close-acc-center">+</div>
        <h1>ĐỔI MẬT KHẨU</h1>
        <form action="">
            <div class="acc-center-data">
                <label for="current-pass" class="text">Mật khẩu hiện tại:</label>
                <input type="password" name="current-pass" id="current-pass" value="" class="input">
                <input type="hidden" name="check-current-pass" id="check-current-pass" value="<?php echo $user_inf['PassWord']; ?>">
                <span class="form-message"></span>
            </div>
            <div class="acc-center-data">
                <label for="new-pass" class="text">Mật khẩu mới:</label>
                <input type="password" name="new-pass" id="new-pass" value="" class="input">
                <span class="form-message"></span>
            </div>
            <div class="acc-center-data">
                <label for="confirm-pass" class="text">Xác nhận mật khẩu:</label>
                <input type="password" name="confirm-pass" id="confirm-pass" value="" class="input">
                <span class="form-message"></span>
            </div>
            <button class="btn-change-pass" id="confirm-change-pass">Xác nhận</button>
        </form>
    </div>
</div>
<script>
    var editMode = false;
    $('.btn-edit-acc-info').click(function(e) {
        e.preventDefault();
        if (!editMode) {
            $('.acc-info .inputedit').removeAttr('readonly');
            $('.acc-info .inputedit').css('box-shadow', '0 0 15px #878282c1');
            $(this).text("Lưu thông tin");
            editMode = true;
        } else {
            var hoten = $('#ho-ten').val();
            var diachi = $('#dia-chi').val();
            var sdt = $('#sdt').val();
            $.ajax({
                type: 'POST',
                url: '?module=auth&action=account-info',
                data: {
                    full_name: hoten,
                    address: diachi,
                    phone: sdt,
                    act: 'update_user',
                },
                success: function(response) {
                    alert('Thông tin đã được cập nhật.')
                    $('.acc-info .inputedit').attr('readonly', true);
                    $('.acc-info .inputedit').css('box-shadow', 'none');
                    $('.btn-edit-acc-info').text("Chỉnh sửa");
                    editMode = false;
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra khi cập nhật thông tin.');
                    console.error(error);
                }
            });
        }
    });

    $('#confirm-change-pass').click(function(e) {
        e.preventDefault();
        var currentPass = $('#current-pass').val();
        var checkPass = $('#check-current-pass').val();
        var newPass = $('#new-pass').val();
        console.log(newPass);
        var confirmPass = $('#confirm-pass').val();

        if (currentPass == checkPass && newPass == confirmPass) {
            $.ajax({
                type: 'POST',
                url: '?module=auth&action=account-info',
                data: {
                    pass: newPass,
                    act: 'change_password'
                },
                success: function(response) {
                    $('#current-pass').val('');
                    $('#new-pass').val('');
                    $('#confirm-pass').val('');
                    alert('Mật khẩu đã được thay đổi.');
                    $('.modal-account').css('display', 'none');
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra khi thay đổi mật khẩu.');
                    console.error(error);
                }
            });
        }
    });


    $('#open-form-change-pass').click(function(e) {
        e.preventDefault();
        $('.modal-account').css('display', 'flex');
    });
    $('#btn-close-acc-center').click(function() {
        $('.modal-account').css('display', 'none');
    });
</script>