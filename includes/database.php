<?php
// if(!defined('_CODE')){
//     die('Access denied...');
// }
require_once('connect.php');

// require_once("config.php");

// Hàm query
function query($sql, $data=[], $check = false) {
    global $conn;
    $result = false;
    try{
        $stmt = $conn -> prepare($sql);
    
        if(!empty($data)) {
            $result =  $stmt->execute($data);
        }
        else {
            $result =  $stmt->execute();
        }
    }catch (Exception $exp){
        echo $exp -> getMessage().'<br>';
        echo "Error File: ".$exp -> getFile().'<br>';
        echo "Error Line: ".$exp -> getLine().'<br>';
        die();
    }

    if($check==true){
        return $stmt;
    }

    return $result;
}

// Hàm insert
function insert($table, $data) {
    $key = array_keys($data);
    $truong = implode(',', $key);
    $valueTable = ':'.implode(',:', $key);

    $sql = 'INSERT INTO '. $table . '('.$truong.')' . 'VALUES('. $valueTable.')';

    $result = query($sql, $data);
    return $result;
}

// Hàm update
function update($table, $data, $condition = ''){
    $update = '';
    foreach($data as $key => $value){
        $update .= $key.'= :'.$key.',';
    }
    $update = trim($update, ',');

    if(!empty($condition)){
        $sql = 'UPDATE '.$table.' SET '.$update.' WHERE '.$condition;
    } else {
        $sql = 'UPDATE '.$table.' SET '.$update;
    }

    $result = query($sql, $data);
    return $result;
}

//Hàm delete
function delete($table, $condition = ''){
    if(empty($condition)) {
        $sql = 'DELETE FROM '.$table;
    } else {
        $sql = 'DELETE FROM '.$table.' WHERE '.$condition;
    }

    $result = query($sql);
    return $result;
}


// Lấy nhiều dòng dữ liệu
function getAllRows($sql){
    $result = query($sql, '', true);
    if(is_object($result)){
        $dataFetch = $result -> fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

// Lấy 1 dòng dữ liệu(Lấy từ trên xuống dưới)
function getOneRow($sql){
    $result = query($sql, '', true);
    if(is_object($result)){
        $dataFetch = $result -> fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

// Đếm số dòng dữ liệu
function countRows($sql){
    $result = query($sql, '', true);
    if(!empty($result)){
        return $result -> rowCount();
    }
}