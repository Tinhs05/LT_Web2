<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
?>

<!-- Header -->
<?php
    require_once (_WEB_PATH_TEMPLATES.'/layout/header.php');
    require_once('product.php');
?>
<body>
<div class="header" > 
        <div class="headbox" id="headbox">
           <!-- <div><picture></picture></div> -->
           
                <div class="headleft">
                     <div><img src="./templates/assets/logoStore.png" id="logo"></div>
                </div>
                <form class="headcenter" class="form-search">
                     <span class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
                     <input type="text" id="form-search-product" type="text" class="form-search-input inputsearch" placeholder="TÌm kiếm sản phẩm"  onclick="searchform()">
                     <span type="button" class="filter-btn"><a href="?module=user&action=filter"><i class="fa-light fa-filter-list"></i>Lọc</a></span>
                </form>
                <div class="headerright">
                    <div class="headerright-click ">
                       <div id="AccountLogin">
                            <?php
                                if(isset($_SESSION['user'])){
                                    echo '<button  id="btnAccount"><a href="?module=auth&action=account-centre" style="color: #333; text-decoration: none;"><i class="fa-regular fa-user" style="margin: 0 10px 0 0"></i>'.$_SESSION['user-Name'].'</a></button>';
                                }else{
                                    echo '<button><a href="?module=auth&action=login" style="color: #333; text-decoration: none;">Đăng nhập</a></button>';
                                }
                            ?>
                        </div>
                        <div class="header-middle-right-menu">
                            <ul class="header-middle-right">
                             </ul>
                        </div>
                    </div>
                    <div class="headerright-click"><button onclick="openCart()"> <i class="fa-regular fa-cart-shopping"></i></button></div>
                </div>
        </div>
        <div class="lowmenu">
                  <div class=""> <button type="button"><i class="fa-regular fa-house"></i><a href="?module=user">Trang chủ</a></button></div>
                   <div class=""> <button  onclick="showCategory('Áo sơ mi')">Áo sơ mi</button></div>
                   <div class=""> <button onclick="showCategory('Áo thun')">Áo thun</button></div>
                   <div class=""> <button onclick="showCategory('Áo Khoác')">Áo Khoác</button></div>
                   <div class=""> <button onclick="showCategory('Áo Polo')">Áo Polo</button></div>
                   <div class=""> <button onclick="showCategory('Áo Hoodie')">Áo Hoodie</button></div>
   
               <!-- </div> -->
        </div>
        <div class="advanced-search">
            <div class="container">
                <div class="advanced-search-category">
                    <span>Phân loại </span>
                    <select name="" id="advanced-search-category-select" onchange="searchProducts()">
                        <option>Tất cả</option>
                        <option>Áo Sơ mi</option>
                        <option>Áo Thun</option>
                        <option>Áo Khoác</option>
                        <option>Áo polo</option>
                        <option>Áo Hoodie</option>
                        <option>Sale</option>
                    </select>
                </div>
                <div class="advanced-search-price">
                    <div id="price-range">
                        <label for="min-price">Giá :</label>
                        <input type="text" id="min-price" readonly> - <input type="text" id="max-price" readonly>
                    </div>
                    <div>
                        <button id="filter-price" onclick="filterProductPrice()"><i class="fa-light fa-filter-circle-dollar"></i></button>
                    </div>
                </div>

                <div class="advanced-search-control">
                    <button id="sort-ascending" onclick="searchProducts(1)"><i class="fa-regular fa-arrow-up-short-wide"></i></button>
                    <button id="sort-descending" onclick="searchProducts(2)"><i class="fa-regular fa-arrow-down-wide-short"></i></button>
                    <button id="reset-search" onclick="searchProducts(0)"><i class="fa-light fa-arrow-rotate-right"></i></button>
                    <button onclick="closeSearchAdvanced()"><i class="fa-light fa-xmark"></i></button>
                </div>
            </div>
        </div>

    </div>
    <div class="head-img" id="head-img">
        <button class="slide-img"><img src="./templates/assets/slide1.webp"  alt=""></button> 
         <button class="slide-img"><img src="./templates/assets/slide2.webp"  alt=""></button>
     </div>

    <div>
       <div class="home-title-block" id="home-title">
            <h2 class="home-title">Khám phá sản phẩm của chúng tôi</h2>
        </div>
        <div class="container-products">     
            <div class="home-products" id="home-products">
                <?php
                    $list_product = loadAllProducts();
                    foreach ($list_product as $p ) {?>
                        <div class="col-product">
                            <article class="card-product">
                                <div class="card-header">
                                <input type="hidden" class="product-id" value="<?php echo $p["ProductID"];?>">                            
                                    <a href="#" class="card-image-link">
                                    <img class="card-image" src="./templates<?php echo $p["Image"];?>" loading="lazy" alt="">
                                    <img class="card-image-hover" src="./templates<?php echo $p["ImageHV"];?>" loading="lazy" alt="">
                                    </a>
                                </div>
                                <div class="prod-info">
                                    <div class="card-content">
                                        <div class="card-title">
                                            <a href="#" class="card-title-link"><?php echo $p["ProductName"];?></a>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="product-price">
                                        <span class="current-price"></span>
                                            <span class="old-price"><?php echo number_format($p["Price"], 0, ',','.');?>&nbsp;₫</span>

                                        </div>
                                    <div class="product-buy">
                                        <button class="card-button order-item"><i class="fa-regular fa-cart-shopping-fast"></i>Xem sản phẩm</button>
                                    </div> 
                                </div>
                                </div>
                            </article>
                        </div>
                <?php
                    }
                ?>
            </div>
            <div class="page-nav">
                <ul class="page-nav-list">
                </ul>
            </div>
         </div>
        
    </div>
    <div id="div_detail" ></div>
    <div id="show-imgSize">
        <div class="modal-img">
            <button type="button" id="img-size-close"><i class="fa-regular fa-xmark"></i></button>
            <div id="imgModal">
               <img src="./templates/assets/bảng size.webp" alt="">
            </div>
        </div>
    </div>

    <div class="detail-order">
        <div class="modal-container">
            <h3 class="modal-container-title">CHI TIẾT ĐƠN HÀNG</h3>
            <button class="modal-close"><i class="fa-regular fa-xmark"></i></button>
            <div class="modal-detail-order">
            </div>
            </form>
        </div>
    </div>
    <div class="modal-cart">
        <div class="cart-container">
            <div class="cart-header">
                <h3 class="cart-header-title"><i class="fa-regular fa-basket-shopping-simple"></i> Giỏ hàng</h3>
                <button class="cart-close" onclick="closeCart()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>
            <div class="cart-body">
                <div class="gio-hang-trong">
                    <i class="fa-thin fa-cart-xmark"></i>
                    <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                </div>
                <div id="cart-list">
                    <div class ="cart-left">
                        <table>
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Phân loại</td>
                                    <td>Giá</td>
                                    <td>Số lượng</td>
                                    <td>Tùy chọn</td>
                                </tr>
                            </thead>
                            <tbody id="showProdCart">
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-right">
                      <div class="cart-total-price">
                         <p class="text-tt">Tạm tính:</p>
                         <p class="text-price">0đ</p>
                      </div>
                      <div class="cart-ship">
                        <p>Giao hàng</p>
                        <div>
                            <form class="list-ship" id="radioForm">
                                <div>
                                    <input type="radio" name="shippingOption" class="shippingOption" value="20000" checked>
                                    <label for="" id="transport-fee"></label>
                                </div>
                                <div>
                                    <input type="radio" name="shippingOption" class="shippingOption" value="30000" >
                                    <label for="" id="speed-ship"></label>
                                </div>
                            </form>
                            <p id="ship-to-province">Vận chuyển đến <strong>Hồ Chí Minh</strong></p>
                            
                            <form action="" id="shippingForm">
                                <span class="change-address" onclick="showSectionProv()">Đổi địa chỉ</span>
                                <section class="sectionProvince">
                                    <p>
                                        <select name="" id="provinceSelect" class="formProvinces" onchange="selectProv()" >
                                            <option value="selected" >Chọn tỉnh/thành phố</option>
                                        </select>
                                        <p>Địa chỉ chi tiết</p>
                                        <input type="text" class="detail-address">
                                    </p>
                                </section>
                            </form>
                        </div>
                      </div>
                      <div class="total-price">
                          <p>Tổng:</p>
                          <p id="total-bill">100000</p>
                      </div>
                    </div>
                </div>
               <div class="cart-footer">
                   <div class="cart-footer-payment">
                          <button class="them-sp"><i class="fa-sharp fa-solid fa-arrow-left"></i></i>Tiếp tục mua sắm</button>
                          <button class="thanh-toan disabled">Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div id="advertise"></div>  
</body>
    
<!-- Footer -->
<div class="footer">
    <div class="footleft">Thông tin shop</div>
    
</div>
<?php 
    require_once (_WEB_PATH_TEMPLATES.'/layout/footer.php');
?>
       


