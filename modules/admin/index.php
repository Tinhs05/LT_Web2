
<?php 
    if(!defined('_CODE')){
        die('Access denied...');
    }
require_once('header.php');


?>

        <main class="content">
            <!-- <div class="section active embrace">
                <h1 class="page-title">Trang tổng quát của Halo Store</h1>
                <div class="cards">
                    <div class="card-single fade">
                        <div class="box">
                            <h2 id="amount-user">0</h2>
                            <div class="on-box">
                                <img src="./templates/assets/khach-hang.jpg" alt="" style=" width: 450px;">
                                <h3>Khách hàng</h3>
                                <p>Khách hàng mục tiêu là một nhóm đối tượng khách hàng trong phân khúc thị trường mục
                                    tiêu mà doanh nghiệp bạn đang hướng tới. </p>
                                
                            </div>

                        </div>
                    </div>
                    <div class="card-single fade">
                        <div class="box">
                            <div class="on-box">
                                <img src="./templates/assets/image/sản phẩm.webp" alt="" style=" width: 450px;">
                                <h2 id="amount-product">0</h2>
                                <h3>Sản phẩm</h3>
                                <p>Sản phẩm là bất cứ cái gì có thể đưa vào thị trường để tạo sự chú ý, mua sắm, sử dụng
                                    hay tiêu dùng nhằm thỏa mãn một nhu cầu hay ước muốn. Nó có thể là những vật thể,
                                    dịch vụ, con người, địa điểm, tổ chức hoặc một ý tưởng.</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-single fade">
                        <div class="box">
                            <div class="on-box">
                                <img src="./templates/assets/đơn hàng.jpg" alt="" style=" width: 450px;">
                                <h2 id="amount-product">0</h2>
                                <h3>Đơn hàng</h3>
                                <p>Đơn hàng luôn được đóng gói cẩn thận, tỉ mỉ, đẹp mắt khi tới tay khách hàng.</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-single fade">
                        <div class="box">
                            <h2 id="doanh-thu">$5020</h2>
                            <div class="on-box">
                                <img src="./templates/assets/doanh thu.png" alt="" style=" width: 450px; height: 300px;">
                                <h3>Doanh thu</h3>
                                <p>Doanh thu của doanh nghiệp là toàn bộ số tiền sẽ thu được do tiêu thụ sản phẩm, cung
                                    cấp dịch vụ với sản lượng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <?php 
            if(isset($_GET['action'])){
                switch ($_GET['action']) {
                    case 'listUser':
                        require_once('homeCustomer.php');
                        break;
                    case 'listOrder':
                        require_once('homeOrders.php');
                        break;
                    case 'statistic':
                        require_once('homeStatistic.php');
                        break;
                    default:
                        require_once('homeProducts.php');
                        break;
                }
            } else {
                require_once('homeProducts.php');
            }
            ?>
        </main>
    </div>
    <!-- <div class="modal-fillter-date">
        <form action="" class="fillter-date" id="fillter-date">
            <button type="button" id="fillter-date-close" class="fillter-close"><i class="fa-regular fa-xmark"></i></button>
                <div class="opt-date">
                    <div>Từ:</div>
                    <select id="daystart" name="day"></select>
            
                    <select id="monthstart" name="month"></select>
            

                    <select id="yearstart" name="year"></select>
            
                    <div>Đến:</div>
                    
                    <select id="dayend" name="day"></select>
            
                    <select id="monthend" name="month"></select>
            

                    <select id="yearend" name="year"></select>
                 </div>

                <div class="acp-date"><button type="button" class="btn-acp-date acp-date-cus" id="btn-acp-date-cus" onclick="ApplyDateCus()" ><i class="fa-regular fa-filter"></i> Áp dụng</button></div>
                <div class="acp-date"><button type="button" class="btn-acp-date acp-date-od" id="btn-acp-date-od" onclick="ApplyDateOd()" ><i class="fa-regular fa-filter"></i> Áp dụng</button></div>
                <div class="acp-date"><button type="button" class="btn-acp-date acp-date-tk" id="btn-acp-date-tk" onclick="ApplyDateTk()" ><i class="fa-regular fa-filter"></i> Áp dụng</button></div>

        </form>

    </div> -->
    <!-- modal add-product -->
    <!-- modal detail-order -->
    <div class="modal detail-order">
        <div class="modal-container">
            <h3 class="modal-container-title">CHI TIẾT ĐƠN HÀNG</h3>
            <button class="modal-close"><i class="fa-regular fa-xmark"></i></button>
            <div class="modal-detail-order">
            </div>
            <div class="modal-detail-bottom">               
            </div>
            </form>
        </div>
    </div>
    <div class="modal detail-order-product">

        <div class="modal-container">
            <h2>THỐNG KÊ CHI TIẾT</h2>
            <button class="modal-close"><i class="fa-regular fa-xmark"></i></button>
            <div class="table">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Mã đơn</td>
                            <td>Tên áo</td>
                            <td>Size</td>
                            <td>Số lượng</td>
                            <td>Đơn giá</td>
                            <td>Ngày đặt</td>
                        </tr>
                    </thead>
                    <tbody id="show-product-order-detail">
                    </tbody>
                </table>
            </div>
            </form>
        </div>
    </div>

    <!-- Add or Edit Users -->
    <!-- <div class="modal signup">
        <div class="modal-container">
            <h3 class="modal-container-title add-account-e">THÊM KHÁCH HÀNG MỚI</h3>
            <h3 class="modal-container-title edit-account-e">CHỈNH SỬA THÔNG TIN</h3>

            <button class="modal-close"><i class="fa-regular fa-xmark"></i></button>
            <div class="form-content sign-up">
                <form action="?module=admin&action=manager" method="post" class="signup-form">
                    <div class="form-group">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input id="fullname" name="fullname" type="text" placeholder="VD: Nguyễn Văn Long" class="form-control">
                        <?php echo empty($errors['fullname']['required']) ? '':'<p class="message fullnameSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['fullname']['required'].'</p>' ?>
                        <?php echo empty($errors['fullname']['min_length']) ? '':'<p class="message fullnameSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['fullname']['min_length'].'</p>' ?>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="text" placeholder="VD: ngvlong202@gmail.com" class="form-control">
                        <?php echo empty($errors['email']['required']) ? '':'<p class="message emailSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['email']['required'].'</p>' ?>
                        <?php echo empty($errors['email']['unique']) ? '':'<p class="message emailSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['email']['unique'].'</p>' ?>
                    </div>
                    <div class="form-group">
                        <label for="phonenumber" class="form-label">Số điện thoại</label>
                        <input id="phonenumber" name="phonenumber" type="text" placeholder="Nhập số điện thoại" class="form-control">
                        <?php echo empty($errors['phonenumber']['required']) ? '':'<p class="message phonenumberSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['phonenumber']['required'].'</p>' ?>
                        <?php echo empty($errors['phonenumber']['invalid']) ? '':'<p class="message phonenumberSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['phonenumber']['invalid'].'</p>' ?>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input id="address" name="address" type="text" placeholder="VD: 273 An Dương Vương, Quận 5" class="form-control">
                        <?php echo empty($errors['address']['required']) ? '':'<p class="message addressSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['address']['required'].'</p>' ?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                        <div class="form-eye">
                            <span id="showPassword" class="toggle-password" onclick="togglePassword()"><i class="fa-regular fa-eye"></i> </span>
                            <span id="hidePassword" class="toggle-password" onclick="togglePassword()"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                        <?php echo empty($errors['password']['required']) ? '':'<p class="message passwordSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['password']['required'].'</p>' ?>
                        <?php echo empty($errors['password']['min_length']) ? '':'<p class="message passwordSign" style="color: red;font-size: 12px;margin-top: -7px;margin-left: 176px;">'.$errors['password']['min_length'].'</p>' ?>
                    </div>   
                    <div class="form-group edit-account-e" id="edit-account-e">
                        <div style="display: flex;"><label for="" class="form-label">Trạng thái</label>
                        <div class="form-status" id="status-acv">
                            <span id="acv-circle"><i class="fa-solid fa-circle"></i></span>
                            <label for="">Hoạt động</label>
                        </div>
                        <div class="form-status" id="status-nonacv">
                            <span id="nonacv-circle"><i class="fa-solid fa-circle"></i></span>
                            <label for="">Tắt hoạt động</label>
                        </div>
                        </div>

                    </div>
                    <button type="submit" class="form-submit add-account-e" id="signup-button">Đăng ký</button>
                    <button type="submit" class="form-submit edit-account-e" id="btn-update-account"><i class="fa-regular fa-floppy-disk"></i> Lưu thông tin</button>
                </form>
            </div>
        </div>
    </div> -->
    </div>

<?php 
    require_once('footer.php');
?>