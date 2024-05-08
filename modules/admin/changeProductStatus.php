<?php
require_once('../../includes/database.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // $isSold = countRows("SELECT * FROM detailorders WHERE ProductID = '$id' ");

    $data = [
        'status' => 1
    ];

    update('product', $data, "ProductID = $id");

    echo 'Đã hiển thị sản phẩm lên trang bán hàng.';
    
    // if($isSold > 0) {
    //     update('product', $data, "ProductID = $id");
    //     echo 'Đã ẩn sản phẩm ở trang bán hàng';
    // } else {
    //     echo 'Sản phẩm này chưa được bán ra';
        
    // }

    

} else {
    echo 'error'; // Trả về 'error' nếu không có id được gửi
}
?>
