<?php
if(!defined('_CODE')){
    die('Access denied...');
}
try {
    $user = -1;
    if(isset($_SESSION['user-id'])){
        $user = $_SESSION['user-id'];
    }

    $sql = "SELECT p.ProductID, p.Image, p.ProductName, t.TypeName, p.Price, c.Quantity FROM cart c
            INNER JOIN product p ON p.ProductID = c.ProductID
            INNER JOIN type t ON t.TypeID = p.TypeID
            WHERE CustomerID = '.$user.' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resuilt = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resuilt);
} catch (\Throwable $th) {
    echo "Lỗi: ".$th->getMessage();
}
