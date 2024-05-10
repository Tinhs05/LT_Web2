<?php
require_once('../../includes/database.php');
$CustomerID = $_GET['id'];

// Từ ngày 
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';

// Đến ngày
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

$sql = "SELECT * FROM orders WHERE CustomerID = '$CustomerID' AND CancelDate IS NULL";

if (!empty($startDate) && empty($endDate)) {
    $sql .= " AND OrderDate >= '$startDate'";
} else if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND OrderDate BETWEEN '$startDate' AND '$endDate'";
}

$sql .= " ORDER BY OrderDate DESC;";

// echo $sql;

$listOrdersByUserID = getAllRows($sql);

echo json_encode($listOrdersByUserID);

