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