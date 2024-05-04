<!-- Đăng nhập tài khoản -->
<?php
ob_start();
// <!-- Header -->
require_once (_WEB_PATH_TEMPLATES.'/layout/header.php');
require_once('./includes/connect.php');

// <!-- Hàm xử lý -->
function get_user_info($conn, $user,$pass){
    try {
    $sql = "SELECT * FROM customer WHERE Email='".$user."' AND PassWord='".$pass."' AND Status='1'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resuilt = $stmt->fetch(PDO::FETCH_ASSOC);

    echo print_r($resuilt);
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }finally{
        $conn = null;
    }

    return $resuilt;
}
// <!-- Controller -->
    if((isset($_POST['dangnhap'])) && ($_POST['dangnhap'])){
        $user = $_POST['email'];
        $pass = $_POST['password'];
        $kq = get_user_info($conn, $user, $pass);

        if(!empty($kq)){
            if($kq['UserType']==1) header('location: ?module=admin&action=manager');
            else{
                $_SESSION['user']=$user;
                $_SESSION['user-id']= $kq['CustomerID'];
                $_SESSION['user-Name']= $kq['FullName'];
                header('location: ?module=user');
            }
        }else{
            echo 'Tài khoản hoặc mật khẩu không đúng';
        }
    }

?>

<!-- HTML -->
<div class="modal-account">
    <div id="login">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="login-form">
            <div class="header-login">
                <h1 id="title__signin">ĐĂNG NHẬP</h1>
                <button type="button" class="btnclose"><a href="?module=user" style="font-size: 48px">+</a></button>
            </div>

            <div class="bodylogin">
                <div class="datalogin">
                    <label for="email"><img src="./templates/assets/image/username.png"></label>
                    <input name="email" type="email" placeholder="Email" id="emailLogin" required>
                    <span class="message emaillog"></span>
                </div>
                <div class="datalogin">
                    <label for="password"><img src="./templates/assets/image/password.png"></label>
                    <input name="password" type="password" placeholder="Mật khẩu" id="passwordLogin" required>
                    <span class="message passwordlog"></span>
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