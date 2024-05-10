<?php
$detail_order_id = $_POST['detail_order_id'];

try {
    $sql = "SELECT detail.OrderID, o.DeliveryName, o.Receiver, o.PhoneNumber, o.Address, o.OrderDate, o.PriceTotal, o.Status, detail.ProductID, detail.Quantity, p.ProductName, p.Image, p.Price
                FROM detailorders detail
                INNER JOIN product p ON detail.ProductID = p.ProductID
                INNER JOIN orders o ON detail.OrderID = o.OrderID
                WHERE o.OrderID = '$detail_order_id' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    //throw $th;
}finally {
    $conn = null;
}
$kq = $result;
?>

<div class="container">
    <span class="btn-close-detail-order-status">+</span>
    <h2>Chi tiết đơn hàng</h2>
    <div class="content-left">
        <table style="width: 100%;">
            <thead>
                <tr style="background-color: #8a959a;">
                    <th>Sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($kq as $do) { ?>
                    <tr style="background-color: #ffffff94;">
                        <td style="padding: 0;"><img style="height: 90px; width: 75px;" src="./templates<?php echo $do['Image']; ?>" alt=""></td>
                        <td style="padding: 0;"><?php echo $do['ProductName']; ?></td>
                        <td style="padding: 0;"><?php echo $do['Quantity']; ?></td>
                        <td style="padding: 0;"><?php echo number_format($do['Price'], 0, ',', '.'); ?>&nbsp;₫</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="content-right">
        <div class="total" style="text-align: right; width: 95%; font-size: 24px; padding-bottom: 20px;">Tổng tiền: <strong><?php echo number_format($kq[0]['PriceTotal'], 0, ',', '.'); ?>&nbsp;₫</strong></div>
        <div class="info-receiver"><strong>Số điện thoại: </strong><?php echo $kq[0]['PhoneNumber']; ?></div>
        <div class="info-receiver"><strong>Tên người nhận: </strong><?php echo $kq[0]['Receiver']; ?></div>
        <div class="info-receiver"><strong>Địa chỉ giao: </strong><?php echo $kq[0]['Address']; ?></div>
        <div class="info-receiver"><strong>Ngày đặt: </strong><?php echo $kq[0]['OrderDate']; ?></div>
        <div class="info-receiver"><strong>Ngày giao: </strong><?php echo $kq[0]['OrderDate']; ?></div>
        <div class="info-receiver"><strong>Phương thức vận chuyển: </strong><?php echo $kq[0]['DeliveryName']; ?></div>
        <div class="info-receiver"><strong>Trạng thái đơn hàng: </strong><?php echo $kq[0]['Status']; ?></div>
    </div>
</div>
<script>
    $('.btn-close-detail-order-status').on('click', function() {
        $('.detail-order-status-modal').css('display', 'none');
    })
</script>