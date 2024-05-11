<?php
$cancelDate = date("Y-m-d");
$cancel_order_id = $_POST['cancel_order_id'];

try {
    $sql = "UPDATE orders SET Status = 'Đã hủy', CancelDate = '$cancelDate' WHERE OrderID = '$cancel_order_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "Thành công";
} catch (\Throwable $th) {
    //throw $th;
}