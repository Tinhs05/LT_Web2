<style>
.list-user {
    color: var(--light-gray);
    background-color: var(--lightest-gray);
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
require_once('header.php');

//Truy vấn vào bảng user
$listAllUser = getAllRows('SELECT * FROM customer ORDER BY joinDate DESC');

function loadData($listAllUser){
    if(!empty($listAllUser)):
        $count = 0; // Số thứ tự
        foreach($listAllUser as $item):
            $count++;
    ?>
        <tr>    
            <td class="limited-width"><?php echo $count ?></td>
            <td class="limited-width"><?php echo $item['FullName'] ?></td>
            <td class="limited-width"><?php echo $item['PhoneNumber'] ?></td>
            <td class="limited-width"><?php echo $item['Email'] ?></td>
            <td class="limited-width"><?php echo $item['Address'] ?></td>
            <td class="limited-width"><?php echo date('d/m/Y', strtotime($item['JoinDate'])) ?></td>
            <td class="limited-width"><?php echo $item['Status'] == 0 ? '<span class="status-no-complete">Bị khóa</span>' : '<span class="status-complete">Hoạt động</span>'?></td>
            <td class="control control-table">
            <button class="btn-edit" id="edit-account" data-customer-id="<?php echo $item['CustomerID'] ?>" onclick='editCustomer(<?php echo $item["CustomerID"] ?>)' ><i class="fa-light fa-pen-to-square"></i></button>
            <!-- <button class="btn-delete" id="delete-account" onclick="deleteCustomer()"><i class="fa-regular fa-trash"></i></button> -->
            </td>
        </tr>
    <?php 
            endforeach;
        else:
            ?>
            <td colspan="8">Không có dữ liệu</td>
            <?php
        endif;
}
?>


<!-- Account  -->
<div class="section active admin-all">
    <div class="admin-control">
        <div class="admin-control-left">
            <select name="tinh-trang-user" id="tinh-trang-user" onchange="showUser()">
                <option value="2">Tất cả</option>
                <option value="1">Hoạt động</option>
                <option value="0">Bị khóa</option>
            </select>
        </div>
        <div class="admin-control-center">
            <form action="" class="form-search">
                <span class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
                <input type="text" class="form-search-input "  id="form-search-user" placeholder="Tìm kiếm khách hàng..." oninput="showUser()">
            </form>
        </div>
        <div class="admin-control-right">
            <button type="button" name="Customer" class="btn-fillter-date" id="btn-fillter-Us"><i class="fa-light fa-calendar-lines-pen"></i>Lọc theo ngày</button>

            <button class="btn-reset-order" id="btn-reset-order" onclick="cancelSearchUser()"><i class="fa-light fa-arrow-rotate-right"></i>Làm mới</button>  
            <button id="btn-add-user" class="btn-control-large" onclick="openCreateAccount()"><i class="fa-light fa-plus"></i> <span>Thêm khách hàng</span></button>          
        </div>
    </div>

    <div class="table">
        <table width="100%">
            <thead>
                <tr>
                    <td class="limited-width"></td>
                    <td class="limited-width">Họ và tên</td>
                    <td class="limited-width">Liên hệ</td>
                    <td class="limited-width">Email</td>
                    <td class="limited-width">Địa chỉ</td>
                    <td class="limited-width"> <div>Ngày tham gia</div>
                        <!-- <div class="mess-time">
                            <button >
                                <label for=""><i class="fa-light fa-calendar-clock"></i>:</label>
                                <span class="show-Date" id="result-time-start-cus"></span><span><i class="fa-light fa-arrow-right"></i></span><span class="show-Date" id="result-time-end-cus"></span>
                            </button>
                        </div> -->
                    </td>
                    <td class="limited-width">Tình trạng</td>
                    <td class="limited-width">Sửa</td>
                </tr>
            </thead>
            <tbody id="show-user">
            <?php loadData($listAllUser)?>
            </tbody>
        </table>
    </div>
    <!-- </div> -->
</div>

<div class="modal signup">
        <div class="modal-container">
            <h3 class="modal-container-title add-account-e">THÊM KHÁCH HÀNG MỚI</h3>
            <h3 class="modal-container-title edit-account-e">CHỈNH SỬA THÔNG TIN</h3>

            <button class="modal-close" onclick="closeForm()"><i class="fa-regular fa-xmark"></i></button>
            <div class="form-content sign-up">
                <form action="/LT_Web2/modules/admin/addCustomer.php" method="POST" class="signup-form" id="signup-form">
                    <div class="form-group">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input id="fullname" name="fullname" type="text" placeholder="VD: Nguyễn Văn Long" class="form-control">
                    </div>
                    <div class="form-group add-account-e">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="text" placeholder="VD: ngvlong202@gmail.com" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phonenumber" class="form-label">Số điện thoại</label>
                        <input id="phonenumber" name="phonenumber" type="text" placeholder="Nhập số điện thoại" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input id="address" name="address" type="text" placeholder="VD: 273 An Dương Vương, Quận 5" class="form-control">
                    </div>
                    <div class="form-group add-account-e">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                        <div class="form-eye">
                            <span id="showPassword" class="toggle-password" onclick="togglePassword()"><i class="fa-regular fa-eye"></i> </span>
                            <span id="hidePassword" class="toggle-password" onclick="togglePassword()"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                    </div>   
                    <div class="form-group add-account-e">
                        <label for="password_firm" class="form-label">Nhập lại mật khẩu</label>
                        <input id="password_confirm" name="password_confirm" type="password" placeholder="Nhập lại mật khẩu" class="form-control">
                        <div class="form-eye">
                            <span id="show_password_confirm" class="toggle-password" onclick="togglePasswordConfirm()"><i class="fa-regular fa-eye"></i> </span>
                            <span id="hide_password_confirm" class="toggle-password" onclick="togglePasswordConfirm()"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                    </div> 
                    <div class="form-group edit-account-e" id="edit-account-e">
                        <div style="display: flex;"><label for="" class="form-label">Trạng thái</label>
                        <div class="form-status" id="status-acv">
                            <span id="acv-circle"><i class="fa-solid fa-circle"></i></span>
                            <label for="">Hoạt động</label>
                        </div>
                        <div class="form-status" id="status-nonacv">
                            <span id="nonacv-circle"><i class="fa-solid fa-circle"></i></span>
                            <label for="">Khóa</label>
                        </div>
                        </div>

                    </div>
                    <button type="submit" class="form-submit add-account-e" id="signup-button">Đăng ký</button>
                    <button class="form-submit edit-account-e" id="btn-update-account"><i class="fa-regular fa-floppy-disk"></i> Lưu thông tin</button>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php 
    require_once('footer.php');
?>

<script>
    function closeForm() {
        document.querySelector(".signup").classList.remove("open");
    }

    document.getElementById('btn-reset-order').addEventListener("click",function(e) {
        e.preventDefault();
        window.location.href = '?module=admin&action=homeCustomers';
    });

    $(document).ready(function() {
        $('#signup-form').submit(function(event) {
        // Xác định nút button được nhấp
        var element = document.getElementById("signup-button");

        var displayStyle = window.getComputedStyle(element).getPropertyValue('display');

        // Kiểm tra nút button và xử lý tương ứng
        if (displayStyle === 'block') {
            // Thực hiện hành động cho nút "Thêm sản phẩm"
            event.preventDefault(); // Ngăn chặn form gửi đi một cách thông thường
            var formData = new FormData(this);

            // Gửi request AJAX
            $.ajax({
                url: '/LT_Web2/modules/admin/addCustomer.php',
                type: 'POST',
                data: formData,
                processData: false, // Ngăn chặn jQuery chuyển đổi dữ liệu thành chuỗi query
                contentType: false, // Không thiết lập header Content-Type
                success: function(response) {
                    alert(response); // Hiển thị cửa sổ cảnh báo với thông báo thành công

                    if(response === 'Thêm khách hàng thành công.'){
                        window.location.href = '?module=admin&action=homeCustomers';
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.responseText); // Hiển thị cửa sổ cảnh báo với thông báo lỗi
                }
            });
        } else {
            event.preventDefault(); // Ngăn chặn form gửi đi một cách thông thường
            var formData = new FormData(this);
            
            // Lấy giá trị của data-customer-id từ nút submit
            var customerId = $(this).find('#btn-update-account').data('customer-id');
            formData.append('customer_id', customerId); // Thêm customer_id vào formData

            // Lấy phần tử có class "form-status" và id "status-acv"
            var statusForm = document.getElementById("status-acv");

            // Kiểm tra xem phần tử có class "open" hay không
            if (statusForm.classList.contains("open")) {
                formData.append('status', 1); // Thêm customer_id vào formData
            } else {
                formData.append('status', 0); // Thêm customer_id vào formData
            }
            // Gửi request AJAX
            $.ajax({
                url: '/LT_Web2/modules/admin/editCustomer.php',
                type: 'POST',
                data: formData,
                processData: false, // Ngăn chặn jQuery chuyển đổi dữ liệu thành chuỗi query
                contentType: false, // Không thiết lập header Content-Type
                success: function(response) {
                    alert(response); // Hiển thị cửa sổ cảnh báo với thông báo thành công
                    if(response === 'Thay đổi thông tin khách hàng thành công.'){
                        window.location.href = '?module=admin&action=homeCustomers';
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.responseText); // Hiển thị cửa sổ cảnh báo với thông báo lỗi
                }
            });
        }

            
        });
    });

    function editCustomer(id) {
        document.querySelector(".signup").classList.add("open");
        document.querySelectorAll(".add-account-e").forEach(item => {
            item.style.display = "none"
        })
        document.querySelectorAll(".edit-account-e").forEach(item => {
            item.style.display = "block"
        })
        document.getElementById("signup-button").type = "button";
        document.getElementById("btn-update-account").type = "submit";
        $.ajax({
            url: '/LT_Web2/modules/admin/getInfoCustomer.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                var customer = JSON.parse(response);

                document.getElementById("fullname").value = customer.FullName;
                document.getElementById("phonenumber").value = customer.PhoneNumber;
                document.getElementById("address").value = customer.Address;
                if(customer.Status == 1){
                    document.getElementById("status-acv").classList.add("open");
                    document.getElementById("status-nonacv").classList.remove("open");
                } else {
                    document.getElementById("status-acv").classList.remove("open");
                    document.getElementById("status-nonacv").classList.add("open");
                }
                document.getElementById("btn-update-account").setAttribute("data-customer-id", id);
            }
        }); 
    }

    function openCreateAccount() {
        resetFormData();
        document.querySelector(".signup").classList.add("open");
        document.querySelectorAll(".edit-account-e").forEach(item => {
            item.style.display = "none"
        })
        document.querySelectorAll(".add-account-e").forEach(item => {
            item.style.display = "block"
        })
    }

    // Hàm để reset dữ liệu
    function resetFormData() {
        document.getElementById("fullname").value = "";
        document.getElementById("phonenumber").value = "";
        document.getElementById("address").value = "";
        document.getElementById("signup-button").type = "submit";
        document.getElementById("btn-update-account").type = "button";
        // document.getElementById("product-form").attr('id', 'add-product-form');
    }

    var checkAcv = document.getElementById("status-acv");
    var checkNonAcv = document.getElementById("status-nonacv");
    
    checkAcv.onclick = function () {
            checkNonAcv.classList.remove("open");
            checkAcv.classList.add("open");
            sttUs = 1;
        };
    checkNonAcv.onclick = function () {
            checkAcv.classList.remove("open");
            checkNonAcv.classList.add("open");
            sttUs = 0;
        };
</script>