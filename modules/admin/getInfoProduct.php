<?php
require_once('../../includes/database.php');
$productId = $_GET['id'];

$sql = "SELECT product.* FROM product WHERE ProductID = '$productId' ";

$productInfo = getOneRow($sql);

$productInfo = json_encode($productInfo);

echo $productInfo;