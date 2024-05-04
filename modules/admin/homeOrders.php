
<style>
.list-order {
    color: var(--light-gray);
    background-color: var(--lightest-gray);
}

#btn-update-status{
    margin-left: 2px;
}

.received_date {
    height: 40px;
    height: 40px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.received_date:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

#btn_received_date_filter {
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

#btn_received_date_filter:hover {
    background-color: var(--lighter-gray);
}

#btn_received_address_filter {
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

#btn_received_address_filter:hover {
    background-color: var(--lighter-gray);
}


.select_address{
    height: 40px;
    margin-right: 4px;
}

.limited-width {
    max-width: 200px; /* Đặt chiều rộng tối đa tại đây */
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis; /* Để hiển thị dấu ... khi văn bản bị cắt */
}
</style>

<?php
if(!defined('_CODE')){
    die('Access denied...');
}

// Trạng thái đơn hàng được chọn
$chooseStatus = isset($_GET['chooseStatus']) ? $_GET['chooseStatus'] : '';

// Từ ngày 
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';

// Đến ngày
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

// Tỉnh thành được chọn
$chooseCity = isset($_GET['chooseCity']) ? $_GET['chooseCity'] : '';

// Quận huyện được chọn
$chooseDistrict = isset($_GET['chooseDistrict']) ? $_GET['chooseDistrict'] : '';

$sql = "SELECT orders.* , customer.FullName
        FROM orders
        INNER JOIN customer ON orders.CustomerID = customer.CustomerID
        WHERE 1 ";

if (!empty($chooseStatus)) {
    $sql .= " AND orders.Status = '$chooseStatus'";
}

if (!empty($startDate) && empty($endDate)) {
    $sql .= " AND ReceivedDate >= '$startDate'";
} else if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND ReceivedDate BETWEEN '$startDate' AND '$endDate'";
}

if (!empty($chooseCity)) {
    $sql .= " AND orders.Address LIKE '%$chooseCity%'";
}

if (!empty($chooseDistrict)) {
    $sql .= " AND orders.Address LIKE '%$chooseDistrict%'";
}

$sql .= " ORDER BY OrderDate DESC " ;                          

$listAllOrder = getAllRows($sql);

require_once('header.php');

function loadData($listOrder) {
        if(!empty($listOrder)):
            foreach($listOrder as $item):

                // Chuyển đổi ngày nhận được thành một đối tượng DateTime
                $receivedDateTime = new DateTime($item['OrderDate']);

                // Lấy ngày cách đó 4 ngày
                $fourDaysLater = ($receivedDateTime->add(new DateInterval('P4D')))->format('d/m/Y');

                $receivedDateTime = new DateTime($item['OrderDate']);

                // Lấy ngày cách đó 7 ngày
                $sevenDaysLater = ($receivedDateTime->add(new DateInterval('P7D')))->format('d/m/Y');

    ?>
        <tr>    
            <td class="limited-width"><?php echo 'MĐ'.$item['OrderID'] ?></td>
            <td class="limited-width"><?php echo $item['FullName'] ?></td>
            <td class="limited-width"><?php echo date('d/m/Y', strtotime($item['OrderDate'])) ?></td>
            <td class="limited-width"><?php
                if($item['Status'] == 'Chờ xác nhận'){
                    echo 'Dự kiến:<br>'.$sevenDaysLater;
                } elseif ($item['Status'] == 'Đang giao hàng'){
                    echo 'Dự kiến:<br>'.$fourDaysLater;
                } elseif ($item['Status'] == 'Đã hủy'){
                    echo 'Đã hủy:<br>'.date('d/m/Y', strtotime($item['CancelDate']));
                } else {
                    echo 'Đã giao:<br>'.date('d/m/Y', strtotime($item['ReceivedDate']));
                }
             ?></td>
            <td class="limited-width"><?php echo $item['Address'] ?></td>
            <td class="limited-width"><?php 
                if($item['Status'] == 'Chờ xác nhận'){
                    echo '<span class="status-no-complete">Chờ xác nhận</span>';
                } elseif ($item['Status'] == 'Đang giao hàng'){
                    echo '<span class="status-shipping-complete">Đang giao hàng</span>';
                } elseif ($item['Status'] == 'Đã hủy'){
                    echo '<span class="status-complete">Đã hủy</span>';
                } else {
                    echo '<span class="status-complete">Đã giao hàng</span>';
                }
            ?></td>
            <td class="control" class="limited-width">
                <?php 
                    if($item['Status'] == 'Chờ xác nhận'){
                        echo '<button class="btn-detail " id="btn-cancel" onclick="cancelOrder('.$item['OrderID'].')"><i class="fa-regular fa-trash-can"></i></button>';
                        echo '<button class="btn-detail " id="btn-update-status" onclick="updateOrderStatus('.$item['OrderID'].')"><i class="fa-solid fa-truck-arrow-right"></i></button>';
                    } elseif ($item['Status'] == 'Đang giao hàng'){
                        echo '<button class="btn-detail" id="btn-undo" onclick="undoOrderStatus('.$item['OrderID'].')"><i class="fa-solid fa-rotate-left"></i></button>';
                        echo '<button class="btn-detail" id="btn-update-status" onclick="updateOrderStatus('.$item['OrderID'].')"><i class="fa-solid fa-truck-arrow-right"></i></button>';
                    } elseif ($item['Status'] == 'Đã hủy'){
                        echo '';
                    } else {
                        echo '<button class="btn-detail" id="btn-undo" onclick="undoOrderStatus('.$item['OrderID'].')"><i class="fa-solid fa-rotate-left"></i></button>';
                    }
                ?>
            </td>
        </tr>
    <?php 
            endforeach;
        else:
            ?>
            <td colspan="6">Không có dữ liệu</td>
            <?php
        endif;
}


