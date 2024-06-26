<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
?>

<!-- Header -->
<?php
    require_once (_WEB_PATH_TEMPLATES.'/layout/header.php');
?>

<div class="header" > 
        <div class="headbox" id="headbox">
           <!-- <div><picture></picture></div> -->
           
                <div class="headleft">
                     <div><img src="./templates/assets/logoStore.png" id="logo"></div>
                </div>
                <form class="headcenter" class="form-search">
                     <span class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
                     <input type="text" id="form-search-product" type="text" class="form-search-input inputsearch" placeholder="TÌm kiếm sản phẩm"  onclick="searchform()">
                     <span class="filter-btn"><i class="fa-light fa-filter-list"></i>Lọc</span>
                </form>
                <div class="headerright">
                    <div class="headerright-click ">
                       <div id="AccountLogin">
                           <button  id="btnAccount"  onclick="showForm()">
                           <a href="?module=admin&action=homeManager" style="color: #333; text-decoration: none;">Đăng nhập</a>
                        </button>
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
                  <div class=""> <button type="button"><i class="fa-regular fa-house"></i><a href="">Trang chủ</a></button></div>
                   <div class=""> <button  onclick="showCategory('Áo sơ mi')">Áo sơ mi</button></div>
                   <div class=""> <button onclick="showCategory('Áo thun')">Áo thun</button></div>
                   <div class=""> <button onclick="showCategory('Áo Khoác')">Áo Khoác</button></div>
                   <div class=""> <button onclick="showCategory('Áo Polo')">Áo Polo</button></div>
                   <div class=""> <button onclick="showCategory('Áo Hoodie')">Áo Hoodie</button></div>
                   <div class=""> <button onclick="showCategory('Sale')">Sale</button></div>
   
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
            </div>
            <div class="page-nav">
                <ul class="page-nav-list">
                </ul>
            </div>
         </div>
        
    </div>

   
    <div id="div_detail" >
        <div class="detail">
            <button class="close_detail" onclick="closedetail()">+</button>
       <div class="title-container">
        <h1 class="title" id="titleprod"> Tên Áo</h1>
      </div>
      <div class="detail-container">
        <div class="img-container">
          <img src="" alt="" id="img_main">
          <div class="swap-img-container">
              <img class="idtruoc" id="idtruoc" onclick="swap_img(this)"/>
              <img class="idsau" id="idsau" src=""  onclick="swap_img(this)"/>
          </div>
        </div>
        <div class="detail-content">
          <div class="div_type">
            <span class="type">Phân loại:</span>
            <span class="nametype" id="nametype"></span>
          </div>
          <div class="div_price">
            <h1 class="newprice" id="newprice"></h1>
            <h1 class="price" id="price"></h1>

          </div>
          <div id ="list-size" class= "list-size">
           <ul class="btn-sizes">
              <li class="list-btn-size row-size active">
                  <span class="icon-out iconszS" id="iconszS"><i class="fa-thin fa-xmark-large"></i></span>
                  <button type = "button" class="btn-size btns" id="btns">S</button>           
              </li>
              <li class="list-btn-size row-size ">
                  <span class="icon-out iconszM" id="iconszM"><i class="fa-thin fa-xmark-large"></i></span>
                  <button type = "button" class="btn-size btnm" id="btnm" >M</button>
                 
              </li>
              <li class="list-btn-size row-size">
                  <span class="icon-out" id="iconszL"><i class="fa-thin fa-xmark-large"></i></span>
                  <button type = "button" class="btn-size btnl" id="btnl" >L</button>
                
              </li>
              <li class="list-btn-size row-size">
                  <span class="icon-out" id="iconszXL"><i class="fa-thin fa-xmark-large"></i></span>
                  <button type = "button" class="btn-size bntxl" id="btnxl" >XL</button>
              
              </li>
          </ul>
       </div>
          <div id="table-size"> 
          <span class="btn-img-size" onclick="showTbSize()">Tham khảo bảng size</span>
          </div>
          <div id="div_quantity">
          <span class="lb-quantity">Số lượng:</span>
            <button class="quantity" id="quantity-down" onclick="handleMinus()">-</button>
            <input id="amount" class="input-qty" name="amount" type="" value="1">
            <button class="quantity " id="quantity-up" onclick="handlePlus()">+</button>
          </div> 
           
          <div class="div_describe"> 
          <span class="lb-describe">Mô tả sản phẩm:</span>
          <h5 id="detailDesc"></h5>
           </div>
           <div class="box-ctl"> 
                <button class="div_cart" id="btnAddCart" >THÊM VÀO GIỎ HÀNG</button>
                <button class="div_buy" >MUA NGAY</button>
           </div>
          </div>
      </div>
        </div>
    </div>
    <div id="show-imgSize">
        <div class="modal-img">
            <button type="button" id="img-size-close"><i class="fa-regular fa-xmark"></i></button>
            <div id="imgModal">
               <img src="./templates/assets/bảng size.webp" alt="">
            </div>
        </div>
    </div>


    <div class="account-container">
      <div class="account-box">
        <div class="account-menu">
          <h3>Tài khoản</h3>
          <ul>
            <li><a href="?module=admin&action=manager"><i class="fa-light fa-gear"></i> Quản lý cửa hàng</a></li>
            <li class="sidebar-list-item active"><a href="#"  >Thông tin tài khoản</a></li>
            <li class="sidebar-list-item"><a href="#"  >Lịch sử mua hàng</a></li>
            <li class="sidebar-list-item"><a href="#"  >Đổi mật khẩu</a></li>
          </ul>
        </div>
        <div class="account-wrapper">
            <div class="account-content  active " id="account-info">
                <h3>Thông tin cá nhân</h3>
                <ul>
                  <li>
                    <label>Họ tên</label>
                    <input type="text" id="name" />
                  </li>
                  <li>
                    <label>Email</label>
                    <input type="email" id="email" />
                  </li>

                  <li>
                    <label>Số điện thoại</label>
                    <input type="tel" id="phone" />
                  </li>
                  <li>
                    <label>Địa chỉ</label>
                    <input type="text" id="address" />
                  </li>
                  <li>
                    <button onclick="updateAccountInfo()">Cập nhật thông tin tài khoản</button>
                  </li>
                </ul>
              </div>              
          
            <div class="account-content" id="order-history">
              <h3>Lịch sử mua hàng</h3>
               <div class="table">
              <table>
                <thead>
                  <tr>
                    <td>Mã đơn hàng</td>
                    <td>Tên người nhận</td>
                    <td>Ngày mua</td>
                    <td>Tổng tiền</td>
                    <td>Trạng thái</td>
                    <td>Chi tiết</td>
                  </tr>
                </thead>
                <tbody id="showOrder">
                </tbody>
              </table>
            </div>
            </div>
          
            <div class="account-content" id="change-password">
              <h3>Đổi mật khẩu</h3>
              <form action="/account/change-password" method="post" id="changePass-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                    <label for="old_password">Mật khẩu hiện tại</label>   
                    <input type="password" name="old_password" id="old_password" class="form-control" required />
                    <span class="message"></span>
                    </div>  
                    <div
                    class="form-group">  
                    <label
                    for="new_password">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required/>
                    <span class="message"></span>
                    </div>     
                    <div
                    class="form-group">
                    <label for="confirm_password">Xác nhận mật khẩu mới</label>     
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required/>
                    <span class="message"></span>      
                    </div>      
                <button type="submit" class="btn btn-primary">Xác nhận</button>
              </form>
            </div>
        </div>
        <div class="exit-account-container" onclick="toggleAccountContainer()">Thoát</div>
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
                                <td>Size</td>
                                <td>Giá</td>
                                <td>Số lượng</td>
                                <td>Tạm tính</td>
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
                                    <input type="radio" name="shippingOption" class="shippingOption" value="20000" >
                                    <label for="" id="transport-fee"></label>
                                </div>
                                <div>
                                    <input type="radio" name="shippingOption" class="shippingOption" value="30000" checked>
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
    <div class="checkout-page">
        <div class="checkout-header">
            <div class="checkout-return">
                <button onclick="closecheckout()"><i class="fa-regular fa-chevron-left"></i></button>
            </div>
            <h2 class="checkout-title">Thanh toán</h2>
        </div>
        <main class="checkout-section container">
            <div class="checkout-col-left">
                <div class="checkout-row">
                    <div class="checkout-col-title">
                        Thông tin người nhận
                    </div>
                    <div class="checkout-col-content">
                        <div class="content-group">
                            <form action="" class="info-nhan-hang">
                                <div class="form-group">
                                    <label for="">Họ và tên</label>
                                    <input id="tennguoinhan" name="tennguoinhan" type="text"
                                        placeholder="Tên người nhận" class="form-control">
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input id="sdtnhan" name="sdtnhan" type="text" placeholder="Số điện thoại nhận hàng"
                                        class="form-control">
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Tỉnh/Thành Phố</label>
                                    <select name="" id="selectProvinceBill" class="formProvinces">
                                        <option value="">Chọn tỉnh/thành phố</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Địa chỉ chi tiết</label>
                                    <input id="diachinhan" name="diachinhan" type="text" placeholder="Địa chỉ nhận hàng"
                                        class="form-control chk-ship">
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <p class="checkout-content-label">Ghi chú đơn hàng</p>
                                    <textarea type="text" class="note-order" placeholder="Nhập ghi chú"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>            
            </div>
            <div class="checkout-col-right">
                <div class="checkout-col-right-head">
                    <p class="checkout-content-label">Đơn hàng</p>
                    <p class="checkout-content-label">Tạm tính</p>
                </div>
                <div class="bill-total" id="list-order-checkout">
                </div>
                <div class="bill-payment">
                    <div class="total-bill-order">
                        <div class="priceFlx">
                            <div class="text">
                                 Tạm tính
                            </div>
                            <div class="price-detail">
                                <span id="checkout-cart-total"></span>
                            </div>
                        </div>
                        <div class="priceFlx chk-ship">
                        <form class="list-ship" id="radioFormShip">
                           <div>
                              <input type="radio" name="shippingOps" class="shippingOps" value="20000" >
                              <label for="" id="transport-fee-bill"></label>
                          </div>
                          <div>
                              <input type="radio" name="shippingOps" class="shippingOps" value="30000" checked>
                              <label for="" id="speed-ship-bill"></label>
                          </div>
                        </form>
                        </div>
                    </div>
                    <div class="policy-note">
                        Bằng việc bấm vào nút “Đặt hàng”, tôi đồng ý với
                        <a href="#" target="_blank">chính sách hoạt động</a>
                        của chúng tôi.
                    </div>
                </div>
                <div class="total-checkout">
                    <div class="text">Tổng tiền</div>
                    <div class="price-bill">
                        <div class="price-final" id="checkout-cart-price-final">0</div>
                    </div>
                </div>
                <button class="complete-checkout-btn">Đặt hàng</button>
            </div>
        </main>
    </div>     
     
    
<!-- Footer -->
<div class="footer">
    <div class="footleft">Thông tin shop</div>
    
</div>
<?php 
    require_once (_WEB_PATH_TEMPLATES.'/layout/footer.php');
?>
       


