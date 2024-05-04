<?php
    function loadAllProducts(){
        try {
            $sql = 'Select * from product';
            $data = [];
            $stmt = query($sql, $data, true);
            $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;
            echo json_encode($result);

            $conn = null;
        } catch (Exeption $exp) {
            echo $exp -> getMessage().'<br>';
            echo "Error File: ".$exp -> getFile().'<br>';
            echo "Error Line: ".$exp -> getLine().'<br>';
        die();
        }
    }

?>