?>


<!-- Order  -->
<div class="section active admin-all">
    <div class="admin-control control-Od">
        <div class="admin-control-left">
            <select name="tinh-trang" id="tinh-trang" onchange="findOrder()">
                <option value="" <?php echo $chooseStatus == "" ? 'selected' : ''?>>Tất cả</option>
                <option value="Chờ xác nhận" <?php echo $chooseStatus == "Chờ xác nhận" ? 'selected' : ''?>>Chờ xác nhận</option>
                <option value="Đang giao hàng" <?php echo $chooseStatus == "Đang giao hàng" ? 'selected' : ''?>>Đang giao hàng</option>
                <option value="Đã giao hàng" <?php echo $chooseStatus == "Đã giao hàng" ? 'selected' : ''?>>Đã giao hàng</option>
                <option value="Đã hủy" <?php echo $chooseStatus == "Đã hủy" ? 'selected' : ''?>>Đã hủy</option>
            </select>
        </div>
        <div class="admin-control-center">
            <form action="" class="form-search">
                <!-- Thẻ select cho chọn thành phố -->
                <select class="select_address" id="citySelect">
                    <option value="" <?php echo $chooseCity == "" ? 'selected' : ''?>>Chọn thành phố</option>
                    <option value="Hà Nội" <?php echo $chooseCity == "Hà Nội" ? 'selected' : ''?>>Hà Nội</option>
                    <option value="Thành phố Hồ Chí Minh" <?php echo $chooseCity == "Thành phố Hồ Chí Minh" ? 'selected' : ''?>>TP Hồ Chí Minh</option>
                    <!-- Thêm các thành phố khác nếu cần -->
                </select>

                <!-- Thẻ select cho chọn quận huyện -->
                <select class="select_address" id="districtSelect" onclick="populateDistricts()">
                    <option value="" >Chọn quận huyện</option>
                </select>
                <span id="btn_received_address_filter" onclick="filterReceivedAddress()">Lọc</span>
            </form>
        </div>
        <div class="admin-control-right">
            <form> <!-- Điều chỉnh action cho phù hợp với tên tệp xử lý của bạn -->
                Từ ngày: <input type="date" name="start_received_date" class="received_date " id="start_received_date" value="<?php echo $startDate?>">
                Đến ngày: <input type="date" name="end_received_date" class="received_date " id="end_received_date" value="<?php echo $endDate?>">
                <span id="btn_received_date_filter" onclick="filterReceivedDate()">Lọc</span>
            </form>
        </div>
    </div>
    <div class="table">
        <table width="100%">
            <thead>
                <tr>
                    <td class="limited-width">Mã đơn</td>
                    <td class="limited-width">Khách hàng</td>
                    <td class="limited-width"><div>Ngày đặt</div></td>
                    <td class="limited-width"><div>Ngày giao</div></td>
                    <td class="limited-width">Nơi Nhận</td>
                    <td class="limited-width">Trạng thái</td>
                    <td class="limited-width">Tùy chọn</td>
                </tr>
            </thead>
            <tbody id="showOrder">
                <?php
                    loadData($listAllOrder) ;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
    require_once('footer.php');
