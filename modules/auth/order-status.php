<?php

$user = $_SESSION['user-id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['orderID'])) $orderID = $_POST['orderID'];
}
function getAllOrders($conn, $user)
{
    $sql = "SELECT * FROM orders WHERE CustomerID = '$user'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getDetailOrder($conn, $orderID)
{
    $sql = "SELECT detail.OrderID, o.DeliveryName, o.Receiver, o.PhoneNumber, o.Address, o.OrderDate, o.PriceTotal, o.Status, detail.ProductID, detail.Quantity, p.ProductName, p.Image, p.Price
            FROM detailorders detail
            INNER JOIN product p ON detail.ProductID = p.ProductID
            INNER JOIN orders o ON detail.OrderID = o.OrderID
            WHERE o.OrderID = '$orderID'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function countOrdersByStatus($conn, $status, $user)
{
    $sql = "SELECT COUNT(*) as total FROM orders WHERE CustomerID = '$user' AND Status = '$status'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

?>
<!-- Script -->
<script>
    function show_details_order(id, btn) {
        orderID = id;
        $.post('?module=auth&action=show_order', {
            detail_order_id: orderID
        }, function(data) {
            $('.detail-order-status-modal').html(data);
            $('.detail-order-status-modal').css('display', 'flex');
        });
    }
</script>
<!-- HTML -->
<div class="order-acc-centre">
    <h1>Đơn hàng của bạn</h1>
    <div class="order-acc-centre-status">
        <div>
            <div class="order-status" data-status="all">
                <i class="fa-regular fa-list-timeline"></i></br>Tất cả
            </div>
        </div>
        <div>
            <div class="order-status" data-status="pending">
                <i class="fa-regular fa-file-signature">
                    <div class="num-order-status"><?php echo countOrdersByStatus($conn, "Chờ xác nhận", $user); ?></div>
                </i></br>Chờ xác nhận
            </div>
        </div>
        <div>
            <div class="order-status" data-status="shipping">
                <i class="fa-sharp fa-solid fa-truck-fast">
                    <div class="num-order-status"><?php echo countOrdersByStatus($conn, "Đang giao hàng", $user); ?></div>
                </i></br>Đang giao hàng
            </div>
        </div>
        <div>
            <div class="order-status" data-status="success">
                <i class="fa-solid fa-box-check">
                    <div class="num-order-status"><?php echo countOrdersByStatus($conn, "Đã giao xong", $user); ?></div>
                </i></br>Đã giao xong
            </div>
        </div>
    </div>
    <div class="list-order-nows">
        <h2 style="margin-left:100px;">Đơn hàng</h2>
        <?php
        $orders = getAllOrders($conn, $user);
        foreach ($orders as $o) {
        ?>
            <div class="order-bill">
                <?php
                $product = getDetailOrder($conn, $o['OrderID']);
                if ($product) {
                    foreach ($product as $p) {
                ?>
                        <div class="data">
                            <img src="./templates<?php echo $p['Image']; ?>" alt="">
                            <div class="info-pod">
                                <span style="font-size: 20px; font-weight: bold;"><?php echo $p['ProductName'] ?></span>
                                <span>x<?php echo $p['Quantity']; ?></span>
                                <span style="font-weight: bold;"><?php echo number_format($p["Price"], 0, ',', '.'); ?>&nbsp;₫</span>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="show-detail-pod" onclick="show_details_order(<?php echo $o['OrderID']; ?>, this)">
                    <span style="font-size: 16px; padding-bottom: 10px; font-weight: bold;">Chi tiết</span>
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <div class="status">
                    <div class="status-color"><?php echo $o['Status']; ?></div>
                </div>
                <div class="cancel-order">
                    <?php
                    if ($o['Status'] === "Chờ xác nhận") {
                    ?>
                        <i class="fa-solid fa-trash"></i>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="detail-order-status-modal" style="display: none;"></div>
<script>
    let orderBillIndex = 0;
    let slideIndexes = [];

    function slide_product() {
        $('.order-bill').each(function(index) {
            let slides = $(this).find('.data');
            if (slideIndexes[index] === undefined) {
                slideIndexes[index] = 0;
            }
            $(slides).hide();
            slideIndexes[index]++;
            if (slideIndexes[index] > slides.length) {
                slideIndexes[index] = 1;
            }
            $(slides[slideIndexes[index] - 1]).show();
        });
        setTimeout(slide_product, 5000);
    }
    slide_product();

    $('.status-color').each(function() {
        var statusElement = $(this);
        var status = statusElement.text().trim();

        switch (status) {
            case "Chờ xác nhận":
                statusElement.css('background-color', 'rgb(0,158,255)');
                break;
            case "Đang giao hàng":
                statusElement.css('background-color', 'rgb(244, 244, 35)');
                statusElement.css('color', 'black');
                break;
            case "Đã giao xong":
                statusElement.css('background-color', 'rgb(44, 197, 44)');
                break;
            case "Đã hủy":
                statusElement.css('background-color', 'gray');
                break;
        }
    });

    $('.order-status').on('click', function() {
        var status = $(this).data('status');

        $('.order-bill').hide();

        switch (status) {
            case "all":
                $('.order-bill').show();
                break;
            case "pending":
                $('.order-bill').each(function() {
                    if ($(this).find('.status-color').text().trim() === "Chờ xác nhận") {
                        $(this).show();
                    }
                });
                break;
            case "shipping":
                $('.order-bill').each(function() {
                    if ($(this).find('.status-color').text().trim() === "Đang giao hàng") {
                        $(this).show();
                    }
                });
                break;
            case "success":
                $('.order-bill').each(function() {
                    if ($(this).find('.status-color').text().trim() === "Đã giao xong") {
                        $(this).show();
                    }
                });
                break;
        }
    });
</script>