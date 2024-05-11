<?php
require_once(_WEB_PATH_TEMPLATES . '/layout/header.php');
require_once('./includes/connect.php');

$user_name = $_SESSION['user-Name'];
$address = $_SESSION['address'];
$phoneNumber = $_SESSION['PhoneNumber'];

$productID = $_POST['productID'];
    $quantity = $_POST['quantity'];
    $sql = "SELECT * FROM product WHERE ProductID = '$product'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $kq = $stmt->fetch(PDO::FETCH_ASSOC);



?>
<div class="checkout-page">
    <div class="checkout-header">
        <div class="checkout-return">
            <button id="btn-close"><i class="fa-regular fa-chevron-left"></i></button>
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
                                <input name="tennguoinhan" type="text" value="<?php echo $user_name ?>" placeholder="Tên người nhận" class="form-control" required>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input name="sdtnhan" type="text" value="<?php echo $phoneNumber ?>" placeholder="Số điện thoại nhận hàng" class="form-control" required>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Địa chỉ chi tiết</label>
                                <input name="diachinhan" type="text" value="<?php echo $address ?>" placeholder="Địa chỉ nhận hàng" class="form-control chk-ship" required>
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
                <div class="product-total">
                    <div class="product-total-left">
                        <div class=""><img class="check-out-img" src="./templates<?php echo $kq['Image']; ?>" alt=""></div>
                        <div class="info-prod">
                            <div class="name-prod"><?php echo $kq['ProductName']; ?></div>
                        </div>
                        <div class="count">x<?php echo $quantity ?></div>
                    </div>
                    <div class="product-total-right">
                        <div class="priceProd"><?php echo number_format($kq['Price'], 0, ',', '.'); ?>&nbsp;₫</div>
                    </div>
                </div>
            </div>
            <div class="bill-payment">
                <div class="total-bill-order">
                    <div class="priceFlx">
                        <div class="text">
                            Tạm tính
                        </div>
                        <div class="price-detail">
                            <span class="checkout-cart-total"><?php echo number_format($kq['Price'] * $quantity, 0, ',', '.'); ?>&nbsp;₫</span>
                        </div>
                    </div>
                    <div class="priceFlx chk-ship">
                        <form class="list-ship" id="radioFormShip">
                            <div>
                                <input type="radio" name="shippingOps" class="shippingOps" value="20000" checked>
                                <label for="shippingOps" id="transport-fee-bill">Vận chuyển thường: <strong>20.000&nbsp;₫</strong></label>
                            </div>
                            <div>
                                <input type="radio" name="shippingOps" class="shippingOps" value="30000">
                                <label for="shippingOps" id="speed-ship-bill">Giao hàng hỏa tốc nội thành: <strong>30.000&nbsp;₫</strong></label>
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
                    <div class="price-final" id="checkout-cart-price-final"><?php echo number_format(($kq['Price'] * $quantity) + 20000, 0, ',', '.'); ?> &nbsp;₫</div>
                </div>
            </div>
            <div class="payment-method">
                <span>Phương thức thanh toán</span>
                <form id="paymentForm">
                    <select id="paymentMethod" name="paymentMethod" style="padding: 5px 0;">
                        <option value="cash"><strong>Thanh toán khi nhận hàng</strong></option>
                        <option value="online"><strong>Thanh toán trực tuyến</strong></option>
                    </select>
                </form>
            </div>
            <button class="complete-checkout-btn">Đặt hàng</button>
        </div>
    </main>
</div>
<div id="advertise"></div>