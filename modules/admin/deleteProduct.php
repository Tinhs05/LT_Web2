<?php
require_once('../../includes/database.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];


    delete('product', "ProductID = $id");
     echo 'Đã xóa sản phẩm khỏi dữ liệu.';

    

} else {
    echo 'error'; // Trả về 'error' nếu không có id được gửi
}
?>