<style>
.statistic {
    color: var(--light-gray);
    background-color: var(--lightest-gray);
}

.order_date {
    height: 40px;
    height: 40px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.order_date:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

#btn_order_date_filter {
    width: 60px;
    padding: 10px 16px;
    font-size: 16px;
    background-color: var(--light-gray);
    color: black;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 0;
}

#btn_order_date_filter:hover {
    background-color: var(--lighter-gray);
}

.admin-control-left{
    width: 538px;
    margin-left: -56px;
}

</style>

<?php
if(!defined('_CODE')){
    die('Access denied...');
}
require_once('header.php');

// Từ ngày 
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';

// Đến ngày
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

//Truy vấn vào bảng user
$sql = 'SELECT c.CustomerID, c.FullName, SUM(o.PriceTotal) AS TotalPrice
        FROM orders o
        JOIN customer c ON o.CustomerID = c.CustomerID
        WHERE o.CancelDate IS NULL ';

if (!empty($startDate) && empty($endDate)) {
    $sql .= " AND OrderDate >= '$startDate'";
} else if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND OrderDate BETWEEN '$startDate' AND '$endDate'";
}

$sql .= "GROUP BY c.CustomerID, c.FullName
        ORDER BY TotalPrice DESC 
        LIMIT 5;" ; 

$listAllUserWithPurchases = getAllRows($sql);


function loadData($listAllUser){
    if(!empty($listAllUser)):
        $count = 0; // Số thứ tự
        foreach($listAllUser as $item):
            $count++;
    ?>
        <tr style="cursor: pointer;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='#fff'" onclick="showOrders(<?php echo $item['CustomerID'] ?>)">    
            <td class="limited-width"><?php echo $count ?></td>
            <td class="limited-width"><?php echo $item['FullName'] ?></td>
            <td class="limited-width"><?php echo number_format($item['TotalPrice']) ?></td>
        </tr>
    <?php 
            endforeach;
        else:
            ?>
            <td colspan="3">Không có dữ liệu</td>
            <?php
        endif;
}
?>

<div class="section tk active admin-all">
    <div class="admin-control" style="margin-top: 16px;">
        <div class="admin-control-left">
            <form action="" class="form-search">
                <span class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
                <input id="form-search-tk" type="text" class="form-search-input" placeholder="Tìm kiếm tên khách hàng..." oninput="thongKe()">
            </form> 
        </div>
        <div class="admin-control-center">
            <form> <!-- Điều chỉnh action cho phù hợp với tên tệp xử lý của bạn -->
                Từ ngày: <input type="date" name="start_order_date" class="order_date " id="start_order_date" value="<?php echo $startDate?>">
                Đến ngày: <input type="date" name="end_order_date" class="order_date " id="end_order_date" value="<?php echo $endDate?>">
                <span id="btn_order_date_filter" onclick="filterOrderDate()">Lọc</span>
            </form>
        </div>
        <div class="admin-control-right">            
            <button class="btn-reset-order" id="btn-reset-tk" onclick="resetHome()"><i class="fa-light fa-arrow-rotate-right"></i>Làm mới</button>                    
        </div>
    </div>
    <div class="order-statistical" id="order-statistical">
        <div class="order-statistical-item">
            <div class="order-statistical-item-icon">
                <i class="fa-light fa-shirt"></i>
            </div>
            <div class="order-statistical-item-content">
                <p class="order-statistical-item-content-desc">Sản phẩm được bán ra</p>
                <h4 class="order-statistical-item-content-h" id="quantity-product"></h4>
            </div>

        </div>

        <div class="order-statistical-item">
            <div class="order-statistical-item-icon order-product">
                <span id="order-product1"><i class="fa-solid fa-shirt"></i></span>
                <span id="order-product2"><i class="fa-light fa-shirt-long-sleeve"></i></span>
            </div>
            <div class="order-statistical-item-content">
                <p class="order-statistical-item-content-desc">Số lượng sản phẩm bán ra</p>
                <h4 class="order-statistical-item-content-h" id="quantity-order-product"></h4>
            </div>

        </div>
        <div class="order-statistical-item">
            <div class="order-statistical-item-icon">
                <i class="fa-light fa-file-lines"></i>
            </div>
            <div class="order-statistical-item-content">
                <p class="order-statistical-item-content-desc">Số lượng hóa đơn</p>
                <h4 class="order-statistical-item-content-h" id="quantity-order"></h4>
            </div>

        </div>
        <div class="order-statistical-item">
            <div class="order-statistical-item-icon">
                <i class="fa-light fa-dollar-sign"></i>
            </div>
            <div class="order-statistical-item-content">
                <p class="order-statistical-item-content-desc">Doanh thu</p>
                <h4 class="order-statistical-item-content-h" id="quantity-sale"></h4>
            </div>

        </div>
    </div>
    <div class="tables" style="display: flex;">
        <div class="table" style="margin-right: 18px;">
            <table width="100%">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Khách hàng</td>
                        <td>Tổng mua (VND)</td>
                    </tr>
                </thead>
                <tbody id="showTk">
                    <?php
                        loadData($listAllUserWithPurchases) ;
                    ?>
                </tbody>
            </table>

        </div>
        <div class="table">
            <table width="100%">
                <thead>
                    <tr>
                        <!-- <td>STT</td> -->
                        <td>Mã đơn</td>
                        <td>Ngày đặt</td>
                        <td>Chi tiết</td>
                    </tr>
                </thead>
                <tbody id="showTk" class="showDh">
                </tbody>
            </table>

        </div>
    </div>
    <!-- <div id="column-chart" class="chart-container">
        
    </div> -->
