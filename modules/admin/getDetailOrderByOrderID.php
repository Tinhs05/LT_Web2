<?php
require_once('../../includes/database.php');
$OrderID = $_GET['id'];

$sql = "SELECT d.OrderID, o.OrderDate, p.ProductName, d.Size, d.Quantity, p.Price
        FROM detailorders d
        JOIN orders o ON d.OrderID = o.OrderID
        JOIN product p ON d.ProductID = p.ProductID
        WHERE d.OrderID = '$OrderID'
        ;";

$listDetailOrdersByUserID = getAllRows($sql);

echo json_encode($listDetailOrdersByUserID);