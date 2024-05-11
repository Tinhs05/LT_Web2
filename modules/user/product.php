<?php
try {
    $sql = 'Select * from product order by ProductID desc';
    $data = [];
    $stmt = query($sql, $data, true);
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    echo json_encode($result);
} catch (Exception $exp) {
    echo $exp->getMessage() . '<br>';
    echo "Error File: " . $exp->getFile() . '<br>';
    echo "Error Line: " . $exp->getLine() . '<br>';
    die();
} finally {
    $conn = null;
}
    