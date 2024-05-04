<!-- Đăng xuất -->
<?php
ob_start();
if(!defined('_CODE')){
    die('Access denied...');
}

session_destroy();
header('location: ?module=user');