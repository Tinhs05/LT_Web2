<style>
.statistic {
    color: var(--light-gray);
    background-color: var(--lightest-gray);
}
</style>
<?php
if(!defined('_CODE')){
    die('Access denied...');
}
require_once('header.php');
?>

<div class="section tk active admin-all">
    <div class="admin-control">
        <div class="admin-control-left">
            <select name="the-loai-tk" id="the-loai-tk" onchange="thongKe()">
                <option>Tất cả</option>
                <option>Áo Thun</option>
                <option>Áo Polo</option>
                <option>Áo Sơ mi</option>
                <option>Áo Khoác</option>
                <option>Áo Hoodie</option>
                <option>Đã xóa</option>
            </select>
        </div>
        <div class="admin-control-center">
            <form action="" class="form-search">
                <span class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
                <input id="form-search-tk" type="text" class="form-search-input" placeholder="Tìm kiếm tên áo..." oninput="thongKe()">
                <!-- <span id="filter-Money"><i class="fa-sharp fa-light fa-filter-circle-dollar"></i></span> -->
            </form>
        </div>
        <div class="admin-control-right">
            <button  class="btn-fillter-date" id="btn-fillter-tk"><i class="fa-light fa-calendar-lines-pen"></i>Lọc theo ngày</button>    
            <div class="form-gr-info" style="display: flex;">
                <div class="form-info">
                    <button class="btn-reset-order btn-up-quatity" id="btn-up-quatity" onclick="thongKe(1)"><i class="fa-regular fa-arrow-up-short-wide"></i></button>
                    <div class="mess-info info-up-quatity">Sắp xếp theo số lượng bán tăng dần</div>
                </div> 
                <div class="form-info">
                    <button class="btn-reset-order btn-down-quatity" id="btn-down-quatity"  onclick="thongKe(2)"><i class="fa-regular fa-arrow-down-wide-short"></i></button>
                    <div class="mess-info info-down-quatity">Sắp xếp theo số lượng bán giảm dần</div>
                </div>
            </div> 

            <div class="form-gr-info" >
                <div class="form-info">
                    <button class="btn-reset-order btn-up-quatity" id="btn-up-quatity" onclick="thongKe(3)"><i class="fa-regular fa-chart-line-up"></i></button>
                    <div class="mess-info info-up-quatity">Sắp xếp theo doanh thu tăng dần</div>
                </div> 
                <div class="form-info">
                    <button class="btn-reset-order btn-down-quatity" id="btn-down-quatity"  onclick="thongKe(4)"><i class="fa-regular fa-chart-line-down"></i></button>
                    <div class="mess-info info-down-quatity">Sắp xếp theo doanh thu giảm dần</div>
                </div>
            </div>


            
            <button class="btn-reset-order" id="btn-reset-tk" onclick="thongKe(0)"><i class="fa-light fa-arrow-rotate-right"></i>Làm mới</button>                    
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
    <div class="table">
        <table width="100%">
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Tên áo</td>
                    <td>Phân loại</td>
                    <td>Số lượng bán</td>
                    <td>Doanh thu</td>
                    <td>Chi tiết</td>
                </tr>
            </thead>
            <tbody id="showTk">
            </tbody>
        </table>

    </div>
    <!-- <div id="column-chart" class="chart-container">
        
    </div> -->
</div>

<?php 
    require_once('footer.php');
?>