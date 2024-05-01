<?php
require_once('../../includes/database.php');
require_once('../../includes/functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Validate fullname: bắt buộc phải nhập, nhập lớn hơn 5 kí tự
    if(empty($_POST['fullname'])){
        echo 'Họ tên không được để trống!';
        die();
    }else{
        if(strlen($_POST['fullname'])<5){
            echo 'Họ tên không nhỏ hơn 5 kí tự!';
            die();
        }
    }

    // Email validate: phải nhập, đúng định dạng không, email đã được tạo hay chua
    if(empty($_POST['email'])){
        echo 'Email không được để trống!';
        die();
    }else{
        $email = $_POST['email'];
        $sql = "SELECT customerID FROM customer WHERE email = '$email'";
        if(countRows($sql) > 0){
            echo 'Email đã tồn tại!';
            die();
        }
    }

    //Phone Number Validate: phải nhập, có đúng định dạng không
    if(empty($_POST['phonenumber'])){
        echo 'Số điện thoại không được để trống!';
        die();
    }else{
        if(!isPhoneNumber($_POST['phonenumber'])){
            echo 'Số điện thoại không hợp lệ!';
            die();
        }
    }

    // Adress validate
    if(empty($_POST['address'])){
        echo 'Địa chỉ không được để trống!';
        die();
    }

    // Password Validate: phải nhập, >=8 kí tự 
    if(empty($_POST['password'])){
        echo 'Mật khẩu không được để trống!';
        die();
    }else{
        if(strlen($_POST['password'])<8){
            echo 'Mật khẩu không nhỏ hơn 8 kí tự!';
            die();
        }
    }

    // Passwore Comfirm Validate: phải nhập, phải giống ở trên
    if(empty($_POST['password_confirm'])){
        echo 'Nhập lại mật khẩu để xác nhận!';
        die();
    }else{
        if($_POST['password_confirm'] != $_POST['password']){
            echo 'Nhập lại mật khẩu không chính xác!';
            die();
        }
    }

    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phonenumber'];
    $joinDate = date("Y-m-d");
    $address = $_POST['address'];
    $password = $_POST['password'];
    // $password_confirm = $_POST['password_confirm'];

    $dataInsert = [
        'fullname' => $fullName,
        'email' => $email,
        'phonenumber' => $phoneNumber,
        'address' => $address,
        'password' => $password,
        'joindate' => $joinDate
    ];


    if(insert('customer', $dataInsert)) {
        echo 'Thêm khách hàng thành công.';
    }
} else {
    echo "Thêm khách hàng thất bại!!!";
}
?>