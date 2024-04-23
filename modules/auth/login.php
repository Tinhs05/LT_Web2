<!-- Đăng nhập tài khoản -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}
// <!-- Header -->
require_once (_WEB_PATH_TEMPLATES.'/layout/header.php');

$password = '1234556';
// $md5 = md5($password);
// $sha1 = sha1($password);
// echo $md5;
// echo '<br>'.$sha1;

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
// echo $passwordHash;

$checkPass = password_verify('1234556', $passwordHash);
var_dump($checkPass);

?>


<div id="modal">
    <div id="login">
        <form action="" method="post" id="login-form">
            <div class="header-login">
                <h1 id="title__signin">ĐĂNG NHẬP</h1>
                <button type="button" class="btnclose" onclick="closeForm()"><a href="?module=user" style="font-size: 48px">+</a></button>
            </div>

            <div class="bodylogin">
                <div class="datalogin">
                    <label for="Email"><img src="./templates/assets/image/username.png"></label>
                    <input name="email" type="text" placeholder="Email" id="emailLogin">
                    <span class="message emaillog"></span>
                </div>
                <div class="datalogin">
                    <label for="password"><img src="./templates/assets/image/password.png"></label>
                    <input name="password" type="password" placeholder="Mật khẩu" id="passwordLogin">
                    <div class="showpass">
                        <img src="./templates/assets/image/showPass.png" alt="" id="showIcon">
                        <img src="./templates/assets/image/hidenPass.png" alt="" id="hideIcon">
                    </div>
                    <span class="message passwordlog"></span>
                </div>
            </div>
            <div class="footlogin">
                <button type="submit" id="btnlogin">
                <a href="" style="color: white; text-decoration: none;">Đăng nhập</a>
                </button>
                <p>Bạn chưa có tài khoản?<a href="?module=auth&action=register" onclick="showSignupForm()">Đăng kí</a></p>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<?php 
    require_once (_WEB_PATH_TEMPLATES.'/layout/footer.php');
?>