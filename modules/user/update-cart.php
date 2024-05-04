<?php
$productQuantities = json_decode(file_get_contents("php://input"), true);
if($productQuantities){
    foreach ($productQuantities as $p) {
        $productID = $p['productID'];
        $quantity = $p['quantity'];

        $sql = "UPDATE cart SET Quantity = :quantity WHERE ProductID = :productID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmt->execute();
        
        echo "Thành công";
    }
}