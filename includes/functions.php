<?php
if(!defined('_CODE')){
    die('Access denied...');
}

//Import header-footer
function layouts($layoutName = 'header'){
    if(file_exists(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php')){
        require_once(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php');
    }
}

// Kiểm tra phương thức get
function isGet(){
    if($_SERVER['REQUEST_METHOD']=='GET'){
        return true;
    }
    return false;
}

// Kiểm tra phương thức post
function isPost(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        return true;
    }
    return false;
}

// Hàm filter lọc dữ liệu
function filter(){
    $filterArr = [];
    if(isGet()){
        //Xử lý dữ liệu trước khi hiển thị ra
        //return $_GET;
        if(!empty($_GET)){
            foreach($_GET as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    if(isPost()){
        if(!empty($_POST)){
            foreach($_POST as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    return $filterArr;
}

//Kiểm tra email
function isEmail($email){
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

//Kiểm tra số nguyên
function isNumberInt($number){
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}

//Kiểm tra số thực
function isNumberFloat($number){
    $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}

// Kiểm tra số điện thoại
function isPhoneNumber($phone){
    $checkZero = false;
    if($phone[0]==0){
        $checkZero = true;
        $phone = substr($phone, 1); 
    }

    $checkNumber = false;
    if(isNumberInt($phone) && strlen($phone)==9){
        $checkNumber = true;
    }

    if($checkZero && $checkNumber){
        return true;
    } 
    return false;
}

