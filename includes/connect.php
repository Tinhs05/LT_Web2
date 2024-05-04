<?php
// if(!defined('_CODE')){
//     die('Access denied...');
// }

// require_once('../../config.php');
// // Connect db
const _HOST = 'localhost';
const _DB = 'webbanao';
const _USER = 'root';
const _PASS = '';


try{
    if(class_exists('PDO')){
        $dsn = 'mysql:host='._HOST.';dbname='._DB;

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //Set utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Tạo thông báo ra ngoại lệ khi gặp lỗi
        ];

        $conn = new PDO($dsn,_USER,_PASS, $options);
    }
    
} catch(Error $e) {
    echo '<div style="color: red; padding: 20px; border: 1px solid red;">'.$e -> getMessage().'</div>';
    die();
}
