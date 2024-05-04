<?php
require_once('../../includes/database.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM orders WHERE OrderID = '$id' ";

    $orderInfo = getOneRow($sql);    

    if($orderInfo['Status'] == 'Đã giao hàng'){
        $data = [
            'status' => 'Đang giao hàng',
            'receiveddate' => null
        ];
    } else if($orderInfo['Status'] == 'Đang giao hàng'){
        $data = [
            'status' => 'Chờ xác nhận'
        ];
    }

    update('orders', $data, "OrderID = $id");

} else {
    echo 'error'; // Trả về 'error' nếu không có id được gửi
}
?>