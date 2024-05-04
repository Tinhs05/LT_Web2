<?php
require_once('../../includes/database.php');
$customerId = $_GET['id'];

$sql = "SELECT * FROM customer WHERE CustomerID = '$customerId' ";

$customerInfo = getOneRow($sql);

$customerInfo = json_encode($customerInfo);

echo $customerInfo;