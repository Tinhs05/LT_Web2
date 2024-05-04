<?php
$userID = $_SESSION['user-id'];
$deliverName = htmlspecialchars($_POST['deliveryName']);
$receiver = htmlspecialchars($_POST['receiver']);
$phoneNumber = htmlspecialchars($_POST['phoneNumber']);
$address = htmlspecialchars($_POST['address']);
$priceTotal = htmlspecialchars($_POST['priceTotal']);
$productList = $_POST['productList'];

// Tạo một hóa đơn
try {
    $orderDate = date("Y-m-d");

    $sql = "INSERT INTO orders(CustomerID, DeliveryName, Receiver, PhoneNumber, Address, OrderDate, PriceTotal, Status) 
            VALUES (:userID,:deliverName,:receiver,:phoneNumber,:address,:orderDate,:priceTotal,'Chờ xác nhận')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userID',$userID, PDO::PARAM_INT);
    $stmt->bindParam(':deliverName',$deliverName);
    $stmt->bindParam(':receiver',$receiver);
    $stmt->bindParam(':phoneNumber',$phoneNumber);
    $stmt->bindParam(':address',$address);
    $stmt->bindParam(':orderDate',$orderDate);
    $stmt->bindParam(':priceTotal',$priceTotal, PDO::PARAM_INT);
    $stmt->execute();

    $orderID =  $conn->lastInsertId();

    foreach ($productList as $p) {
        $productID = $p['ProductID'];
        $quantity = $p['Quantity'];

        $sql2 = "INSERT INTO detailorders(OrderID, ProductID, Quantity, Status) 
                VALUES (:orderID, :productID, :quantity, 1)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':orderID',$orderID, PDO::PARAM_INT);
        $stmt2->bindParam(':productID',$productID, PDO::PARAM_INT);
        $stmt2->bindParam(':quantity',$quantity, PDO::PARAM_INT);
        $stmt2->execute();
    }

    echo "Tạo thành công hóa đơn và chi tiết hóa đơn";
} catch (\Throwable $th) {
    echo "Lỗi: ".$th->getMessage();
}

//Xóa giỏ hàng
try {
    $sql3 = "DELETE FROM cart WHERE CustomerID = :user";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bindParam(':user', $userID, PDO::PARAM_INT);
    $stmt3->execute();

    echo "Xóa giỏ hàng thành công";
} catch (\Throwable $th) {
    echo "Lỗi: ".$th->getMessage();
}finally{
    $conn = null;
}