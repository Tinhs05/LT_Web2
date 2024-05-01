<?php
require_once('../../includes/database.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // print_r($_POST) ;
    // Validate productname: bắt buộc phải nhập
    if(empty($_POST['ten-ao'])){
        echo 'Hey bro quên nhập tên áo rồi!!!';
        die();
    }

    // Price validate: phải nhập
    if(empty($_POST['gia-ban'])){
        echo 'Áo cho hay gì mà không nhập giá ad ơi!!!';
        die();
    } else {
        if($_POST['gia-ban']<=0) {
            echo 'Hãy nhập giá đúng!!!';
            die();
        }
    }

    // Description validate: phải nhập
    if(empty($_POST['mo-ta'])){
        echo 'Hãy nhập mô tả để khách hàng dễ mua hàng nhé!!!';
        die();
    }


    if(empty($_FILES['up-hinh-anh']['name'])){
        echo 'Hãy chọn hình ảnh để khách hàng dễ mua hàng nhé!!!';
        die();
    }

    if(empty($_FILES['up-hinh-anh-hvr']['name'])){
        echo 'Hãy chọn hình ảnh bổ sung!!!';
        die();
    }

    $typeID = $_POST['category'];
    $productName = $_POST['ten-ao'];
    $price = $_POST['gia-ban'];
    $description = $_POST['mo-ta'];
    $fileIMG = './assets/image/'.$_FILES['up-hinh-anh']['name'];
    $fileIMGHV = './assets/image/'.$_FILES['up-hinh-anh-hvr']['name'];

    move_uploaded_file($_FILES['up-hinh-anh']['tmp_name'], 'C:\xampp\htdocs\LT_Web2\templates\assets\image\\'.$_FILES['up-hinh-anh']['name']);
    move_uploaded_file($_FILES['up-hinh-anh-hvr']['tmp_name'], 'C:\xampp\htdocs\LT_Web2\templates\assets\image\\'.$_FILES['up-hinh-anh-hvr']['name']);

    $dataInsert = [
        'typeid' => $typeID,
        'productname' => $productName,
        'image' => $fileIMG,
        'imagehv' => $fileIMGHV,
        'price' => $price,
        'description' => $description
    ];


    if(insert('product', $dataInsert)) {
        echo 'Thêm sản phẩm thành công.';
    }
} else {
    echo "Thêm sản phẩm thất bại!!!";
}




?>