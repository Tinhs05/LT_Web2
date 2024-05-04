<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$productID = $_POST['productID'];
try {
    $sql = "DELETE FROM `cart` WHERE ProductID = :productID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->rowCount();

    echo $row;
} catch (\Throwable $th) {
    echo "Lỗi: ".$th->getMessage();
}finally{
    $conn = null;
}
