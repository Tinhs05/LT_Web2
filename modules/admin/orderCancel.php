<?php
require_once('../../includes/database.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $cancelDate = date("Y-m-d");

    $data = [
        'status' => 'Đã hủy',
        'canceldate' => $cancelDate
    ];

    update('orders', $data, "OrderID = $id");
    echo 'Đã hủy đơn hàng thành công.';

} else {
    echo 'error'; // Trả về 'error' nếu không có id được gửi
}
?>