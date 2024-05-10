<!-- Đăng kí tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied...');
}


if (isPost()) {
    $filterAll = filter();
    $errors = []; // Mảng chứa các lỗi

    //Validate fullname: bắt buộc phải nhập, nhập lớn hơn 5 kí tự
    if (empty($filterAll['fullname'])) {
        $errors['fullname']['required'] = 'Họ tên không được để trống!';
    } else {
        if (strlen($filterAll['fullname']) < 5) {
            $errors['fullname']['min_length'] = 'Họ tên không nhỏ hơn 5 kí tự!';
        }
    }

    // Email validate: phải nhập, đúng định dạng không, email đã được tạo hay chua
    if (empty($filterAll['email'])) {
        $errors['email']['required'] = 'Email không được để trống!';
    } else {
        $email = $filterAll['email'];
        $sql = "SELECT customerID FROM customer WHERE email = '$email'";
        if (countRows($sql) > 0) {
            $errors['email']['unique'] = 'Email đã tồn tại!';
        }
    }

    // Phone Number Validate: phải nhập, có đúng định dạng không
    if (empty($filterAll['phonenumber'])) {
        $errors['phonenumber']['required'] = 'Số điện thoại không được để trống!';
    } else {
        if (!isPhoneNumber($filterAll['phonenumber'])) {
            $errors['phonenumber']['invalid'] = 'Số điện thoại không hợp lệ!';
        }
    }

    // Adress validate
    if (empty($filterAll['address'])) {
        $errors['address']['required'] = 'Địa chỉ không được để trống!';
    }

    // Password Validate: phải nhập, >=8 kí tự 
    if (empty($filterAll['password'])) {
        $errors['password']['required'] = 'Mật khẩu không được để trống!';
    } else {
        if (strlen($filterAll['password']) < 8) {
            $errors['password']['min_length'] = 'Mật khẩu không nhỏ hơn 8 kí tự!';
        }
    }

    // Passwore Comfirm Validate: phải nhập, phải giống ở trên
    if (empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['required'] = 'Nhập lại mật khẩu để xác nhận!';
    } else {
        if ($filterAll['password_confirm'] != $filterAll['password']) {
            $errors['password_confirm']['different'] = 'Nhập lại mật khẩu không chính xác!';
        }
    }

    if (empty($errors)) {
        try {
            $fullName = $_POST['fullname'];
            $phoneNumber = $_POST['phonenumber'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $joinDate = date('Y-m-d');

            $sql1 = "INSERT INTO customer(FullName, PhoneNumber, Address, Email, PassWord, JoinDate, UserType, Status) VALUES ('$fullName', '$phoneNumber', '$address', '$email', '$password', '$joinDate', 0, 1)";
            $stmt = $conn->prepare($sql1);
            $stmt->execute();
            $row = $stmt->rowCount();
            if($row > 0) {
                echo "<script>signup_success();</script>";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

require_once(_WEB_PATH_TEMPLATES . '/layout/header.php');
?>

<div class="modal-account">
    <!-- Đăng ký -->
    <div id="signup">
        <form action="" method="post" id="signup-form">
            <div class="header-signup">
                <h1 id="title__signup">Đăng kí</h1>
                <button type="button" class="btnclose" onclick=""><a href="?module=user" style="font-size: 48px">+</a></button>
            </div>
            <div class="body_signup">
                <div class="datasignup">
                    <label for="fullname">Họ và tên</label>
                    <input name="fullname" type="text" placeholder="Nguyễn Văn A" id="usernameSignUp">
                    <?php echo empty($errors['fullname']['required']) ? '' : '<p class="message fullnameSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['fullname']['required'] . '</p>' ?>
                    <?php echo empty($errors['fullname']['min_length']) ? '' : '<p class="message fullnameSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['fullname']['min_length'] . '</p>' ?>
                </div>
                <div class="datasignup">
                    <label for="email">Email</label>
                    <input name="email" type="email" placeholder="VD:nguyenvana@gmail.com" id="emailSignUp">
                    <?php echo empty($errors['email']['required']) ? '' : '<p class="message emailSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['email']['required'] . '</p>' ?>
                    <?php echo empty($errors['email']['unique']) ? '' : '<p class="message emailSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['email']['unique'] . '</p>' ?>
                </div>
                <div class="datasignup">
                    <label for="phonenumber">Số điện thoại</label>
                    <input name="phonenumber" type="text" placeholder="VD:0123456789" id="phonenumberSignUp">
                    <?php echo empty($errors['phonenumber']['required']) ? '' : '<p class="message phonenumberSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['phonenumber']['required'] . '</p>' ?>
                    <?php echo empty($errors['phonenumber']['invalid']) ? '' : '<p class="message phonenumberSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['phonenumber']['invalid'] . '</p>' ?>
                </div>
                <div class="datasignup">
                    <label for="adress">Địa chỉ</label>
                    <input name="address" type="text" placeholder="VD:273 An Dương Vương, Quận 5" id="addressSignUp">
                    <?php echo empty($errors['address']['required']) ? '' : '<p class="message addressSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['address']['required'] . '</p>' ?>
                </div>
                <div class="datasignup">
                    <label for="password">Mật khẩu</label>
                    <input name="password" type="password" placeholder="Mật khẩu" id="passwordSignUp">
                    <?php echo empty($errors['password']['required']) ? '' : '<p class="message passwordSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['password']['required'] . '</p>' ?>
                    <?php echo empty($errors['password']['min_length']) ? '' : '<p class="message passwordSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['password']['min_length'] . '</p>' ?>
                </div>
                <div class="datasignup">
                    <label>Nhập lại mật khẩu</label>
                    <input name="password_confirm" type="password" placeholder="Nhập lại mật khẩu" id="confirm-password">
                    <?php echo empty($errors['password_confirm']['required']) ? '' : '<p class="message password_confirmSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['password_confirm']['required'] . '</p>' ?>
                    <?php echo empty($errors['password_confirm']['different']) ? '' : '<p class="message password_confirmSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">' . $errors['password_confirm']['different'] . '</p>' ?>
                </div>
            </div>
            <div class="footsignup">
                <button id="btnsignup">Đăng ký
                </button>
                <p>Quay lại đăng nhập? <a href="?module=auth&action=login" onclick="showLoginForm()">Đăng nhập</a></p>
            </div>
        </form>
    </div>
</div>
<script>
    function signup_success() {
        alert("Đăng ký thành công!");
        window.location.href = "?module=auth&action=login";
    }
</script>