?>

<script>
    // Dữ liệu quận huyện của các thành phố
    var districtsData = {
        "Hà Nội": ["Ba Đình", "Hoàn Kiếm", "Hai Bà Trưng", "Đống Đa", "Tây Hồ", /* Thêm các quận khác */],
        "Thành phố Hồ Chí Minh": ["Quận 1", "Quận 2", "Quận 3", "Quận 4", "Quận 5", /* Thêm các quận khác */]
        // Thêm dữ liệu cho các thành phố khác nếu cần
    };

    // Hàm điều chỉnh danh sách quận huyện khi người dùng chọn thành phố
    function populateDistricts() {
        var citySelect = document.getElementById("citySelect");
        var districtSelect = document.getElementById("districtSelect");
        var selectedCity = citySelect.value;

        // Xóa các tùy chọn quận huyện hiện có
        districtSelect.innerHTML = '<option value="">Chọn quận huyện</option>';

        // Nếu thành phố đã được chọn, cập nhật danh sách quận huyện tương ứng
        if (selectedCity !== "") {
            var districts = districtsData[selectedCity];
            districts.forEach(function(district) {
                var option = document.createElement("option");
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    }

    document.getElementById('districtSelect').addEventListener("change",function(e) {
        e.preventDefault();
        const chooseCity = '&chooseCity='+document.getElementById('citySelect').value;
        const chooseDistrict = '&chooseDistrict='+this.value;
        // const inputAction = '&inputText='+ document.getElementById('form-search-product').value;
        var changeSelectAction = '?module=admin&action=homeOrders' + chooseCity + chooseDistrict;
        window.location.href = changeSelectAction;
    });

    document.getElementById('citySelect').addEventListener("change",function(e) {
        e.preventDefault();
        const chooseCity = '&chooseCity='+this.value;
        // const inputAction = '&inputText='+ document.getElementById('form-search-product').value;
        var changeSelectAction = '?module=admin&action=homeOrders' + chooseCity;
        window.location.href = changeSelectAction;
    });
    
    document.getElementById('tinh-trang').addEventListener("change",function(e) {
        e.preventDefault();
        const selectAction = '&chooseStatus='+this.value;
        // const inputAction = '&inputText='+ document.getElementById('form-search-product').value;
        var changeSelectAction = '?module=admin&action=homeOrders' + selectAction;
        window.location.href = changeSelectAction;
    });

    function filterReceivedDate() {
        const startDate = '&startDate='+ document.getElementById('start_received_date').value;
        const endDate = '&endDate='+ document.getElementById('end_received_date').value;

        if(document.getElementById('start_received_date').value == ''){
            alert("Chọn ngày bắt đầu!");
            return false;
        }

        var sDate = new Date(startDate);
        var eDate = new Date(endDate);

        if (sDate.getTime() > eDate.getTime()) {
            alert("Ngày bắt đầu không được lớn hơn ngày kết thúc!");
            return false;
        }

        var changeSelectAction = '?module=admin&action=homeOrders' + startDate + endDate;
        window.location.href = changeSelectAction;
    }

    function cancelOrder(id) {
        if(confirm('Bạn có chắc muốn hủy đơn hàng này?')){
            $.ajax({
            url: '/LT_Web2/modules/admin/orderCancel.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                alert(response)
                window.location.reload();
                // window.location.href = '?module=admin&action=homeOrders';
            }
            }); 
        };
    }

    function updateOrderStatus(id) {
        $.ajax({
            url: '/LT_Web2/modules/admin/orderStatusUpdate.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                // alert(response)
                window.location.reload();
                // window.location.href = '?module=admin&action=homeOrders';
            }
        }); 
    }

    function undoOrderStatus(id) {
        $.ajax({
            url: '/LT_Web2/modules/admin/orderStatusUndo.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                // alert(response)
                window.location.reload();
                // window.location.href = '?module=admin&action=homeOrders';
            }
        });
    }
</script>
