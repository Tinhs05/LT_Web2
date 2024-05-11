<?php
if (!defined('_CODE')) {
    die('Access denied...');
}
?>

<!-- Header -->
<?php
require_once(_WEB_PATH_TEMPLATES . '/layout/header.php');
?>

<body>
    <div class="header">
        <div class="headbox" id="headbox">
            <!-- <div><picture></picture></div> -->

            <div class="headleft">
                <div><img src="./templates/assets/logoStore.png" id="logo"></div>
            </div>
            <form class="headcenter" class="form-search">
                <span class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
                <input type="text" id="form-search-product" type="text" class="form-search-input inputsearch" placeholder="TÌm kiếm sản phẩm" value="">
                <span type="button" class="filter-btn"><a href="#"><i class="fa-light fa-filter-list"></i>Lọc</a></span>
            </form>
            <div class="headerright">
                <div class="headerright-click ">
                    <div id="AccountLogin">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '<button  id="btnAccount"><a href="?module=auth&action=account-centre" style="color: #333; text-decoration: none;"><i class="fa-regular fa-user" style="margin: 0 10px 0 0"></i>' . $_SESSION['user-Name'] . '</a></button>';
                        } else {
                            echo '<button><a href="?module=auth&action=login" style="color: #333; text-decoration: none;">Đăng nhập</a></button>';
                        }
                        ?>
                    </div>
                    <div class="header-middle-right-menu">
                        <ul class="header-middle-right">
                        </ul>
                    </div>
                </div>
                <div class="headerright-click"><button onclick="openCart()"> <i class="fa-regular fa-cart-shopping"></i></button></div>
            </div>
        </div>
        <div class="lowmenu">
            <div class=""> <button type="button"><i class="fa-regular fa-house"></i><a href="?module=user">Trang chủ</a></button></div>
            <div class="" data-catelogy="3"> <button>Áo sơ mi</button></div>
            <div class="" data-catelogy="1"> <button>Áo thun</button></div>
            <div class="" data-catelogy="5"> <button>Áo Khoác</button></div>
            <div class="" data-catelogy="4"> <button>Áo Polo</button></div>
            <div class="" data-catelogy="2"> <button>Áo Hoodie</button></div>
        </div>
        <div class="advanced-search">
            <div class="container">
                <div class="advanced-search-category">
                    <span>Phân loại </span>
                    <select name="" id="advanced-search-category-select" onchange="searchProducts()">
                        <option>Tất cả</option>
                        <option>Áo Sơ mi</option>
                        <option>Áo Thun</option>
                        <option>Áo Khoác</option>
                        <option>Áo polo</option>
                        <option>Áo Hoodie</option>
                        <option>Sale</option>
                    </select>
                </div>
                <div class="advanced-search-price">
                    <div id="price-range">
                        <label for="min-price">Giá :</label>
                        <input type="text" id="min-price" readonly> - <input type="text" id="max-price" readonly>
                    </div>
                    <div>
                        <button id="filter-price" onclick="filterProductPrice()"><i class="fa-light fa-filter-circle-dollar"></i></button>
                    </div>
                </div>

                <div class="advanced-search-control">
                    <button id="sort-ascending" onclick="searchProducts(1)"><i class="fa-regular fa-arrow-up-short-wide"></i></button>
                    <button id="sort-descending" onclick="searchProducts(2)"><i class="fa-regular fa-arrow-down-wide-short"></i></button>
                    <button id="reset-search" onclick="searchProducts(0)"><i class="fa-light fa-arrow-rotate-right"></i></button>
                    <button onclick="closeSearchAdvanced()"><i class="fa-light fa-xmark"></i></button>
                </div>
            </div>
        </div>

    </div>
    <div class="head-img" id="head-img">
        <button class="slide-img"><img src="./templates/assets/slide1.webp" alt=""></button>
        <button class="slide-img"><img src="./templates/assets/slide2.webp" alt=""></button>
    </div>

    <div>
        <div class="home-title-block" id="home-title">
            <h2 class="home-title">Khám phá sản phẩm của chúng tôi</h2>
        </div>
        <div class="container-products">
            <div class="home-products" id="home-products">
            </div>
            <div class="page-nav">
                <ul class="page-nav-list">
                </ul>
            </div>
        </div>

    </div>
    <div id="div_detail"></div>
    <div id="show-imgSize">
        <div class="modal-img">
            <button type="button" id="img-size-close"><i class="fa-regular fa-xmark"></i></button>
            <div id="imgModal">
                <img src="./templates/assets/bảng size.webp" alt="">
            </div>
        </div>
    </div>

    <div class="detail-order">
        <div class="modal-container">
            <h3 class="modal-container-title">CHI TIẾT ĐƠN HÀNG</h3>
            <button class="modal-close"><i class="fa-regular fa-xmark"></i></button>
            <div class="modal-detail-order">
            </div>
            </form>
        </div>
    </div>
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
                    <div class="cart-left">
                        <table>
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Phân loại</td>
                                    <td>Giá</td>
                                    <td>Số lượng</td>
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
    <div id="advertise"></div>
    <!-- <div class="footter-wrapper">
        <h2>CHÍNH SÁCH ĐỔI TRẢ</h2>

        <h4>Nhằm giúp quý khách an tâm chọn lựa cho mình một sản phẩm ưng ý nhất và phục vụ khách hàng chu đáo,
            Hades thông báo chương trình đổi trả cho các sản phẩm và đơn hàng như sau:</h4>
        <div class="content-wrapper">
            <h3>1. Thời gian đổi trả</h3>
            <p>Trong vòng 03 ngày được tính kể từ ngày mua hàng (tại cửa hàng) hoặc ngày nhận hàng (khi mua online).
            </p>
            <h3> 2. Điều kiện đổi trả</h3>
            <p>
                Khách hàng chỉ có thể đổi sản phẩm khi đáp ứng đủ 03 điều kiện sau: <br>
                - Thời gian mua hàng không quá 03 ngày.<br>

                - Phải có hóa đơn mua hàng.<br>

                - Sản phẩm phải còn nguyên vẹn, nguyên nhãn mác, mã vạch , chưa qua sử dụng, giặt ủi, không có mùi
                lạ và chưa sửa chữa.<br>

                - Sản phẩm không nằm trong các chương trình ưu đãi, giảm giá.<br>
            </p>
            <h3>3. Quy trình đổi trả</h3>
            <p>
                Cùng mã sản phẩm: Chỉ đổi size, không đổi màu <br>

                (Tham khảo) [Dưới đây là phần tham khảo về quy trình đổi trả:<br>

            <h4>+ Đổi tại cửa hàng:</h4>

            Bước 1: Gửi mail về địa chỉ halostore@gmail.com để được hỗ trợ<br>

            Bước 2: Đóng gói sản phẩm cẩn thận có kèm hóa đơn mua hàng, mã vận chuyển (nếu mua online)<br>

            Bước 3: Đến trực tiếp cửa hàng Hades để nhân viên hỗ trợ đổi sản phẩm.<br>

            <h4>+ Đổi hàng qua chuyển phát nhanh:</h4>

            Bước 1: Gửi mail về địa chỉ halostore@gmail.com để được hỗ trợ<br>

            Bước 2: Đóng gói sản phẩm cẩn thận có kèm hóa đơn mua hàng, mã vận đơn (nếu mua Online)<br>

            Bước 3: Gửi hàng về địa chỉ: 273 Đ. An Dương Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh.<br>

            Bước 4: Nhận lại sản phẩm đổi hàng theo đường chuyển phát nhanh.<br>

            <h3>Lưu ý:<br></h3>

            - Hades chỉ hỗ trợ tối đa một sản phẩm được đổi một lần, không hỗ trợ đổi hàng đối với sản phẩm đã đổi
            một lần trước đó<br>

            - Hades chỉ hỗ trợ đổi Sản phẩm trong cùng một mã sản phẩm. Trường hợp trên Hades chỉ đổi size, không
            đổi màu.<br>

            - Hades chỉ miễn phí đổi hàng trong trường hợp bị lỗi từ nhà sản xuất, giao nhầm hàng trong vòng 1
            tháng.<br>
            </p>
        </div>
    </div>
    <div class="footter-wrapper giudeShoping">
        <h2>CHÍNH SÁCH GIAO NHẬN - VẬN CHUYỂN</h2>

        <h4>Halo Store thực hiện giao hàng tới tất cả các tỉnh thành trên toàn quốc cho khách hàng đã đặt hàng
            online tại website chúng tôi</h4>


        <h3>1. Thời gian vận chuyển</h3>

        Đơn hàng của quý khách sẽ được Hades chuẩn bị và giao hàng trong vòng từ 2 - 5 ngày làm việc, tùy thuộc vào
        khoảng cách địa lý hoặc yêu cầu của quý khách. <br>

        - Đơn hàng có thể được gửi tới địa chỉ do quý khách chọn (nhà riêng, cơ quan).<br>

        <h3>2. Phí vận chuyển:</h3>

        Phí vận chuyển của đơn hàng được tính theo địa điểm nhận hàng của quý khách hàng, thường dao động trong
        khoảng 20.000 - 30.000 đồng tùy theo khu vực. <br>

        Quý khách hàng vui lòng thanh toán mọi chi phí liên quan tới tiền vận chuyển theo cách thức sau:<br>

        + Thanh toán trực tiêp phí vận chuyển cho nhân viên vận chuyển hàng hóa.<br>

        Quý khách hàng có thể kiểm tra trực tiếp phí vận chuyển khi tiến hành đặt hàng tại trang thanh toán<br>

        <h3>3. Tra cứu thông tin & Liên hệ</h3>

        Để kiểm tra thông tin, trạng thái đơn hàng, quý khách vui lòng gửi mail tới địa chỉ halostore@gmail.com hoặc
        kiểm tra lịch sử đơn hàng trong thông tin tài khoản.<br>
    </div>
    <div class="footter-wrapper giudeShoping">
        <h2>HƯỚNG DẪN MUA HÀNG</h2>

        <h4> HADES nhận giao hàng hàng toàn quốc. Quý Khách hàng có thể mua hàng trực tiếp tại shop hoặc đặt hàng
            trên Website chính thức www.hades.vn theo các bước sau:</h4>
        <div class="content-wrapper">

            <h4>BƯỚC 1: TÌM SẢN PHẨM MONG MUỐN</h4>

            <h4>Quý Khách hàng có thể tìm kiếm bằng 2 hình thức sau:</h4>

            - Tìm kiếm theo tên/ mã sản phẩm: nhấp vào biểu tượng kính lúp ở góc phải, nhập từ khoá tìm kiếm vào ô
            tìm kiếm và gõ ENTER hoặc Nhấp vào vào biểu tượng kính lúp. <br>

            - Tìm kiếm theo nhóm sản phẩm: Rê chuột vào các mục sản phẩm trên menu chính, các mục sản phẩm bao gồm:
            Tops, Bottoms, Outerwear, Hat, Bags xuất hiện. Nhấp vào vào từng mục sẽ hiện ra chi tiết nhóm sản phẩm
            Quý Khách hàng muốn tìm.<br>

            <h4>BƯỚC 2: THÊM SẢN PHẨM CẦN MUA VÀO GIỎ HÀNG</h4>

            - Sau khi đã tìm được sản phẩm Quý Khách hàng mong muốn và tham khảo đầy đủ hình ảnh, mô tả kèm theo,
            hãy thực hiện thao tác chọn size, số lượng cần mua rồi Nhấp vào THÊM VÀO GIỎ để thêm sản phầm vào giỏ
            hàng hoặc MUA NGAY.<br>

            - Góc phải màn hình sẽ hiện danh sách sản phẩm đang có trong giỏ hàng và tổng số tiền tạm tính. Nhấp vào
            XEM GIỎ HÀNG nếu muốn kiểm tra đầy đủ giỏ hàng, Nhấp vàoTHANH TOÁN nếu đã chọn đủ món hàng mong muốn
            hoặc nhấp “Tiếp tục mua hàng” ở góc phải màn hình để tiếp tục mua hàng.<br>

            - Quý Khách hàng có thể nhấn vào biểu tượng thùng rác ở bên dưới “Thành tiền” để loại bỏ sản phẩm mình
            không muốn mua ra khỏi giỏ hàng.<br>

            <h4>BƯỚC 3: KIỂM TRA GIỎ HÀNG VÀ TIẾN HÀNH ĐẶT HÀNG</h4>

            - Kiểm tra lại thông tin đầy đủ về sản phẩm muốn đặt mua.<br>

            - Điền mã giảm giá (nếu có) của Quý Khách hàng vào khung MÃ GIẢM GIÁ và nhấp vào SỬ DỤNG.<br>

            - Điền đầy đủ thông tin giao hàng của Quý Khách hàng bao gồm Họ và tên, Email, Số điện thoại, Địa chỉ.
            Nếu đã có đăng ký tài khoản từ trước hãy nhấp vào ĐĂNG NHẬP.<br>

            - Kiểm tra lại tất cả thông tin đã nhập, sau khi đã chắc chắn thì Nhấp vào TIẾP TỤC ĐẾN PHƯƠNG THỨC
            THANH TOÁN để chuyển sang bước tiếp theo.<br>

            <h4>BƯỚC 4: CHỌN PHƯƠNG THỨC VẬN CHUYỂN</h4>

            Sau khi Quý Khách hàng nhập đầy đủ thông tin trong phần thông tin giao hàng, căn cứ vào địa chỉ nhận
            hàng và tổng giá trị đơn hàng, Website sẽ tự động đưa ra các phí vận chuyển cho Quý Khách hàng.<br>

            Mức phí vận chuyển tùy theo từng khu vực giao động từ 30.000 (VNĐ) đến 40.000 (VNĐ)<br>

            <h4>BƯỚC 5: CHỌN PHƯƠNG THỨC THANH TOÁN</h4>

            Sau khi Quý Khách hàng nhập đầy đủ thông tin trong phần thông tin giao hàng, căn cứ vào địa chỉ nhận
            hàng và tổng giá trị đơn hàng, Website sẽ tự động đưa ra phương thức thanh toán cho Quý Khách hàng.<br>

            Cụ thể là thanh toán khi nhận hàng (COD): Quý Khách hàng thanh toán cho nhân viên giao hàng tại thời
            điểm nhận hàng.<br>

            <h4>BƯỚC 6: HOÀN TẤT ĐƠN HÀNG</h4>

            Quý Khách hàng nhấn vào nút HOÀN TẤT ĐƠN HÀNG sau khi đã hoàn thành các bước trên và kiểm tra thật kỹ
            tất cả các thông tin đơn hàng, phương thức vận chuyển, phương thức thanh toán.<br>

            Quý Khách hàng có thể theo dõi trạng thái đơn hàng của Quý Khách hàng tại mục KIỂM TRA ĐƠN HÀNG ở góc
            dưới màn hình Website hoặc Quý Khách hàng vui lòng gửi mail tới địa chỉ halostore@gmail.com hoặc nhắn
            tin với bộ phận hỗ trợ của Hades trên Facebook & Instagram.<br>
        </div>
    </div>

    <div class="footter-wrapper listTableSize">
        <h2>Bảng Size</h2>
        <div>
            <h3>1. Áo Sơ mi</h3>
            <div class="table-size"><img src="./templates/assets/bảng size sơ mi.webp" alt=""></div>
        </div>
        <div>
            <h3>2. Áo Thun</h3>
            <div class="table-size"><img src="./templates/assets/bảng size áo thun.webp" alt=""></div>
        </div>
        <div>
            <h3>3. Áo Polo</h3>
            <div class="table-size"><img src="./templates/assets/bảng size.webp" alt=""></div>
        </div>
        <div>
            <h3>4. Áo Hoodie</h3>
            <div class="table-size"><img src="./templates/assets/bảng size hoodie.webp" alt=""></div>
        </div>
        <div>
            <h3>5. Áo Khoác</h3>
            <div class="table-size"><img src="./templates/assets/bảng size áo khoác.webp" alt=""></div>
        </div>
    </div> -->


    <div class="footter">
        <div class="footter-left">
            <ul>
                <h3>ABOUT US</h3>
                <li class="list-aboutus"><a href="#">Chính sách đổi trả</a></li>
                <li class="list-aboutus"><a href="#">Chính sách giao nhận - vận chuyển</a></li>
                <li class="list-aboutus"><a href="#">Hướng dẫn mua hàng</a></li>
                <li class="list-aboutus"><a href="#">Bảng size</a></li>
            </ul>
        </div>
        <div class="footter-center">
            <ul>
                <h3>FOLLOW US ON SOCIAL MEDIA</h3>
                <li><span><a href=""><i class="fa-brands fa-tiktok"></i></a></span></li>
                <li><span><a href=""><i class="fa-brands fa-instagram"></i></a></span></li>
                <li><span><a href=""><i class="fa-brands fa-facebook"></i></a></span></li>
            </ul>
        </div>
        <div class="footter-right">
            <ul>
                <h3>THÔNG TIN LIÊN HỆ</h3>
                <li><span>Số CSKH: 0833197999</span></li>
                <li><span>Email: halostore@gmail.com</span></li>
                <li><span>Địa chỉ cửa hàng: 273 Đ. An Dương Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</span>
                </li>
            </ul>
        </div>
    </div>
</body>

<!-- Footer -->

<?php
require_once(_WEB_PATH_TEMPLATES . '/layout/footer.php');
?>