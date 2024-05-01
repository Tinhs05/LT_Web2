<?php
require_once('../../includes/database.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM orders WHERE OrderID = '$id' ";

    $orderInfo = getOneRow($sql);    

    if($orderInfo['Status'] == 'Đang giao hàng'){
        $data = [
            'status' => 'Đã giao hàng',
            'receiveddate' => date("Y-m-d")
        ];
    } else if($orderInfo['Status'] == 'Chờ xác nhận'){
        $data = [
            'status' => 'Đang giao hàng'
        ];
    }

    update('orders', $data, "OrderID = $id");

} else {
    echo 'error'; // Trả về 'error' nếu không có id được gửi
}
?>