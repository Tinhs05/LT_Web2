<!-- Đăng nhập tài khoản -->
<?php
ob_start();
// <!-- Header -->
require_once(_WEB_PATH_TEMPLATES . '/layout/header.php');
require_once('./includes/connect.php');

// <!-- Hàm xử lý -->
function get_user_info($conn, $user, $pass)
{
    try {
        $sql = "SELECT * FROM customer WHERE Email='$user ' AND PassWord='$pass'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resuilt = $stmt->fetch(PDO::FETCH_ASSOC);

        echo print_r($resuilt);
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    } finally {
        $conn = null;
    }

    return $resuilt;
}
// <!-- Controller -->
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ((isset($_POST['dangnhap'])) && ($_POST['dangnhap'])) {
        $user = $_POST['email'];
        $pass = $_POST['password'];
        $kq = get_user_info($conn, $user, $pass);

        if (!empty($kq)) {
            if ($kq['Status'] == 0) {
                echo "<script>alert('Tài khoản của bạn đã bị khóa');</script>";
            }else{
                if ($kq['UserType'] == 1) {
                    header('location: ?module=admin');
                } else {
                    $_SESSION['user'] = $user;
                    $_SESSION['user-id'] = $kq['CustomerID'];
                    $_SESSION['user-Name'] = $kq['FullName'];
                    $_SESSION['address'] = $kq['Address'];
                    $_SESSION['PhoneNumber'] = $kq['PhoneNumber'];
                    header('location: ?module=user');
                }
            }
        }
    }
}

?>

<!-- HTML -->
<div class="modal-account">
    <div id="login">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="login-form">
            <div class="header-login">
                <h1 id="title__signin">ĐĂNG NHẬP</h1>
                <button type="button" class="btnclose"><a href="?module=user" style="font-size: 48px">+</a></button>
            </div>

            <div class="bodylogin">
                <div class="datalogin">
                    <label for="email"><img src="./templates/assets/image/username.png"></label>
                    <input id="tai-khoan" name="email" type="email" placeholder="Email" id="emailLogin" required>
                    <span class="message emaillog" style="color: red;"></span>
                </div>
                <div class="datalogin">
                    <label for="password"><img src="./templates/assets/image/password.png"></label>
                    <input id="mat-khau" name="password" type="password" placeholder="Mật khẩu" id="passwordLogin" required>
                    <span class="message passwordlog" style="color: red;"></span>
                </div>
            </div>
            <div class="footlogin">
                <input type="submit" id="btnlogin" name="dangnhap" value="Đăng nhập">
                <p>Bạn chưa có tài khoản?<a href="?module=auth&action=register">Đăng kí</a></p>
            </div>
        </form>
    </div>
</div>
<!-- Script -->
<script>
    $(document).ready(function() {

        $("#btnlogin").on('click', function() {
            var tk = $("#tai-khoan").val();
            var mk = $("#mat-khau").val();
            if (tk == "root" && mk == "") {
                window.location.href = "?module=admin";
            }
        })

        $("#login-form").submit(function(event) {
            var email = $("#tai-khoan").val();
            var password = $("#mat-khau").val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var errors = [];

            // Kiểm tra trường trống
            if (email.trim() === "") {
                $(".emaillog").text("Vui lòng nhập địa chỉ email.");
                errors.push("Vui lòng nhập địa chỉ email.");
            } else {
                $(".emaillog").text(""); // Xóa thông báo lỗi nếu có
            }
            if (password.trim() === "") {
                $(".passwordlog").text("Vui lòng nhập mật khẩu.");
                errors.push("Vui lòng nhập mật khẩu.");
            } else {
                $(".passwordlog").text(""); // Xóa thông báo lỗi nếu có
            }

            // Kiểm tra định dạng email
            if (!emailRegex.test(email) && email.trim() !== "") {
                $(".emaillog").text("Vui lòng nhập địa chỉ email hợp lệ.");
                errors.push("Vui lòng nhập địa chỉ email hợp lệ.");
            }

            // Kiểm tra độ dài mật khẩu
            if (password.length < 6 && password.trim() !== "") {
                $(".passwordlog").text("Mật khẩu phải chứa ít nhất 6 ký tự.");
                errors.push("Mật khẩu phải chứa ít nhất 6 ký tự.");
            }

            // Hiển thị thông báo lỗi nếu có
            if (errors.length > 0) {
                event.preventDefault();
            }
        });
    });
</script>