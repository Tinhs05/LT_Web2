<?php
if(!defined('_CODE')){
    die('Access denied...');
}

    if(isset($_POST['userID'])) $userID = $_POST['userID'];
    if(isset($_POST['productID'])) $productID = $_POST['productID'];
    if(isset($_POST['quantity'])) $quantity = $_POST['quantity'];

    try {
        $sql = "INSERT INTO cart (CustomerID, ProductID, Quantity) VALUES (:userID, :productID, :quantity)
                ON DUPLICATE KEY UPDATE Quantity = Quantity + :quantity";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        echo "Thêm thành công: ".$rowCount;
    } catch (\Throwable $th) {
        echo "Lỗi: ".$th->getMessage();
    } finally {
        $conn = null;
    }
