<?php

$isUser = -1;
if(isset($_SESSION['user'])){
    $isUser = $_SESSION['user-id'];
}

if(isset($_POST["productID"])) {
    $productID = $_POST["productID"];
    
    try {
        $sql = "SELECT p.ProductID, t.TypeName, p.ProductName, p.Image, p.ImageHV, p.Price, p.Description FROM product p 
                INNER JOIN type t ON p.TypeID = t.TypeID
                WHERE ProductID = :productID AND p.Status = '1'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':productID', $productID);
        $stmt->execute();
        $resuilt = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (\Throwable $th) {
        echo "Lỗi: ".$th->getMessage();
    }finally{
        $conn = null;
    }
} else {
    // Nếu biến $_POST["productID"] không tồn tại
    echo "Lỗi: Không có dữ liệu được gửi từ phía client.";
}

//<!-- HTML -->
if(!empty($resuilt)){?>
    <div class="detail">
        <input type="hidden" id="user-id" value="<?php echo $isUser;?>">
        <input type="hidden" id="product-id" value="<?php echo $productID;?>">
        <button class="close_detail" onclick="closedetail()">+</button>
        <div class="title-container">
            <h1 class="title" id="titleprod"><?php echo $resuilt['ProductName'];?></h1>
        </div>
        <div class="detail-container">
            <div class="img-container">
            <img src="./templates<?php echo $resuilt['Image'];?>" alt="" id="img_main">
            <div class="swap-img-container">
                <img class="idtruoc" id="idtruoc" onclick="swap_img(this)" src="./templates<?php echo $resuilt['Image'];?>" style="border: 2px solid black;">
                <img class="idsau" id="idsau" src="./templates<?php echo $resuilt['ImageHV'];?>" onclick="swap_img(this)" style="border: none;">
            </div>
            </div>
            <div class="detail-content">
            <div class="div_type">
                <span class="type">Phân loại:</span>
                <span class="nametype" id="nametype"><?php echo $resuilt['TypeName'];?></span>
            </div>
            <div class="div_price">
                <h1 class="newprice" id="newprice"></h1>
                <h1 class="price" id="price"><?php echo number_format($resuilt['Price'], 0, ',', '.');?>&nbsp;₫</h1>
            </div>
            <div id="list-size" class="list-size">
            <ul class="btn-sizes">
                <li class="list-btn-size row-size">
                    <span class="icon-out iconszS" id="iconszS" style="display: none;"><i class="fa-thin fa-xmark-large"></i></span>
                    <button type="button" class="btn-size btns" id="btns">S</button>           
                </li>
                <li class="list-btn-size row-size">
                    <span class="icon-out iconszM" id="iconszM" style="display: none;"><i class="fa-thin fa-xmark-large"></i></span>
                    <button type="button" class="btn-size btnm" id="btnm">M</button>
                    
                </li>
                <li class="list-btn-size row-size active">
                    <span class="icon-out" id="iconszL" style="display: none;"><i class="fa-thin fa-xmark-large"></i></span>
                    <button type="button" class="btn-size btnl" id="btnl">L</button>
                    
                </li>
                <li class="list-btn-size row-size">
                    <span class="icon-out" id="iconszXL" style="display: none;"><i class="fa-thin fa-xmark-large"></i></span>
                    <button type="button" class="btn-size bntxl" id="btnxl">XL</button>
                </li>
            </ul>
        </div>
            <div id="table-size"> 
            <span class="btn-img-size" onclick="showtableSize()">Tham khảo bảng size</span>
            </div>
            <div id="div_quantity">
            <span class="lb-quantity">Số lượng:</span>
                <button class="quantity quantity-down" onclick="handleMinus(this)">-</button>
                <input class="amount input-qty" type="" value="1">
                <button class="quantity quantity-up" onclick="handlePlus(this)">+</button>
            </div> 
            
            <div class="div_describe"> 
            <span class="lb-describe">Mô tả sản phẩm:</span>
            <h5 id="detailDesc"><?php echo $resuilt['Description'];?></h5>
            </div>
            <div class="box-ctl"> 
                <button class="div_cart" id="btnAddCart" onclick="addPodCart()">THÊM VÀO GIỎ HÀNG</button>
                <button class="div_buy" onclick="buy_now()">MUA NGAY</button>
            </div>
            </div>
        </div>
    </div>
<?php
}
?>

