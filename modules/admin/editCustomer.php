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

    $fullName = $_POST['fullname'];
    $phoneNumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $customerID = $_POST['customer_id'];

    $dataInsert = [
        'fullname' => $fullName,
        'phonenumber' => $phoneNumber,
        'address' => $address,
        'status' => $status,
    ];


    if(update('customer', $dataInsert, "CustomerID = $customerID")) {
        echo 'Thay đổi thông tin khách hàng thành công.';
    };
} else {
    echo "Thay đổi thông tin khách hàng thất bại!!!";
}