</div>

<div class="modal detail-order-product">
    <div class="modal-container">
        <h2>CHI TIẾT ĐƠN HÀNG</h2>
        <button class="modal-close" onclick="closeForm()"><i class="fa-regular fa-xmark"></i></button>
        <div class="table">
            <table width="100%">
                <thead>
                    <tr>
                        <!-- <td>Mã đơn</td> -->
                        <td>Tên áo</td>
                        <td>Size</td>
                        <td>Số lượng</td>
                        <td>Đơn giá (VND)</td>
                        <!-- <td>Ngày đặt</td> -->
                    </tr>
                </thead>
                <tbody id="show-product-order-detail">
                </tbody>
            </table>
        </div>
        <div style="position: fixed; bottom: 20px; right: 2%; font-size: 20px">
            <span>Tổng mua:</span>
            <span id="total-price-order"></span>
        </div>
    </div>
</div>

<?php 
    require_once('footer.php');
?>

<script>
    function detailOrderProduct(id) {
        document.querySelector(".modal.detail-order-product").classList.add("open");
        
        $.ajax({
            url: '/LT_Web2/modules/admin/getDetailOrderByOrderID.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                var responseData = JSON.parse(response);

                var tbody = $('#show-product-order-detail');
                var totalPrice = $('#total-price-order');

                tbody.empty();

                var html = "";

                var priceProduct = 0;

                // Duyệt qua mỗi đơn hàng từ phản hồi Ajax và tạo HTML cho từng dòng
                $.each(responseData, function(index, detailOrder) {
                    html += "<tr>";
                    // html += "<td>" + "MĐ" + detailOrder.OrderID + "</td>"; // Mã đơn hàng
                    html += "<td>" + detailOrder.ProductName + "</td>"; // Tên sp
                    html += "<td>" + detailOrder.Size + "</td>"; // Size
                    html += "<td>" + detailOrder.Quantity + "</td>"; // Số lượng
                    html += "<td>" + parseInt(detailOrder.Price).toLocaleString('vi-VN') + "</td>"; // Đơn giá
                    // html += "<td>" + detailOrder.OrderDate + "</td>"; // Ngày đặt
                    html += "</tr>";
                    priceProduct += detailOrder.Quantity * detailOrder.Price
                });   

                
                var htmlPrice = priceProduct.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }).replace('₫', 'VND');
                
                // Thêm HTML vào tbody
                totalPrice.html(htmlPrice);
                tbody.html(html);
            }
        }); 
    }
    
    function closeForm() {
        document.querySelector(".modal.detail-order-product").classList.remove("open")
    }
    
    function showOrders(id) {
        const startDate = document.getElementById('start_order_date').value;
        const endDate = document.getElementById('end_order_date').value;
        $.ajax({
            url: '/LT_Web2/modules/admin/getOrdersOfCustomer.php',
            type: 'GET',
            data: { 
                id: id,
                startDate: startDate,
                endDate: endDate
            },
            success: function(response) {
                // alert(response)
                var responseData = JSON.parse(response);
                // Lấy thẻ tbody
                var tbody = $('.showDh');

                // Xóa nội dung cũ của tbody (nếu có)
                tbody.empty();

                // Khởi tạo biến lưu trữ HTML
                var html = "";

                // Duyệt qua mỗi đơn hàng từ phản hồi Ajax và tạo HTML cho từng dòng
                $.each(responseData, function(index, order) {
                    html += "<tr>";
                    // html += "<td>" + (index + 1) + "</td>"; // STT
                    html += "<td>" + "MĐ" + order.OrderID + "</td>"; // Mã đơn hàng
                    html += "<td>" + order.OrderDate + "</td>"; // Mã đơn hàng
                    html += '<td><button class="btn-detail product-order-detail" onclick="detailOrderProduct('+order.OrderID+')"><i class="fa-regular fa-eye"></i></button></td>';
                    html += "</tr>";
                });

                // Thêm HTML vào tbody
                tbody.html(html);
            }
        }); 
    }

    function filterOrderDate() {
        const startDate = '&startDate='+ document.getElementById('start_order_date').value;
        const endDate = '&endDate='+ document.getElementById('end_order_date').value;

        if(document.getElementById('start_order_date').value == ''){
            alert("Chọn ngày bắt đầu!");
            return false;
        }

        var sDate = new Date(startDate);
        var eDate = new Date(endDate);

        if (sDate.getTime() > eDate.getTime()) {
            alert("Ngày bắt đầu không được lớn hơn ngày kết thúc!");
            return false;
        }

        var changeSelectAction = '?module=admin&action=homeStatistic' + startDate + endDate;
        window.location.href = changeSelectAction;
    }

    function resetHome(){
        window.location.href = '?module=admin&action=homeStatistic';
    }
</script>