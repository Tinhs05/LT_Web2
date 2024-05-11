<?php
require_once(_WEB_PATH_TEMPLATES . '/layout/header.php');
require_once('./includes/connect.php');

$userID = $_SESSION['user-id'];
$total = 0;

function getPodformCart($conn, $userID)
{
    try {
        $sql = "SELECT c.ProductID, p.ProductName, p.Image, p.Price, c.Quantity, cus.FullName, cus.PhoneNumber, cus.Address
                FROM cart c
                INNER JOIN product p ON p.ProductID = c.ProductID
                INNER JOIN customer cus ON cus.CustomerID = c.CustomerID
                WHERE c.CustomerID = :userID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $resuilt = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
        echo "Lỗi: " . $th->getMessage();
    } finally {
        $conn = null;
    }
    return $resuilt;
}

$kq = getPodformCart($conn, $userID);
?>

<!-- HTML -->
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
                                <input name="tennguoinhan" type="text" value="<?php echo $kq[0]['FullName']; ?>" placeholder="Tên người nhận" class="form-control" required>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input name="sdtnhan" type="text" value="<?php echo $kq[0]['PhoneNumber']; ?>" placeholder="Số điện thoại nhận hàng" class="form-control" required>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Địa chỉ chi tiết</label>
                                <input name="diachinhan" type="text" value="<?php echo $kq[0]['Address']; ?>" placeholder="Địa chỉ nhận hàng" class="form-control chk-ship" required>
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
                <?php
                foreach ($kq as $data) {
                    $total += ($data['Quantity'] * $data['Price']); ?>
                    <div class="product-total">
                        <div class="product-total-left">
                            <div class=""><img class="check-out-img" src="./templates<?php echo $data['Image']; ?>" alt=""></div>
                            <div class="info-prod">
                                <div class="name-prod"><?php echo $data['ProductName']; ?></div>
                            </div>
                            <div class="count">x<?php echo $data['Quantity']; ?></div>
                        </div>
                        <div class="product-total-right">
                            <div class="priceProd"><?php echo number_format($data['Price'], 0, ',', '.'); ?>&nbsp;₫</div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="bill-payment">
                <div class="total-bill-order">
                    <div class="priceFlx">
                        <div class="text">
                            Tạm tính
                        </div>
                        <div class="price-detail">
                            <span class="checkout-cart-total"><?php echo number_format($total, 0, ',', '.'); ?>&nbsp;₫</span>
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
                    <div class="price-final" id="checkout-cart-price-final"><?php echo number_format($total + 20000, 0, ',', '.'); ?> &nbsp;₫</div>
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
<script>
    $('#btn-close').on('click', function() {
        window.location.href = "?module=user";
    })
    var deliveryName = 'Vận chuyển thường';
    var total_final = <?php echo $total + 20000; ?>;
    $('.shippingOps').on('change', function() {
        var labelValue = $(this).next('label').text();
        var deliveryName = labelValue.split(':')[0].trim();
        var shippingFee = $('input[name="shippingOps"]:checked').val();
        var temporaryTotal = <?php echo $total; ?>;
        $('#checkout-cart-price-final').html(vnd(parseInt(shippingFee) + parseInt(temporaryTotal)) + "&nbsp;₫");
    });

    function vnd(number) {
        return number.toLocaleString('vi-VN');
    }

    $(".complete-checkout-btn").click(function(event) {
        var tennguoinhan = $('input[name="tennguoinhan"]').val();
        var sdtnhan = $('input[name="sdtnhan"]').val();
        var diachinhan = $('input[name="diachinhan"]').val();
        var productList = <?php echo json_encode($kq); ?>;

        var priceTotal = <?php echo $total; ?>;
        console.log(priceTotal)

        var isEmpty = false;
        $(".info-nhan-hang").find('input, select, textarea').each(function() {
            if ($(this).val().trim() === "") {
                isEmpty = true;
                $(this).siblings('.form-message').text("Trường này không được trống");
            }
        });
        if (!isEmpty) {
            event.preventDefault();
        } else {
            $.ajax({
                url: "?module=user&action=create-orders",
                type: "POST",
                data: {
                    deliveryName: deliveryName,
                    receiver: tennguoinhan,
                    phoneNumber: sdtnhan,
                    address: diachinhan,
                    priceTotal: priceTotal,
                    productList: productList
                },
                success: function(data) {
                    advertise({
                        title: 'Success',
                        message: 'Sản phẩm đã được thêm vào giỏ hàng thành công!',
                        type: 'success',
                        duration: 3000
                    })
                    setTimeout(function() {
                        window.location.href = "?module=auth&action=account-centre";
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    })

    function advertise({
        title = 'Success',
        message = 'Tạo tài khoản thành công',
        type = 'success',
        duration = 1000
    }) {
        const main = $('#advertise');
        if (main.length) {
            const advertise = $('<div class="advertise"></div>');
            //Auto remove advertise
            const autoRemove = setTimeout(function() {
                advertise.remove();
            }, duration + 1000);
            //Remove advertise when click btn close
            advertise.on('click', function(e) {
                if ($(e.target).closest('.fa-regular').length) {
                    advertise.remove();
                    clearTimeout(autoRemove);
                }
            });
            const colors = {
                success: '#47d864',
                info: '#2f86eb',
                warning: '#ffc021',
                error: '#ff6243'
            }
            const icons = {
                success: 'fa-light fa-check',
                info: 'fa-solid fa-circle-info',
                warning: 'fa-solid fa-triangle-exclamation',
                error: 'fa-solid fa-bug'
            };
            const color = colors[type];
            const icon = icons[type];
            const delay = (duration / 1000).toFixed(2);
            advertise.addClass(`advertise--${type}`).css('animation', `slideInTop ease 0.3s, fadeOut linear 1s ${delay}s forwards`)
                .html(`<div class="advertise__private" >
          <div class="advertise__icon">
              <i class="${icon}"></i>
          </div>
          <div class="advertise__body">
              <h3 class="advertise__title" >${title}</h3>
              <p class="advertise__msg">
                  ${message}
              </p>
          </div>
      </div>
      <div class="advertise__background"style="background-color: ${color};">
      </div>`);
            main.append(advertise);
        }
    }
</script>